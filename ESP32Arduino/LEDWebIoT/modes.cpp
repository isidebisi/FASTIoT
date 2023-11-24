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
    std::vector<float> hours_estimation;
    std::vector<float> windSpeeds;
    std::vector<float> Critical(8, 0);
    std::vector<float> Sprayingtimes(48, 100);
    std::vector<double> SprayingFrequency(8);
    std::vector<float> SprayingPeriod(8, 10000);
    std::vector<float> time_of_spraying_start_vector(8, 0); 

    std::vector<float> time_interval_start(8);
    std::vector<float> time_interval_finish(8);    
    
    // Set Threshold for spraying
    double threshold_temp_1 = 4;
    double threshold_temp_2 = 0;
    double threshold_temp_3 = -5;

    double threshold_humidity_1 = 75;
    double threshold_humidity_2 = 85;


    //Set time between spraying and detection in Hours
    double delta_time_detected_spray = 3; //Start Spraying 3 hours before Critical situation detected


    double delta_time_spray_3 = 3;
    double delta_time_spray_1_5 = 1.5;
    double delta_time_spray_1 = 1;
    double delta_time_spray_0_5 = 0.5;


    //Set coordinates of location
    //const String lat = "46.111";
    //const String lon = "7.006";

    const String lat = "46.52";
    const String lon = "6.63";


    fetchWeatherData(lat, lon, temperatures, humidities, dateTimeValues, windSpeeds, hours_estimation);

    for (size_t index = 0; index < temperatures.size(); ++index) {
        float temp = temperatures[index];
        float humidity = humidities[index];
        float windspeed = windSpeeds[index]; 
        //Serial.println(temp);
        //Serial.println(humidity);
        //Serial.println(index);



        //CRITICAL LEVEL 1

        if (threshold_temp_2 <= temp && temp < threshold_temp_1 && threshold_humidity_1 < humidity && humidity <= threshold_humidity_2) { // Corrected the condition

            if (windspeed > 50) {
              //Serial.println("Critical: 6 at time " + String(hours_estimation[index]) + "because of Windspeed: " + String(windspeed) + " (Temperature: " + String(temp) + ", Humidity: " + String(humidity) + ")");
              Critical[index] = 5;               
            } 

            else {
                //Serial.println("Critical: 1 at time " + String(hours_estimation[index]) + ". Temperature: " + String(temp) + ", Humidity: " + String(humidity) + ", Windspeed: " + String(windspeed));
                Critical[index] = 1;
                double Time_period = delta_time_spray_3;
                double frequency = 1.0 / Time_period;
                SprayingFrequency[index] = frequency;

                float time_of_spraying_start = 0;
                if (hours_estimation[index] < delta_time_detected_spray) {
                    time_of_spraying_start = 24 + hours_estimation[index] - delta_time_detected_spray;
                }
                else{
                    time_of_spraying_start = hours_estimation[index] - delta_time_detected_spray;
                }
                time_of_spraying_start_vector[index] = time_of_spraying_start;
                //Serial.println("Start spraying at " + String(time_of_spraying_start) + " untill " + String(hours_estimation[index]) + " with a frequency of " + String(SprayingFrequency[index]) + "/hour (e.g. every " + String(delta_time_spray_3) + "hours)");


                //Sprayingtimes[index * 6] = time_of_spraying;
                //Sprayingtimes[index * 6 + 1] = time_of_spraying + 1.5;
            }
        }



        //CRITICAL LEVEL 2

        if (threshold_temp_2 <= temp && temp < threshold_temp_1 &&  threshold_humidity_2 < humidity) { // Corrected the condition

            //Serial.println("Critical: 2.1 at time " + String(hours_estimation[index]) + ". Temperature: " + String(temp) + ", Humidity: " + String(humidity) + ", Windspeed: " + String(windspeed));
            if (windspeed > 50) {
                //Serial.println("Critical: 0 at time " + String(hours_estimation[index]) + "because of Windspeed: " + String(windspeed) + " (Temperature: " + String(temp) + ", Humidity: " + String(humidity));
                Critical[index] = 5;                       
            } 
            else {
                //Serial.println("Critical: 2.1 at time " + String(hours_estimation[index]) + ". Temperature: " + String(temp) + ", Humidity: " + String(humidity) + ", Windspeed: " + String(windspeed));
                Critical[index] = 2;
                double Time_period = delta_time_spray_3;
                double frequency = 1.0 / Time_period;
                SprayingFrequency[index] = frequency;

                float time_of_spraying_start = 0;
                if (hours_estimation[index] < delta_time_detected_spray) {
                    time_of_spraying_start = 24 + hours_estimation[index] - delta_time_detected_spray;
                }
                else{
                    time_of_spraying_start = hours_estimation[index] - delta_time_detected_spray;
                }
                time_of_spraying_start_vector[index] = time_of_spraying_start;
                //Serial.println("Start spraying at " + String(time_of_spraying_start) + " untill " + String(hours_estimation[index]) + " with a frequency of " + String(SprayingFrequency[index]) + "/hour (e.g. every " + String(delta_time_spray_3) + "hours)");

            }
        }



        //CRITICAL LEVEL 2

        if (threshold_temp_3 <= temp && temp < threshold_temp_2 && threshold_humidity_1 < humidity && humidity <= threshold_humidity_2) {

            if (windspeed > 50) {
                //Serial.println("Critical: 0 at time " + String(hours_estimation[index]) + "because of Windspeed: " + String(windspeed) + " (Temperature: " + String(temp) + ", Humidity: " + String(humidity));
                Critical[index] = 5;       
            } 
            
            else {
                //Serial.println("Critical: 2.2 at time " + String(hours_estimation[index]) + ". Temperature: " + String(temp) + ", Humidity: " + String(humidity) + ", Windspeed: " + String(windspeed));
                Critical[index] = 2;
                double Time_period = delta_time_spray_3;
                double frequency = 1.0 / Time_period;
                SprayingFrequency[index] = frequency;

                float time_of_spraying_start = 0;
                if (hours_estimation[index] < delta_time_detected_spray) {
                    time_of_spraying_start = 24 + hours_estimation[index] - delta_time_detected_spray;
                }
                else{
                    time_of_spraying_start = hours_estimation[index] - delta_time_detected_spray;
                }
                time_of_spraying_start_vector[index] = time_of_spraying_start;
                //Serial.println("Start spraying at " + String(time_of_spraying_start) + " untill " + String(hours_estimation[index]) + " with a frequency of " + String(SprayingFrequency[index]) + "/hour (e.g. every " + String(delta_time_spray_3) + "hours)");
                
            }
        }


        //CRITICAL LEVEL 3

        if (temp < threshold_temp_3 && threshold_humidity_1 < humidity && humidity <= threshold_humidity_2) {

            if (windspeed > 50) {
                //Serial.println("Critical: 0 at time " + String(hours_estimation[index]) + "because of Windspeed: " + String(windspeed) +  " (Temperature: " + String(temp) + ", Humidity: " + String(humidity));
                Critical[index] = 5;
            } 
            
            else {

                //Serial.println("Critical: 3.1 at time " + String(hours_estimation[index]) + ". Temperature: " + String(temp) + ", Humidity: " + String(humidity) + ", Windspeed: " + String(windspeed));
                Critical[index] = 3;
                double Time_period = delta_time_spray_3;
                double frequency = 1.0 / Time_period;
                SprayingFrequency[index] = frequency;

                float time_of_spraying_start = 0;
                if (hours_estimation[index] < delta_time_detected_spray) {
                    time_of_spraying_start = 24 + hours_estimation[index] - delta_time_detected_spray;
                }
                else{
                    time_of_spraying_start = hours_estimation[index] - delta_time_detected_spray;
                }
                time_of_spraying_start_vector[index] = time_of_spraying_start;
                //Serial.println("Start spraying at " + String(time_of_spraying_start) + " untill " + String(hours_estimation[index]) + " with a frequency of " + String(SprayingFrequency[index]) + "/hour (e.g. every " + String(delta_time_spray_3) + "hours)");

            }

        }


        //CRITICAL LEVEL 3

        if (threshold_temp_2 <= temp && temp < threshold_temp_1 && threshold_humidity_2 < humidity) {

            if (windspeed > 50) {
                //Serial.println("Critical: 0 at time " + String(hours_estimation[index]) + "because of Windspeed: " + String(windspeed) + " (Temperature: " + String(temp) + ", Humidity: " + String(humidity));
                Critical[index] = 5;
            } 
            
            else {
                //Serial.println("Critical: 3.2  at time " + String(hours_estimation[index]) + ". Temperature: " + String(temp) + ", Humidity: " + String(humidity) + ", Windspeed: " + String(windspeed));
                Critical[index] = 3;
                double Time_period = delta_time_spray_3;
                double frequency = 1.0 / Time_period;
                SprayingFrequency[index] = frequency;

                float time_of_spraying_start = 0;
                if (hours_estimation[index] < delta_time_detected_spray) {
                    time_of_spraying_start = 24 + hours_estimation[index] - delta_time_detected_spray;
                }
                else{
                    time_of_spraying_start = hours_estimation[index] - delta_time_detected_spray;
                }
                time_of_spraying_start_vector[index] = time_of_spraying_start;
                //Serial.println("Start spraying at " + String(time_of_spraying_start) + " untill " + String(hours_estimation[index]) + " with a frequency of " + String(SprayingFrequency[index]) + "/hour (e.g. every " + String(delta_time_spray_3) + "hours)");

            }

        }



        //CRITICAL LEVEL 4

        if (temp < threshold_temp_3 && threshold_humidity_2 < humidity) {

            if (windspeed > 50) {
                //Serial.println("Critical: 0 at time " + String(hours_estimation[index]) + "because of Windspeed: " + String(windspeed) + " (Temperature: " + String(temp) + ", Humidity: " + String(humidity));
                Critical[index] = 6;
            } 
            
            else {

                //Serial.println("Critical: 4 at time " + String(hours_estimation[index]) + ". Temperature: " + String(temp) + ", Humidity: " + String(humidity) + ", Windspeed: " + String(windspeed));
                Critical[index] = 4;
                double Time_period = delta_time_spray_3;
                double frequency = 1.0 / Time_period;
                SprayingFrequency[index] = frequency;

                float time_of_spraying_start = 0;
                if (hours_estimation[index] < delta_time_detected_spray) {
                    time_of_spraying_start = 24 + hours_estimation[index] - delta_time_detected_spray;
                }
                else{
                    time_of_spraying_start = hours_estimation[index] - delta_time_detected_spray;
                }
                time_of_spraying_start_vector[index] = time_of_spraying_start;
                //Serial.println("Start spraying at " + String(time_of_spraying_start) + " untill " + String(hours_estimation[index]) + " with a frequency of " + String(SprayingFrequency[index]) + "/hour (e.g. every " + String(delta_time_spray_3) + "hours)");

            }
        }


        //CRITICAL LEVEL 0

        if  (temp >= threshold_temp_1 || humidity <= threshold_humidity_1)
          {
              Critical[index] = 0;
              //Serial.println("Critical: 0 at time " + String(hours_estimation[index]) + ". Temperature: " + String(temp) + ", Humidity: " + String(humidity) + ", Windspeed: " + String(windspeed));

              SprayingFrequency[index] = 0;

              float time_of_spraying_start = 0;
              if (hours_estimation[index] < delta_time_detected_spray) {
                  time_of_spraying_start = 24 + hours_estimation[index] - delta_time_detected_spray;
              }
              else{
                  time_of_spraying_start = hours_estimation[index] - delta_time_detected_spray;
              }
              time_of_spraying_start_vector[index] = time_of_spraying_start;
          }

        //Serial.println("For  Time: " + String(hours_estimation[index]) + ", Critical: " + String(Critical[index]) + ", Temperature: " + String(temp) + ", Humidity: " + String(humidity) + ", Windspeed: " + String(windspeed));
    }

    time_interval_start.assign(time_of_spraying_start_vector.begin(), time_of_spraying_start_vector.end());
    time_interval_finish.assign(hours_estimation.begin(), hours_estimation.end());   

    // UNCOMMENT FOR TEMP, HUMIDITY AND WINDSPEED FORECAST
    //for (int i = 0; i < SprayingFrequency.size(); ++i) {
    //    String output = "Spraying Frequency: " + String(SprayingFrequency[i], 6) + "/hour between " + String(time_of_spraying_start_vector[i]) + " and " + String(hours_estimation[i]) + ", Critical " + String(Critical[i]) + " (Temp: " + temperatures[i] + ", Humidity: " + humidities[i] + ", Windspeed; " + windSpeeds[i] + ")";
    //    Serial.println(output);
    //}


    for (int i = 0; i < SprayingFrequency.size(); ++i) {
        String output = "Spraying Frequency: " + String(SprayingFrequency[i], 6) + "/hour between " + String(time_interval_start[i]) + " and " + String(time_interval_finish[i]) + ", with critically at level " + String(Critical[i]);
        Serial.println(output);
    }
  //delay(30000);
}




//Check why Critical is displayed 10 times and not 8, the first 8 are correct
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