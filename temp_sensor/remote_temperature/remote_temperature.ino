/**************************************************************************
 * 
 * ESP8266 NodeMCU with Nokia 5110 LCD (84x48 Pixel) and LM35 analog
 *   temperature sensor.
 * This is a free software with NO WARRANTY.
 * https://simple-circuit.com/
 *
 *************************************************************************/
 
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>

//const char* ssid = "DESCO-ICT";
//const char* password = "DESCO@DESCO#";

const char* ssid = "descoss3_1";
const char* password = "powerisy0urs";


//String serverName = "http://10.0.1.39/tmons/monitor.php";
String serverName = "http://192.168.0.59/tmons/monitor.php";

// the following variables are unsigned longs because the time, measured in
// milliseconds, will quickly become a bigger number than can be stored in an int.
unsigned long lastTime = 0;
// Timer set to 10 minutes (600000)
// Set timer to 5 seconds (5000)
unsigned long timerDelay = 1000*60;


 
void setup(void)
{
  // initialize the display
  
 Serial.begin(9600); 
 //pinMode(LED_BUILTIN, OUTPUT);     // Initialize the LED_BUILTIN pin as an output
 pinMode(LED_BUILTIN, OUTPUT);     // Initialize the LED_BUILTIN pin as an output
  
 digitalWrite(LED_BUILTIN, HIGH); // turn the LED on.

  WiFi.begin(ssid, password);     //Connect to your WiFi router
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
     digitalWrite(LED_BUILTIN, HIGH); // turn the LED on.

  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
  digitalWrite(LED_BUILTIN, LOW);
}
 
float tKelvin, tCelsius, tFahrenheit;
// main loop
void loop()
{
  int i=0;
  for(i=0;i<=5;i++){
  digitalWrite(LED_BUILTIN, LOW); // turn the LED on.
  delay(100); 
  digitalWrite(LED_BUILTIN, HIGH);// turn the LED off.(Note that LOW is the voltage level but actually                        
  delay(100);  
  }
  digitalWrite(LED_BUILTIN, LOW);// turn the LED off.(Note that LOW is the voltage level but actually                        

int analogValue = analogRead(A0);
float celsius = (analogValue/1024.0) * 3300; //3300 is the voltage provided by NodeMCU
Serial.print("in DegreeC=   ");

  tCelsius = (celsius/10.00)-5; 
  
  Serial.println(tCelsius);
 
  delay(timerDelay-1000);  // wait a second

  if(WiFi.status()== WL_CONNECTED){
      HTTPClient http;

      String serverPath = serverName + "?temperature="+tCelsius+"&server=1";
      
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
