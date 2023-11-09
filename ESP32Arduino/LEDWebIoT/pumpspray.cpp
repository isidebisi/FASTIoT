/*

const int pumpRelayPin = 16;   // Replace with the actual relay pin connected to the pump
const int switchPin = 5;       // Replace with the switch pin
const int analogSensorPin = 34; // Replace with the analog sensor pin

const int ledPin = 16;  // Replace with the PWM pin for the pump

int switchState = HIGH;
int lastSwitchState = HIGH;
int pumpState = LOW;

// PWM properties
const int freq = 22000;
const int ledChannel = 0;
const int resolution = 8;

void setup() {
  pinMode(pumpRelayPin, OUTPUT);  // Set pump relay pin as OUTPUT
  pinMode(switchPin, INPUT_PULLUP);  // Set switch pin as INPUT with internal pull-up resistor
  pinMode(analogSensorPin, INPUT);  // Set analog sensor pin as INPUT
  digitalWrite(pumpRelayPin, LOW); // Ensure the pump relay is off initially

  // PWM setup
  ledcSetup(ledChannel, freq, resolution);  // Set up PWM
  ledcAttachPin(ledPin, ledChannel);  // Attach PWM to the LED pin

  Serial.begin(115200);  // Initialize serial communication for debugging
}

void loop() {
  int sensorValue = analogRead(analogSensorPin);  // Read analog sensor value

  if (sensorValue > 100) {
    Serial.println("Brine is detected.");  // Print message if brine is detected
  } else {
    Serial.println("Brine is not detected.");  // Print message if brine is not detected
  }

  switchState = digitalRead(switchPin);  // Read the state of the switch

  if (switchState != lastSwitchState) {  // Check if the switch state has changed
    if (switchState == LOW) {  // Check if the switch is pressed (LOW)
      pumpState = !pumpState;  // Toggle the pump state
      
      // Toggle the relay state based on the pumpState
      if (pumpState) {
        digitalWrite(pumpRelayPin, HIGH); // Turn on the relay
      } else {
        digitalWrite(pumpRelayPin, LOW);  // Turn off the relay
      }

      // PWM control for the pump
      for (int dutyCycle = 0; dutyCycle <= 255; dutyCycle++) {
        ledcWrite(ledChannel, dutyCycle);
        delay(15);
      }

      for (int dutyCycle = 255; dutyCycle >= 0; dutyCycle--) {
        ledcWrite(ledChannel, dutyCycle);
        delay(15);
      }
    }
  }

  lastSwitchState = switchState;  // Update the last switch state for the next iteration
}
*/
