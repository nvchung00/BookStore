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
    <link rel="stylesheet" href="../../../assets/css/admin/index.css">

</head>

<body style="overflow: unset;">
    <!-- Side bar -->

    <?php include('../header/index.php'); ?>


    <div class="container-fluid">

        <!-- start code     -->
        <div class="row">
            <div class="col-12">
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 id="titleTable" style="margin-top: 50px;">
                            All Employees
                        </h3>
                        <div class="col d-flex justify-content-end">
                    <button class="btn btn-success" data-toggle="modal" data-target="#staffModal">Add new employee</button>
                </div>
                    </div>
                    <div class="card-content">
                        <table class="table table-striped table-hover table-responsive-lg" style="table-layout:fixed;">
                            <thead>
                                <tr>
                                    <th class="font-weight-bold table-primary">ID</th>
                                    <th class="font-weight-bold table-primary">Full name</th>
                                    <th class="font-weight-bold table-primary">Work as</th>
                                    <th class="font-weight-bold table-primary">Link avatar</th>
                                    <th class="font-weight-bold table-primary">Link facebook</th>
                                    <th class="font-weight-bold table-primary">Link twitter</th>
                                    <th class="font-weight-bold table-primary">Link instagram</th>
                                    <th class="font-weight-bold table-primary"></th>
                                    <th class="font-weight-bold table-primary"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php



                                $sql = "SELECT * from employee";
                                $res = $mysql_db->query($sql);
                                $employ = array();
                                while ($row = $res->fetch_assoc()) {
                                    array_push($employ, array($row['id'], $row['full_name'], $row['work_as'], $row['link_image'], $row['link_facebook'], $row['link_twitter'], $row['link_instagram']));

                                ?>
                                    <tr>
                                        <td> <?php echo $row['id'] ?> </td>
                                        <td> <?php echo $row['full_name'] ?> </td>
                                        <td> <?php echo $row['work_as'] ?> </td>
                                        <td> <?php echo $row['link_image'] ?> </td>
                                        <td> <?php echo $row['link_facebook'] ?> </td>
                                        <td> <?php echo $row['link_twitter'] ?> </td>
                                        <td> <?php echo $row['link_instagram'] ?> </td>


                                        <td> <button class="btn btn-primary" data-toggle="modal" data-target="#staffEditModal<?php echo $row['id'] ?>">Edit</button>
                                        </td>
                                        <td> <button class="btn btn-danger" onclick="deleteEmployee(<?php echo $row['id'] ?>)">Delete</button>
                                        </td>
                                        </td>

                                    </tr>

                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- modal add new employee -->
    <div class="modal fade" id="staffModal" tabindex="-1" role="dialog" aria-labelledby="staffModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Add new employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row align-items-center justify-content-center">
                            <label for="name" class="col-2 col-form-label"><strong>Full name</strong></label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="" id="name">
                            </div>
                            <span class="text-danger" id="nameErr"></span>
                        </div>
                        <div class="form-group row align-items-center justify-content-center">
                            <label for="profile" class="col-2 col-form-label"><strong>Work as</strong></label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="" id="work">
                            </div>
                            <span class="text-danger" id="workErr"></span>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="email" class="col-2 col-form-label"><strong>Link avatar</strong></label>
                            <div class="col-10">
                                <input class="form-control" type="email" value="" id="avatar">
                            </div>
                            <span class="text-danger" id="avatarErr"></span>
                        </div>
                        <div class="form-group row align-items-center justify-content-center">
                            <label for="phone" class="col-2 col-form-label"><strong>Link facebook</strong></label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="" id="face">
                            </div>
                            <span class="text-danger" id="faceErr"></span>
                        </div>
                        <div class="form-group row align-items-center justify-content-center">
                            <label for="html" class="col-2 col-form-label"><strong>Link twitter</strong></label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="" id="twitter">
                            </div>
                            <span class="text-danger" id="twitterErr"></span>
                        </div>
                        <div class="form-group row align-items-center justify-content-center">
                            <label for="html" class="col-2 col-form-label"><strong>Link instagram</strong></label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="" id="insta">
                            </div>
                            <span class="text-danger" id="instaErr"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addEmployee()">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!-- edit employee -->
    <?php
    for ($index = 0; $index < count($employ); $index++) {
    ?>

        <div class="modal fade" id="staffEditModal<?php echo $employ[$index][0]; ?>" tabindex="-1" role="dialog" aria-labelledby="staffEditModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Edit employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group row align-items-center">
                                <label for="id-edit-<?php echo $employ[$index][0]; ?>" class="col-2 col-form-label"><strong>ID</strong></label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="<?php echo $employ[$index][0]; ?>" id="id-edit-<?php echo $employ[$index][0]; ?>" disabled>
                                </div>
                                <span class="text-danger" id="idErr"></span>
                            </div>
                            <div class="form-group row align-items-center justify-content-center">
                                <label for="name-edit-<?php echo $employ[$index][0]; ?>" class="col-2 col-form-label"><strong>Full name</strong></label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="<?php echo $employ[$index][1]; ?>" id="name-edit-<?php echo $employ[$index][0]; ?>">
                                </div>
                                <span class="text-danger" id="nameErr"></span>
                            </div>
                            <div class="form-group row align-items-center justify-content-center">
                                <label for="work-edit-<?php echo $employ[$index][0]; ?>" class="col-2 col-form-label"><strong>Work as</strong></label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="<?php echo $employ[$index][2]; ?>" id="work-edit-<?php echo $employ[$index][0]; ?>">
                                </div>
                                <span class="text-danger" id="workErr"></span>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="avatar-edit-<?php echo $employ[$index][0]; ?>" class="col-2 col-form-label"><strong>Link avatar</strong></label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="<?php echo $employ[$index][3]; ?>" id="avatar-edit-<?php echo $employ[$index][0]; ?>">
                                </div>
                                <span class="text-danger" id="avatarErr"></span>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="face-edit-<?php echo $employ[$index][0]; ?>" class="col-2 col-form-label"><strong>Link facebook</strong></label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="<?php echo $employ[$index][4]; ?>" id="face-edit-<?php echo $employ[$index][0]; ?>">
                                </div>
                                <span class="text-danger" id="faceErr"></span>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="twitter-edit-<?php echo $employ[$index][0]; ?>" class="col-2 col-form-label"><strong>Link twitter</strong></label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="<?php echo $employ[$index][5]; ?>" id="twitter-edit-<?php echo $employ[$index][0]; ?>">
                                </div>
                                <span class="text-danger" id="twitterErr"></span>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="insta-edit-<?php echo $employ[$index][0]; ?>" class="col-2 col-form-label"><strong>Link instagram</strong></label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="<?php echo $employ[$index][3]; ?>" id="insta-edit-<?php echo $employ[$index][0]; ?>">
                                </div>
                                <span class="text-danger" id="instaErr"></span>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="editEmployee(<?php echo $employ[$index][0]; ?>)">Edit</button>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }
    ?>


    <script>
        // edit employee
        function editEmployee(employ_id) {
            var id = document.getElementById("id-edit-" + employ_id).value;
            var fname = document.getElementById("name-edit-" + employ_id).value;
            var work = document.getElementById("work-edit-" + employ_id).value;
            var avatar = document.getElementById("avatar-edit-" + employ_id).value;
            var face = document.getElementById("face-edit-" + employ_id).value;
            var twitter = document.getElementById("twitter-edit-" + employ_id).value;
            var insta = document.getElementById("insta-edit-" + employ_id).value;
            //console.log(id + " " + fname + " "+work+" "+avatar+" "+face+" "+twitter+" "+insta);
            $.post(
                "../post/employee_func.php", {
                    action: "edit_employee",
                    id: id,
                    fname: fname,
                    work: work,
                    avatar: avatar,
                    face: face,
                    twitter: twitter,
                    insta: insta
                },
                function(data, status) {
                    alert(data);
                    if (data == "Change employee information successfully!") window.location.href = "index.php";
                }
            );
        }

        // delete employee
        function deleteEmployee(employ_id) {
            $.post(
                "../post/employee_func.php", {
                    action: "delete_employee",
                    id: employ_id
                },
                function(data, status) {
                    alert(data);
                    if (data == "Delete employee information successfully!") window.location.href = "index.php";
                }
            );
        }

        // add employee
        function addEmployee() {
            var fname = document.getElementById("name").value;
            var work = document.getElementById("work").value;
            var avatar = document.getElementById("avatar").value;
            var face = document.getElementById("face").value;
            var twitter = document.getElementById("twitter").value;
            var insta = document.getElementById("insta").value;
            $.post(
                "../post/employee_func.php", {
                    action: "add_employee",
                    fname: fname,
                    work: work,
                    avatar: avatar,
                    face: face,
                    twitter: twitter,
                    insta: insta
                },
                function(data, status) {
                    alert(data);
                    if (data == "Add employee information successfully!") window.location.href = "index.php";
                }
            );
        }
    </script>



</body>

</html>