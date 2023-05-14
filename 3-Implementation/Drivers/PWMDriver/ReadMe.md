# PWM Driver

## Description

This program provides functions for controlling PWM (Pulse Width Modulation) lines on a Raspberry Pi using the Linux sysfs interface.

The program includes the following functions:

* `load_pwm_line`: exports a PWM line to the sysfs interface for use.
* `enable_disable_pwm`: enables or disables a PWM line.
* `set_period_pwm`: sets the period of a PWM line.
* `set_duty_cycle_pwm`: sets the duty cycle of a PWM line.

## Usage

To use the program, you must first include the `pwmDriver.h` header file in your code. Then, you can call the functions provided by the program to control your PWM lines.

Here is an example of how to use the program:

<pre class=""><div class="bg-black rounded-md mb-4"><div class="flex items-center relative text-gray-200 bg-gray-800 px-4 py-2 text-xs font-sans justify-between rounded-t-md"><span>c</span></div></div></pre>

<pre class=""><div class="bg-black rounded-md mb-4"><div class="p-4 overflow-y-auto"><code class="!whitespace-pre hljs language-c">#include <stdio.h>
#include <stdlib.h>
#include "pwmDriver.h"

int main(void)
{
    S_PWM_LINE pwm_line;
    char id_number[4] = "0";
    int period = 1000000;
    int duty_cycle = 500000;
  
    load_pwm_line(&pwm_line, id_number);
    set_period_pwm(&pwm_line, period);
    set_duty_cycle_pwm(&pwm_line, duty_cycle);
    enable_disable_pwm(&pwm_line, 1);

    return 0;
}
</code></div></div></pre>

## Errors

The program may throw the following errors:

* `Cannot open export file.`: This error occurs when the program is unable to open the export file for the PWM line. This may be due to a permissions issue or a problem with the file system. To fix this error, ensure that the program has permission to access the sysfs interface and that the file system is properly mounted.
* `Segmentation fault (core dumped)`: This error occurs when the program attempts to access memory that it is not allowed to access. This may be due to a buffer overflow or an out-of-bounds array access. To fix this error, ensure that all memory accesses are within bounds and that all buffers are properly sized.
* `Floating point exception (core dumped)`: This error occurs when the program attempts to perform a division by zero or another mathematically impossible operation. To fix this error, ensure that all mathematical operations are properly defined and that all input values are valid.

# Clause de non-responsabilité

Ce code est fourni tel quel et peut ne pas convenir à tous les cas d'utilisation. Veuillez faire preuve de prudence lors de la modification des fichiers système et assurez-vous que vous disposez des autorisations nécessaires pour le faire. Les auteurs ne sont pas responsables des dommages causés par l'utilisation de ce code.

# Licence

Ce code est publié sous la licence MIT.

# Authors

This program was written by ILYAS NHASSE under the supervision of M. ANASS MANSOURI.
