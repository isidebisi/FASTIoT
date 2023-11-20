#include "serverCommunication.h"


void exchangeServer(String* sendData, String* receiveData) {
  HTTPClient http;                                  //Create new client

  // Your code goes here
  
  http.begin(SERVER_URL);       //Indicate the destination webpage 
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");        //Prepare the header

  //test
  Serial.println("Sending data: " + *sendData);

  int response_code = http.POST(*sendData);



  if(response_code > 0){
    // Serial.println("HTTP code " + String(response_code));                     //Print return code

    if(response_code == 200){                                                 //If code is 200, we received a good response and we can read the echo data
      String response_body = http.getString();                                //Save the data comming from the website
      Serial.print("Sending data: ");
      Serial.print(*sendData);
      Serial.print(", Server reply: ");                                         //Print data to the monitor for debug
      Serial.println(response_body);

      //If the received data is LED_is_off, we set LOW the LED pin
      *receiveData = response_body;
    } else { //End of response_code = 200
    Serial.print("error sending POST, Code != 200 as it should be");
    }
  }//END of response_code > 0
  
  else{
    Serial.print("Error sending POST, code: ");
    Serial.println(response_code);
  }
  http.end();
}


bool sendServerMessage(ServerMessages message, ControlVariables* control) {
  String sendData;
  String receiveData;
  String dataString, hourString, minuteString, secondString, expectedResponse;
  bool success = false;
  Serial.println("Sending server message called with parameter : " + String(message));

  switch(message) {
    //TODO: Assemble messages
    case ServerMessages::ReadTimeOfSpray:
      sendData = "rToS=1";
      exchangeServer(&sendData, &receiveData);
      control->scheduledSprayHour = (unsigned int)receiveData.substring(3).toInt();
      success = true;
      break;

    case ServerMessages::ReadOperationMode:
      sendData = "rOM=1";
      exchangeServer(&sendData, &receiveData);
      control->currentMode = (Mode)receiveData.substring(2).toInt();
      success = true;
      break;

    case ServerMessages::WriteIsSpraying:
      sendData = "wIS=1&newVal=" + String(control->isSpraying);
      expectedResponse = "IS" + String(control->isSpraying);
      exchangeServer(&sendData, &receiveData);
      success = (receiveData.substring(0, expectedResponse.length()) == expectedResponse);
      break;

    case ServerMessages::WriteLastOnline:
      hourString = (control->hour >= 10) ? String(control->hour) : "0" + String(control->hour);
      minuteString = (control->minute >= 10) ? String(control->minute) : "0" + String(control->minute);
      secondString = (control->second >= 10) ? String(control->second) : "0" + String(control->second);

      dataString = String(control->dayStamp.substring(2)) + " at " + hourString + ":" + minuteString + ":" + secondString;
      sendData = "wLO=1&newVal=" + dataString;
      expectedResponse = "LO" + dataString;
      exchangeServer(&sendData, &receiveData);
      success = (receiveData.substring(0, expectedResponse.length()) == expectedResponse);
      break;

    case ServerMessages::WriteLastSprayed:
      hourString = (control->lastSprayedHour >= 10) ? String(control->lastSprayedHour) : "0" + String(control->lastSprayedHour);
      minuteString = (control->lastSprayedMinute >= 10) ? String(control->lastSprayedMinute) : "0" + String(control->lastSprayedMinute);
      secondString = (control->lastSprayedSecond >= 10) ? String(control->lastSprayedSecond) : "0" + String(control->lastSprayedSecond);
      dataString = String(control->lastSprayedDayStamp.substring(2)) + " at " + hourString + ":" + minuteString + ":" + secondString;

      sendData = "wLS=1&newVal=" + dataString;
      expectedResponse = "LS" + dataString;
      exchangeServer(&sendData, &receiveData);
      success = (receiveData.substring(0, expectedResponse.length()) == expectedResponse);
      break;

    case ServerMessages::WriteNextSpray:
      hourString = (control->nextSprayHour >= 10) ? String(control->nextSprayHour) : "0" + String(control->nextSprayHour);
      minuteString = (control->nextSprayMinute >= 10) ? String(control->nextSprayMinute) : "0" + String(control->nextSprayMinute);
      secondString = (control->nextSpraySecond >= 10) ? String(control->nextSpraySecond) : "0" + String(control->nextSpraySecond);
      dataString = String(control->nextSprayDayStamp.substring(2)) + " at " + hourString + ":" + minuteString + ":" + secondString;

      sendData = "wNS=1&newVal=" + ((control->nextSprayHour <= 23) ?  dataString : "No spraying scheduled ");
      expectedResponse = "NS" + ((control->nextSprayHour <= 23) ?  dataString : "No spraying scheduled ");
      exchangeServer(&sendData, &receiveData);
      success = (receiveData.substring(0, expectedResponse.length()) == expectedResponse);
      break;

    case ServerMessages::WriteOperationMode:
      sendData = "wOM=1&newVal=" + String(control->currentMode);
      expectedResponse = "OM" + String(control->currentMode);
      exchangeServer(&sendData, &receiveData);
      success = (receiveData.substring(0, expectedResponse.length()) == expectedResponse);
      break;

    case ServerMessages::WriteSaltConcentration:
      sendData = "wSC=1&newVal=" + String(control->saltConcentration);
      expectedResponse = "SC" + String(control->saltConcentration);
      exchangeServer(&sendData, &receiveData);
      success = (receiveData.substring(0, expectedResponse.length()) == expectedResponse);
      break;

    case ServerMessages::WriteSaltLevel:
      sendData = "wSL=1&newVal=" + String(control->saltLevel);
      expectedResponse = "SL" + String(control->saltLevel);
      exchangeServer(&sendData, &receiveData);
      success = (receiveData.substring(0, expectedResponse.length()) == expectedResponse);
      break;

    case ServerMessages::WriteWaterTankLevel:
      sendData = "wWTL=1&newVal=" + String(control->waterTankLevel);
      expectedResponse = "WTL" + String(control->waterTankLevel);
      exchangeServer(&sendData, &receiveData);
      success = (receiveData.substring(0, expectedResponse.length()) == expectedResponse);
      break;

    default:
      // Handle invalid message
      break;
  }
  return success;
}

