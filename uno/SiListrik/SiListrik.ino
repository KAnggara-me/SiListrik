#include <PZEM004Tv30.h>

PZEM004Tv30 pzem(Serial2, 16, 17);

float current = 0.0;
float voltage = 220;

void setup() {
  Serial.begin(115200);
}

float getCurrent() {
  // Read the data from the sensor
  float ampere = pzem.current();

  // Check if the data is valid
  if (isnan(ampere)) {
    Serial.println("Error reading current");
    return current;
  } else {
    return ampere;
  }
}

float getVoltage() {
  // Read the data from the sensor
  float volt = pzem.voltage();

  // Check if the data is valid
  if (isnan(volt)) {
    Serial.println("Error reading Voltage");
    return voltage;
  } else {
    return volt;
  }
}

void loop() {
  // read Voltage
  voltage = getVoltage();
  current = getCurrent();
  Serial.println(voltage);
  Serial.println(current);
}
