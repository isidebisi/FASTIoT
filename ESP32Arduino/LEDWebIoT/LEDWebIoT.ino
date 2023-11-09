//Include libraries
#include <HTTPClient.h>               //Download: https://electronoobs.com/eng_arduino_httpclient.php
#include <WiFi.h>                     //Download: https://electronoobs.com/eng_arduino_wifi.php

#include "modes.h"
#include "time.h"
#include "serverCommunication.h"

#define SLEEP_TIME_MS 1*1000                    //sleep time expressed in milli seconds
#define SLEEP_TIME_US SLEEP_TIME_MS*1000        //sleep time expressed in micro seconds
#define LED_PIN 4

//Add WIFI data
const char* ssid = "Ismael";              //Add your WIFI network name 
const char* password =  "hallohallo";     //Add WIFI password


//Variables used in the code
String LED_id = "1";                  
String MODE_id = "1";                 
String data_to_send = "";             //Text data to send to the server
String receiveData = "";              //Text data received from the server
unsigned int Actual_Millis, Previous_Millis;



String dayStamp;
unsigned int hour;
unsigned int minute;
unsigned int second;


//Inputs/outputs
int LED = LED_PIN;                          //Connect LED on this pin (add 150ohm resistor)
Mode currentMode = OFF;               //Current mode of the system


//function definitions
void goToDeepSleep();

void setup() {
  delay(10);
  Serial.begin(115200);                   //Start monitor
  pinMode(LED, OUTPUT);                   //Set pin 2 as OUTPUT

  WiFi.begin(ssid, password);             //Start wifi connection
  Serial.print("Connecting...");
  while (WiFi.status() != WL_CONNECTED) { //Check for the connection
    delay(500);
    Serial.print(".");
  }

  Serial.print("Connected, my IP: ");
  Serial.println(WiFi.localIP());
  Actual_Millis = millis();               //Save time for refresh loop
  Previous_Millis = Actual_Millis; 

  setupTime();
}


void loop() {  
  //We make the refresh loop using millis() so we don't have to sue delay();
  Actual_Millis = millis();
  if(Actual_Millis - Previous_Millis > SLEEP_TIME_MS){
    Previous_Millis = Actual_Millis;  

    //Get time
    
    getTime(&dayStamp, &hour, &minute, &second);

    if(WiFi.status()== WL_CONNECTED){                   //Check WiFi connection status  

      data_to_send = "check_LED_status=" + LED_id;      //send text: "check_LED_status"
      
      exchangeServer(&data_to_send, &receiveData);
      if(receiveData == "LED_is_off"){
          digitalWrite(LED, LOW);
        }
        //If the received data is LED_is_on, we set HIGH the LED pin
        else if(receiveData == "LED_is_on"){
          digitalWrite(LED, HIGH);
        }

      data_to_send = "check_Operation_Mode=" + MODE_id;
      exchangeServer(&data_to_send, &receiveData);
      if (receiveData == "Operation_Mode_is_0") {
          currentMode = OFF;
      } else if (receiveData == "Operation_Mode_is_1") {
          currentMode = MANUAL;
      } else if (receiveData == "Operation_Mode_is_2") {
          currentMode = TIMER;
      } else if (receiveData == "Operation_Mode_is_3") {
          currentMode = AUTOMATIC;
      }
      Serial.print("Current mode: ");
      Serial.println(currentMode);
    }

  }
}

void goToDeepSleep(){
  Serial.print("Going to deep sleep . . .");

  esp_sleep_enable_timer_wakeup(SLEEP_TIME_US);
  esp_deep_sleep_start();
}
