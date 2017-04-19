<?php
    unset( $_SESSION['firstNameLoggedIn']);
    unset( $_SESSION['lastNameLoggedIn']);
    unset( $_SESSION['userIDloggedin']);
    header( 'Location: index.php?p=frontpage' );

?>