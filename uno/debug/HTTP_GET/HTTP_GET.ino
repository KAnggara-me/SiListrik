#include <WiFi.h>
#include <Arduino.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>

#include "config.h"

const char* ssid = WIFI_SSID;
const char* password = WIFI_PASS;

const String serverGet = "https://silistrik.apiwa.tech/api/v1/setting/";

const int LED = 2;
unsigned long prevMilis = 0;
unsigned int getTime = 1;
int relayState = 0;

void setup() {
  Serial.begin(115200);
  pinMode(LED, OUTPUT);
  delay(10);

  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

int getData() {
  String res;
  HTTPClient http;
  http.begin(serverGet + AdminId);
  int httpCode = http.GET();

  if (httpCode == 200) {
    res = http.getString();
    StaticJsonDocument<1024> json;
    deserializeJson(json, res);
    int relay = json["relay"];
    return relay;
  }

  return 0;
}

void loop() {
  long milis = millis() / 1000;

  // run every 3 s
  if (milis - prevMilis >= getTime) {
    prevMilis = milis;
    relayState = getData();
  }

  // check relay state
  if (relayState == 1) {
    digitalWrite(LED, HIGH);
  } else {
    digitalWrite(LED, LOW);
  }

  Serial.println(relayState);
  delay(500);
}
