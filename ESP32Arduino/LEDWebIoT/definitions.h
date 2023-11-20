
#ifndef DEFINITIONS_H
#define DEFINITIONS_H

//ENUMS

enum Mode {
    OFF = 0,
    MANUAL = 1,
    TIMER = 2,
    AUTOMATIC = 3,
};

enum TankLevel {
    EMPTY = 0,
    REFILLING = 1,
    MEDIUM = 2,
    FULL = 3,
};

enum ServerMessages {
    ReadTimeOfSpray,
    ReadOperationMode,
    WriteIsSpraying,
    WriteLastOnline,
    WriteLastSprayed,
    WriteNextSpray,
    WriteOperationMode,
    WriteSaltConcentration,
    WriteSaltLevel,
    WriteWaterTankLevel,
};

// STRUCTURES

struct ControlVariables {

  //GENERAL
  Mode currentMode = OFF;


  bool sprayNow = false;
  bool isSpraying = false;
  
  //TIME
  String dayStamp;
  unsigned int hour;
  unsigned int minute;
  unsigned int second;

  //Scheduled Spray
  unsigned int scheduledSprayHour;
  unsigned int scheduledSprayMinute;
  unsigned int scheduledSpraySecond;

  //lastSprayed
  String lastSprayedDayStamp;
  unsigned int lastSprayedHour;
  unsigned int lastSprayedMinute;
  unsigned int lastSprayedSecond;

  //nextSpray
  String nextSprayDayStamp;
  unsigned int nextSprayHour;
  unsigned int nextSprayMinute;
  unsigned int nextSpraySecond;

  //location
  double latitude;
  double longitude;

  //Tank and Salt
  TankLevel waterTankLevel = EMPTY;
  bool saltLevel = false;
  unsigned int saltConcentration = 0;

};

#endif // DEFINITIONS_H
