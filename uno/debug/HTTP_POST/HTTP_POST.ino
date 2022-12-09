#include <WiFi.h>
#include <Arduino.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>

#include "config.h"


const char* ssid = WIFI_SSID;
const char* password = WIFI_PASS;

const String admin = AdminId;
const String token = TokenId;

const String serverPost = "https://silistrik.apiwa.tech/api/v1/data";

unsigned long postMilis = 0;
unsigned int postTime = 30;

void setup() {
  Serial.begin(115200);
  wifiConnect();
}

void wifiConnect() {
  Serial.print("\n\nConnecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("\nWiFi connected");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
}

void postData() {
  Serial.println("Post Data");
  String param;
  String res;
  HTTPClient http;

  StaticJsonDocument<200> buff;

  buff["api"] = 0;
  buff["arus"] = 1;
  buff["asap"] = 250;
  buff["voltase"] = 222;
  buff["temperatur"] = 29;
  buff["kelembaban"] = 80;
  buff["token"] = token;
  buff["username"] = admin;

  serializeJson(buff, param);
  http.begin(serverPost);
  http.addHeader("Content-Type", "application/json");
  int statusCode = http.POST(param);
  res = http.getString();

  StaticJsonDocument<1024> json;
  deserializeJson(json, res);

  Serial.println(statusCode);
  Serial.println(res);
  Serial.println(param);
}

void loop() {
  long milis = millis() / 1000;

  if (milis - postMilis >= postTime) {
    postMilis = milis;
    postData();
  }

  delay(500);
}
