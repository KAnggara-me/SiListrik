<?php

use App\Models\Webhook;

/**
 * Make a request to API KirimWA.id
 *
 * @param Array $params
 * @return Array
 * @throws Exception
 */
if (!function_exists('apiKirimWaRequest')) {
  function apiKirimWaRequest(array $params)
  {
    $httpStreamOptions = [
      'method' => $params['method'] ?? 'GET',
      'header' => [
        'Content-Type: application/json',
        'Authorization: Bearer ' . ($params['token'] ?? '')
      ],
      'timeout' => 15,
      'ignore_errors' => true
    ];

    if ($httpStreamOptions['method'] === 'POST') {
      $httpStreamOptions['header'][] = sprintf('Content-Length: %d', strlen($params['payload'] ?? ''));
      $httpStreamOptions['content'] = $params['payload'];
    }

    // Join the headers using CRLF
    $httpStreamOptions['header'] = implode("\r\n", $httpStreamOptions['header']) . "\r\n";

    $stream = stream_context_create(['http' => $httpStreamOptions]);
    $response = file_get_contents($params['url'], false, $stream);

    // Headers response are created magically and injected into
    // variable named $http_response_header
    $httpStatus = $http_response_header[0];

    preg_match('#HTTP/[\d\.]+\s(\d{3})#i', $httpStatus, $matches);

    if (!isset($matches[1])) {
      throw new Exception('Can not fetch HTTP response header.');
    }

    $statusCode = (int)$matches[1];
    if ($statusCode >= 200 && $statusCode < 500) {
      return ['body' => $response, 'statusCode' => $statusCode, 'headers' => $http_response_header];
    }

    throw new Exception($response, $statusCode);
  }
}

/**
 * Generate Token
 *
 * @return string
 */
if (!function_exists('tokenGen')) {
  function tokenGen($length = 10)
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
}

/**
 * Send notif to user
 * @param String $token
 * @param Number $receiver
 * @param String $username
 * @param String $msg
 * @param Boolean $isGroup
 * @param String $type
 * @return string
 */
if (!function_exists('notifWa')) {
  function notifWa($token, $reciver, $username, $msg, $isGroup = false, $type = "text", $caption = null)
  {
    try {
      $reqParams = [
        "token" => $token,
        "url" => "https://api.kirimwa.id/v1/messages",
        "method" => "POST",
        "payload" => json_encode([
          "message" => $msg,
          "caption" => $type != "image" ? $caption : null,
          "device_id" => $username,
          "message_type" => $type,
          "phone_number" => $reciver,
          "is_group_message" => $isGroup,
        ])
      ];
      $response = apiKirimWaRequest($reqParams);
      $response = json_decode($response['body'], true);
      if ($response) {
        $webhook = new Webhook();
        $webhook->id = $response['id'];
        $webhook->type = "send_message_response";
        $webhook->status = $response['status'];
        $webhook->device_id = $username;
        $webhook->phone_number = $reciver;
        $webhook->webhook_msg = $response['message'];
        $webhook->message = $msg;
        $webhook->save();
      }
      return $response;
    } catch (Exception $e) {
      print_r($e);
    }
  }
}
