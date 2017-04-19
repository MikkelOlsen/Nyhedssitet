<?php
if(isset($_SESSION['userIDloggedin'])) {
if(isset($_POST['Opret']))
    {
        $title = $_POST['title'];
        $article = $_POST['article'];

            echo 'beginning';

            $target_dir = '../img/';
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			$success = '<div class="alert alert-danger" role="alert">File is an image - " . $check["mime"] . ".</div>';
			$uploadOk = 1;
		} else {
			$success = '<div class="alert alert-danger" role="alert">File is not an image.</div>';
			$uploadOk = 0;
		}
	// Check if file already exists
	if (file_exists($target_file)) {
        $success = '<div class="aler alert-danger" role="alert">Billedet eksistere allerede</div>';
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		$success = '<div class="alert alert-danger" role="alert">Sorry, your file is too large.</div>';
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$success = '<div class="alert alert-danger" role="alert">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>';
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		$success = '<div class="alert alert-danger" role="alert">Dit produkt blev ikke oprettet - Prøv igen</div>';
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			$success = '<div class="alert alert-success" role="alert">Dit produkt er nu oprettet!</div>';
			$fileName = basename( $_FILES["fileToUpload"]["name"]);            
            
                                }

                            
                }
    $stmtImg = $conn->prepare("INSERT INTO pictures (filename) 
                               VALUES (?)");
    $stmtImg->bind_param('s', $fileName);
    $stmtImg->execute();
    $lastId = mysqli_insert_id($conn);
    $stmtImg->close();

	//Insert product informaion into product databse
	$stmt = $conn->prepare("INSERT INTO mynews (title, article, fkPicture, fkCreated)
													VALUES (?, ?, ?, ?)");
	$stmt->bind_param('ssii', $_POST['title'],
															$_POST['article'],
                                                            $lastId,
                                                            $_SESSION['userIDloggedin']);
	$stmt->execute();
	$stmt->close();

            
		} 

        
header('Location: index.php?p=news');
}
?>