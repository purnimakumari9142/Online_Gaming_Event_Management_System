$("#contactForm").submit(function(event) {
    event.preventDefault(); // prevent default form submission
    // get values from FORM
    var name = $("#name").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var message = $("#message").val();

    // Check for white space in name for Success/Fail message
    var firstName = name.split(" ").slice(0, -1).join(" ");

    $.ajax({
        url: "http://localhost:8012/assets/mail/contact_me.php",
        type: "POST",
        data: {
            name: name,
            email: email,
            phone: phone,
            message: message,
        },
        cache: false,
        success: function() {
            // Success message
            $("#success").html("<div class='alert alert-success'>");
            $("#success > .alert-success")
                .html(
                    "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;"
                )
                .append("</button>");
            $("#success > .alert-success").append(
                "<strong>Your message has been sent.</strong>"
            );
            $("#success > .alert-success").append("</div>");

            // Delay the redirection for a few seconds (e.g., 3 seconds)
            setTimeout(function() {
                window.location.href = "#";
                // "http://localhost:8012/assets/mail/display_data.php";
            }, 3000);
        },

        error: function() {
            // Fail message
            $("#success").html("<div class='alert alert-danger'>");
            $("#success > .alert-danger")
                .html(
                    "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;"
                )
                .append("</button>");
            $("#success > .alert-danger").append(
                $("<strong>").text(
                    "Sorry " +
                    firstName +
                    ", it seems that there was an issue submitting your message. Please try again later!"
                )
            );
            $("#success > .alert-danger").append("</div>");
            //clear all fields
            $("#contactForm").trigger("reset");
        },
    });
});

$('a[data-toggle="tab"]').click(function(e) {
    e.preventDefault();
    $(this).tab("show");
});

/*When clicking on Full hide fail/success boxes */
$("#name").focus(function() {
    $("#success").html("");
});