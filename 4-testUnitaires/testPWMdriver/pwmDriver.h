#ifndef pwm_H_
#define pwm_H_

#define PWM0 "0"
#define PWM1 "1"



struct S_PWM_LINE {
char id_number[3];
int enable;
int period;
int duty_cycle;};
typedef struct S_PWM_LINE S_PWM_LINE;

int load_pwm_line(S_PWM_LINE *pwm_line,char id_number[4]);
int enable_disable_pwm(S_PWM_LINE *pwm_line, int i_value);
int set_period_pwm(S_PWM_LINE *pwm_line, int period);
int set_duty_cycle_pwm(S_PWM_LINE *pwm_line, int i_duty_cycle);

#endif
