#include "modes.h"
#include "time.h"
#include "WeatherFetcher.h"

#include <Arduino.h>
#include <ArduinoJson.h>
#include <WiFiClient.h>
#include <HTTPClient.h>
#include "time.h"
#include "serverCommunication.h"

void manualMode( bool * sprayNow) {
    Serial.println("We will now spray... Manual Mode");
    *sprayNow = true;

    //change mode back to OFF
    String commandModeOff = "cOM=1&newVal=0";
    String commandResponse = "";
    exchangeServer(&commandModeOff, &commandResponse);
    Serial.println(commandResponse);
}

void timerMode( bool * sprayNow, unsigned int* lastSprayed) {
    Serial.println("We are in Timer Mode...");
    String dayStamp;
    unsigned int hour;
    unsigned int minute;
    unsigned int second;

    getTime(&dayStamp, &hour, &minute, &second);

    
}

void automaticMode( bool * sprayNow, unsigned int* lastSprayed) {
    std::vector<float> temperatures;
    std::vector<float> humidities;
    std::vector<String> dateTimeValues;
    
    // Set Lat and Lon for Location
    float threshold_temp = 4;
    float threshold_humidity = 75;
    String lat = "46.519";
    String lon = "6.633";

    fetchWeatherData(lat, lon, temperatures, humidities, dateTimeValues);


    for (size_t index = 0; index < temperatures.size(); ++index) {
        float temp = temperatures[index];
        float humidity = humidities[index];

        if (temp < threshold_temp && humidity > threshold_humidity) {
            Serial.println("Under " + String(threshold_temp) + "°C and over " + String(threshold_humidity) + "% humidity. Critial Weather detected at" + String(dateTimeValues[index]));
            Serial.println("We will now spray...");
            *sprayNow = true;
            break; // Exit the loop since we found a temperature under the threshold
        }
    }


}

void offMode(bool * sprayNow) {
    *sprayNow = false;
}

void executeMode(Mode mode, bool * sprayNow, unsigned int* lastSprayed) {
    switch(mode) {
        case MANUAL:
            manualMode(sprayNow);
            break;
        case TIMER:
            timerMode(sprayNow, lastSprayed);
            break;
        case AUTOMATIC:
            automaticMode(sprayNow, lastSprayed);
            break;
        case OFF:
            offMode(sprayNow);
            break;
    }
}