#include "modes.h"
#include "time.h"
#include <Arduino.h>


void manualMode() {
    // Implement manual mode functionality here
}

void timerMode() {
    // Implement timer mode functionality here
}

void automaticMode() {
    // Implement automatic mode functionality here
}

void offMode() {
    // Implement off mode functionality here
}

void switchMode(Mode mode) {
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