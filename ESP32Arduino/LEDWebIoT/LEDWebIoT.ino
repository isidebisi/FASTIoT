//Include libraries
#include <HTTPClient.h>               //Download: https://electronoobs.com/eng_arduino_httpclient.php
#include <WiFi.h>                     //Download: https://electronoobs.com/eng_arduino_wifi.php

#include "modes.h"
#include "definitions.h"
#include "time.h"
#include "serverCommunication.h"


// DEFINE INPUTS/OUTPUTS
#define EXT_PUMP_PIN 16
#define EXT_PUMP2_PIN 17
#define EXT_PUMP3_PIN 18
#define EXT_PUMP4_PIN 19

#define VALVE_PIN 
#define WATER_TANK_LEVEL_PROBE_PIN 36
#define WATER_TANK_LEVEL_LOW_PIN 39
#define WATER_TANK_LEVEL_MEDIUM_PIN 34
#define WATER_TANK_LEVEL_HIGH_PIN 35



#define SLEEP_TIME_MS 1*1000                    //sleep time expressed in milli seconds
#define SLEEP_TIME_US SLEEP_TIME_MS*1000        //sleep time expressed in micro seconds

#define SPRAY_TIME_MS 15*1000       //how long we want to spray in milli seconds
#define MIN_SPRAY_INTERVAL_MS 5*60*1000 //minimum time between sprays in milli seconds is 5 Minutes
// PWM properties
#define PWM_FREQUENCY 25000
#define LED_CHANNEL 0
#define PWM_RESOLUTION 8
#define DUTYCYCLE 160



//Add WIFI data
const char* ssid = "Ismael";              //Add your WIFI network name 
const char* password =  "hallohallo";     //Add WIFI password


//global Variables used in the code
String LED_id = "1";                  
String MODE_id = "1";                 
String data_to_send = "";             //Text data to send to the server
String receiveData = "";              //Text data received from the server
unsigned int Actual_Millis, Previous_Millis;

unsigned int sprayStartTime, lastSprayed = 0;
unsigned int updateServerCounter = 2;
unsigned int iterStatusMessage = 0;


//Inputs/outputs
int LED = EXT_PUMP_PIN;                          //Connect LED on this pin (add 150ohm resistor)
int pump2 = EXT_PUMP2_PIN;
int pump3 = EXT_PUMP3_PIN;
int pump4 = EXT_PUMP4_PIN;


ControlVariables controls;

//function definitions
void goToDeepSleep();
void sprayControl();
void sendStatusToServer();
void checkRefillWaterTank();


void setup() {
  delay(10);
  Serial.begin(115200);                   //Start monitor
  pinMode(EXT_PUMP_PIN, OUTPUT);              //Set pin EXT_PUMP_PIN as OUTPUT
  pinMode(EXT_PUMP2_PIN, OUTPUT);
  pinMode(EXT_PUMP3_PIN, OUTPUT);
  pinMode(EXT_PUMP4_PIN, OUTPUT);

    // PWM setup
  ledcSetup( LED_CHANNEL , PWM_FREQUENCY , PWM_RESOLUTION );  // Set up PWM
  ledcAttachPin( EXT_PUMP_PIN , LED_CHANNEL ) ;                   // Attach PWM to the LED pin

  WiFi.begin(ssid, password);             //Start wifi connection
  Serial.print("Connecting...");
  while (WiFi.status() != WL_CONNECTED) { //Check for the connection
    delay(500);
    Serial.print(".");
  }

  pinMode(23,OUTPUT);
  digitalWrite(23,1);

  Serial.print("Connected, my IP: ");
  Serial.println(WiFi.localIP());
  Actual_Millis = millis();               //Save time for refresh loop
  Previous_Millis = Actual_Millis; 
  sprayStartTime = millis();
  ledcWrite( LED_CHANNEL , 0 );
  setupTime();
}


void loop() {  
  //We make the refresh loop using millis() so we don't have to sue delay();
  Actual_Millis = millis();
  

  
  if(Actual_Millis - Previous_Millis > SLEEP_TIME_MS){
    Previous_Millis = Actual_Millis;  

    
    //gradually update server
    sendStatusToServer();
    
    

    if(WiFi.status()== WL_CONNECTED){                   //Check WiFi connection status  
      /*
      data_to_send = "check_LED_status=" + LED_id;      //send text: "check_LED_status"
      
      exchangeServer(&data_to_send, &receiveData);
      if(receiveData == "LED_is_off"){
        //ledcWrite( LED_CHANNEL , 0 );
      }
      //If the received data is LED_is_on, we set HIGH the LED pin
      else if(receiveData == "LED_is_on"){
        //ledcWrite(LED_CHANNEL, DUTYCYCLE);
      }
      */

      
      //Get time
      getTime(&controls.dayStamp, &controls.hour, &controls.minute, &controls.second);

      sendServerMessage(ReadOperationMode, &controls);


      executeMode(controls.currentMode, &controls);

      Serial.print("Current mode: ");
      Serial.println(controls.currentMode);

      sprayControl();
    }

  }

}

void goToDeepSleep(){
  Serial.println("Going to deep sleep . . .");

  esp_sleep_enable_timer_wakeup(SLEEP_TIME_US);
  esp_deep_sleep_start();
}


void sprayControl(){
  if (controls.sprayNow && controls.isSpraying == false) {
    controls.isSpraying = true;

    ledcWrite(LED_CHANNEL, 255);
    digitalWrite(EXT_PUMP2_PIN,HIGH);
    digitalWrite(EXT_PUMP3_PIN,HIGH);
    digitalWrite(EXT_PUMP4_PIN,HIGH);

    sprayStartTime = millis();
    controls.sprayNow = false;
    
    //Set last sprayed time
    controls.lastSprayedDayStamp = controls.dayStamp;
    controls.lastSprayedHour = controls.hour;
    controls.lastSprayedMinute = controls.minute;
    controls.lastSprayedSecond = controls.second;

    controls.lastSprayedString = String(controls.lastSprayedDayStamp) + " at ";
    controls.lastSprayedString += (controls.lastSprayedHour >= 10) ? String(controls.lastSprayedHour) : "0" + String(controls.lastSprayedHour);
    controls.lastSprayedString += ":";
    controls.lastSprayedString += (controls.lastSprayedMinute >= 10) ? String(controls.lastSprayedMinute) : "0" + String(controls.lastSprayedMinute);
    controls.lastSprayedString += ":";
    controls.lastSprayedString += (controls.lastSprayedSecond >= 10) ? String(controls.lastSprayedSecond) : "0" + String(controls.lastSprayedSecond);
  }
  
  if (controls.isSpraying) {
    Serial.println("NOW SPRAYING");
    controls.sprayNow = false;
    if (millis() - sprayStartTime > SPRAY_TIME_MS) {
      controls.isSpraying = false;
      
      ledcWrite( LED_CHANNEL , 0 );
      digitalWrite(EXT_PUMP2_PIN,0);
      digitalWrite(EXT_PUMP3_PIN,0);
      digitalWrite(EXT_PUMP4_PIN,0);
    }
  } else {
    Serial.println("... not spraying ...");
    ledcWrite(LED_CHANNEL, 0);
    digitalWrite(EXT_PUMP2_PIN,0);
    digitalWrite(EXT_PUMP3_PIN,0);
    digitalWrite(EXT_PUMP4_PIN,0);
  }
}

void sendStatusToServer(){
  //Serial.println("*****UPDATING SERVER *****");  
  bool success = false;
  
  if (iterStatusMessage != WriteNextSpray && iterStatusMessage != WriteOperationMode){  //don't send automatically WriteNextSpray and WriteOperationMode commands
    success = sendServerMessage((ServerMessages)iterStatusMessage, &controls);
    if(!success) Serial.print("*** ERROR at sending Message to server: " + String(iterStatusMessage) + "\n\n");
    }
  iterStatusMessage = (iterStatusMessage < WriteWaterTankLevel) ? iterStatusMessage + 1 : 0;
  }

void checkRefillWaterTank(){

}