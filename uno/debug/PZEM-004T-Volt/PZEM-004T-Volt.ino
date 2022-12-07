#include <PZEM004Tv30.h>

#define PZEM_RX_PIN 16
#define PZEM_TX_PIN 17
#define PZEM_SERIAL Serial2

PZEM004Tv30 pzem(PZEM_SERIAL, PZEM_RX_PIN, PZEM_TX_PIN);

void setup() {
  Serial.begin(115200);
}

void loop() {
  // Read the data from the sensor
  float voltage = pzem.voltage();

  // Check if the data is valid
  if (isnan(voltage)) {
    Serial.println("Error reading voltage");
  } else {
    Serial.println(voltage);
  }

  delay(2000);
}
