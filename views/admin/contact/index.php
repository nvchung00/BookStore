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
    <link rel="stylesheet" href="../../../assets/css/admin/contact.css">
    <link rel="stylesheet" href="../../../assets/css/admin/index.css">
</head>

<body style="overflow: unset;">
    <!-- Side bar -->

    <?php include('../header/index.php'); ?>


    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 id="titleTable">
                    All Contacts
                </h3>
            </div>
            <div class="card-content">
                <table class="table table-striped table-hover table-responsive-lg">
                    <thead>
                        <tr>
                            <th class="font-weight-bold">ID</th>
                            <th class="font-weight-bold">First Name</th>
                            <th class="font-weight-bold">Last Name</th>
                            <th class="font-weight-bold">Email</th>
                            <th class="font-weight-bold">Website</th>
                            <th class="font-weight-bold">Subject</th>
                            <th class="font-weight-bold">Message</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "select * from send_email_log";
                        $result = $mysql_db->query($sql);
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr id=<?php echo $row['id']; ?>>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['first_name']; ?></td>
                                    <td><?php echo $row['last_name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['website']; ?></td>
                                    <td><?php echo $row['subject']; ?></td>
                                    <th><button class="btn btn-success" data-toggle="collapse" data-target=<?php echo "#msg" . $row['id']; ?> aria-expanded="false" aria-controls=<?php echo "msg" . $row['id']; ?>>View
                                            message</button>
                                    </th>
                                    <td><button class="btn_delete btn btn-danger" data-toggle="modal" data-rowid=<?php echo $row['id']; ?> data-target="#deleteConfirm">Delete</button></td>
                                </tr>

                                <tr id=<?php echo $row['id'] . "collapse"; ?>>
                                    <th colspan="9">
                                        <div class="card collapse" id=<?php echo "msg" . $row['id']; ?>>
                                            <div class="card-header">
                                                <h6 id="titleTable">
                                                    <?php
                                                    echo $row['first_name'] . " " . $row["last_name"] . "'s message";
                                                    ?>
                                                </h6>
                                            </div>
                                            <div class="card-content p-3">
                                                <p>
                                                    <?php
                                                    echo $row['message'];
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                        <tr>
                            <th colspan="10" class="text-center">
                                ---End---
                            </th>
                        </tr>
                    </tbody>

                </table>

            </div>
        </div>

    </div>
    <!-- Modal delete confirm-->
    <div class="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="deleteConfirm">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    This operation will remove the contact permanently.
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" id="confirmDeleteBtn" class="btn btn-primary">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../assets/js/admin/contact.js"></script>
</body>

</html>