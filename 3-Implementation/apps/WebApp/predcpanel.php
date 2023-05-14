<!DOCTYPE html>
<html>
<head>
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
        .Perdection {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 2px 2px #ddd;
            padding: 20px;
            margin: 20px auto;
            width: 200px;
            text-align: center;
        }
        .Perdection p {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-shadow: 2px 2px #ddd;
        }
    </style>
</head>
<body>
    <h1>Predection Panel :</h1>
    <?php
    $Perdection = exec("/www/c-bin/predectioncode");
    ?>

    <div class="Perdection">
        <p>Predection the user will set motor to : <?php echo $Perdection; ?> </p>
    </div>
</body>
</html>
