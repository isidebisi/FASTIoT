#include "serverCommunication.h"


void exchangeServer(String* sendData, String* receiveData) {
  HTTPClient http;                                  //Create new client

  // Your code goes here
  http.begin(SERVER_URL);       //Indicate the destination webpage 
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");        //Prepare the header

  int response_code = http.POST(*sendData);

  if(response_code > 0){
    Serial.println("HTTP code " + String(response_code));                     //Print return code

    if(response_code == 200){                                                 //If code is 200, we received a good response and we can read the echo data
      String response_body = http.getString();                                //Save the data comming from the website
      Serial.print("Server reply: ");                                         //Print data to the monitor for debug
      Serial.println(response_body);

      //If the received data is LED_is_off, we set LOW the LED pin
      *receiveData = response_body;
    }//End of response_code = 200
  }//END of response_code > 0
  
  else{
    Serial.print("Error sending POST, code: ");
    Serial.println(response_code);
  }
  http.end();
}


