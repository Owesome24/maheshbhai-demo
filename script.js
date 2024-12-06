$(document).ready(function() {
    $("#signupForm").submit(function(event) {
        event.preventDefault();

        let formData = {
            username: $("#username").val(),
            email: $("#email").val(),
            password: $("#password").val()
        };

        $.ajax({
            type: "POST",
            url: "signup.php",
            data: JSON.stringify(formData),
            contentType: "application/json",
            success: function(response) {
                $("#responseMessage").html("<div class='alert alert-success'>" + response.message + "</div>");
            },
            error: function() {
                $("#responseMessage").html("<div class='alert alert-danger'>There was an error processing your signup. Please try again.</div>");
            }
        });
    });
});
