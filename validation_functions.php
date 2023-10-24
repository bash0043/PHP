<?php

function ValidateYears($years) {
    if (empty($years)) {
        return "Years is required.";
    } elseif (!is_numeric($years) || $years < 1 || $years > 26) {
        return "Please select a valid number of years to deposit.";
    }
    return ""; // return an empty string if there is no error
}

function ValidateName($name) {
    if (empty($name)) {
        return "Name is required.";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        return "Only letters and white space allowed";
    }
    return ""; // return an empty string if there is no error
}

function ValidateEmail($email) {
    if (empty($email)) {
        return "Email Address is required.";
    } elseif (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $email)) {
        return "Invalid email format. ";
    }
    return ""; // return an empty string if there is no error
}

function ValidatePostal($postal) {
    if (empty($postal)) {
        return "Postal Code is required.";
    } elseif (!preg_match('/^[A-Za-z]\d[A-Za-z] ?\d[A-Za-z]\d$/', $postal)) {
        return "Invalid postal code format.";
    }
    return ""; // return an empty string if there is no error
}

function validatePhoneNumber($phoneNumber) {
    if (empty($phoneNumber)) {
        return "Phone number is required.";
    } elseif (!preg_match('/^[2-9]\d{2}-[2-9]\d{2}-\d{4}$/', $phoneNumber)) {
        return "Invalid phone number.";
    }
    return "";
}

function validateDeposit($deposit) {
    if (empty($deposit)) {
        return "Principal Amount is required.";
    } elseif (!is_numeric($deposit)) {
        return "Principal Amount must be numeric and greater than 0.";
    } elseif ($deposit <= 0) {
        return "Principal Amount must be greater than 0.";
    }
    return ""; // return an empty string if there is no error
}

function validateContact($contact) {
    if (empty($contact)) {
        return "Preferred contact method is required.";
    } elseif ($contact != 'Phone' && $contact != 'Email') {
        return "Invalid contact method selected.";
    }
    return ""; // return an empty string if there is no error
}

function validateTimes($times) {
    // Check if $times is empty, i.e., no contact times were selected when the contact method is Phone
    if (empty($times)) {
        return "When preferred contact method is phone, you have to select one or more contact times";
    }
    return ""; // return an empty string if there is no error
}
?>

