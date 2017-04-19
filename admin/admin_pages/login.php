<?php
    if( isset( $_POST['login']))
{
    $myusername = $_POST['username'];
    $mypassword = $_POST['password'];
    $sqliPassFetch = $conn->query("SELECT id, password FROM users WHERE username = '$myusername'");
    $row = $sqliPassFetch->fetch_array();

	if (password_verify($mypassword, $row['password'])) {
    $sqli = "SELECT id, firstName, lastName FROM users WHERE username='$myusername'";
    $resultuser = $conn->query($sqli);

    if( $resultuser->num_rows == 1)
    {
        $row = $resultuser->fetch_assoc();
        $_SESSION['firstNameLoggedIn'] = $row['firstName'];
        $_SESSION['lastNameLoggedIn'] = $row['lastName'];
        $_SESSION['userIDloggedin'] = $row['id'];
        header( 'Location: index.php?p=frontpage' );
        
    }
    }
    else
    {
        echo "Der er fejl i brugernavn eller kodeord";
    }

}
?>