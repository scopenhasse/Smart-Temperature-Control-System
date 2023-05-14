#include <stdio.h>
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
