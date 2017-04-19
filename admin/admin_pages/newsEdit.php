<?php
if(isset($_SESSION['userIDloggedin'])) {
if( isset( $_GET['newsID']))
    {
        $_SESSION['newsID'] = $_GET['newsID'];
    }
if(isset($_POST['opdater']))
    {
        $editTitle = $_POST['editTitle'];
        $editArticle = $_POST['editArticle'];
        $newsID = $_SESSION['newsID'];
        $editedID = $_SESSION['userIDloggedin'];
        $sqli = "UPDATE `mynews` SET `title`='$editTitle', `article`='$editArticle', `fkEdited`='$editedID' WHERE id = '$newsID'";
        $conn->query($sqli);

        
        if($_FILES['editFileToUpload']['error'] == 4) {

        } else {

            
            echo 'beginning';

            $target_dir = "../img/";
	$target_file = $target_dir . basename($_FILES["editFileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["opdater"])) {
		$check = getimagesize($_FILES["editFileToUpload"]["tmp_name"]);
		if($check !== false) {
			$success = '<div class="alert alert-danger" role="alert">File is an image - " . $check["mime"] . ".</div>';
			$uploadOk = 1;
		} else {
			$success = '<div class="alert alert-danger" role="alert">File is not an image.</div>';
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
        $success = '<div class="aler alert-danger" role="alert">Billedet eksistere allerede</div>';
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["editFileToUpload"]["size"] > 500000) {
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
		if (move_uploaded_file($_FILES["editFileToUpload"]["tmp_name"], $target_file)) {
			$success = '<div class="alert alert-success" role="alert">Dit produkt er nu oprettet!</div>';
			$fileName = basename( $_FILES["editFileToUpload"]["name"]);
            $fileDeleted = 1;
            
            echo 'file uploaded to folder';
                if ($fileDeleted == 1) 
                {

                        $sqliDeleteImg = $conn->query("SELECT pictures.id AS picID, pictures.filename, mynews.id AS newsID
                                                        FROM pictures
                                                        INNER JOIN mynews
                                                        ON mynews.fkPicture = pictures.id
                                                        WHERE mynews.id = '$newsID'");
                        while($row = $sqliDeleteImg->fetch_assoc()) {
                            $imgName = $row['filename'];
                            $picID = $row['picID'];
                        }
                        if (file_exists($target_file)) {
                            if (unlink('../img/' . $imgName)) {
                            $unlinkComplete = 1;
                            echo 'file deleted from folder';
                            } else {
                            $unlinkComplete = 0;
                            }
                        }                                         
                                        if($unlinkComplete == 1)
                                            {
                                                //Insert Image information into pictures databse
                                                $stmtImg = $conn->prepare("INSERT INTO pictures (filename) 
                                                                        VALUES (?)");
                                                $stmtImg->bind_param('s', $fileName);
                                                $stmtImg->execute();
                                                $lastId = mysqli_insert_id($conn);
                                                $stmtImg->close();
                                                $dbImgInsertComplete = 1;
                                                echo 'Info on IMG inserted into picture tabel';

                                                            if($dbImgInsertComplete == 1) 
                                                                {
                                                            //Update product informaion in product databse
                                                                    $stmt = "UPDATE mynews SET fkPicture='$lastId' WHERE id='$newsID'";
                                                            $conn->query($stmt);
                                                            echo 'Product Info Updated';
                                                            $completeSoon = 1;

                                                            if($completeSoon == 1) {
                                                            $sqliDeleteImg = "DELETE FROM pictures WHERE pictures.id = '$picID'";
                                                                                                $conn->query($sqliDeleteImg);
                                                                                                echo 'Img FK deleted from products'; 
                                                                                                
                                                                }
                                                        }
                                                }
                                }

                            
                }
            
		} 
		}
	}
header('Location: index.php?p=news');
}
?>