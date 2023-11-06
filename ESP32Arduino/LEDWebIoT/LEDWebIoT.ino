//Include libraries
#include <HTTPClient.h>               //Download: https://electronoobs.com/eng_arduino_httpclient.php
#include <WiFi.h>                     //Download: https://electronoobs.com/eng_arduino_wifi.php

#include "modes.h"
#include "time.h"
#include "serverCommunication.h"


//Add WIFI data
const char* ssid = "Ismael";              //Add your WIFI network name 
const char* password =  "hallohallo";     //Add WIFI password


//Variables used in the code
String LED_id = "1";                  
String MODE_id = "1";                 
String data_to_send = "";             //Text data to send to the server
String receiveData = "";              //Text data received from the server
unsigned int Actual_Millis, Previous_Millis;
int refresh_time = 1000;               //Refresh rate of connection to website (recommended more than 1s)

String formattedDate;
String dayStamp;
String timeStamp;

//Inputs/outputs
int LED = 2;                          //Connect LED on this pin (add 150ohm resistor)
Mode currentMode = OFF;               //Current mode of the system




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
  if(Actual_Millis - Previous_Millis > refresh_time){
    Previous_Millis = Actual_Millis;  

    //Get time
    
    getTime(&formattedDate, &dayStamp, &timeStamp);

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
      Serial.Print("Current mode: ");
      Serial.Println(currentMode);
    }

  }
}
