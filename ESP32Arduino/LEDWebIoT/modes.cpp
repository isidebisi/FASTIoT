#include "modes.h"
#include "time.h"
#include <Arduino.h>

#include "WeatherFetcher.h"
#include <ArduinoJson.h>
#include <WiFiClient.h>
#include <HTTPClient.h>


void manualMode() {
    
}

void timerMode() {
    
}

void automaticMode() {
    std::vector<float> temperatures;
    std::vector<float> humidities;
    std::vector<String> dateTimeValues;

    // Set Lat and Lon for Location
    float threshold_temp = 4;
    float threshold_humidity = 75;
    String lat = "46.111";
    String lon = "7.006";

    fetchWeatherData(threshold_temp, lat, lon, temperatures, humidities, dateTimeValues);

    for (size_t index = 0; index < temperatures.size(); ++index) {
        float temp = temperatures[index];
        float humidity = humidities[index];

        if (temp < threshold_temp && humidity > threshold_humidity) {
            Serial.println("Under " + String(threshold_temp) + "°C and over " + String(threshold_humidity) + "% humidity. humidity -> Spray. Critial Weather detected at" + String(dateTimeValues[index]));
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