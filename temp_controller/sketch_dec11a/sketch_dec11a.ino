#include <LiquidCrystal.h>

LiquidCrystal lcd(7,6,5,4,3,2);

int val;
int tempPin = 1;

void setup( ) {
pinMode(tempPin, INPUT);
lcd.begin(16, 2);
lcd.clear( );
}

void loop( ) {
val = analogRead(tempPin);
float temp = ( val*500)/1023;
float farh = (temp*9)/5 + 32;
lcd.setCursor(0, 0);
lcd.print("Temp(C)=");
lcd.print(temp);
lcd.print("*C");
lcd.setCursor(0,1);
lcd.print(" Temp(F)=");
lcd.print(farh);
lcd.print("F");
delay(1000);
}
