<?php
session_set_cookie_params(0);
session_start();

// Check if the user has accepted the disclaimer
if (!isset($_SESSION['disclaimer_accepted']) || $_SESSION['disclaimer_accepted'] !== true) {
    header('Location: Disclaimer.php');
    exit;
}

// Variables for form data
$name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
$EmailAddress = isset($_SESSION['emailAddress']) ? $_SESSION['emailAddress'] : '';
$postal = isset($_SESSION['postal']) ? $_SESSION['postal'] : '';
$phoneNumber = isset($_SESSION['phone_number']) ? $_SESSION['phone_number'] : '';
$contact = isset($_SESSION['contact']) ? $_SESSION['contact'] : '';

$errors = [];
include 'validation_functions.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $EmailAddress = trim($_POST['emailAddress']);
    $postal = trim($_POST['postal']);
    $phoneNumber = trim($_POST['phone_number']);
    $contact = isset($_POST['contact']) ? trim($_POST['contact']) : '';

    $emailError = ValidateEmail($EmailAddress);
    if ($emailError)
        $errors['emailAddress'] = $emailError;

    $nameError = ValidateName($name);
    if ($nameError)
        $errors['name'] = $nameError;

    $postalError = ValidatePostal($postal);
    if ($postalError)
        $errors['postal'] = $postalError;

    $phoneError = validatePhoneNumber($phoneNumber);
    if ($phoneError)
        $errors['phone_number'] = $phoneError;
     $contactError = validateContact($contact);
    if ($contactError) {
        $errors['contact'] = $contactError;
    }


    //


    if (empty($errors)) {
        $_SESSION["name"] = $name;
        $_SESSION["emailAddress"] = $EmailAddress;
        $_SESSION["postal"] = $postal;
        $_SESSION["phone_number"] = $phoneNumber;
        $_SESSION["contact"] = $contact;

        if ($contact == "Phone") {
            header("Location: ContactTime.php");
            exit;
        } else if ($contact == "Email") {
            header("Location: DepositCalculator.php");
            exit;
        }
    }
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
        <h1>Customer Information</h1>
        <form id="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <!-- Name Input -->
            <!-- Name Input -->
            <div class="input-group">
                <div class="label-container">
                    <label for="name">Name:</label>
                </div>
                <div class="input-and-error-container">
                    <div class="input-container"> 
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" oninput="clearErrorMessage(this)">
                    </div>
                    <div class="error-space">
                        <span class="error"><?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
                    </div>
                </div>
            </div>

            <!-- Postal Code Input -->
            <div class="input-group">
                <div class="label-container">
                    <label for="postal-code">Postal Code:</label>
                </div>
                <div class="input-and-error-container">
                    <div class="input-container"> 
                        <input type="text" id="postal-code" name="postal" value="<?php echo htmlspecialchars($postal); ?>" oninput="clearErrorMessage(this)">
                    </div>
                    <div class="error-space">
                        <span class="error"><?php echo isset($errors['postal']) ? $errors['postal'] : ''; ?></span>
                    </div>
                </div>
            </div>

            <!-- Phone Number Input -->
            <div class="input-group">
                <div class="label-container">
                    <label for="phone-number">Phone Number:<br/>(nnn-nnn-nnnn)</label>
                </div>
                <div class="input-and-error-container">
                    <div class="input-container"> 
                        <input type="tel" id="phone-number" name="phone_number" value="<?php echo htmlspecialchars($phoneNumber); ?>" oninput="clearErrorMessage(this)">
                    </div>
                    <div class="error-space">
                        <span class="error"><?php echo isset($errors['phone_number']) ? $errors['phone_number'] : ''; ?></span>
                    </div>
                </div>
            </div>

            <!-- Email Address Input -->
            <div class="input-group">
                <div class="label-container">
                    <label for="emailAddress">Email Address:</label>
                </div>
                <div class="input-and-error-container">
                    <div class="input-container"> 
                        <input type="email" id="emailAddress" name="emailAddress" value="<?php echo htmlspecialchars($EmailAddress); ?>" oninput="clearErrorMessage(this)">
                    </div>
                    <div class="error-space">
                        <span class="error"><?php echo isset($errors['emailAddress']) ? $errors['emailAddress'] : ''; ?></span>
                    </div>
                </div>
            </div>

            <!-- Contact Method Radio Buttons -->
            <div id="method" class="input-group">
                <label>Preferred Contact Method:</label>
                <div class="radio-group">
                    <input type="radio" id="phone" name="contact" value="Phone" <?php echo ($contact == 'Phone') ? 'checked' : ''; ?>>
                    <label for="phone">Phone</label>
                    <input type="radio" id="email" name="contact" value="Email" <?php echo ($contact == 'Email') ? 'checked' : ''; ?>>
                    <label for="email">Email</label>
                </div>
                <div class="error-space">
                    <span class="error"><?php echo isset($errors['contact']) ? $errors['contact'] : ''; ?></span>
                </div>
            </div>

            <!-- Next Button -->
            <div class="input-group">
                <input id="next" type="submit" name="next" value="Next>">
            </div>

        </form>
<?php include 'footer.php'; ?>
    </body>
</html>