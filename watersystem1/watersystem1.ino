#define BLYNK_TEMPLATE_ID "TMPL6ixzEM5bS"
#define BLYNK_TEMPLATE_NAME "Sucrose"
#define BLYNK_AUTH_TOKEN "DYkevugaSQ-g_SkfpPOsAtArA43q5jOe"

#include <WiFi.h>
#include <BlynkSimpleEsp32.h>
#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <HTTPClient.h>

char ssid[] = "A1";
char pass[] = "12345678";

#define SOIL_PIN 34
#define RELAY_PIN 26

int batasKering = 2500;
int soilKering = 4095;   // Kalibrasi sensor saat kering
int soilBasah  = 1600;   // Kalibrasi sensor saat basah

#define SCREEN_WIDTH 128
#define SCREEN_HEIGHT 64

Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, -1);

BlynkTimer timer;


void kirimData() {

  int soil = analogRead(SOIL_PIN);

  int kelembapan = map(soil, soilKering, soilBasah, 0, 100);

  // Membatasi agar tetap 0–100%
  kelembapan = constrain(kelembapan, 0, 100);

 Blynk.virtualWrite(V0, kelembapan);

String statusSoil;
String statusPump;

if (kelembapan < 40) {

  digitalWrite(RELAY_PIN, LOW);
  Blynk.virtualWrite(V1, 1);

  statusSoil = "KERING";
  statusPump = "ON";

}
else if (kelembapan < 70 ){

  digitalWrite(RELAY_PIN, HIGH);
  Blynk.virtualWrite(V1, 0);

  statusSoil = "LEMBAB";
  statusPump = "OFF";
}
else {

  digitalWrite(RELAY_PIN, HIGH);
  Blynk.virtualWrite(V1, 0);

  statusSoil = "BASAH";
  statusPump = "OFF";

}

display.clearDisplay();

display.setTextSize(2);
display.setTextColor(SSD1306_WHITE);
display.setCursor(10,0);
display.println("Sucrose");

display.setTextSize(1);

display.setCursor(0,24);
display.print("Status Tanah : ");
display.println(statusSoil);

display.setCursor(0,38);
display.print("lembap       : ");
display.print(kelembapan);
display.println("%");

display.setCursor(0,52);
display.print("Status Pompa : ");
display.println(statusPump);

display.display();
// ======================
// Kirim data ke Website
// ======================

if(WiFi.status() == WL_CONNECTED){

    HTTPClient http;

    http.begin("http://10.200.89.165/Sucrose/api/sensor.php");

    http.addHeader("Content-Type","application/x-www-form-urlencoded");

    String data =
    "soil=" + String(kelembapan) +
    "&status_tanah=" + statusSoil +
    "&pump=" + statusPump;

    int httpResponse = http.POST(data);

    Serial.print("HTTP Response : ");
    Serial.println(httpResponse);

    http.end();

}

}

void setup() {

  Serial.begin(115200);

  pinMode(RELAY_PIN, OUTPUT);

  digitalWrite(RELAY_PIN, HIGH);

if(!display.begin(SSD1306_SWITCHCAPVCC, 0x3C)){
  Serial.println("OLED tidak ditemukan");
  while(true);
}

display.clearDisplay();
display.setTextColor(SSD1306_WHITE);

// Splash Screen
display.setTextSize(2);
display.setCursor(15,18);
display.println("Sucrose");

display.setTextSize(1);
display.setCursor(18,45);
display.println("Smart Irrigation");

display.display();

delay(2500);

  Blynk.begin(
    BLYNK_AUTH_TOKEN,
    ssid,
    pass
  );

  timer.setInterval(2000L, kirimData);
}

void loop() {

  Blynk.run();
  timer.run();

}