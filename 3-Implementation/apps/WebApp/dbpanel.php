<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Temperature Database</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
            font-size: 36px;
            color: #333;
            text-shadow: 2px 2px #ddd;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: auto;
            margin-top: 50px;
            background-color: white;
            box-shadow: 2px 2px #ddd;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>Temperature Database</h1>
    <table>
        <tr>
            <th>Time</th>
            <th>Temperature</th>
            <th>Motor State</th>
        </tr>
        <?php
        $db = new SQLite3('tempbase.db');
        $query = "SELECT * FROM temps";
        $results = $db->query($query);
        while ($row = $results->fetchArray()) {
            echo "<tr>";
            echo "<td>" . $row['timestamp'] . "</td>";
            echo "<td>" . $row['temp'] . "</td>";
            echo "<td>" . $row['moto'] . "</td>";
            echo "</tr>";
        }
        $db->close();
        ?>
    </table>
</body>
</html>
