#include <Arduino.h>
#include "time.h"


#define TIME_OFFSET 3600 // GMT +1 = 3600


WiFiUDP ntpUDP;
NTPClient timeClient(ntpUDP);

void setupTime(){
    timeClient.begin();
    timeClient.setTimeOffset(TIME_OFFSET);
}

void getTime(String* dayStamp, unsigned int* hour, unsigned int* minute, unsigned int* second){

    while(!timeClient.update()) {
    timeClient.forceUpdate();
  }

  String timeStamp;
  String formattedDate;

  // The formattedDate comes with the following format:
  // 2018-05-28T16:00:13Z
  // We need to extract date and time
  formattedDate = timeClient.getFormattedDate();
  Serial.println(formattedDate);

  // Extract date
  int splitT = formattedDate.indexOf("T");
  *dayStamp = formattedDate.substring(0, splitT);
  
  // Extract time
  timeStamp = formattedDate.substring(splitT+1, formattedDate.length()-1);

  Serial.print("HOUR: ");
  Serial.println(timeStamp);
  Serial.print("DATE: ");
  Serial.println(*dayStamp);

  int splitHour = timeStamp.indexOf(":");
  *hour = (timeStamp.substring(0,splitHour)).toInt();
  *minute = (timeStamp.substring(splitHour+1, splitHour+3)).toInt();
  *second = (timeStamp.substring(splitHour+4, splitHour+6)).toInt();
  Serial.print("Extracted time is: ");
  Serial.print(*hour);
  Serial.print(" h ");
  Serial.println(*minute);

}