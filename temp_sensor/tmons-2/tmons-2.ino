
 #include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include "DHTesp.h"

#define DHTpin 4    //D15 of ESP32 DevKit

DHTesp dht;
//const char* ssid = "DESCO-DATA-CENTER";
//const char* password = "DESCO@DESCO#";

const char* ssid = "Rana";
const char* password = "1122334455";


String serverName = "http://10.0.1.7/tmons/monitor2.php";
//String serverName = "http://192.168.0.59/tmons/monitor2.php";

// the following variables are unsigned longs because the time, measured in
// milliseconds, will quickly become a bigger number than can be stored in an int.
unsigned long lastTime = 0;
// Timer set to 10 minutes (600000)
// Set timer to 5 seconds (5000)
unsigned long timerDelay = 1000*60;
const int errorPin =  D0;// the number of the LED pin
const int successPin =  D1;// the number of the LED pin


void setup(void)
{
  // initialize the display
 Serial.begin(115200); 

 //pinMode(LED_BUILTIN, OUTPUT);     // Initialize the LED_BUILTIN pin as an output
 pinMode(errorPin, OUTPUT);     // Initialize the LED_BUILTIN pin as an output
 pinMode(successPin, OUTPUT);     // Initialize the LED_BUILTIN pin as an output
 dht.setup(DHTpin, DHTesp::DHT22); //for DHT22 Connect DHT sensor to GPIO 17

 digitalWrite(errorPin,HIGH); // turn the LED on.
 digitalWrite(successPin, LOW);     // Initialize the LED_BUILTIN pin as an output
 delay(1000);

  WiFi.begin(ssid, password);     //Connect to your WiFi router
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
    digitalWrite(errorPin,HIGH); // turn the LED on.

  }
  Serial.println("");
  digitalWrite(errorPin,LOW); // turn the LED on.

  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
  digitalWrite(successPin, LOW);
}
 
float tKelvin, tCelsius, tFahrenheit;
// main loop
void loop()
{
   int i=0;
  for(i=0;i<=5;i++){
  digitalWrite(successPin, LOW); // turn the LED on.
  delay(100); 
  digitalWrite(successPin, HIGH);// turn the LED off.(Note that LOW is the voltage level but actually                        
  delay(100); 
  }
  digitalWrite(successPin, LOW);// turn the LED off.(Note that LOW is the voltage level but actually                        

/*
int analogValue = analogRead(outputpin);
float millivolts = (analogValue/1024.0) * 3300; //3300 is the voltage provided by NodeMCU
float celsius = millivolts/10;

 */

 float celsius = dht.getTemperature();
 Serial.print("in DegreeC=   ");
 Serial.println(celsius);
  delay(timerDelay-1000);  // wait a second

  if(WiFi.status()== WL_CONNECTED){
      HTTPClient http;

      String serverPath = serverName + "?temperature="+celsius+"&server=1";
      
      // Your Domain name with URL path or IP address with path
      http.begin(serverPath.c_str());
      
      // Send HTTP GET request
      int httpResponseCode = http.GET();
      
      if (httpResponseCode>0) {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);
        String payload = http.getString();
        Serial.println(payload);
      }
      else {
        Serial.print("Error code: ");
        Serial.println(httpResponseCode);
      }
      // Free resources
      http.end();
    }
    else {
      Serial.println("WiFi Disconnected");
    }
  

}
 
// end of code.
