<?php
if(isset($_SESSION['userIDloggedin'])) {

if( isset( $_GET['feedID']))
    {
        $_SESSION['feedID'] = $_GET['feedID'];
    }
    if(isset($_POST['opdater']))
    {
        $editName = $_POST['editFeedName'];
        $editUrl = $_POST['editFeedUrl'];
        $feedId = $_SESSION['feedID'];
        $sqli = "UPDATE `feed` SET `feedName`='$editName', `feedurl`='$editUrl' WHERE id = '$feedId'";
        $conn->query($sqli);
    }

    header('Location:index.php?p=feeds');    
}
?>