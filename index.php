<?php
    ob_start();
    session_start();
    require_once 'sqlconfig.php';
    mysqli_set_charset($conn, "utf8");
?>


<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Nyheder</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="assets/mycss.css">
</head>
<body>

<?php

    include 'includes/header.php';
    if(isset($_SESSION['userIDloggedin'])){
    ?>
    <div id="wrapper">
        <div id="page-wrapper">
        
    <?php
    }
    if(isset($_GET['p'])){
        $page = 'pages/' . $_GET['p'] . '.php';
        if(file_exists($page)){
            include $page;
        } else {
            //404
            header('Location: index.php?p=frontpage');
        }
    } else {
        header('Location: index.php?p=frontpage');
    }
    ?>
    </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php
    include 'includes/footer.php';
    ?>
        
</body>
</html>
