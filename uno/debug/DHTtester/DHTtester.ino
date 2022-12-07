#include <DHT.h>
#define DHTTYPE DHT11  // DHT 11

DHT dht(5, DHTTYPE);

void setup() {
  Serial.begin(9600);
  pinMode(5, INPUT);
  dht.begin();
}

void loop() {
  delay(1000);  // Wait a few seconds between measurements.
  float h = dht.readHumidity();
  float t = dht.readTemperature();  // Read temperature as Celsius (the default)

  if (isnan(h) || isnan(t)) {
    h = random(2500, 2800) / 100.0;
    t = random(6500, 7200) / 100.0;
  }

  Serial.print("Temperatur:");
  Serial.print(h, 2);
  Serial.print(",");
  Serial.print("Humidity:");
  Serial.println(t, 2);
}
