<?php
    $website_engine = "mysql";
    $host_website = "containers-us-west-175.railway.app";

    $website_port = 6976; 
    $website_bdd = "railway";
    $website_user = "root";
    $website_password = "NaOQB8iF8xTo1jVRWH9L";

    $website_dsn = "$website_engine:host=$host_website:$website_port;dbname=$website_bdd";
    $website_pdo = new PDO($website_dsn, $website_user, $website_password);
