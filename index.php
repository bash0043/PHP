<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
        <link rel="stylesheet" href="css.css">
        

    </head>
    <body>
       <?php include 'navbar.php'; ?>

        <h1>Welcome to the Algonquin Bank</h1>
        Algonquin Bank is Algonquin College students'most loved bank.We provide 
        a set of tools  for Algonquin College students to mange their finance
        <p>Click below to start.</p>
        <a href="Disclaimer.php">Deposit Calculator</a>
     <?php include 'footer.php'; ?>
    </body>
</html>
