<!-- Side bar -->
<?php
    require "../../../data/config.php";
    session_start();
    $query = "select avatar from customer WHERE email= '" . $_SESSION['email'] . "'";
    $result = $mysql_db->query($query);
    $row = $result->fetch_assoc();

?>

<link rel="stylesheet" href="../../../assets/css/admin/navbar.css">
<link rel="stylesheet" href="../../../assets/css/admin/index.css">

<nav class="navbar navbar-expand-md navbar-dark bg-dark border-bottom sticky-top">
    <a class="navbar-brand" href="../home_page/index.php">
        Bookstore
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <div class="navbar-nav ml-auto">
            <li class="nav-item active">
                <form class="form-inline" action="../product_page/index.php">
                    <input name="keyword" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                </form>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../home_page/index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../product_page/index.php">Product <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../about_page/index.php">About <span class="sr-only"></span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../contact_page/index.php">Contact <span class="sr-only"></span></a>
            </li>
            <ul class="navbar-right">
                <li style="line-height: 1.5;;"><a class="nav-link" href="../cart/index.php" id="cart" style="color: white;"><i class="fa fa-shopping-cart"></i> Cart <span class="badge"></span></a></li>
            </ul>
            <?php 
                      
                      if (!empty($_SESSION['email'])) {
                          print "<!--end navbar-right -->
                          <div class='nav-item dropdown'>
                              <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                  <img id='linkAvatar' class='rounded-circle' alt='Image placeholder' src=" . $row['avatar'] . " \"width='30' height='30'>
                                  <span class='mb-0' style='color: aliceblue;' id='topLeftName'>
                                      ". $_SESSION['name'] ."
                                  </span>
                              </a>
                              <div class='dropdown-menu dropdown-menu-right' aria-labelledby='navbarDropdownMenuLink'>
                                  <a class='dropdown-item' href='../account_page/index.php'>
                                      <i class='fas fa-user-edit'></i>
                                      <span class='nav-link-text'>Change information</span>
                                  </a>
                                  <a class='dropdown-item' href='../authenticate/logout.php'>
                                      <i class='fas fa-sign-out-alt'></i>
                                      <span class='nav-link-text'>Logout</span>
                                  </a>
                              </div>
                          </div>";
                      }
                      else {
                          print "<li style='line-height: 1.5;;'><a class='nav-link' href='../authenticate/login.php' id='cart' style='color: white;'><i class='fas fa-sign-in-alt'></i> Login <span class='badge'></span></a></li>";
                      }
                  ?>
        </div>

    </div>
</nav>