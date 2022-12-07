#include <PZEM004Tv30.h>

PZEM004Tv30 pzem(Serial2, 16, 17);

void setup() {
  Serial.begin(115200);
}

void loop() {
  // Read the data from the sensor
  float current = pzem.current();

  // Check if the data is valid
  if (isnan(current)) {
    Serial.println("Error reading current");
  } else {
    Serial.println(current);
  }

  delay(2000);
}
