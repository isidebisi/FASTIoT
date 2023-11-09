#include <ArduinoJson.h>    //Library to download
#include <WiFiClient.h>   
#include <HTTPClient.h>
#include <vector>
#include "WeatherFetcher.h"


void fetchWeatherData(const String& lat, const String& lon,
                      std::vector<float>& temperatures, std::vector<float>& humidities,
                      std::vector<String>& dateTimeValues){

  const String key = "a93c60a4d5a36a73d22d6cc0ddc41db1";
  const String endpoint = "http://api.openweathermap.org/data/2.5/forecast?";
  const String lat_lon = "&";
  const String lon_key = "&appid=";

  String URL = endpoint + "lat=" + lat + lat_lon + "lon=" + lon + lon_key + key;

  if ((WiFi.status() == WL_CONNECTED)) {
    HTTPClient http;
    http.begin(URL);
    int httpCode = http.GET();

    if (httpCode > 0) {
      String payload = http.getString();
      DynamicJsonDocument doc(5000);
      deserializeJson(doc, payload);
      JsonArray list = doc["list"];

      for (JsonVariant value : list) {
        if (temperatures.size() > 7) {
          Serial.println("More than 1 Day in Advance");
          break;
        }

        JsonObject item = value.as<JsonObject>();
        String dt_txt = item["dt_txt"].as<String>();

        JsonObject main = item["main"];
        float temp = main["temp"].as<float>() - 273.15; // Convert temperature from Kelvin to Celsius
        float humidity = main["humidity"].as<float>();

        temperatures.push_back(temp);
        humidities.push_back(humidity);
        dateTimeValues.push_back(dt_txt);
      }

      for (int i = 0; i < temperatures.size(); ++i) {
        String output = "Date Time: " + dateTimeValues[i] + ", Temperature: " + String(temperatures[i]) + "°C, Humidity: " + String(humidities[i]) + "%";
        Serial.println(output);
      }

    } else {
      Serial.println("Error on HTTP request");
    }

    http.end(); // Free the resources
  }
}
