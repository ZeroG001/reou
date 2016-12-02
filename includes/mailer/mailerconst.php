<?php
require 'phpmailer/PHPMailerAutoload.php';

$reoumail = new PHPMailer;

$reoumail->SMTPDebug = 1;                               // Enable verbose debug output

$reoumail->isSMTP();
$reoumail->Timeout       = 10;
$reoumail->Host          = "smtp.office365.com";
$reoumail->SMTPAuth 	 = true;
$reoumail->Username      = 'info@realestateone.com';
$reoumail->Password      = 'N0tbl@nk!';
$reoumail->SMTPSecure    = 'tls';
$reoumail->port          = '587';
$reoumail->WordWrap      =  50;
$reoumail->isHTML(true);

$reoumail->setFrom('info@realestateone.com', 'Info - RealEstateOne');


// $reoumail->addCC('cc@example.com');
// $reoumail->addBCC('bcc@example.com');
// $reoumail->addAttachment('/var/tmp/file.tar.gz');      // Add attachments
// $reoumail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name


/**
 * Sanitize Email
 *
 * Takes a string and removes the characters that should not be in an email address.
 * Intended to be assigned to a varible
 * @param (string) String to clean
 * @return (string) 
 */
function sanitize_email($email) {
    $email = $_POST['email_address'];
    $unacceptable = array("\"", "(", ")", ",", ":", ";", "<", ">", "[", "\\", "]");
    $email = str_replace($unacceptable, "", $email);
    return $email;
}



/**
 * sanitize_notes
 *
 * removes characters to a string that aren't supposed to be in the notes
 * 
 * @param (string) Path to file
 * @return (string) 
 */
function sanitize_notes($notes) {
    $notes = $_POST['xdata_3'];
    $unacceptable = array("\"", "(", ")", "<", ">", "@", "[", "\\", "]");
    $notes = str_replace($unacceptable, "", $notes);
    return $notes;
}



/**
 * checkParams
 *
 * Removes array items that aren't in list of accepted param names
 * 
 * @param (array) $_POST array
 * @return (string) 
 */
function checkParams($params) {
    $acceptedParams = array("email_address");
    foreach ($params as $k => $param) {
        if( !in_array(strtolower($k), $params) ) {
            unset($params[$k]);
        } 
    }
}



/**
 * requireToVar
 *
 * Takes and external HTML file and moves it to a variable. Used for PHP mailer $body
 * Path is relative to where the function was created (this file)
 * 
 * @param (string) path to external file 
 * @return (string) html from resulting file
 */
function requireToVar($file) {
    ob_start();
    require_once($file);
    return ob_get_clean();
}

// To make everything work just hit mai $mail->send()


// Activate this when you're ready to send email

// if(!$reoumail->send()) {
//     echo 'Message could not be sent.';
//     echo 'Mailer Error: ' . $mail->ErrorInfo;
// } else {
//     echo 'Message has been sent';
// }