<?php
if(isset($_SESSION['userIDloggedin'])) {
if(isset($_POST['Opret']))
    {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $username = $_POST['username'];


	$pwd=$_POST['password'];
	$hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

	//Insert product informaion into product databse
	$stmt = $conn->prepare("INSERT INTO users (firstName, lastName, username, password)
													VALUES (?, ?, ?, ?)");
	$stmt->bind_param('ssss', 
                       $firstName,
                       $lastName,
                       $username,
                       $hashed_password);
	$stmt->execute();
	$stmt->close();

            
		} 

        
header('Location: index.php?p=users');
}
?>