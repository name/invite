<?php

// Define a base path for better readability and portability
define('BASE_PATH', $_SERVER['DOCUMENT_ROOT']);

require_once(BASE_PATH . '/server/autoload.php');
require_once(BASE_PATH . '/server/waitlist.php');
require_once(BASE_PATH . '/server/components/inputForm.php');

// Function to sanitize user input
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags($input));
}

if (isset($_POST['username'])) {
    // Sanitize the username input
    $username = sanitizeInput($_POST['username']);

    // Add username to waitlist with error handling
    try {
        addWaitlistEntry($username);
    } catch (Exception $e) {
        // Handle the error appropriately
        error_log($e->getMessage());
        // Redirect or display an error message
    }

    exit;
}

$page_title = 'Waitlist - ' . (isset($GLOBALS['PROJECT_NAME']) ? $GLOBALS['PROJECT_NAME'] : 'Default Project');

// Grouping layout related requires
require_once(BASE_PATH . '/server/views/layout/header.php');
require_once(BASE_PATH . '/server/views/waitlist.php');
require_once(BASE_PATH . '/server/views/layout/footer.php');

?>
