<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  <?php
  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'yashvimalviya@gmail.com';
  
  // Validate and sanitize user inputs
  $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
  $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
  $subject = isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : '';
  $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';
  
  // Check if required fields are not empty
  if (empty($name) || empty($email) || empty($subject) || empty($message)) {
      die('Please fill in all required fields.');
  }
  
  // Check if email is valid
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      die('Invalid email address.');
  }
  
  // Include PHP Email Form library
  $php_email_form = '../assets/vendor/php-email-form/php-email-form.php';
  if (file_exists($php_email_form)) {
      include($php_email_form);
  } else {
      die('Unable to load the "PHP Email Form" Library!');
  }
  
  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $name;
  $contact->from_email = $email;
  $contact->subject = $subject;
  
  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */
  
  // Add message content
  $contact->add_message($name, 'From');
  $contact->add_message($email, 'Email');
  $contact->add_message($message, 'Message', 10);
  
  // Send the email and handle errors
  if (!$contact->send()) {
      die('Error occurred while sending the email.');
  } else {
      echo 'Message sent successfully!';
  }
  ?>
  