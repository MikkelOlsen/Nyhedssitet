<?php
if(isset($_SESSION['userIDloggedin'])) {
if( isset( $_GET['id']))
{
    $userID = $_GET['id'];
    $sqli = "DELETE FROM users WHERE users.id='$userID'";
    $conn->query( $sqli );
}
header( 'Location: index.php?p=users' );
}
?>
