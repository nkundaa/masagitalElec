<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'id' => 'dht22',
                'name' => 'DHT22 Temperature & Humidity Sensor',
                'category' => 'sensors',
                'price' => 3500,
                'original_price' => 4500,
                'image' => 'https://images.pexels.com/photos/343457/pexels-photo-343457.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'short_description' => 'High precision digital temperature and humidity sensor module.',
                'description' => 'The DHT22 is a basic, low-cost digital temperature and humidity sensor. It uses a capacitive humidity sensor and a thermistor to measure the surrounding air and outputs a digital signal on the data pin. It is relatively simple to use but requires careful timing to grab data.',
                'specifications' => json_encode([
                    'Operating Voltage: 3.3V to 5V',
                    'Temperature Range: -40°C to 80°C (±0.5°C accuracy)',
                    'Humidity Range: 0% to 100% (±2% accuracy)',
                    'Sampling Rate: 0.5Hz (once every 2 seconds)',
                    'Body Size: 15.1mm x 25mm x 7.7mm',
                    'Interface: Single-bus digital signal'
                ]),
                'how_it_works' => json_encode([
                    'Connect VCC to 3.3V or 5V power supply on your microcontroller.',
                    'Connect GND to the ground pin.',
                    'Connect the DATA pin to a digital input pin on your microcontroller.',
                    'Add a 10kΩ pull-up resistor between VCC and the DATA pin.',
                    'Install the DHT library in your Arduino IDE (Sketch > Include Library > DHT sensor library).',
                    'Upload the example sketch and open Serial Monitor to view temperature and humidity readings.',
                    'The sensor outputs digital data — no analog-to-digital conversion needed!'
                ]),
                'youtube_video_id' => 'OogldSc9uMg',
                'tutorial_title' => 'DHT22 Sensor with Arduino - Complete Tutorial',
                'in_stock' => true,
                'rating' => 4.7,
                'reviews' => 128,
                'badge' => 'Best Seller'
            ],
            [
                'id' => 'hcsr04',
                'name' => 'HC-SR04 Ultrasonic Distance Sensor',
                'category' => 'sensors',
                'price' => 2000,
                'original_price' => null,
                'image' => 'https://images.pexels.com/photos/14887613/pexels-photo-14887613.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'short_description' => 'Accurate non-contact distance measurement from 2cm to 400cm.',
                'description' => 'The HC-SR04 ultrasonic sensor uses sonar to determine distance to an object. It offers excellent non-contact range detection with high accuracy and stable readings. It comes complete with an ultrasonic transmitter and receiver module.',
                'specifications' => json_encode([
                    'Operating Voltage: 5V DC',
                    'Operating Current: 15mA',
                    'Measuring Range: 2cm – 400cm',
                    'Measuring Angle: 15 degrees',
                    'Trigger Input Signal: 10µs TTL pulse',
                    'Dimension: 45 x 20 x 15mm'
                ]),
                'how_it_works' => json_encode([
                    'Connect VCC to 5V and GND to ground on your Arduino.',
                    'Connect TRIG pin to a digital output pin (e.g., pin 9).',
                    'Connect ECHO pin to a digital input pin (e.g., pin 10).',
                    'Send a 10µs HIGH pulse to the TRIG pin to start measurement.',
                    'The sensor sends 8 ultrasonic pulses at 40kHz.',
                    'Measure the duration of the HIGH pulse on the ECHO pin.',
                    'Calculate distance: Distance = (Duration × 0.034) / 2 cm.'
                ]),
                'youtube_video_id' => 'ZejQOX69K5M',
                'tutorial_title' => 'HC-SR04 Ultrasonic Sensor Arduino Tutorial',
                'in_stock' => true,
                'rating' => 4.5,
                'reviews' => 95,
                'badge' => null
            ],
            [
                'id' => 'mpu6050',
                'name' => 'MPU-6050 Accelerometer & Gyroscope',
                'category' => 'sensors',
                'price' => 4000,
                'original_price' => 5000,
                'image' => 'https://images.pexels.com/photos/4549831/pexels-photo-4549831.png?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'short_description' => '6-axis motion tracking sensor with built-in DMP.',
                'description' => 'The MPU-6050 is the world\'s first integrated 6-axis MotionTracking device that combines a 3-axis gyroscope, 3-axis accelerometer, and a Digital Motion Processor (DMP). Perfect for drones, robots, and motion tracking projects.',
                'specifications' => json_encode([
                    'Gyroscope Range: ±250, ±500, ±1000, ±2000 °/s',
                    'Accelerometer Range: ±2g, ±4g, ±8g, ±16g',
                    'Communication: I2C interface',
                    'Operating Voltage: 3.3V – 5V',
                    'Built-in 16-bit ADC',
                    'Digital Motion Processing (DMP) engine'
                ]),
                'how_it_works' => json_encode([
                    'Connect VCC to 3.3V or 5V and GND to ground.',
                    'Connect SDA to Arduino A4 (SDA) and SCL to Arduino A5 (SCL).',
                    'Install the MPU6050 library from the Arduino Library Manager.',
                    'Initialize the sensor using Wire.begin() and the MPU6050 library.',
                    'Read accelerometer values (ax, ay, az) for tilt and motion detection.',
                    'Read gyroscope values (gx, gy, gz) for rotation rate measurement.',
                    'Use the DMP for advanced motion processing and sensor fusion.'
                ]),
                'youtube_video_id' => 'wTfSfhjhAU0',
                'tutorial_title' => 'MPU-6050 Gyroscope + Accelerometer Arduino Tutorial',
                'in_stock' => true,
                'rating' => 4.8,
                'reviews' => 73,
                'badge' => 'Popular'
            ],
            [
                'id' => 'pir-motion',
                'name' => 'PIR Motion Sensor Module',
                'category' => 'sensors',
                'price' => 1500,
                'original_price' => null,
                'image' => 'https://images.pexels.com/photos/7394229/pexels-photo-7394229.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'short_description' => 'Passive infrared motion detection for security and automation.',
                'description' => 'The PIR (Passive Infrared) motion sensor detects movement by measuring changes in infrared radiation levels. It is widely used in security alarms, automatic lighting, and home automation systems.',
                'specifications' => json_encode([
                    'Operating Voltage: 4.5V to 20V',
                    'Detection Range: up to 7 meters',
                    'Detection Angle: 110° cone',
                    'Output: Digital HIGH/LOW (3.3V TTL)',
                    'Delay Time: Adjustable (0.3s to 5min)',
                    'Dimensions: 32mm x 24mm'
                ]),
                'how_it_works' => json_encode([
                    'Connect VCC to 5V, GND to ground, and OUT to a digital pin.',
                    'Allow the sensor 30-60 seconds to calibrate when first powered on.',
                    'The sensor outputs HIGH when motion is detected.',
                    'Adjust the sensitivity potentiometer on the board to set detection range.',
                    'Adjust the time-delay potentiometer to set how long output stays HIGH.',
                    'Use digitalRead() in your code to check the sensor output.',
                    'Combine with buzzer or LED for a simple alarm system.'
                ]),
                'youtube_video_id' => '6Fdrr_1WLEY',
                'tutorial_title' => 'PIR Motion Sensor with Arduino - Beginner Tutorial',
                'in_stock' => true,
                'rating' => 4.4,
                'reviews' => 61,
                'badge' => null
            ],
            [
                'id' => 'arduino-uno',
                'name' => 'Arduino Uno R3 Board',
                'category' => 'microcontrollers',
                'price' => 12000,
                'original_price' => 15000,
                'image' => 'https://images.pexels.com/photos/343457/pexels-photo-343457.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'short_description' => 'The most popular microcontroller board for beginners and experts.',
                'description' => 'The Arduino Uno R3 is the most used and documented board in the Arduino family. It is based on the ATmega328P microcontroller. It has 14 digital I/O pins, 6 analog inputs, a USB connection, and a power jack. It\'s the perfect board to get started with electronics and coding.',
                'specifications' => json_encode([
                    'Microcontroller: ATmega328P',
                    'Operating Voltage: 5V',
                    'Digital I/O Pins: 14 (6 PWM output)',
                    'Analog Input Pins: 6',
                    'Flash Memory: 32 KB',
                    'Clock Speed: 16 MHz',
                    'USB Type-B connector'
                ]),
                'how_it_works' => json_encode([
                    'Download and install the Arduino IDE from arduino.cc.',
                    'Connect the Arduino Uno to your computer using a USB Type-B cable.',
                    'Select "Arduino Uno" from Tools > Board menu in the IDE.',
                    'Select the correct COM port from Tools > Port.',
                    'Write your code in the setup() and loop() functions.',
                    'Click the Upload button to compile and upload your sketch.',
                    'The built-in LED on pin 13 can be used for your first "Blink" test.'
                ]),
                'youtube_video_id' => 'fJWR7dBuc18',
                'tutorial_title' => 'Arduino Uno for Beginners - Complete Getting Started Guide',
                'in_stock' => true,
                'rating' => 4.9,
                'reviews' => 215,
                'badge' => 'Top Rated'
            ],
            [
                'id' => 'esp32',
                'name' => 'ESP32 Development Board (WiFi + BLE)',
                'category' => 'microcontrollers',
                'price' => 8000,
                'original_price' => null,
                'image' => 'https://images.pexels.com/photos/14887613/pexels-photo-14887613.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'short_description' => 'Powerful dual-core MCU with built-in WiFi and Bluetooth.',
                'description' => 'The ESP32 is a powerful, generic WiFi+BT+BLE MCU module that targets a wide variety of applications. It features a dual-core processor, built-in WiFi and Bluetooth connectivity, making it the go-to choice for IoT projects.',
                'specifications' => json_encode([
                    'Processor: Dual-core Xtensa 32-bit LX6, up to 240MHz',
                    'WiFi: 802.11 b/g/n',
                    'Bluetooth: v4.2 BR/EDR and BLE',
                    'GPIO Pins: 36',
                    'Flash Memory: 4MB',
                    'RAM: 520 KB SRAM',
                    'Operating Voltage: 3.3V'
                ]),
                'how_it_works' => json_encode([
                    'Install ESP32 board support in Arduino IDE via Board Manager.',
                    'Connect the ESP32 to your computer using a micro-USB cable.',
                    'Select "ESP32 Dev Module" from Tools > Board.',
                    'Hold the BOOT button while uploading your first sketch.',
                    'Use WiFi.begin(ssid, password) to connect to your WiFi network.',
                    'Create a web server with WiFiServer or use HTTP client for API calls.',
                    'Use BLE libraries for Bluetooth Low Energy communication.'
                ]),
                'youtube_video_id' => 'xPlN_Tk3VLQ',
                'tutorial_title' => 'Getting Started with ESP32 - WiFi & Bluetooth Tutorial',
                'in_stock' => true,
                'rating' => 4.8,
                'reviews' => 187,
                'badge' => 'Best for IoT'
            ],
            [
                'id' => 'raspberry-pi-pico',
                'name' => 'Raspberry Pi Pico W',
                'category' => 'microcontrollers',
                'price' => 10000,
                'original_price' => 12000,
                'image' => 'https://images.pexels.com/photos/4549831/pexels-photo-4549831.png?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'short_description' => 'Compact microcontroller with WiFi, powered by RP2040 chip.',
                'description' => 'Raspberry Pi Pico W adds on-board WiFi to the Pico platform. Built on the RP2040 chip with a dual-core Arm Cortex-M0+ processor, it offers flexibility and power for embedded projects. Supports MicroPython and C/C++.',
                'specifications' => json_encode([
                    'Chip: RP2040 Dual-core Arm Cortex-M0+ @ 133MHz',
                    'RAM: 264kB SRAM',
                    'Flash: 2MB on-board',
                    'GPIO: 26 multi-function pins',
                    'WiFi: 2.4GHz 802.11n',
                    'USB: Micro-USB (USB 1.1)',
                    'Supports MicroPython, C/C++'
                ]),
                'how_it_works' => json_encode([
                    'Download MicroPython UF2 firmware from raspberrypi.com.',
                    'Hold BOOTSEL button and connect Pico to your PC via USB.',
                    'Drag and drop the UF2 file onto the RPI-RP2 drive.',
                    'Install Thonny IDE for easy MicroPython programming.',
                    'Select "Raspberry Pi Pico" as the interpreter in Thonny.',
                    'Write Python code and click Run to execute on the Pico.',
                    'Use the network library to connect to WiFi for IoT projects.'
                ]),
                'youtube_video_id' => 'JucQb4DKHOQ',
                'tutorial_title' => 'Raspberry Pi Pico W Getting Started Guide',
                'in_stock' => true,
                'rating' => 4.7,
                'reviews' => 142,
                'badge' => null
            ],
            [
                'id' => 'stm32',
                'name' => 'STM32 Blue Pill (STM32F103C8T6)',
                'category' => 'microcontrollers',
                'price' => 5500,
                'original_price' => null,
                'image' => 'https://images.pexels.com/photos/14517351/pexels-photo-14517351.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'short_description' => '32-bit ARM Cortex-M3 development board, Arduino compatible.',
                'description' => 'The STM32 Blue Pill is a compact, affordable development board based on the STM32F103C8T6 ARM Cortex-M3 microcontroller. It offers superior performance to Arduino Uno at a fraction of the cost and can be programmed with Arduino IDE.',
                'specifications' => json_encode([
                    'Processor: ARM Cortex-M3 @ 72MHz',
                    'Flash: 64KB (some have 128KB)',
                    'RAM: 20KB SRAM',
                    'GPIO: 37 pins',
                    'ADC: 2x 12-bit ADCs',
                    'Communication: USART, SPI, I2C, USB',
                    'Operating Voltage: 3.3V'
                ]),
                'how_it_works' => json_encode([
                    'Install STM32 board support in Arduino IDE via Board Manager.',
                    'Connect an ST-Link V2 programmer to the SWD pins (SWDIO, SWCLK, GND, 3.3V).',
                    'Select "Generic STM32F103C" from Tools > Board.',
                    'Set Upload Method to "STLink" in Tools menu.',
                    'Write your code using familiar syntax.',
                    'Click Upload to flash the firmware via ST-Link.',
                    'Alternatively, use the USB bootloader for cable-free programming.'
                ]),
                'youtube_video_id' => 'JnEMdqqEFMk',
                'tutorial_title' => 'STM32 Blue Pill Programming with Arduino IDE',
                'in_stock' => true,
                'rating' => 4.5,
                'reviews' => 89,
                'badge' => null
            ],
            [
                'id' => 'nodemcu-esp8266',
                'name' => 'NodeMCU ESP8266 WiFi Module',
                'category' => 'iot',
                'price' => 5000,
                'original_price' => 6500,
                'image' => 'https://images.pexels.com/photos/343457/pexels-photo-343457.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'short_description' => 'WiFi-enabled IoT development board with Lua/Arduino support.',
                'description' => 'NodeMCU is an open-source IoT platform based on the ESP8266 WiFi module. It includes firmware running on the ESP8266 SoC and hardware based on the ESP-12 module. Perfect for building connected IoT devices and smart home projects.',
                'specifications' => json_encode([
                    'WiFi: 802.11 b/g/n (2.4GHz)',
                    'Processor: ESP8266 @ 80/160MHz',
                    'Flash: 4MB',
                    'GPIO: 11 pins (some with PWM, I2C, SPI)',
                    'ADC: 1 (10-bit)',
                    'Operating Voltage: 3.3V',
                    'USB: Micro-USB with CH340 driver'
                ]),
                'how_it_works' => json_encode([
                    'Install CH340 USB driver for your operating system.',
                    'Add ESP8266 board URL in Arduino IDE Preferences.',
                    'Install "ESP8266" from Board Manager.',
                    'Connect NodeMCU via micro-USB and select the correct port.',
                    'Use WiFi.begin() to connect to your network.',
                    'Set up a web server to control GPIO pins remotely.',
                    'Connect sensors and publish data to cloud platforms like ThingSpeak or Blynk.'
                ]),
                'youtube_video_id' => 'G6CqvhXpBKM',
                'tutorial_title' => 'NodeMCU ESP8266 IoT Tutorial - Web Server & Sensors',
                'in_stock' => true,
                'rating' => 4.6,
                'reviews' => 167,
                'badge' => 'Hot Deal'
            ],
            [
                'id' => 'lora-module',
                'name' => 'LoRa SX1278 433MHz Wireless Module',
                'category' => 'iot',
                'price' => 7500,
                'original_price' => null,
                'image' => 'https://images.pexels.com/photos/14887613/pexels-photo-14887613.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'short_description' => 'Long-range wireless communication up to 10km for IoT networks.',
                'description' => 'The LoRa SX1278 module enables long-range, low-power wireless communication. With a range of up to 10km in open areas, it\'s ideal for agricultural monitoring, smart cities, and environmental sensing applications.',
                'specifications' => json_encode([
                    'Frequency: 433MHz',
                    'Modulation: LoRa / FSK',
                    'Range: Up to 10km (line of sight)',
                    'Sensitivity: -148dBm',
                    'TX Power: +20dBm',
                    'Interface: SPI',
                    'Operating Voltage: 1.8V to 3.7V'
                ]),
                'how_it_works' => json_encode([
                    'Connect the LoRa module to Arduino via SPI (MOSI, MISO, SCK, NSS).',
                    'Connect RESET and DIO0 pins to digital pins on Arduino.',
                    'Install the LoRa library by Sandeep Mistry.',
                    'Initialize with LoRa.begin(433E6) for 433MHz frequency.',
                    'Use LoRa.beginPacket(), LoRa.print(), LoRa.endPacket() to send data.',
                    'Use LoRa.parsePacket() and LoRa.readString() to receive data.',
                    'Build sender and receiver nodes for a complete IoT network.'
                ]),
                'youtube_video_id' => '_e_0MYGpYgI',
                'tutorial_title' => 'LoRa Long Range IoT Communication Tutorial',
                'in_stock' => true,
                'rating' => 4.6,
                'reviews' => 54,
                'badge' => null
            ],
            [
                'id' => 'sim800l',
                'name' => 'SIM800L GSM/GPRS Module',
                'category' => 'iot',
                'price' => 6000,
                'original_price' => null,
                'image' => 'https://images.pexels.com/photos/4549831/pexels-photo-4549831.png?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'short_description' => 'Cellular connectivity module for SMS, calls, and GPRS data.',
                'description' => 'The SIM800L is a miniature cellular module that allows your projects to make/receive calls, send/receive SMS, and connect to the internet via GPRS. Perfect for remote IoT deployments where WiFi is not available.',
                'specifications' => json_encode([
                    'Quad-band: 850/900/1800/1900MHz',
                    'GPRS: Class 12 (max 85.6kbps)',
                    'SMS & Voice calls support',
                    'Operating Voltage: 3.4V to 4.4V',
                    'Current: 2A peak during transmission',
                    'SIM Card: Micro SIM',
                    'Serial Interface: UART'
                ]),
                'how_it_works' => json_encode([
                    'Insert a micro SIM card with an active data plan.',
                    'Power the module with a stable 3.7V-4.2V supply (not directly from Arduino!).',
                    'Connect TX to Arduino RX and RX to Arduino TX (use voltage divider for RX).',
                    'Use AT commands via Serial to communicate with the module.',
                    'Send SMS: AT+CMGF=1, then AT+CMGS="+250xxxxxxxx".',
                    'Make a call: ATD+250xxxxxxxx;',
                    'For GPRS, configure APN with AT+SAPBR commands and use HTTP AT commands.'
                ]),
                'youtube_video_id' => 'S_mDLfEJeRw',
                'tutorial_title' => 'SIM800L GSM Module - Send SMS & Make Calls with Arduino',
                'in_stock' => true,
                'rating' => 4.3,
                'reviews' => 98,
                'badge' => null
            ],
            [
                'id' => 'relay-wifi',
                'name' => 'Smart WiFi Relay Module (4 Channel)',
                'category' => 'iot',
                'price' => 8500,
                'original_price' => null,
                'image' => 'https://images.pexels.com/photos/18311088/pexels-photo-18311088.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'short_description' => 'Control 4 appliances remotely via WiFi with smartphone app.',
                'description' => 'This 4-channel WiFi relay module allows you to control home appliances remotely using your smartphone. It supports both manual switch and WiFi control, making it perfect for smart home automation projects.',
                'specifications' => json_encode([
                    'Channels: 4 independent relays',
                    'Max Load: 10A 250VAC per channel',
                    'WiFi: ESP8266 built-in',
                    'Control: App / Web / Voice (Alexa compatible)',
                    'Power Supply: 5V DC / 7-32V DC',
                    'Supports: Momentary / Latching modes',
                    'Dimensions: 90mm x 55mm x 20mm'
                ]),
                'how_it_works' => json_encode([
                    'Connect the module to 5V DC power supply.',
                    'Connect appliances to the relay terminals (COM, NO, NC).',
                    'Download the eWeLink app on your smartphone.',
                    'Long press the button on the module to enter pairing mode.',
                    'Follow the app instructions to connect to your WiFi network.',
                    'Name each channel (e.g., Living Room Light, Fan, etc.).',
                    'Control your appliances remotely from anywhere in the world!'
                ]),
                'youtube_video_id' => 'BtLwoNJ6klE',
                'tutorial_title' => 'Smart WiFi Relay - Home Automation Setup Guide',
                'in_stock' => true,
                'rating' => 4.5,
                'reviews' => 76,
                'badge' => 'Smart Home'
            ],
            [
                'id' => 'sg90-servo',
                'name' => 'SG90 Micro Servo Motor',
                'category' => 'actuators',
                'price' => 2500,
                'original_price' => null,
                'image' => 'https://images.pexels.com/photos/7254460/pexels-photo-7254460.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'short_description' => 'Lightweight 9g servo motor with 180° rotation for robotics.',
                'description' => 'The SG90 is a tiny and lightweight servo motor with high output power. It can rotate approximately 180 degrees (90 in each direction) and works just like standard servo motors. Perfect for robotics, RC vehicles, and automation.',
                'specifications' => json_encode([
                    'Weight: 9g',
                    'Torque: 1.8 kg·cm (4.8V)',
                    'Speed: 0.1s/60° (4.8V)',
                    'Rotation: ~180°',
                    'Operating Voltage: 4.8V to 6V',
                    'Gear Type: Nylon gears',
                    'Cable Length: 25cm'
                ]),
                'how_it_works' => json_encode([
                    'Connect the red wire to 5V, brown wire to GND, orange wire to a PWM pin.',
                    'Include the Servo library in your Arduino sketch: #include <Servo.h>.',
                    'Create a Servo object: Servo myServo;',
                    'Attach the servo to a pin: myServo.attach(9);',
                    'Set angle using myServo.write(angle) where angle is 0-180.',
                    'Use a potentiometer to manually control servo position.',
                    'Add a delay between movements to allow the servo to reach its position.'
                ]),
                'youtube_video_id' => 'kUHmYKWwuWs',
                'tutorial_title' => 'SG90 Servo Motor with Arduino - Complete Guide',
                'in_stock' => true,
                'rating' => 4.6,
                'reviews' => 143,
                'badge' => null
            ],
            [
                'id' => 'stepper-28byj',
                'name' => '28BYJ-48 Stepper Motor + ULN2003 Driver',
                'category' => 'actuators',
                'price' => 4500,
                'original_price' => 5500,
                'image' => 'https://images.pexels.com/photos/7254429/pexels-photo-7254429.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'short_description' => 'Precision stepper motor kit with driver board for accurate positioning.',
                'description' => 'The 28BYJ-48 stepper motor with ULN2003 driver board is perfect for projects requiring precise rotational control. With 2048 steps per revolution in half-step mode, it offers excellent precision for 3D printers, CNC machines, and robotics.',
                'specifications' => json_encode([
                    'Motor Type: Unipolar stepper',
                    'Steps per Revolution: 2048 (half-step)',
                    'Gear Ratio: 1:64',
                    'Operating Voltage: 5V DC',
                    'Step Angle: 5.625°/64',
                    'Driver: ULN2003 Darlington array',
                    'LED indicators on driver board'
                ]),
                'how_it_works' => json_encode([
                    'Connect the motor\'s 5-pin connector to the ULN2003 driver board.',
                    'Connect driver board IN1-IN4 to Arduino digital pins (e.g., 8,9,10,11).',
                    'Connect driver board VCC to 5V and GND to ground.',
                    'Include the Stepper library: #include <Stepper.h>.',
                    'Initialize: Stepper myStepper(2048, 8, 10, 9, 11); // Note pin order!',
                    'Set speed: myStepper.setSpeed(15); // RPM',
                    'Rotate: myStepper.step(2048) for one full revolution.'
                ]),
                'youtube_video_id' => 'CEz1EeDlpbs',
                'tutorial_title' => '28BYJ-48 Stepper Motor Arduino Tutorial',
                'in_stock' => true,
                'rating' => 4.5,
                'reviews' => 87,
                'badge' => 'Kit Included'
            ],
            [
                'id' => 'l298n-motor',
                'name' => 'L298N DC Motor Driver Module',
                'category' => 'actuators',
                'price' => 3500,
                'original_price' => null,
                'image' => 'https://images.pexels.com/photos/25626512/pexels-photo-25626512.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'short_description' => 'Dual H-Bridge motor driver for controlling 2 DC motors or 1 stepper.',
                'description' => 'The L298N is a dual H-Bridge motor driver that allows you to control the speed and direction of two DC motors or one stepper motor. It\'s the most popular motor driver for Arduino robotics and automation projects.',
                'specifications' => json_encode([
                    'Driver Chip: L298N Dual H-Bridge',
                    'Motor Supply: 5V to 35V',
                    'Logic Voltage: 5V',
                    'Max Current: 2A per channel',
                    'Control: 2 DC motors or 1 stepper',
                    'PWM Speed Control support',
                    'Built-in 5V regulator'
                ]),
                'how_it_works' => json_encode([
                    'Connect motor power supply (7-12V) to VCC and GND on the module.',
                    'Connect DC motors to Motor A and Motor B terminals.',
                    'Connect IN1, IN2 to Arduino digital pins for Motor A direction.',
                    'Connect IN3, IN4 to Arduino digital pins for Motor B direction.',
                    'Connect ENA and ENB to PWM pins for speed control.',
                    'Set IN1=HIGH, IN2=LOW for forward; IN1=LOW, IN2=HIGH for reverse.',
                    'Use analogWrite(ENA, speed) to control motor speed (0-255).'
                ]),
                'youtube_video_id' => 'dyjo_ggEtVU',
                'tutorial_title' => 'L298N Motor Driver with Arduino - DC Motor Control',
                'in_stock' => true,
                'rating' => 4.7,
                'reviews' => 112,
                'badge' => null
            ],
            [
                'id' => 'relay-5v',
                'name' => '5V Relay Module (2-Channel)',
                'category' => 'actuators',
                'price' => 2000,
                'original_price' => null,
                'image' => 'https://images.pexels.com/photos/8669792/pexels-photo-8669792.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'short_description' => 'Control high-voltage appliances safely with Arduino.',
                'description' => 'This 2-channel relay module allows your Arduino to control high-voltage appliances like lamps, fans, and motors. Each channel can independently switch up to 10A at 250VAC, with optical isolation for safety.',
                'specifications' => json_encode([
                    'Channels: 2 independent relays',
                    'Max Load: 10A @ 250VAC / 10A @ 30VDC',
                    'Control Signal: 5V (active LOW)',
                    'Trigger Current: 15-20mA',
                    'Optical Isolation: Yes',
                    'Indicator LEDs: Yes',
                    'Dimensions: 50mm x 38mm x 18mm'
                ]),
                'how_it_works' => json_encode([
                    'Connect VCC to 5V and GND to ground on your Arduino.',
                    'Connect IN1 and IN2 to digital output pins.',
                    'Wire your appliance through the relay (COM and NO terminals).',
                    'Set the pin LOW to activate the relay (active-low logic).',
                    'Set the pin HIGH to deactivate the relay.',
                    'Always use a separate power supply for high-current appliances.',
                    'Never touch the high-voltage terminals while the circuit is powered!'
                ]),
                'youtube_video_id' => 'dOEyzOLjsJQ',
                'tutorial_title' => 'Relay Module with Arduino - Control AC Appliances Safely',
                'in_stock' => true,
                'rating' => 4.4,
                'reviews' => 95,
                'badge' => null
            ]
        ];

        foreach ($products as $p) {
            $p['created_at'] = now();
            $p['updated_at'] = now();
            DB::table('products')->insert($p);
        }
    }
}
