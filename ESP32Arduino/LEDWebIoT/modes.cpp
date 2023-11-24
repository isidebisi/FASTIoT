#include "modes.h"
#include "time.h"
#include "WeatherFetcher.h"

#include <Arduino.h>
#include <ArduinoJson.h>
#include <WiFiClient.h>
#include <HTTPClient.h>
#include "time.h"
#include "serverCommunication.h"

void manualMode(ControlVariables* controls) {
    Serial.println("We will now spray... Manual Mode");
    controls->sprayNow = true;

    //change mode back to OFF
    String commandModeOff = "wOM=1&newVal=0";
    String commandResponse = "";
    exchangeServer(&commandModeOff, &commandResponse);
    Serial.println(commandResponse);
}

void timerMode(ControlVariables* controls) {
    Serial.println("We are in Timer Mode...");
    String dayStamp;
    unsigned int hour;
    unsigned int minute;
    unsigned int second;

    getTime(&dayStamp, &hour, &minute, &second);

    
}

void automaticMode(ControlVariables* controls) {
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
            controls->sprayNow = true;
            break; // Exit the loop since we found a temperature under the threshold
        }
    }


}

void offMode(ControlVariables* controls) {
    controls->sprayNow = false;
}

void executeMode(Mode mode, ControlVariables* controls) {
    switch(mode) {
        case MANUAL:
            manualMode(controls);
            break;
        case TIMER:
            timerMode(controls);
            break;
        case AUTOMATIC:
            automaticMode(controls);
            break;
        case OFF:
            offMode(controls);
            break;
    }
}