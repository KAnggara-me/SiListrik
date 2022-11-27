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

function flame()
{
  $apiData = [];
  for ($i = 0; $i < 100; $i++) {
    array_push($apiData, 0);
  }
  array_push($apiData, 3);
  return $apiData[rand(0, count($apiData) - 1)];
}

function ampere()
{
  $min = 50;
  $max = 380;
  $hour = date('H') + 7;
  if ($hour > 18 || $hour < 6) {
    $min = 150;
    $max = 380;
  } else {
    $min = 0;
    $max = 200;
  }
  $d = rand($min, $max) / 100;
  return $d;
}

try {
  $value = [
    "api" => flame(),
    "arus" => ampere(),
    "asap" => rand(200, 310),
    "voltase" => rand(219, 222),
    "temperatur" => rand(250, 315) / 10,
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
