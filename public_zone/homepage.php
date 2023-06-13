<?php
    require '../inc/pdo.php';
    session_start();

    echo $_SESSION['id'];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <h1>Homepage</h1>

    <button id="logout-btn">Déconnexion</button>

    <script>
        const logoutBtn = document.getElementById('logout-btn');
        logoutBtn.addEventListener('click', () => {
            window.location.href = '../connection/logout.php'
        })
    </script>
</body>
</html>