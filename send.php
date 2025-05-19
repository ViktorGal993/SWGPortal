<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formulardaten empfangen
    $name = htmlspecialchars($_POST['name_support']);
    $lname = $_POST['lname_support'];
    $email = htmlspecialchars($_POST['email_support']);
    $message = htmlspecialchars($_POST['message_support']);
    $vollname = $name . " " . $lname;

    // E-Mail-Empfänger 
    $to = "swg.passau@gmail.com";

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
} else {
    echo "<p>Ungültige Anfrage.</p>";
}
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