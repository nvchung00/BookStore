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
    <link rel="stylesheet" href="../../../assets/css/admin/transaction.css">
    <link rel="stylesheet" href="../../../assets/css/admin/index.css">
</head>

<body style="overflow: unset;">

    <?php include('../header/index.php'); ?>


    <div class="container-fluid">
        <div class="card-header">
            <h3 id="titleTable">
                Transaction
            </h3>
        </div>
        <div class="card-content">

            <table class="table table-striped table-hover table-responsive-lg">
                <thead>
                    <tr>
                        <th class="font-weight-bold">ID</th>
                        <th class="font-weight-bold">Customer ID</th>
                        <th class="font-weight-bold">Total Price</th>
                        <th class="font-weight-bold">Time</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "select * from shopping_log";
                    $result = $mysql_db->query($sql);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr id=<?php echo $row['id']; ?>>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['customer_id']; ?></td>
                                <td><?php echo $row['total_price']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>

                                <th><button class="btn btn-info" data-toggle="collapse" data-target=<?php echo "#detail" . $row['id']; ?> aria-expanded="false" aria-controls=<?php echo "detail" . $row['id']; ?>>View
                                        detail</button>
                                </th>
                                <td><button class="btn_delete btn btn-danger" data-toggle="modal" data-rowid=<?php echo $row['id']; ?> data-target="#deleteConfirm">Delete</button></td>
                            </tr>

                            <tr id=<?php echo $row['id'] . "collapse"; ?>>
                                <th colspan="9">
                                    <div class="card collapse" id=<?php echo "detail" . $row['id']; ?>>
                                        <div class="card-header">
                                            <h6 id="titleTable">
                                                <?php
                                                $sql = "select name from customer where id = '" . $row['customer_id'] . "'";
                                                $result1 = $mysql_db->query($sql);
                                                $row1 = $result1->fetch_assoc();
                                                echo $row1['name'] . "'s shopping list";
                                                ?>
                                            </h6>
                                        </div>
                                        <div class="card-content p-3">
                                            <table class="table table-striped table-hover table-responsive-lg">
                                                <thead>
                                                    <tr>
                                                        <th class="font-weight-bold">Book ID</th>
                                                        <th class="font-weight-bold">Name</th>
                                                        <th class="font-weight-bold">Category</th>
                                                        <th class="font-weight-bold">Image</th>

                                                        <th class="font-weight-bold">Unit Price</th>
                                                        <th class="font-weight-bold">Quantity</th>
                                                        <th class="font-weight-bold">Total Price</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "select * from shopping_log_entry where log_id = '" . $row['id'] . "'";
                                                    $result2 = $mysql_db->query($sql);
                                                    if ($result2) {
                                                        while ($row2 = $result2->fetch_assoc()) {
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $row2['book_id'] ?></td>
                                                                <td>

                                                                    <?php
                                                                    $sql = "select name, link_image, price, category from book where id = '" . $row2['book_id'] . "'";
                                                                    $result3 = $mysql_db->query($sql);
                                                                    if ($result3) {
                                                                        $row3 = $result3->fetch_assoc();
                                                                    }
                                                                    echo $row3['name'];
                                                                    ?>
                                                                </td>
                                                                <td><?php echo $row3['category'] ?></td>
                                                                <td>
                                                                    <img src="<?php echo str_replace('../../../../', '../../../', $row3['link_image']); ?>" alt="" width="50" height="50">
                                                                </td>
                                                                <td><?php echo $row3['price']; ?></td>
                                                                <td><?php echo $row2['quantity'] ?></td>
                                                                <td><?php echo $row3['price'] * $row2['quantity']; ?>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
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
    <!-- Modal delete confirm-->
    <div class="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="deleteConfirm">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Transaction Log</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    This operation will remove this log permanently.
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" id="confirmDeleteBtn" class="btn btn-primary">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../assets/js/admin/transaction.js"></script>
</body>

</html>