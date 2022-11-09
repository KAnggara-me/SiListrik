<?php

function pushData(array $params)
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


  if ($statusCode >= 200 && $statusCode < 300) {
    return ['body' => $response, 'statusCode' => $statusCode, 'headers' => $http_response_header];
  }

  throw new Exception($response, $statusCode);
}

try {

  $value = [
    "api" => 0,
    "arus" => rand(1, 360) / 100,
    "asap" => rand(200, 250),
    "voltase" => rand(215, 225),
    "temperatur" => rand(24, 30),
    "kelembaban" => rand(35, 80),
    "token" => "KitKat",
    "username" => "admina",
  ];
  $reqParams = [
    'url' => 'https://silistrik.apiwa.tech/api/v1/data',
    'method' => 'POST',
    'payload' => json_encode($value),
  ];

  $response = pushData($reqParams);
  echo $response['body'] . PHP_EOL;
} catch (Exception $e) {
  print_r($e);
}
