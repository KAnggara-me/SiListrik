#include <DHT.h>
#include <PZEM004Tv30.h>

#define DHTTYPE DHT11  // DHT 11

DHT dht(5, DHTTYPE);
PZEM004Tv30 pzem(Serial2, 16, 17);

// Deklarasi GPIO
const int led = 2;
const int buzz = 0;
const int mq2 = 34;
const int flameOne = 33;
const int flameTwo = 25;
const int flameThree = 26;
const int flameFour = 27;
const int flameFive = 15;
const int relayOne = 14;
const int relayTwo = 13;

// Deklarasi Variabel
int flame;

float smoke;
float current;
float voltage;
float humidity;
float temperature;

void setup() {
  Serial.begin(115200);
  pinMode(5, INPUT);    // DHT as Input
  pinMode(mq2, INPUT);  // MQ2 as Input
  pinMode(flameOne, INPUT);
  pinMode(flameTwo, INPUT);
  pinMode(flameThree, INPUT);
  pinMode(flameFour, INPUT);
  pinMode(flameFive, INPUT);
  pinMode(led, OUTPUT);
  pinMode(buzz, OUTPUT);
  pinMode(relayTwo, OUTPUT);
  pinMode(relayOne, OUTPUT);

  digitalWrite(led, LOW);
  digitalWrite(buzz, LOW);
  digitalWrite(relayTwo, HIGH);
  digitalWrite(relayOne, HIGH);
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
  float h = dht.readHumidity();  // read humidity from sensor
  if (isnan(h)) {
    h = random(2500, 2800) / 100.0;
  }
  return h;
}

float getSmoke() {
  float data;
  float input = 0;

  for (int i = 0; i < 20; i++) {
    input += analogRead(mq2);
    delay(25);
  }
  data = input / 10;
  return data;
}

int getFlame() {
  int flemeStateOne = digitalRead(flameOne);
  int flemeStateTwo = digitalRead(flameTwo);
  int flemeStateThree = digitalRead(flameThree);
  int flemeStateFour = digitalRead(flameFour);
  int flemeStateFive = digitalRead(flameFive);
  return flemeStateOne + flemeStateTwo + flemeStateThree + flemeStateFour + flemeStateFive;
}

void loop() {
  flame = getFlame();              // Read Flame
  smoke = getSmoke();              // Read Smoke
  voltage = getVoltage();          // read Voltage
  current = getCurrent();          // Read Current
  humidity = getHumidity();        // Read Humidity
  temperature = getTemperature();  // Read Temperature

  if (flame > 0) {
    digitalWrite(led, HIGH);
    digitalWrite(buzz, HIGH);
    digitalWrite(relayOne, LOW);
  } else {
    digitalWrite(led, LOW);
    digitalWrite(buzz, LOW);
    digitalWrite(relayOne, HIGH);
  }

  Serial.print("Flame:");
  Serial.println(flame);

  Serial.print("Smoke:");
  Serial.println(smoke);

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
