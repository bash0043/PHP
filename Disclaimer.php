<?php
session_set_cookie_params(0);
session_start();

// Only handle the POST data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['agreeTerms'])) {
        // Save to session and redirect to CustomerInfo.php
        $_SESSION['disclaimer_accepted'] = true;

        header("Location: CustomerInfo.php");
        exit;
    } else {
        // User didn't agree, so wipe out their session data and notify them of the error
        unset($_SESSION['name']);
        unset($_SESSION["emailAddress"]);
        unset($_SESSION['phone_number']);
        unset($_SESSION['postal']);
        $error = "You must agree to the terms and conditions to proceed.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Terms and Conditions</title>
        <link rel="stylesheet" href="css.css">

    </head>
    <body>
        <?php include 'navbar.php'; ?>
        <h1>Terms and Conditions</h1>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus ullamcorper tortor.
            Sed faucibus ullamcorper tortor.Sed faucibus ullamcorper tortor.
        </p>

        <p>
            Aliquam a eros nec erat facilisis pharetra. Sed sed nunc rutrum, cursus tellus in,
            vulputate massa. Curabitur aliquet, purus eu fringilla fermentum, dui elit convallis purus,
            sit amet euismod est ante et arcu. Sed faucibus ullamcorper tortor.Sed faucibus ullamcorper tortor.
        </p>

        <p>
            Nunc tristique orci nec urna congue.
            Sed eget ex ut metus volutpat blandit. Sed faucibus ullamcorper tortor.
            Sed faucibus ullamcorper tortor.
        </p>

        <form method="POST">
            <input type="checkbox" id="agreeTerms" name="agreeTerms">
            <label for="agreeTerms">I have read and agree with the terms and conditions.</label>
            <br>
            <?php
            if (isset($error)) {
                echo "<div class='error'>" . $error . "</div>";
            }
            ?>
            <button id="start" type="submit">Start</button>
        </form>
        <?php include 'footer.php'; ?>

        <!--
   <script>
       document.getElementById('start').addEventListener('click', function (event) {
           if (!document.getElementById('agreeTerms').checked) {
               alert('You must agree to the terms and conditions to proceed.');
               event.preventDefault();
           }
       });
   </script>
        -->


    </body>
</html>
