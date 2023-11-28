#ifndef WEATHERFETCHER_H
#define WEATHERFETCHER_H

#include <vector>
#include <Arduino.h> // Include this line if you are using Arduino platform

void fetchWeatherData(const String& lat, const String& lon,
                      std::vector<float>& temperatures, std::vector<float>& humidities,
                      std::vector<String>& dateTimeValues, std::vector<float>& windSpeeds, std::vector<float>& hours_estimation);

#endif
