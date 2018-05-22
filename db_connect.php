<?php
$server ="localhost";
$user ="root";
$pass ="";
$db ="knife-tine";

$conn = mysqli_connect($server, $user, $pass, $db); // Δημιουργία σύνδεσης
// Καλό είναι να ορίζουμε την κωδικοποίηση των χαρακτήρων σε utf8
mysqli_set_charset($conn,"utf8");
// Έλεγχος σύνδεσης
if (!$conn) {
die("Η σύνδεση απέτυχε: " .mysqli_connect_error());
}

?>