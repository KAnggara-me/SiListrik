// GPIO Config
const int flameOne = 25;
const int flameTwo = 26;
const int flameThree = 32;
const int flameFour = 33;
const int flameFive = 34;
const int led = 2;

void setup() {
  Serial.begin(9600);
  pinMode(led, OUTPUT);
  pinMode(flameOne, INPUT);
  pinMode(flameTwo, INPUT);
  pinMode(flameThree, INPUT);
  pinMode(flameFour, INPUT);
  pinMode(flameFive, INPUT);
  digitalWrite(led, LOW);
}

void loop() {
  int flame = checkFlame();
  Serial.print("Flame:");
  Serial.print(String(flame));
  Serial.print(",");
  Serial.print("Warning:");
  if (flame > 0) {
    digitalWrite(led, HIGH);
    Serial.println(String(1));
  } else {
    digitalWrite(led, LOW);
    Serial.println(String(0));
  }
  delay(500);  // delay in between reads for stability
}

int checkFlame() {
  int flemeStateOne = digitalRead(flameOne);
  int flemeStateTwo = digitalRead(flameTwo);
  int flemeStateThree = digitalRead(flameThree);
  int flemeStateFour = digitalRead(flameFour);
  int flemeStateFive = digitalRead(flameFive);
  return flemeStateOne + flemeStateTwo + flemeStateThree + flemeStateFour + flemeStateFive;
}
