#include<fcntl.h> 
#include<stdio.h> 
#include<stdlib.h> 
#include<unistd.h> 
#include<string.h> 
#include<sys/select.h> 
#include "DS_Driver.h" 

float getdstemp(void) {
  int fd;
  char* path = "/sys/bus/w1/devices/28-072170bed5aa/w1_slave";
  char buffer[1000];
  int len = read(fd, buffer, sizeof(buffer));
  char temp[10];
  float tt;

  if ((fd = open(path, O_RDONLY)) < 0) {
    perror("Can't Open value of the slave : ws1_slave");
    exit(EXIT_FAILURE);
  }

  strncpy(temp, buffer + len - 6, 5);
  tt = atof(temp) / 1000;
  close(fd);
  return tt;
}
