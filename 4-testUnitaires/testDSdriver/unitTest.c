#include <assert.h>
#include "DS_Driver.h"

void test_get_ds_temp(void) {
  float temperature = get_ds_temp();
  assert(temperature >= -55 && temperature <= 125); // the DS18B20 temperature range
}

int main(void) {
  test_get_ds_temp();
  return 0;
}
