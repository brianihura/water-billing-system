#include <WiFi.h>

const char* ssid = "denis";
const char* password = "0987654321";

void setup() {
  Serial.begin(115200);
  
  // Connect to WiFi
  connectToWiFi();
}

void loop() {
  // Add your main code here
  delay(1000); // Sample delay
}
