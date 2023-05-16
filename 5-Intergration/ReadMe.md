# Installation and Usage of the Smart Temperature Controle System
## Prerequisites
* Raspberry Pi running Raspbian OS lite (https://www.raspberrypi.org/downloads/raspbian/) follow the installation instructions in the directory "implementation/InstallationOS"

* DS18B20 temperature sensor connected to GPIO pin 4 and ground
* 4.7kOhm resistor between GPIO pin 4 and 3.3V
* DC Motor connected to GPIO pin 32 (GPIO 12) and ground (GND) to be able to control the heating system using PWM
* 1N4007 diode between GPIO pin 32 and the DC Motor to protect the GPIO pin from the back EMF of the DC Motor
* 1kOhm resistor between GPIO pin 32 and the 1N4007 diode to limit the current through the diode

## Installation
### Install the server lighttpd
`sudo apt-get install lighttpd`
this will install the webserver lighttpd and start it automatically after installation

### Install the PHP interpreter
`sudo apt-get install php7.0-cgi php7.0-cli php7.0-common php7.0-curl php7.0-fpm php7.0-gd php7.0-json php7.0-mbstring php7.0-mysql php7.0-opcache php7.0-readline php7.0-xml php7.0-xmlrpc php7.0-zip`

### Install the PHP library for SQLite3
`sudo apt-get install php7.0-sqlite3`

### Create the directory for the webserver 
`sudo mkdir /www`
`sudo chown www-data:www-data /www` this will change the owner of the directory to the user www-data which is the user of the webserver 
`sudo nano /etc/lighttpd/lighttpd.conf` this will open the configuration file of the webserver
add the following line to the file:
`server.document-root = "/www/"` this will set the directory /www as the root directory of the webserver
`sudo service lighttpd force-reload` this will reload the configuration of the webserver
`sudo mkdir /www/c-bin` this will create the directory for executable files of the webserver
`sudo chown www-data:www-data /www/c-bin` this will change the owner of the directory to the user www-data which is the user of the webserver
`sudo chmod 755 /www/c-bin` this will change the permissions of the directory to allow the execution of files in the directory
`sudo usermod -a -G www-data i` this will add the users to the group www-data which is the group of the webserver

### Install the SQLite3 database
`sudo apt-get install sqlite3`

### Enable 1-Wire interface
Enable 1-Wire interface with the raspi-config tool.
`sudo raspi-config`
Select Advanced Option -> 1-Wire -> <Yes>

In fact this tool edits the /boot/config.txt and appends this line: dtoverlay=w1-gpio. With this line, a GPIO to drive an external pullup is disabled by default. It's inconvenience in certain condition so we often change "dtoverlay=w1-gpio" to "dtoverlay=w1-gpio-pullup". We also specify GPIO 4 for I/O, so we change the line to "dtoverlay=w1-gpio-pullup,gpiopin=4". Just for instance, because GPIO 4 (BCM numbering, can be checked by this command: gpio readall) is used for I/O by default so "gpiopin=4" is not usually required.

follow the instructions in the file "implementation/Drivers/DSDriver/ReadMe.md" to check whether the module is started and to read the temperature

### Enable PWM
Enable PWM with the raspi-config tool.
`sudo raspi-config`
Select Advanced Option -> PWM -> <Yes>

In fact this tool edits the /boot/config.txt and appends this line "dtoverlay=pwm-2chan,pin=18,func=2,pin2=13,func2=4". This line enables PWM on GPIO 12 (pin 32) and GPIO 13 (pin 33). The second function of GPIO 12 is PWM0 and the second function of GPIO 13 is PWM1. The PWM0 is used to control the DC Motor.

### Compile the program
Change the current directory to the directory "implementation/Drivers/DSDriver" and compile the program with the following command:
`gcc -o gettempcode DS_Driver.h DS_Driver.c gettempcode.c`
'gettempcode' is the name of the executable file
`gcc -o motocode PWMControl.h PWMControl.c motocode.c`
'motocode' is the name of the executable file

### Copy the executable files to the directory of the webserver
`sudo cp gettempcode /www/c-bin`
`sudo cp motocode /www/c-bin`
`sudo cp *py /www/c-bin`
`sudo cp *.php /www`
#### +x flag
`sudo chmod +x /www/c-bin/*`

### Create the database
`sudo sqlite3 /www/temperature.db`
`sqlite> CREATE TABLE temps (timestamp DATETIME, temp NUMERIC, moto NUMERIC);`
`sqlite> COMMIT;`
`sqlite> .quit`

# Clause non-responsability

This code is provided as is and may not be suitable for all use cases. Please exercise caution when modifying system files and ensure that you have the necessary permissions to do so. The authors are not liable for any damages caused by the use of this code.

# License

this code is under the MIT licence.

# Authors

This program was written by ILYAS NHASSE under the supervision of M. ANASS MANSOURI.




