<?php

    // Formulardaten empfangen
    $name = "Ivan";
    $lname = "Peter";
    $email = "kolian@ivan.com";
    $message = "Hi Iam Ivan";
    $vollname = $name . " " . $lname;

    // E-Mail-Empfänger 
    $to = "swg.passau@outlook.de";

    // E-Mail-Header
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // E-Mail-Inhalt
    $email_content = "Name: $vollname, \n";
    $email_content .= "E-Mail: $email\n\n";
    $email_content .= "Nachricht:\n$message";

    // E-Mail versenden
    $mail_sent = mail($to,$email_content, $headers);

    // Rückmeldung an den Benutzer
    if ($mail_sent) {
        echo "<p>Vielen Dank! Ihre Nachricht wurde erfolgreich gesendet.</p>";
    } else {
        echo "<p>Fehler beim Versenden der E-Mail.</p>";
    }


?>









