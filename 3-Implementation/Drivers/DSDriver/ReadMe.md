# DS_Driver

The `DS_Driver` module provides a function `get_ds_temp` to retrieve the temperature value from a DS18B20 temperature sensor connected to a Raspberry Pi.

## Prerequisites

* Raspberry Pi running Raspbian OS
* DS18B20 temperature sensor connected to GPIO pin 4 and ground

## Installation

Enable 1-Wire interface with the raspi-config tool.
`sudo raspi-config`
Select Advanced Option -> 1-Wire -> `<Yes>`

In fact this tool edits the /boot/config.txt and appends this line: dtoverlay=w1-gpio. With this line, a GPIO to drive an external pullup is disabled by default. It's inconvenience in certain condition so we often change "dtoverlay=w1-gpio" to "dtoverlay=w1-gpio-pullup". We also specify GPIO 4 for I/O, so we change the line to "dtoverlay=w1-gpio-pullup,gpiopin=4". Just for instance, because GPIO 4 (BCM numbering, can be checked by this command: gpio readall) is used for I/O by default so "gpiopin=4" is not usually required.

More details about "dtoverlay", please read the manual: /boot/overlays/README.

Finally, we append this line to the config.txt file: "dtoverlay=w1-gpio-pullup,gpiopin=4" (no space in this line).

Check whether the module is started

`lsmod | grep w1`

you should get :
w1_therm               16384  0
w1_gpio                16384  0
wire                   36864  2 w1_gpio,w1_therm

If not, you can start it manually with this command:

`sudo modprobe w1-gpio pullup=1`
`sudo modprobe w1-therm strong_pullup=1`

Read temperature

Change the current directory to /sys/bus/w1/devices and list the directory content:

`cd /sys/bus/w1/devices`

`ls`

You should get a directory named 28-xxxx (xxxx is the serial number of the sensor).
copy the directory name and change the 11th line of the DS_Driver.c file with the directory name :
  `char* path = "/sys/bus/w1/devices/28-072170bed5aa/w1_slave";`

Compile the DS_Driver.c file with the following command:

`gcc -o gettempcode DS_Driver.h DS_Driver.c gettempcode.c`

Run the program with the following command:

`./gettempcode`

You should get the temperature value in Celsius degrees.

## Usage

To use the `get_ds_temp` function in your C code, include the `DS_Driver.h` header file and call the function:

<pre class=""><div class="bg-black rounded-md mb-4"><div class="flex items-center relative text-gray-200 bg-gray-800 px-4 py-2 text-xs font-sans justify-between rounded-t-md"><span>c</span></div></div></pre>

<pre class=""><div class="bg-black rounded-md mb-4"><div class="p-4 overflow-y-auto"><code class="!whitespace-pre hljs language-c">#include "DS_Driver.h"
#include <stdio.h>

int main(void) {
  float temperature = get_ds_temp();
  printf("The current temperature is %.2f°C\n", temperature);
  return 0;
}
</code></div></div></pre>

## Error Handling

The `get_ds_temp` function may encounter the following errors:

1. File not found error: If the file path specified in the `path` variable does not exist, the `open` function call will fail and return a negative value, which will trigger the `perror` function call to print an error message. The program will then exit with `EXIT_FAILURE` status.
2. Read error: If the `read` function call fails to read from the file, it will return a negative value, which indicates an error. The program will not be able to retrieve the temperature value and may continue executing with an undefined behavior.
3. Memory allocation error: The `temp` buffer might not be large enough to store the temperature string retrieved from the file, leading to a buffer overflow or memory corruption issue.
4. Conversion error: If the temperature string read from the file is not a valid floating-point number, the `atof` function call will return an undefined value, leading to unpredictable behavior.
5. Timing issue: The `sleep` function call may not guarantee an exact amount of time delay, which might affect the accuracy of the temperature reading.

# Clause non-responsability

This code is provided as is and may not be suitable for all use cases. Please exercise caution when modifying system files and ensure that you have the necessary permissions to do so. The authors are not liable for any damages caused by the use of this code.

# Licence

this code is under the MIT licence.

# Authors

This program was written by ILYAS NHASSE under the supervision of M. ANASS MANSOURI.
