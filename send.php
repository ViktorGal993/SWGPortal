<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formulardaten empfangen
    $name = htmlspecialchars($_POST['name_support']);
    $lname = $_POST['lname_support'];
    $email = htmlspecialchars($_POST['email_support']);
    $message = htmlspecialchars($_POST['message_support']);
    $vollname = $name . " " . $lname;
    $subject = "Neue Anfrage von SWG IT-Dienstleistungsportal";

    // E-Mail-Empfänger 
    $admin_mail = "swg.passau@gmail.com";

    // E-Mail-Header
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // E-Mail-Inhalt
    $email_content = "Name: $vollname,\r\n";
    $email_content .= "E-Mail: $email\r\n\n";
    $email_content .= "Nachricht:\n$message\r\n";

    // E-Mail versenden
    $mail_sent = mail($admin_mail,$subject,$email_content, $headers);

   
    // Rückmeldung an den Benutzer
    if ($mail_sent) {
        echo "<p>Vielen Dank! Ihre Nachricht wurde erfolgreich gesendet.</p>";
    } else {
        echo "<p>Fehler beim Versenden der E-Mail.</p>";
    }
} else {
    echo "<p>Ungültige Anfrage.</p>";
}

 // Auto Antwort
    $subject_reply = "Vielen Dank, dass Sie sich gemeldet haben.";
    $message_replay= "Ihre Daten sind erfolgreich gesendet. Unser Team wird sich zeitnah mit Ihnen in Verbindung setzen.";

     $mail_reply = mail($email,$subject_reply,$message_replay);

       header("Location:index.php");

?>








/*
$to = "swg.passau@gmail.com"; // Email, an die die Formulardaten gesendet werden.
$subject = "Neue Anfrage von der Website ";
$name = $_POST['name_support'];
$lname = $_POST['lname_support'];
$email = $_POST['email_support'];
$message = $_POST['message_support'];;

$body = "Имя: $name\\n";
$body .= "Email: $email\\n";
$body .= "Сообщение:\\n$message\\n";

$headers = "From: $email\\r\\n";
$headers .= "Reply-To: $email\\r\\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\\r\\n";

if (mail($to, $name, $message)) {
    echo "erfolgreich versendet";
} else {
    echo "Fehler beim Senden";
}
*/

?>