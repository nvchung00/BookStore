<!-- Side bar -->
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

<link rel="stylesheet" href="../../../assets/css/admin/navbar.css">

<nav class="navbar navbar-expand-md navbar-dark bg-dark border-bottom sticky-top">
        <a class="navbar-brand" href="index.php">
            Bookstore
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <div class="navbar-nav ml-auto">
                <li class="nav-item active" >
                    <a class="nav-link" href="../home/index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active" >
                    <a class="nav-link" href="../product/index.php">Product <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active" >
                    <a class="nav-link" href="../transaction/index.php">Transaction <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active" >
                    <a class="nav-link" href="../customer/index.php">Customer <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active" >
                    <a class="nav-link" href="../employee/index.php">Employee <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active" >
                    <a class="nav-link" href="../contact/index.php">Contact <span class="sr-only"></span></a>
                </li>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img id="linkAvatar" class="rounded-circle" alt="Image placeholder" src=<?php echo $row['avatar'] ?> width="30" height="30">
                        <span class="mb-0" style="color: aliceblue;" id="topLeftName">
                            <?php
                            echo $_SESSION["first_name"];
                            ?>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="../information/index.php">
                        <i class='fas fa-user-edit'></i>
                            <span class="nav-link-text">Change information</span>
                        </a>
                        <a class="dropdown-item" href="../logout/index.php">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="nav-link-text">Logout</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </nav>