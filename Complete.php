<?php
session_start();


$name = isset($_SESSION["name"]) ? $_SESSION["name"] : "";
$EmailAddress = isset($_SESSION["emailAddress"]) ? $_SESSION["emailAddress"] : "";

$result = "<h2>Thank you <span style='color:blue;'>$name</span> for using our service!</h2><br>";

if (isset($_SESSION['contact_times']) && isset($_SESSION['contact']) && $_SESSION['contact'] === "Phone") {
    $checkedTimes = $_SESSION['contact_times'];
    $result .= "<span class='interest-text'>Our customer service department will call you tomorrow at ";
    
    if (count($checkedTimes) > 1) {
        $lastTime = array_pop($checkedTimes);
        $result .= implode(', ', $checkedTimes) . ' or ' . $lastTime;
    } else {
        $result .= $checkedTimes[0];
    }
    $result .= "</span>.<br>";
} else {
    $result .= "<span class='interest-text'>An email about the details of our GIC has been sent to $EmailAddress.</span><br>";
}
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Complete</title>
        <link rel="stylesheet" href="css.css">
    </head>
    <body>
        <?php include 'navbar.php'; ?>

        <div class="content">
            <?php echo $result; ?>
        </div>

        <?php include 'footer.php'; ?>
    </body>
</html>
