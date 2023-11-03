#ifndef MODES_H
#define MODES_H

#include <Arduino.h>

enum Mode {
    OFF = 0,
    MANUAL = 1,
    TIMER = 2,
    AUTOMATIC = 3,
};


/*
*   Modes.h
*   This file contains everything related to the different modes of the FAST IoT Deicing.
*   The modes are:
*   - Manual mode: The user can manually turn on and off the deicing system.
*   - Timer mode: The user can set a timer to turn on and off the deicing system.
*   - Automatic mode: The system automatically turns on and off the deicing system based on the weather API's data.
*
*/

void manualMode();
void timerMode();
void automaticMode();
void offMode();
void switchMode(Mode mode);

#endif // MODES_H
