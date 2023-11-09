#include "modes.h"
#include "time.h"
#include <Arduino.h>


void manualMode() {
    
}

void timerMode() {
    
}

void automaticMode() {
    
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