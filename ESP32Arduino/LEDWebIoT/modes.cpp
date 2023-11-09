#include "modes.h"
#include "time.h"
#include "WeatherFetcher.h"

#include <Arduino.h>
#include <ArduinoJson.h>
#include <WiFiClient.h>
#include <HTTPClient.h>


void manualMode() {
    Serial.println("We will now spray... Manual Mode");
}

void timerMode() {
    Serial.println("We are in Timer Mode...");
}

void automaticMode() {
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
            break; // Exit the loop since we found a temperature under the threshold
        }
    }


}

void offMode() {
    
}

void executeMode(Mode mode) {
    switch(mode) {
        case MANUAL:
            manualMode();
            break;
        case TIMER:
            timerMode();
            break;
        case AUTOMATIC:
            automaticMode();
            break;
        case OFF:
            offMode();
            break;
    }
}