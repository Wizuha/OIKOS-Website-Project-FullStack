<?php
    $website_engine = "mysql";
    $host_website = "containers-us-west-58.railway.app";

    $website_port = 8006; 
    $website_bdd = "railway";
    $website_user = "root";
    $website_user = "root";
    $website_password = "kbSkK8K0xiCNCOScE7u6";

    $website_dsn = "$website_engine:host=$host_website:$website_port;dbname=$website_bdd";
    $website_pdo = new PDO($website_dsn, $website_user, $website_password);
