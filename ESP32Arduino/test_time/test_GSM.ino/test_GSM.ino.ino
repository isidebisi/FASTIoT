/*
  FILE: httpclient.ino
  PURPOSE: Test functionality
*/
#include "utilities.h"

#include <TinyGsmClient.h>
#include <ArduinoHttpClient.h>


// Set serial for debug console (to the Serial Monitor, default speed 115200)
#define SerialMon Serial

// See all AT commands, if wanted
//#define DUMP_AT_COMMANDS

// Define the serial console for debug prints, if needed
#define TINY_GSM_DEBUG SerialMon

#define TINY_GSM_USE_GPRS true
#define TINY_GSM_USE_WIFI false

// set GSM PIN, if any
#define GSM_PIN ""

// Your GPRS credentials, if any
const char apn[]      = "internet";
const char gprsUser[] = "";
const char gprsPass[] = "";

// Your WiFi connection credentials, if applicable
const char wifiSSID[] = "Ismael";
const char wifiPass[] = "hallohallo";

// Server details
const char server[]   = "thawpal.com";
const char resource[] = "rOM=1";
const int  port       = 80;





#ifdef DUMP_AT_COMMANDS
#include <StreamDebugger.h>
StreamDebugger debugger(SerialAT, SerialMon);
TinyGsm        modem(debugger);
#else
TinyGsm        modem(SerialAT);
#endif


TinyGsmClient client(modem);
HttpClient    http(client, server, port);


#define uS_TO_S_FACTOR 1000000ULL  // Conversion factor for micro seconds to seconds
#define TIME_TO_SLEEP  600          // Time ESP32 will go to sleep (in seconds)


void setup()
{
    Serial.begin(115200);
    // Turn on DC boost to power on the modem
#ifdef BOARD_POWERON_PIN
    pinMode(BOARD_POWERON_PIN, OUTPUT);
    digitalWrite(BOARD_POWERON_PIN, HIGH);
#endif

    // Set modem reset
    pinMode(MODEM_RESET_PIN, OUTPUT);
    digitalWrite(MODEM_RESET_PIN, !MODEM_RESET_LEVEL);
    // Turn on modem
    pinMode(BOARD_PWRKEY_PIN, OUTPUT);
    digitalWrite(BOARD_PWRKEY_PIN, LOW);
    delay(100);
    digitalWrite(BOARD_PWRKEY_PIN, HIGH);
    delay(1000);
    digitalWrite(BOARD_PWRKEY_PIN, LOW);

    // Set modem baud
    SerialAT.begin(115200, SERIAL_8N1, MODEM_RX_PIN, MODEM_TX_PIN);

    Serial.println("Start modem...");
    delay(3000);

    // Restart takes quite some time
    // To skip it, call init() instead of restart()
    DBG("Initializing modem...");
    if (!modem.init()) {
        DBG("Failed to restart modem, delaying 10s and retrying");
        return;
    }

#ifndef TINY_GSM_MODEM_SIM7672
    /*
    2 Automatic
    13 GSM Only
    14 WCDMA Only
    38 LTE Only
    */

    String result;
    result = modem.setNetworkMode((NetworkMode) 2);
    if (modem.waitResponse(10000L) != 1) {
        DBG(" setNetworkMode faill");
        return ;
    }
#endif
}

void loop()
{
    // Restart takes quite some time
    // To skip it, call init() instead of restart()
    /*  DBG("Initializing modem...");
      if (!modem.restart()) {
          DBG("Failed to restart modem, delaying 10s and retrying");
          return;
      }*/

    String name = modem.getModemName();
    DBG("Modem Name:", name);

    String modemInfo = modem.getModemInfo();
    DBG("Modem Info:", modemInfo);

#if TINY_GSM_USE_GPRS
    // Unlock your SIM card with a PIN if needed
    if (GSM_PIN && modem.getSimStatus() != 3) {
        modem.simUnlock(GSM_PIN);
    }
#endif


#if TINY_GSM_USE_WIFI
    // Wifi connection parameters must be set before waiting for the network
    SerialMon.print(F("Setting SSID/password..."));
    if (!modem.networkConnect(wifiSSID, wifiPass)) {
        SerialMon.println(" fail");
        delay(10000);
        return;
    }
    SerialMon.println(" success");
#endif

#if TINY_GSM_USE_GPRS && defined TINY_GSM_MODEM_XBEE
    // The XBee must run the gprsConnect function BEFORE waiting for network!
    modem.gprsConnect(apn, gprsUser, gprsPass);
#endif

    SerialMon.print("Waiting for network...");
    if (!modem.waitForNetwork()) {
        SerialMon.println(" fail");
        delay(10000);
        return;
    }
    SerialMon.println(" success");

    if (modem.isNetworkConnected()) {
        SerialMon.println("Network connected");
    }


#if TINY_GSM_USE_GPRS
    // GPRS connection parameters are usually set after network registration
    SerialMon.print(F("Connecting to "));
    SerialMon.print(apn);
    if (!modem.gprsConnect(apn, gprsUser, gprsPass)) {
        SerialMon.println(" fail");
        delay(10000);
        return;
    }
    SerialMon.println(" success");

    if (modem.isGprsConnected()) {
        SerialMon.println("GPRS connected");
    }
#endif

    //SerialMon.print(F("Performing HTTP GET request... "));
    String contentType = "application/x-www-form-urlencoded";
    String postURL = "/esp32_update.php";


    Serial.println("making POST request");
  String postData = "rNS=1";

  http.beginRequest();
  http.post("/esp32_update.php");
  http.sendHeader("Content-Type", "application/x-www-form-urlencoded");
  http.sendHeader("Content-Length", postData.length());
  http.beginBody();
  http.print(postData);
  http.endRequest();

  // read the status code and body of the response
  int statusCode =  http.responseStatusCode();
  String response = http.responseBody();

  SerialMon.print("Status code: ");
  SerialMon.println(statusCode);
  SerialMon.print("Response: ");
  SerialMon.println(response);




    /*
    //int err = http.get(resource);
    http.connectionKeepAlive();
    http.beginRequest();
    int err = http.post("/");
    http.sendHeader(F("Content-Type"), F("application/x-www-form-urlencoded"));
    http.sendHeader(F("Content-Length"), String(resource).length());
    http.beginBody();
    http.println(resource);   



    if (err != 0) {
        SerialMon.println(F("failed to connect"));
        delay(10000);
        return;
    }
    

    int status = http.responseStatusCode();
    SerialMon.print(F("Response status code: "));
    SerialMon.println(status);
    if (!status) {
        delay(10000);
        return;
    }

    SerialMon.println(F("Response Headers:"));
    while (http.headerAvailable()) {
        String headerName  = http.readHeaderName();
        String headerValue = http.readHeaderValue();
        SerialMon.println("    " + headerName + " : " + headerValue);
    }

    int length = http.contentLength();
    if (length >= 0) {
        SerialMon.print(F("Content length is: "));
        SerialMon.println(length);
    }
    if (http.isResponseChunked()) {
        SerialMon.println(F("The response is chunked"));
    }

    String body = http.responseBody();
    SerialMon.println(F("Response:"));
    SerialMon.println(body);

    SerialMon.print(F("Body length is: "));
    SerialMon.println(body.length());
*/
    // Shutdown

    http.stop();
    SerialMon.println(F("Server disconnected"));

#if TINY_GSM_USE_WIFI
    modem.networkDisconnect();
    SerialMon.println(F("WiFi disconnected"));
#endif
#if TINY_GSM_USE_GPRS
    modem.gprsDisconnect();
    SerialMon.println(F("GPRS disconnected"));
#endif

    // Do nothing forevermore
    while (true) {
        delay(1000);
    }

}
