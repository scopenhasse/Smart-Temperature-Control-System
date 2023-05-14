import sqlite3
import random

# Connect to the database
conn = sqlite3.connect('tempbase.db')
cursor = conn.cursor()

# Select the rows to update in the "temps" table
cursor.execute("SELECT * FROM temps")

# loop through the result set
for row in cursor.fetchall():
    x = random.randint(0, 3)
    cursor.execute("UPDATE temps SET moto = ?", (x,))

# Commit the changes and close the connection
conn.commit()
conn.close()
