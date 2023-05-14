#using the model to predict the data
#!/usr/bin/env python3

import pickle
import pandas as pd
import os

temperature = os.system("./gettempcode")

from datetime import datetime as d
date = d.now()
date = date.strftime("%Y-%m-%d %H:%M:%S")

def timestamp_to_float(ts):
    return pd.to_datetime(ts).timestamp()

# Load the model
model = pickle.load(open('model.pkl','rb'))


data = [[date, temperature]]
df = pd.DataFrame(data, columns=['timestamp', 'temp'])

# Convert timestamp column to float
df['timestamp'] = df['timestamp'].apply(timestamp_to_float)

# Make a prediction using the model
prediction = model.predict(df)

# Print the predictions
print(prediction)

