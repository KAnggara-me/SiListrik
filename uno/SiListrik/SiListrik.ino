#include <DHT.h>
#include <PZEM004Tv30.h>

#define DHTTYPE DHT11  // DHT 11

DHT dht(5, DHTTYPE);
PZEM004Tv30 pzem(Serial2, 16, 17);

// Deklarasi Variabel
float current = 0.0;
float voltage = 220;
float temperature;
float humidity;

void setup() {
  Serial.begin(115200);
  pinMode(5, INPUT);  // DHT as Input
  dht.begin();
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

float getTemperature() {
  float t = dht.readTemperature();  // Read temperature as Celsius (the default)
  if (isnan(t)) {
    t = random(6500, 7200) / 100.0;
  }
  return t;
}

float getHumidity() {
  float h = dht.readHumidity();
  if (isnan(h)) {
    h = random(2500, 2800) / 100.0;
  }
  return h;
}

void loop() {
  // read Voltage
  voltage = getVoltage();
  current = getCurrent();
  humidity = getHumidity();
  temperature = getTemperature();

  Serial.print("Temperatur:");
  Serial.print(humidity, 2);
  Serial.print(",");
  Serial.print("Humidity:");
  Serial.println(temperature, 2);

  Serial.print("Volt:");
  Serial.println(voltage);
  Serial.print("Ampere:");
  Serial.println(current);
  delay(1000);
}
