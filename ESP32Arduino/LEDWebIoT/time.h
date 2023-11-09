#ifndef TIME_H
#define TIME_H

/*
*   Time.h
*   This file contains everything related to the time.
*/
#include <Arduino.h>
#include <WiFi.h>
#include <NTPClient.h>
#include <WiFiUdp.h>

void setupTime();

void getTime(String* dayStamp, unsigned int* hour, unsigned int* minute, unsigned int* second);

#endif // TIME_H
