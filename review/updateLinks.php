<?php
include('connection.php');
$UID = $_POST['UID'];

$trip1 = $_POST['trip1'];
$trip2 = $_POST['trip2'];
$trip3 = $_POST['trip3'];
$trip4 = $_POST['trip4'];
$tripside1 = $_POST['tripside1'];
$tripside2 = $_POST['tripside2'];
$tripside3 = $_POST['tripside3'];
$tripside4 = $_POST['tripside4'];

$book = $_POST['book'];
$bookside = $_POST['book1'];

$lafour = $_POST['laFour'];
$lafourside = $_POST['laFour1'];

$expedia = $_POST['expedia1'];
$expediaside = $_POST['expedia2'];

$jaune1 = $_POST['jaune1'];
$jaune2 = $_POST['jaune2'];
$jaune3 = $_POST['jaune3'];
$jaune4 = $_POST['jaune4'];

$jauneside1 = $_POST['jauneside1'];
$jauneside2 = $_POST['jauneside2'];
$jauneside3 = $_POST['jauneside3'];
$jauneside4 = $_POST['jauneside4'];


$petit1 = $_POST['petit1'];
$petit2 = $_POST['petit2'];
$petit3 = $_POST['petit3'];
$petit4 = $_POST['petit4'];

$petitside1 = $_POST['petitside1'];
$petitside2 = $_POST['petitside2'];
$petitside3 = $_POST['petitside3'];
$petitside4 = $_POST['petitside4'];

$sql = "UPDATE UserTable SET TripAdvisor1='" . $trip1 . "', TripAdvisor2='" . $trip2 . "', TripAdvisor3='" . $trip3 . "', TripAdvisor4='" . $trip4
        . "', TripAdvisorSide1='" . $tripside1 . "', TripAdvisorSide2='" . $tripside2 . "', TripAdvisorSide3='" . $tripside3 . "', TripAdvisorSide4='" . $tripside4
        . "', Booking='" . $book . "', BookingSide='" . $bookside . "', LaFour='" . $lafour . "', LaFourSide='" . $lafourside
        . "', Expedia='" . $expedia . "', ExpediaSide='" . $expediaside . "', Jaune1='" . $jaune1 . "', Jaune2='" . $jaune2 . "', Jaune3='" . $jaune3 . "', Jaune4='" . $jaune4
        . "', JauneSide1='" . $jauneside1 . "', JauneSide2='" . $jauneside2 . "', JauneSide3='" . $jauneside3 . "', JauneSide4='" . $jauneside4        
        . "', Petit1='" . $petit1 . "', Petit2='" . $petit2 . "', Petit3='" . $petit3 . "', Petit4='" . $petit4
        . "', PetitSide1='" . $petitside1 . "', PetitSide2='" .$petitside2 . "', PetitSide3='" . $petitside3 . "', PetitSide4='" . $petitside4 . "' WHERE UID=" . $UID;
$conn->query($sql);
$conn->close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
