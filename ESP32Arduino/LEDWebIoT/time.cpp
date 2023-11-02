#include <Arduino.h>
#include "time.h"


#define TIME_OFFSET 3600 // GMT +1 = 3600


WiFiUDP ntpUDP;
NTPClient timeClient(ntpUDP);

void setupTime(){
    timeClient.begin();
    timeClient.setTimeOffset(TIME_OFFSET);
}

void getTime(String* formattedDate, String* dayStamp, String* timeStamp){

    while(!timeClient.update()) {
    timeClient.forceUpdate();
  }
  // The formattedDate comes with the following format:
  // 2018-05-28T16:00:13Z
  // We need to extract date and time
  *formattedDate = timeClient.getFormattedDate();
  Serial.println(*formattedDate);

  // Extract date
  int splitT = formattedDate->indexOf("T");
  *dayStamp = formattedDate->substring(0, splitT);
  Serial.print("DATE: ");
  Serial.println(*dayStamp);
  // Extract time
  *timeStamp = formattedDate->substring(splitT+1, formattedDate->length()-1);
  Serial.print("HOUR: ");
  Serial.println(*timeStamp);

}