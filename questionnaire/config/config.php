<?php

   $config = parse_ini_file('config.ini');

    // Accessing individual configuration values
    $host = $config['database_host'];
    $name = $config['database_name'];
    $user = $config['database_user'];
    $pass = $config['database_pass'];
    $image_path = $config['IMAGE_URI_PATH'];

    // Use the configuration values
    echo "Host: $host\n";
    echo "Name: $name\n";
    echo "User: $user\n";
    echo "Pass: $pass\n";
    echo "<br>Image Path: $image_path\n";
?>