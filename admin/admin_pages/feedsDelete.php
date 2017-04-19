<?php
if( isset($_SESSION['userIDloggedin'])) {
if( isset( $_GET['id']))
{
    $deleteFeedID = $_GET['id'];

    $sqli = "DELETE FROM feed WHERE id='$deleteFeedID'";
    $conn->query( $sqli );
}
header('Location: index.php?p=feeds');
}
?>