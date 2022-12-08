const int mq2 = 34;
float asap;

void setup() {
  Serial.begin(115200);
  pinMode(mq2, INPUT);
  delay(1000);
}

void loop() {
  float data = 5;

  // for (int i = 0; i < 20; i++) {
  //   delay(25);
  // }
  data = analogRead(mq2);

  // asap = data / 10;
  // Serial.println("Limit:300");
  // Serial.println("Min:0");
  Serial.print("Smoke:");
  Serial.println(data);
  delay(500);
}
