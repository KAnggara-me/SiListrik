const int mq2 = 34;
float asap;

void setup() {
  Serial.begin(115200);
  pinMode(mq2, INPUT);
  delay(1000);
}

void loop() {
  float data = 0;

  for (int i = 0; i < 20; i++) {
    data += analogRead(mq2);
    delay(25);
  }

  asap = data / 10;
  Serial.println(data / 10);
  delay(500);
}
