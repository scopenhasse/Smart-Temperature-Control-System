#ifndef PWM_H_
#define PWM_H_



#define PWM0 "0"
#define PWM1 "1"

#define ENABLE "1"
#define DISABLE "0"

struct S_PWM {
    char id_canal[2];
    int enable;
    long long int period;
    long long int duty_cycle;
};
typedef struct S_PWM S_PWM;

int load_pwm(S_PWM *ps_pwm, char id_canal[2]);
int set_pwm_enable(S_PWM *ps_pwm, int i_enable);
int set_pwm_period(S_PWM *ps_pwm, long long int period);
int set_pwm_duty_cycle(S_PWM *ps_pwm, long long int duty_cycle);

#endif /PWM_H_/