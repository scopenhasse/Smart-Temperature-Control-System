#include <stdio.h>
#include <unistd.h>
#include "DS_Driver.h"

int main() {
  float temperature;
  temperature = get_ds_temp();
  printf("%2.3f\n", temperature);
  return 0;
}