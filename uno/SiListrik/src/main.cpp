#include <Arduino.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>

const char* ssid = "KAnggara75v7";
const char* password = "duaakar3";

// Your Domain name with URL path or IP address with path
const char* serverName = "https://reqres.in/api/users/";
const char* serverGet = "https://reqres.in/api/users/2";

unsigned long lastTime = 0;
unsigned long timerDelay = 15000;

void setup() {
  Serial.begin(115200);

  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
  Serial.println("Connected to " + WiFi.SSID());
  Serial.println("MAC address: " + WiFi.macAddress());
  Serial.println("Signal strength: " + String(WiFi.RSSI()) + " dBm");
}

void getHttp() {
  String url = "https://reqres.in/api/users/2";
  HTTPClient http;
  http.begin(url);
  int httpCode = http.GET();

  if (httpCode > 0) {
    String payload = http.getString();
    Serial.println(payload);
  }
  else {
    Serial.println("Error on HTTP request");
  }
}

void loop() {
  getHttp();
  delay(5000);
}