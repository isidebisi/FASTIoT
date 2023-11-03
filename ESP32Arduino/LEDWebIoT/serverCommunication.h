#ifndef SERVERCOMMUNICATION_H
#define SERVERCOMMUNICATION_H

#include <HTTPClient.h>               //Download: https://electronoobs.com/eng_arduino_httpclient.php
#include <Arduino.h>


// DEFINES
#define SERVER_URL "https://fastiotepfl.000webhostapp.com/esp32_update.php"


//Function prototypes
void exchangeServer(String* sendData, String* receiveData);


#endif // SERVERCOMMUNICATION_H
