// BOSCHUNG TEST 1
/*
#define dutyCycle 176

const int pumpRelayPin = 16;   // Replace with the actual relay pin connected to the pump
const int switchPin = 5;       // Replace with the switch pin
int U ; // Switch State 


// PWM properties
const int freq = 25000;
const int ledChannel = 0;
const int resolution = 8;

void setup() {

  pinMode(switchPin, INPUT_PULLUP);  // Set switch pin as INPUT with internal pull-up resistor
  
  // PWM setup
  ledcSetup( ledChannel , freq , resolution );  // Set up PWM
  ledcAttachPin( pumpRelayPin , ledChannel ) ;  // Attach PWM to the LED pin

  Serial.begin(115200);  // Initialize serial communication for debugging

}

void loop() {
  
  U = digitalRead(switchPin) ;

  if( U == 0 ) {
    ledcWrite( ledChannel , 0 );
  }
  else{
    ledcWrite(ledChannel, dutyCycle);
  }

  Serial.println(U) ;  

  delay(50) ;
  
}
*/