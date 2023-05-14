#!/usr/bin/env python3
import sqlite3
import time
import sys

speriod = (1.5)
dbname = '/www/tempbase.db'

def get_temp():
    arg1 = sys.argv[2]
    return arg1

def get_moto():
    arg1 = sys.argv[1]
    return arg1

def log_temperature(temp, moto):
  conn = sqlite3.connect(dbname)
  curs = conn.cursor()
  curs.execute("INSERT INTO temps values(datetime('now'), (?),(?))", (temp, moto,))
  conn.commit()
  conn.close()

    

if __name__ == '__main__':
    temperature = get_temp()
    moto = get_moto()
    if temperature != None:
        print("temperature="+str(temperature))
    else:
        temperature = get_temp()
        print("temperature="+str(temperature))
    if moto != None:
        print("moto="+str(moto))  
    else:
        moto = get_moto()
        print("moto="+str(moto))
    log_temperature(temperature, moto)
    time.sleep(speriod)