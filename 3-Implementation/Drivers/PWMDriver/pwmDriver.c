
#include <stdio.h>
#include<stdlib.h>
#include <unistd.h>
#include <string.h>

#include "pwmDriver.h"

int load_pwm_line(S_PWM_LINE *pwm_line,char id_number[4])
{
    FILE *p_pwm_line;
    
    /* Exporting pwm line */
    if ((p_pwm_line = fopen("/sys/class/pwm/pwmchip0/export", "w")) == NULL)
    {
        printf("Cannot open export file.\n");
        exit(1);
    }
    rewind(p_pwm_line);
    strcpy(pwm_line->id_number, id_number);
    fwrite(&pwm_line->id_number, sizeof(char), 1, p_pwm_line); 
    fclose(p_pwm_line);
    enable_disable_pwm(pwm_line, 1);

    return 0;
}

int enable_disable_pwm(S_PWM_LINE *pwm_line, int i_value){
	FILE *p_pwm_enable;
	char pwm_device[35];
	char c_value[2];
	sprintf(pwm_device,"/sys/class/pwm/pwmchip0/pwm%s/enable",pwm_line->id_number);
	
	if((p_pwm_enable=fopen(pwm_device,"w+"))==NULL){
	 printf("Cannot open export file.\n");
         exit(1);
        }
        
        rewind(p_pwm_enable);
        sprintf(c_value,"%d",i_value);
        pwm_line->enable=i_value;
        fwrite(&c_value,sizeof(char),1,p_pwm_enable);
        fclose(p_pwm_enable);
        
        return 0;
	
}

int set_period_pwm(S_PWM_LINE *pwm_line, int period){
	FILE *p_pwm_period;
	char pwm_device[35];
	char c_value[2];
	enable_disable_pwm(pwm_line,0);
	sprintf(pwm_device,"/sys/class/pwm/pwmchip0/pwm%s/period",pwm_line->id_number);
	if((p_pwm_period=fopen(pwm_device,"w+"))==NULL){
	 printf("Cannot open export file.\n");
         exit(1);
        }
        
        rewind(p_pwm_period);
        sprintf(c_value,"%d",period);
        pwm_line->period=period;
        fwrite(&c_value,sizeof(char),10,p_pwm_period);
        fclose(p_pwm_period);
        enable_disable_pwm(pwm_line,1);
        
        return 0;
}

int set_duty_cycle_pwm(S_PWM_LINE *pwm_line, int i_duty_cycle){
	FILE *p_pwm_duty;
	char pwm_device[35];
	char c_value[2];
	enable_disable_pwm(pwm_line,0);
	sprintf(pwm_device,"/sys/class/pwm/pwmchip0/pwm%s/duty_cycle",pwm_line->id_number);
	if((p_pwm_duty=fopen(pwm_device,"w"))==NULL){
	 printf("Cannot open export file.\n");
         exit(1);
        }
        
        rewind(p_pwm_duty);
        sprintf(c_value,"%d",i_duty_cycle);
        pwm_line->duty_cycle=i_duty_cycle;
        fwrite(&c_value,sizeof(char),10,p_pwm_duty);
        fclose(p_pwm_duty);
        enable_disable_pwm(pwm_line,1);
        
        return 0;

}


