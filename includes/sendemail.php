<?php
  
  require "recaptcha.php";
  
  $isValid = recaptchaSiteVerify($_POST["action"], $_POST["token"]);
  echo "\n\r";
  echo "valid: " . $isValid;
  if($isValid) {
    $senderName = isset( $_POST['name'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['name'] ) : "";
    $senderEmail = isset( $_POST['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email'] ) : "";
    $message = isset( $_POST['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message'] ) : "";
    if ($senderName && $senderEmail && $message) {
      $subject = isset( $_POST['subject'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['subject'] ) : "";
      $txt = "studioelitecam.com" . "\n\n" . $message . "\n\n" . "Saludos,\n\n" . $senderName . " | " .$senderEmail;
      $mailTo = "contacto@studioelitecam.com";
      $headers = "From: " . $senderEmail;
      mail($mailTo, $subject, $txt, $headers);
      echo "<p class='uk-alert uk-alert-success uk-margin-large-bottom success' data-uk-alert=''>Gracias por contactarnos. Nos pondremos en contacto con usted lo antes posible!</p>";
    }
  } else {
    echo "<p class='uk-alert uk-alert-danger uk-margin-large-bottom' data-uk-alert=''>Error, no se puede enviar el correo </p>";
  }
  
?>