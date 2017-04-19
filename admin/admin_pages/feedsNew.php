<?php
if(isset( $_SESSION['userIDloggedin'])) {
if ($_POST) {

	//Insert product informaion into product databse
	$stmt = $conn->prepare("INSERT INTO feed (feedName, feedurl)
													VALUES (?, ?)");
	$stmt->bind_param('ss', $_POST['feedName'],
							$_POST['feedUrl']);
	$stmt->execute();
	$stmt->close();

                                                }
header('Location: index.php?p=feeds');
}
?>