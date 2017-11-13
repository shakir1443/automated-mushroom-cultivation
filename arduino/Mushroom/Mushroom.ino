#include <DHT11.h>
#include <SoftwareSerial.h>
#include <Wire.h>
#include <DS3231.h>
DS3231 clock;
RTCDateTime dt;
SoftwareSerial esp(2,3);
int pin=4;
//int fan=13;
//int water=12;
#define anInput     A0                        //analog feed from MQ135
#define digTrigger   8                        //digital feed from MQ135
#define co2Zero     55                        //calibrated CO2 0 level
#define light       A1

int val = 0; //value for storing moisture value 
int soilPin = A2;//Declare a variable for the soil moisture sensor 
int soilPower = 7;//Variable for Soil moisture Power
DHT11 dht11(pin); 
void setup()
{
  pinMode(light,INPUT);
 // pinMode(fan,OUTPUT);
 // pinMode(water,OUTPUT);
  pinMode(anInput,INPUT);                     //MQ135 analog feed set for input
  pinMode(digTrigger,INPUT);                  //MQ135 digital feed set for input
  pinMode(soilPower, OUTPUT);//Set D7 as an OUTPUT
 //  digitalWrite(fan,HIGH);
 // digitalWrite(water,HIGH);
  digitalWrite(soilPower, LOW);//Set to LOW so no power is flowing through the sensor
  Serial.begin(9600);                         //serial comms for debuging
  esp.begin(9600);
  clock.begin();

  // Set sketch compiling time
  clock.setDateTime(__DATE__, __TIME__);
  esp.write("AT+CWJAP=\"DataSoft_WiFi\",\"support123\"\r\n");
  delay(2000);
  while (!Serial) {
      ; // wait for serial port to connect. Needed for Leonardo only
    }
}
int readSoil()
{
    digitalWrite(soilPower, HIGH);//turn D7 "On"
    delay(10);//wait 10 milliseconds 
    val = analogRead(soilPin);//Read the SIG value form sensor 
    digitalWrite(soilPower, LOW);//turn D7 "Off"
    return val;//send current moisture value
}
/*
void fan_control()
{
  digitalWrite(fan,LOW);
  delay(10000);
  digitalWrite(fan,HIGH);
}

void water_control()
{
  digitalWrite(water,LOW);
  delay(7500);
  digitalWrite(water,HIGH);
}
*/
void loop()
{
  int err;
  float temp, humi;
  int co2now[10];                               //int array for co2 readings
  int co2raw = 0;                               //int for raw value of co2
  int co2comp = 0;                              //int for compensated co2 
  int co2ppm = 0;                               //int for calculated ppm
  int zzz = 0;                                  //int for averaging
  String t,h;
  dt = clock.getDateTime();
  /*
 
  if(dt.hour == 0 && dt.minute == 1)
  {
    fan_control();
  }
  else if(dt.hour == 7 && dt.minute == 1)
  {
    water_control();
    delay(1500);
    fan_control();
  }
  else if(dt.hour == 10 && dt.minute == 1)
  {
    water_control();
    delay(1500);
    fan_control();
  }
  else if(dt.hour == 13 && dt.minute == 1)
  {
    water_control();
    delay(1500);
    fan_control();
  }
  else if(dt.hour == 15 && dt.minute == 40)
  {
    water_control();
    delay(1500);
    fan_control();
  }
  else if(dt.hour == 18 && dt.minute == 1)
  {
    water_control();
    delay(1500);
    fan_control();
  }
  */
  Serial.print("Raw data: ");
  Serial.print(dt.year);   Serial.print("-");
  Serial.print(dt.month);  Serial.print("-");
  Serial.print(dt.day);    Serial.print(" ");
  Serial.print(dt.hour);   Serial.print(":");
  Serial.print(dt.minute); Serial.print(":");
  Serial.print(dt.second); Serial.println("");
  int li = analogRead(A1);
  String lit = String(li);
  String lite = String(lit+",");
  String light_sensor = String("Light Sensitivity : "+lit);
  Serial.println(light_sensor);
  String s = "Soil Moisture : ";
  val = readSoil();
  int value =100-(val-223 )/8;
  String value5 = String(value);
  String value4 = String(lite+value5);
  String sc = String(value4+",");
  String so= String(s+value);
  String soil= String(so+" %");
  Serial.println(soil);
  for (int x = 0;x<10;x++){                     //samplpe co2 10x over 2 seconds
    co2now[x]=analogRead(A0);
    delay(100);
  }
  for (int x = 0;x<10;x++){                     //add samples together
    zzz=zzz + co2now[x];
  }
  co2raw = zzz/10;                            //divide samples by 10
  co2comp = co2raw - co2Zero;                 //get compensated value
  co2ppm = map(co2comp,0,1023,300,8000);      //map value for atmospheric levels
  Serial.print("Measurement of CO2 : ");
  Serial.println(co2ppm);                    //Measuring CO2 Using equilibiriam
  
  String sco = String(sc+co2ppm);
 
  if((err=dht11.read(humi, temp))==0)
  {
    Serial.print("Temperature : ");
    Serial.print(temp);
    Serial.print("C");
    Serial.print("\n");
    Serial.print("Humidity : ");
    Serial.print(humi);
    Serial.print("%");
    Serial.println();
    t = String(temp,2);
    h = String(humi,4);
 
  }
  else
  {
    Serial.println();
    Serial.print("Error No :");
    Serial.print(err);
    Serial.println();    
  }
  String th = String(sco+",");
  String thu = String(th+t);
  String thum = String(thu+",");
  String thumi = String(thum+h);
  esp.write("AT+CIPSTART=\"TCP\",\"192.168.4.235\",8000\r\n");
  delay(2000);
  esp.write("AT+CIPSEND=21\r\n");
  delay(1000);
  esp.print(thumi);
  delay(2000);
  esp.write("AT+CIPCLOSE\r\n");
  delay(1000);
  delay(DHT11_RETRY_DELAY); //delay for reread
  delay(300000);
}




