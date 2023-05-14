#include <stdlib.h>
#include <stdio.h>
#include <unistd.h>
#include <string.h>
#include <time.h>
#include "pwmDriver.h"

int main(int argc, char const *argv[])
{
    S_PWM s_pwm;
    
    int pwm_value = atoi(argv[1]);
    load_pwm(&s_pwm, PWM1);
    set_pwm_enable(&s_pwm, 1);
    switch (pwm_value)
    {
    case 0:
        set_pwm_period(&s_pwm, 1000000000);
        set_pwm_duty_cycle(&s_pwm, 100000000);
        break;
    
    case 1:
        set_pwm_period(&s_pwm, 1000000000);
        set_pwm_duty_cycle(&s_pwm, 200000000);
        break;
    
    case 2:
        set_pwm_period(&s_pwm, 1000000000);
        set_pwm_duty_cycle(&s_pwm, 300000000);
        break;
    default:
        break;
    }

    return 0;
}