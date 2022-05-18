<?php
require "../../../data/config.php";
session_start();
if (!$_SESSION['id_admin']) {
    header("Location: ../login/index.php");
}
$query = "select avatar from admin WHERE id= '" . $_SESSION['id_admin'] . "'";
$result = $mysql_db->query($query);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <!-- Page plugins -->
    <?php include('../include/stylesheet.php'); ?>
    <?php include('../include/script.php'); ?>
    <link rel="stylesheet" href="../../../assets/css/admin/navbar.css">
    <link rel="stylesheet" href="../../../assets/css/admin/index.css">
</head>

<body style="overflow: unset;">
    <!-- Side bar -->

    <?php include('../header/index.php'); ?>


    <div class="container-fluid">
    <div class="text-center">
    <img lass="img-fluid mx-auto d-block" id="linkAvatar" class="rounded-circle" alt="Image placeholder" src=<?php echo $row['avatar'] ?> width="480px" height="600px">
        <h1 >Wellcome <?php echo $_SESSION["first_name"] ?>!!!</h1>
    </div>
    </div>
</body>

</html>