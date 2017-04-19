<?php
if(isset($_SESSION['userIDloggedin'])) {
if( isset( $_GET['id']))
{
    $deleteNewsID = $_GET['id'];
    $sqliDeleteImg = $conn->query("SELECT pictures.id AS picID, pictures.filename, mynews.id AS newsID
                                   FROM pictures
                                   INNER JOIN mynews
                                   ON mynews.fkPicture = pictures.id
                                   WHERE mynews.id = '$deleteNewsID'");
    while($row = $sqliDeleteImg->fetch_assoc()) {
        $imgName = $row['filename'];
        $imgID = $row['picID'];
    }
    if( file_exists('../img/'.$imgName)) {
        unlink('../img/'.$imgName);
    }

    $sqli = "DELETE FROM mynews WHERE mynews.id='$deleteNewsID'";
    $conn->query( $sqli );

    $sqliImg = "DELETE FROM pictures WHERE pictures.id ='$imgID'";
    $conn->query($sqliImg);
}
header( 'Location: index.php?p=news' );
}
?>
