jQuery(document).ready(function($) {
    // Show the popup after 5 seconds
    setTimeout(function() {
        $('#subscriber-popup-form').fadeIn();
    }, 5000);

    // Optional: Close the popup when clicked outside
    $(document).click(function(event) {
        if (!$(event.target).closest("#subscriber-popup-form").length) {
            $("#subscriber-popup-form").fadeOut();
        }
    });
});

