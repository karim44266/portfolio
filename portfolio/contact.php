<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = strip_tags(trim($_POST["name"]));
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $message = trim($_POST["message"]);

  if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
    header("Location: index.php?success=0");
    exit;
  }

  $to = "youremail@example.com";  // Replace with your actual email
  $subject = "New contact from portfolio site";
  $email_content = "Name: $name\n";
  $email_content .= "Email: $email\n\n";
  $email_content .= "Message:\n$message\n";

  $email_headers = "From: $name <$email>";

  if (mail($to, $subject, $email_content, $email_headers)) {
    header("Location: index.php?success=1");
  } else {
    header("Location: index.php?success=0");
  }
} else {
  header("Location: index.php");
}
?>
