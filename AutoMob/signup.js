<script>
function submitForm() {
    var form = document.getElementById("signUpForm");
    var formData = new FormData(form);

    // Perform AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "signup.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Display success message
            document.getElementById("signupMessage").innerText = xhr.responseText;
            document.getElementById("signupMessage").style.color = "green";
            form.reset(); // Clear form fields
        } else {
            // Display error message
            document.getElementById("signupMessage").innerText = "An error occurred.";
            document.getElementById("signupMessage").style.color = "red";
        }
    };
    xhr.send(formData);
}
</script>
