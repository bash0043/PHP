
document.addEventListener('DOMContentLoaded', function () {


    let radios = document.querySelectorAll('input[name="contact"]');


    if (radios.length > 0) {
        toggleContactSection();
    }


    radios.forEach(function (radio) {
        radio.addEventListener('change', toggleContactSection);
    });

    function toggleContactSection() {
        let selectedRadio = document.querySelector('input[name="contact"]:checked');
        if (selectedRadio && selectedRadio.value === "Phone") {

            document.getElementById('contactTimesSection').style.display = "block";
        } else {

            document.getElementById('contactTimesSection').style.display = "none";
        }
    }
});
function clearForm() {
    var form = document.getElementById('myForm');
    var inputs = form.getElementsByTagName('input');
    var textareas = form.getElementsByTagName('textarea');
    var selects = form.getElementsByTagName('select');
    var errors = form.getElementsByClassName('error'); // Get all error message elements
    
    // Clearing input fields
    for (var i = 0; i < inputs.length; i++) {
        var type = inputs[i].type;
        if (type === 'text' || type === 'email' || type === 'password' || type === 'number' || type === 'tel') {
            inputs[i].value = '';
        } else if (type === 'checkbox' || type === 'radio') {
            inputs[i].checked = false;
        }
    }

    // Clearing textarea fields
    for (var i = 0; i < textareas.length; i++) {
        textareas[i].value = '';
    }

    // Clearing select dropdowns
    for (var i = 0; i < selects.length; i++) {
        selects[i].selectedIndex = 0;
    }
    
    // Clearing error messages
    for (var i = 0; i < errors.length; i++) {
        errors[i].textContent = ''; // or errors[i].innerHTML = '';
    }
}

function clearErrorMessage(inputElement) {
    var errorContainer = inputElement.parentElement.parentElement.querySelector('.error-space');
    var errorSpan = errorContainer.querySelector('.error');
    errorSpan.textContent = ''; // Clear the error message.
}

function clearRadioErrorMessage(radioElement) {
    var inputGroupDiv = radioElement.closest('.input-group'); // Navigate to the closest 'div.input-group'.
    var errorSpaceDiv = inputGroupDiv.nextElementSibling; // Get the next sibling (which is 'div.error-space').
    var errorSpan = errorSpaceDiv.querySelector('span.error'); // Select the 'span' with class 'error' inside the 'div.error-space'.

    if (errorSpan)
        errorSpan.textContent = ''; // Clear the error message.
}


