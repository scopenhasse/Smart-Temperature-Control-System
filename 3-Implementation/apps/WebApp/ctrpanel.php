<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=windows-1252">
    <title>Control Panel</title>
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
        .button-container {
            display: flex;
            justify-content: center;
            margin: 20px auto;
            padding: 0 20px;
            flex-wrap: wrap;
        }
        .button-container div {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 2px 2px #ddd;
            padding: 20px;
        }
        .button-container p {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-shadow: 2px 2px #ddd;
            text-align: center;
        }
        .button-container button {
            padding: 10px 20px;
            font-size: 16px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button-container button.high {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ff0000;
            color: white;
            text-align: center;
        }
        .button-container button.mid {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffa500;
            color: white;
            text-align: center;
        }
        .button-container button.low {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffff00;
            color: white;
            text-align: center;
        }
        .button-container button.off {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #00ff00;
            color: white;
            text-align: center;
        }
        .temperature {
            width: auto;
            max-width: 90%; /* Added max-width to prevent container from overflowing */
            margin: 20px auto;
            text-align: center;
        }
        .temperature p {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-shadow: 2px 2px #ddd;
        }
 
        .pedection-container {
            display: flex;
            justify-content: center;
            margin: 20px auto;
        }

        .pedection-container form {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 2px 2px #ddd;
            padding: 20px;
        }
        .pedection-container p {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-shadow: 2px 2px #ddd;
            text-align: center;
        }
        .pedection-container button {
            padding: 10px 20px;
            font-size: 16px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #4CAF50;
            color: #fff;
        }
        .db-container {
            display: flex;
            justify-content: center;
            margin: 20px auto;
        }
        .db-container form {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 2px 2px #ddd;
            padding: 20px;
        }
        .db-container p {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-shadow: 2px 2px #ddd;
            text-align: center;
        }
        .db-container button {
            padding: 10px 20px;
            font-size: 16px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #4CAF50;
            color: #fff;
        }
    </style>
</head>
<body>
    <h1>Control Panel :</h1>

    <?php
    $tempactual = exec("/www/c-bin/gettempcode");
    if (isset($_GET['level']))
    {
        $level = $_GET['level'];
        echo "level = $level";
    }
    $command = 'python3 /www/c-bin/writeDB.py' . $level . ' ' . $tempactual;
    $output = passthru($command);
    ?>

    <div class="temperature">
        <p>Temperature :</p>
        <p><?php echo $tempactual; ?></p>
    </div>

    <div class="button-container">
        <div>
            <p>Control Motor</p>
            <button onclick="location.href='ctrpanel.php?level=3'" class="high" type="button">HIGH</button><br>
            <button onclick="location.href='ctrpanel.php?level=2'" class="mid" type="button">MIDUIM</button><br>
            <button onclick="location.href='ctrpanel.php?level=1'" class="low" type="button">LOW</button><br>
            <button onclick="location.href='ctrpanel.php?level=0'" class="off" type="button">OFF</button>
        </div>
    </div>

    <div class="pedection-container">
        <form action="predcpanel.php" method="get">
            <p>Make a Predection:</p>
            <button type="submit">Go to Pedection Page</button>
        </form>
    </div>

    <div class="db-container">
        <form action="dbpanel.php" method="get">
            <p>DATA BASE</p>
            <button type="submit">Go to Data Base Page</button>
        </form>
    </div>

</body>
</html>
