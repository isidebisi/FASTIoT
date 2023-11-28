#ifndef SERVERCOMMUNICATION_H
#define SERVERCOMMUNICATION_H

#include <HTTPClient.h>               //Download: https://electronoobs.com/eng_arduino_httpclient.php
#include <Arduino.h>
#include "definitions.h"




// DEFINES
#define SERVER_URL "https://thawpal.com/esp32_update.php"


//Function prototypes
void exchangeServer(String* sendData, String* receiveData);
bool sendServerMessage(ServerMessages message, ControlVariables* control);


#endif // SERVERCOMMUNICATION_H
