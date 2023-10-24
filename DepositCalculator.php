<?php
session_set_cookie_params(0);
session_start();

if(!isset($_SESSION['disclaimer_accepted']) || $_SESSION['disclaimer_accepted'] !== true) {
    header('Location: Disclaimer.php');
    exit;
}

$name = isset($_SESSION["name"]) ? $_SESSION["name"] : "";
$EmailAddress = isset($_SESSION["emailAddress"]) ? $_SESSION["emailAddress"] : "";
$phoneNumber = isset($_SESSION["phone_number"]) ? $_SESSION["phone_number"] : "";

$errors = [];
$deposit = isset($_POST['deposit']) ? trim($_POST['deposit']) : '';
$years = isset($_POST['years']) ? trim($_POST['years']) : '';
$result = '';  // Initialize $result

include 'validation_functions.php';

if (isset($_POST['previous'])) {
   
    if (isset($_SESSION["contact"]) && $_SESSION["contact"] == "Phone") {
        // Redirect to ContactTime.php if the user chose "Phone"
        header('Location: ContactTime.php');
    } else {
       
        header('Location: CustomerInfo.php');
    }
    exit;
}


if (isset($_POST['calculate'])) {
    $yearsError = ValidateYears($years);
    if ($yearsError) {
        $errors['years'] = $yearsError;
    }

    $depositError = validateDeposit($deposit);
    if ($depositError) {
        $errors['deposit'] = $depositError;
    }

    if (empty($errors)) {
        $_SESSION["years"] = $years;
        $_SESSION["deposit"] = $deposit;

        $result = "<h2>Thank you <span class='blue'>$name</span>, for using our deposit calculator!</h2><br>";

        $principalAmount = $deposit;
        $interestRate = 0.03;

        $result .= "<span class='interest-text'>The following are the calculation results at the current interest rate of 3%.</span><br>";
        $result .= "<table border='1'>";
        $result .= "<tr><th>Year</th><th>Principal at Year Start</th><th>Interest for the Year</th></tr>";

        for ($i = 0; $i < $years; $i++) {
            $interestPayment = $principalAmount * $interestRate;
            $result .= sprintf("<tr><td>%d</td><td>$%.2f</td><td>$%.2f</td></tr>", $i + 1, $principalAmount, $interestPayment);
            $principalAmount += $interestPayment;
        }

        $result .= "</table>";
    }
}

if (isset($_POST['complete'])) {
    header('Location: Complete.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Customer Info</title>
        <link rel="stylesheet" href="css.css">
    </head>
    <body>
        <?php include 'navbar.php'; ?>


        <h1>Enter principal amount, interest rate and select number of years to deposit</h1>
        <form id="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="input-group">
                <div class="label-container">
                    <label for="principal-amount">Principal Amount:</label>
                </div>
                <div class="input-and-error-container"> <!-- New container to group input and error message -->
                    <div class="input-container"> 
                        <input id="principal-amount" name="deposit" value="<?php echo htmlspecialchars($deposit); ?>"oninput="clearErrorMessage(this)">
                    </div>
                    <div class="error-space">
                        <span class="error"><?php echo isset($errors['deposit']) ? $errors['deposit'] : ''; ?></span>
                    </div>
                </div>
            </div>


            <div class="input-group">
                <div class="label-container">
                    <label for="years">Years to Deposit:</label>
                </div>
                <div class="input-and-error-container"> <!-- New container to group select and error message -->
                    <div class="input-container">
                        <select id="years" name="years" onchange="clearErrorMessage(this)">
                            <option value="" <?php echo!isset($_POST['years']) ? 'selected' : ''; ?>>Select one...</option>
                            <?php for ($i = 1; $i <= 25; $i++): ?>
                                <option value="<?php echo $i; ?>" <?php echo isset($_POST['years']) && $_POST['years'] == $i ? 'selected' : ''; ?>><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <?php if (isset($errors['years'])): ?>
                        <div class="error-space">
                            <span class="error"><?php echo $errors['years']; ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>



            <input id="calculate" type="submit" name="calculate" value="Calculate">
            <input id="complete" type="submit" name="complete" value="Complete">
            <input id="previous" type="submit" name="previous" value="Previous">

        </form>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)): ?>
            <!-- If form is submitted and there are no errors, display the result -->
            <?php echo $result; ?>
        <?php endif; ?>


        <?php include 'footer.php'; ?>
    </body>
</html>
