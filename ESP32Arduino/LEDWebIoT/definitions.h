
#ifndef DEFINITIONS_H
#define DEFINITIONS_H

#define TIMENOTSET 61

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
    ReadOperationMode,
    ReadNextSpray,
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
  String dayStamp = "datanotset";
  unsigned int hour;
  unsigned int minute;
  unsigned int second;

  //Scheduled Spray
  unsigned int scheduledSprayHour[3] = {TIMENOTSET};
  unsigned int scheduledSprayMinute[3] = {TIMENOTSET};

  //lastSprayed
  String lastSprayedDayStamp = "datanotset";
  unsigned int lastSprayedHour = TIMENOTSET;
  unsigned int lastSprayedMinute = TIMENOTSET;
  unsigned int lastSprayedSecond = TIMENOTSET;
  String lastSprayedString = "datanotset";

  //nextSpray
  String nextSprayDayStamp = "datanotset";
  unsigned int nextSprayHour = TIMENOTSET;
  unsigned int nextSprayMinute = TIMENOTSET;
  unsigned int nextSpraySecond = TIMENOTSET;


  //location
  double latitude;
  double longitude;

  //Tank and Salt
  TankLevel waterTankLevel = EMPTY;
  bool saltLevel = false;
  unsigned int saltConcentration = 0;

};

#endif // DEFINITIONS_H
