<?php
/**
 * TNT Wine Tours Landing Page Form Handler
 *
 * This script processes form submissions from the Wine Tours landing page
 * and sends email notifications to TNT's sales team.
 *
 * Usage: Upload to your web server and update the form action in landing-page.html
 */

// ============================================
// CONFIGURATION - UPDATE THESE VALUES
// ============================================

// Email address to receive lead notifications
define('RECIPIENT_EMAIL', 'sedan@tntauto.com');

// Email subject line
define('EMAIL_SUBJECT', 'New Wine Tour Lead');

// Success redirect URL (optional - leave empty to show in-page message)
define('SUCCESS_REDIRECT', '');

// Your website domain (for security)
define('ALLOWED_DOMAIN', 'tntlimousine.com');

// ============================================
// SECURITY CHECKS
// ============================================

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die('Method Not Allowed');
}

// Basic spam prevention: Check if form was submitted too quickly
session_start();
if (isset($_SESSION['form_submitted_time'])) {
    $time_diff = time() - $_SESSION['form_submitted_time'];
    if ($time_diff < 3) {
        http_response_code(429);
        die('Form submitted too quickly. Please wait a moment and try again.');
    }
}
$_SESSION['form_submitted_time'] = time();

// ============================================
// COLLECT AND SANITIZE FORM DATA
// ============================================

// Required fields
$firstName = isset($_POST['firstName']) ? sanitize_input($_POST['firstName']) : '';
$lastName = isset($_POST['lastName']) ? sanitize_input($_POST['lastName']) : '';
$email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
$phone = isset($_POST['phone']) ? sanitize_input($_POST['phone']) : '';

// Optional fields
$tourDate = isset($_POST['tourDate']) ? sanitize_input($_POST['tourDate']) : 'Not specified';
$groupSize = isset($_POST['groupSize']) ? sanitize_input($_POST['groupSize']) : 'Not specified';
$tourInterest = isset($_POST['tour_interest']) && $_POST['tour_interest'] === 'yes' ? 'YES' : 'No';

// ============================================
// VALIDATE REQUIRED FIELDS
// ============================================

$errors = [];

if (empty($firstName)) {
    $errors[] = 'First name is required';
}

if (empty($lastName)) {
    $errors[] = 'Last name is required';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Valid email address is required';
}

if (empty($phone)) {
    $errors[] = 'Phone number is required';
}

// If there are validation errors, return them
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// ============================================
// BUILD EMAIL CONTENT
// ============================================

$emailBody = "New Wine Tour Lead Received\n";
$emailBody .= str_repeat("=", 50) . "\n\n";

$emailBody .= "CONTACT INFORMATION:\n";
$emailBody .= str_repeat("-", 50) . "\n";
$emailBody .= "Name: {$firstName} {$lastName}\n";
$emailBody .= "Email: {$email}\n";
$emailBody .= "Phone: {$phone}\n\n";

$emailBody .= "TOUR DETAILS:\n";
$emailBody .= str_repeat("-", 50) . "\n";
$emailBody .= "Tour Interest: {$tourInterest}\n";
$emailBody .= "Preferred Date: {$tourDate}\n";
$emailBody .= "Group Size: {$groupSize}\n\n";

// Add hot lead flag if they checked tour interest
if ($tourInterest === 'YES') {
    $emailBody .= str_repeat("!", 50) . "\n";
    $emailBody .= "HOT LEAD: Customer indicated interest in booking a wine tour!\n";
    $emailBody .= str_repeat("!", 50) . "\n\n";
}

$emailBody .= str_repeat("-", 50) . "\n";
$emailBody .= "Lead Source: Wine Tours Landing Page\n";
$emailBody .= "Submitted: " . date('Y-m-d H:i:s') . "\n";
$emailBody .= "IP Address: " . get_client_ip() . "\n";

// ============================================
// BUILD HTML EMAIL (OPTIONAL - PRETTIER)
// ============================================

$htmlBody = "
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #CC0000; color: white; padding: 20px; border-radius: 8px 8px 0 0; }
        .content { background: #f9fafb; padding: 20px; border: 1px solid #e5e7eb; }
        .field { margin: 10px 0; }
        .label { font-weight: bold; color: #374151; }
        .value { color: #111827; }
        .hot-lead { background: #fef2f2; border-left: 4px solid #CC0000; padding: 15px; margin: 20px 0; }
        .footer { background: #1f2937; color: #9ca3af; padding: 15px; text-align: center; font-size: 12px; border-radius: 0 0 8px 8px; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h2 style='margin: 0;'>New Wine Tour Lead</h2>
        </div>
        <div class='content'>
            <h3>Contact Information</h3>
            <div class='field'>
                <span class='label'>Name:</span>
                <span class='value'>{$firstName} {$lastName}</span>
            </div>
            <div class='field'>
                <span class='label'>Email:</span>
                <span class='value'><a href='mailto:{$email}'>{$email}</a></span>
            </div>
            <div class='field'>
                <span class='label'>Phone:</span>
                <span class='value'><a href='tel:{$phone}'>{$phone}</a></span>
            </div>

            <h3 style='margin-top: 20px;'>Tour Details</h3>
            <div class='field'>
                <span class='label'>Tour Interest:</span>
                <span class='value'>{$tourInterest}</span>
            </div>
            <div class='field'>
                <span class='label'>Preferred Date:</span>
                <span class='value'>{$tourDate}</span>
            </div>
            <div class='field'>
                <span class='label'>Group Size:</span>
                <span class='value'>{$groupSize}</span>
            </div>";

if ($tourInterest === 'YES') {
    $htmlBody .= "
            <div class='hot-lead'>
                <strong>HOT LEAD ALERT</strong><br>
                Customer indicated interest in booking a wine tour!<br>
                <strong>Action Required:</strong> Follow up within 24 hours to confirm availability.
            </div>";
}

$htmlBody .= "
        </div>
        <div class='footer'>
            Lead Source: Wine Tours Landing Page<br>
            Submitted: " . date('Y-m-d H:i:s') . " | IP: " . get_client_ip() . "
        </div>
    </div>
</body>
</html>
";

// ============================================
// SEND EMAIL
// ============================================

$headers = [
    'From: TNT Limousine Website <noreply@' . ALLOWED_DOMAIN . '>',
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion(),
    'MIME-Version: 1.0',
    'Content-Type: text/html; charset=UTF-8'
];

$subject = EMAIL_SUBJECT . ': ' . $firstName . ' ' . $lastName;

// Send the email
$mailSent = mail(
    RECIPIENT_EMAIL,
    $subject,
    $htmlBody,
    implode("\r\n", $headers)
);

// ============================================
// HANDLE SUCCESS/FAILURE
// ============================================

if ($mailSent) {
    // Log successful submission (optional)
    log_submission($firstName, $lastName, $email, $tourInterest);

    // Redirect or return success
    if (!empty(SUCCESS_REDIRECT)) {
        header('Location: ' . SUCCESS_REDIRECT);
        exit;
    } else {
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Thank you! We\'ve received your information and will send your free guide shortly. A dispatcher will contact you within 24 hours.'
        ]);
    }
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Sorry, there was an error processing your request. Please try again or call us at (804) 409-2595.'
    ]);
}

// ============================================
// HELPER FUNCTIONS
// ============================================

/**
 * Sanitize text input
 */
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Sanitize email address
 */
function sanitize_email($email) {
    return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
}

/**
 * Get client IP address (handles proxies)
 */
function get_client_ip() {
    $ip = '';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return sanitize_input($ip);
}

/**
 * Log submission to CSV file (optional tracking)
 * Creates a simple CSV log in the same directory as this script
 */
function log_submission($firstName, $lastName, $email, $tourInterest) {
    $logFile = __DIR__ . '/wine-tour-leads.csv';

    // Create file with headers if it doesn't exist
    if (!file_exists($logFile)) {
        $headers = ['Timestamp', 'First Name', 'Last Name', 'Email', 'Phone', 'Tour Interest', 'Date', 'Group Size', 'IP'];
        file_put_contents($logFile, implode(',', $headers) . "\n");
    }

    // Append lead data
    $data = [
        date('Y-m-d H:i:s'),
        $firstName,
        $lastName,
        $email,
        $_POST['phone'] ?? '',
        $tourInterest,
        $_POST['tourDate'] ?? 'Not specified',
        $_POST['groupSize'] ?? 'Not specified',
        get_client_ip()
    ];

    // Properly escape CSV data
    $escapedData = array_map(function($field) {
        return '"' . str_replace('"', '""', $field) . '"';
    }, $data);

    file_put_contents($logFile, implode(',', $escapedData) . "\n", FILE_APPEND);
}

?>
