#!/usr/bin/env python3
import sqlite3
import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder
from sklearn.ensemble import RandomForestClassifier
import pickle

def timestamp_to_float(ts):
    return pd.to_datetime(ts).timestamp()

# Connect to the database
conn = sqlite3.connect('tempbase.db')

# Load data from the database
df = pd.read_sql_query("SELECT * from temps", conn)

# Convert timestamp column to float
df['timestamp'] = df['timestamp'].apply(timestamp_to_float)

# Split data into features and target
X = df[['timestamp', 'temp']]
y = df['moto']

# Encode target variable
le = LabelEncoder()
y = le.fit_transform(y)

# Split data into training and testing sets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.3, random_state=42)

# Build and train the model
model = RandomForestClassifier()
model.fit(X_train, y_train)

# Make predictions on the testing data
y_pred = model.predict(X_test)

# Convert predictions to original encoding
y_pred = le.inverse_transform(y_pred)

#save the model 

pickle.dump(model, open('model.pkl','wb'))

# Close the connection
conn.close()

# Print the predictions
print(y_pred[1])