<?php

session_start();

if(!isset($_SESSION['disclaimer_accepted']) || $_SESSION['disclaimer_accepted'] !== true) {
    header('Location: Disclaimer.php');
    exit;
}

$availabeTimes = array("9am-10am", "10am-11am", "11am-12pm", "12pm-1pm", "1pm-2pm", "2pm-3pm", "3pm-4pm", "4pm-5pm", "5pm-6pm");
$errors = [];

// Only handle the POST data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['back']) || isset($_POST['next'])) {
        $_SESSION['contact_times'] = isset($_POST['contact_times']) ? $_POST['contact_times'] : [];
    }

    if (isset($_POST['back'])) {
        header('Location: CustomerInfo.php');
        exit;
    }

    if (isset($_POST['next'])) {
        include 'validation_functions.php';
        $timesError = validateTimes($_SESSION['contact_times']);
        if ($timesError) {
            $errors['times'] = $timesError;
        }

        if (empty($errors)) {
            header('Location: DepositCalculator.php');
            exit;
        }
    }
}

$times = isset($_SESSION['contact_times']) ? $_SESSION['contact_times'] : [];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Time</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <h1>Select Contact Times</h1>
    <form id="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="input-group">
            <div class="label-container">
                <h4>When can we contact you? Check all applicable:</h4>
            </div>
            <div class="input-and-error-container">
                <div class="checkbox-group">
                    <?php
                    foreach ($availabeTimes as $time) {
                        $parts = explode("-", $time);
                        $formattedTimeStart = $parts[0];
                        $formattedTimeEnd = substr($parts[1], 0, -2) . ":00" . substr($parts[1], -2);
                        $timeDisplay = $formattedTimeStart . '-' . $formattedTimeEnd;

                        echo '<div class="checkbox-item">';
                        echo '<input type="checkbox" id="' . $time . '" name="contact_times[]" value="' . $time . '" ' .
                            (in_array($time, $times) ? 'checked' : '') . '>';
                        echo '<label for="' . $time . '">' . $timeDisplay . '</label>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php if (isset($errors['times'])): ?>
            <div class="error">
                <?php echo htmlspecialchars($errors['times']); ?>
            </div>
        <?php endif; ?>
        
        <input id="next" type="submit" name="next" value="Next">
        <input id="back" type="submit" name="back" value="Back">
    </form>
    <?php include 'footer.php'; ?>
</body>
</html>
