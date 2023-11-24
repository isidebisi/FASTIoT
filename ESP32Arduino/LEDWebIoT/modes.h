#ifndef MODES_H
#define MODES_H

#include <Arduino.h>
#include "definitions.h"

#define SPRAY_TIME_MS 15*1000     //how long we want to spray in milli seconds




/*
*   Modes.h
*   This file contains everything related to the different modes of the FAST IoT Deicing.
*   The modes are:
*   - Manual mode: The user can manually turn on and off the deicing system.
*   - Timer mode: The user can set a timer to turn on and off the deicing system.
*   - Automatic mode: The system automatically turns on and off the deicing system based on the weather API's data.
*
*/


void offMode(ControlVariables* controls);
void manualMode(ControlVariables* controls);
void timerMode(ControlVariables* controls);
void automaticMode(ControlVariables* controls);
void executeMode(Mode mode, ControlVariables* controls);

#endif // MODES_H
