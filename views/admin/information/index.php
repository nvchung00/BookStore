<?php
require "../../../data/config.php";
session_start();
if (!$_SESSION['id_admin']) {
    header("Location: ../login/index.php");
}
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
    <link rel="stylesheet" href="../../../assets/css/admin/dashboard.css">
    <link rel="stylesheet" href="../../../assets/css/admin/index.css">
</head>

<body style="overflow: unset;">
    <!-- Side bar -->

    <?php include('../header/index.php'); ?>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 id="titleTable">
                                    My Profile
                                </h3>
                            </div>
                            <div class="card-content">

                                <table class="table table-hover table-responsive-lg" id='tableProfile'>
                                    <?php
                                    $sql = "select email, first_name, last_name, 
                                    user_name , phone, birthdate, avatar from admin WHERE id= '" . $_SESSION['id_admin'] . "'";
                                    $result = $mysql_db->query($sql);
                                    $row = $result->fetch_assoc();
                                    ?>

                                    <tr>
                                        <th>Username</th>
                                        <td><?php echo $row['user_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>First Name</th>
                                        <td><?php echo $row['first_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Last Name</th>
                                        <td><?php echo $row['last_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo $row['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Telephone</th>
                                        <td><?php echo $row['phone']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Birthday</th>
                                        <td><?php echo $row['birthdate']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Avatar</th>
                                        <td><?php echo $row['avatar'] ?></td>
                                    </tr>
                                    
                                </table>

                            </div>

                        </div>
                        <div class="col d-flex justify-content-center my-3">
                            <button class="btn btn-primary mx-3" data-toggle="modal" data-target="#profileModal">Edit Profile <i class="fas fa-user-cog"></i></button>
                            <button class="btn btn-success mr-2" data-toggle="modal" data-target="#passwordModal" ?>Change
                                Password  <i class="fas fa-user-shield"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal section -->
    <!-- Edit profile -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="profileModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Your Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="fileUploadForm">
                        <div class="form-group row">
                            <label for="inputUserName" class="col-sm-2 col-form-label font-weight-bold">Username</label>
                            <div class="col-sm-10" id="formUserName">
                                <input name="username" type="text" class="form-control" id="inputUserName" value="<?php echo $row['user_name']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputFirstName" class="col-sm-2 col-form-label font-weight-bold">First
                                Name</label>
                            <div class="col-sm-10" id="formFirstName">
                                <input name="fistName" type="text" class="form-control" id="inputFirstName" value="<?php echo $row['first_name']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputLastName" class="col-sm-2 col-form-label font-weight-bold">Last Name</label>
                            <div class="col-sm-10" id="formLastName">
                                <input name="lastName" type="text" class="form-control" id="inputLastName" value="<?php echo $row['last_name']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputAvatar" class="col-sm-2 col-form-label font-weight-bold">Avatar</label>
                            <div class="col-sm-10" id="formLastName">
                                <input name="avatar" type="file" name="fileToUpload"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label font-weight-bold">Email</label>
                            <div class="col-sm-10" id="formEmail">
                                <input name="email" type="email" class="form-control" id="inputEmail" value="<?php echo $row['email'];  ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPhone" class="col-sm-2 col-form-label font-weight-bold">Telephone</label>
                            <div class="col-sm-10" id="formPhone">
                                <input name="phone" type="text" class="form-control" id="inputPhone" value="<?php echo $row['phone']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputBirthday" class="col-sm-2 col-form-label font-weight-bold">Birthday</label>
                            <div class="col-sm-10" id="formBirthday">
                                <input name="birthday" type="date" class="form-control" id="inputBirthday" value="<?php echo $row['birthdate']; ?>">
                            </div>
                        </div>
                        <div class=" modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" id="confirmProfileBtn">Save
                        changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Change password -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="passwordModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change your password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label for="inputOldPassword" class="col-sm-3 col-form-label font-weight-bold">Old
                                Password</label>
                            <div class="col-sm-9" id="formOldPassword">
                                <input type="password" class="form-control" id="inputOldPassword">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputNewPassWord1" class="col-sm-3 col-form-label font-weight-bold">New
                                Password</label>
                            <div class="col-sm-9" id="formNewPassword">
                                <input type="password" class="form-control" id="inputNewPassword">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputNewPassWord2" class="col-sm-3 col-form-label font-weight-bold">Retype New
                                Password</label>
                            <div class="col-sm-9" id="formConfirmNewPassword">
                                <input type="password" class="form-control" id="inputConfirmNewPassword">
                            </div>

                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-center" id="passwordModalFooter">
                    <button type="button" class="btn btn-primary" id="confirmChangePassword">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal section -->
    <!-- Toast section -->



    <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
        <div class="" style="position: absolute; top: 0; right:0;">

            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="toastPassword" data-delay="5000" data-autohide='false'>
                <div class="toast-header">
                    <strong class="mr-auto">System</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    Your password has been changed.
                </div>
            </div>

        </div>
    </div>

    <!-- End toast section -->
    <script src="../../../assets/js/admin/edit_profile.js"></script>
    <script src="../../../assets/js/admin/change_password.js"></script>
</body>

</html>