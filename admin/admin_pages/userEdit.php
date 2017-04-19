<?php
if(isset($_SESSION['userIDloggedin'])) {
if( isset( $_GET['userID']))
    {
        $_SESSION['userID'] = $_GET['userID'];
    }
if(isset($_POST['opdater']))
    {
        $editFirstName = $_POST['editFirstName'];
        $editLastName = $_POST['editLastName'];
        $editUsername = $_POST['editUsername'];
        $userID = $_SESSION['userID'];
        $sqli = "UPDATE `users` SET `firstName`='$editFirstName', `lastName`='$editLastName', `username`='$editUsername' WHERE id = '$userID'";
        $conn->query($sqli);

        $_SESSION['firstNameLoggedIn'] = $_POST['editFirstName'];
        $_SESSION['lastNameLoggedIn'] = $_POST['editLastName'];
	}
header('Location: index.php?p=users');
}
?>