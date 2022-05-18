<?php
require "../../../data/config.php";
session_start();
if (!$_SESSION['id_admin']) {
    header("Location: ../login/index.php");
}
// Get all customer information
$query = "SELECT * FROM customer";
$result = $mysql_db->query($query);
$customers = array();
while ($item = mysqli_fetch_assoc($result)) {
    $customers[] = $item;
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
    <link rel="stylesheet" href="../../../assets/css/admin/customer.css">
    <link rel="stylesheet" href="../../../assets/css/admin/index.css">
</head>

<body style="overflow: unset;">
    <!-- Side bar -->

    <?php include('../header/index.php'); ?>


    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 id="titleTable">
                    Customer
                </h3>
            </div>
            <div class="card-content">

                <table class="table-stripped">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Birthday</th>
                        <th>Register At</th>
                        <th>Active</th>
                        <th>Password</th>
                        <th></th>
                        <th></th>
                    </tr>

                    <?php foreach ($customers as $customer) { ?>

                        <tr>
                            <td><?php echo $customer['id']; ?></td>
                            <td><?php echo $customer['name']; ?></td>
                            <td><?php echo $customer['email']; ?></td>
                            <td><?php echo $customer['phone']; ?></td>
                            <td><?php echo $customer['birthdate']; ?></td>
                            <td><?php echo $customer['registered_at']; ?></td>
                            <td><?php echo $customer['active']; ?></td>
                            <td><button class="btn btn-primary" data-toggle="modal" data-target="#customerEditModal<?php echo $customer['id']; ?>">Edit</button>
                            </td>
                            <td><button class="btn btn-danger" onclick="deleteCustomer(<?php echo $customer['id']; ?> , '<?php echo $customer['email']; ?>')">Delete</button>
                            </td>
                        </tr>

                    <?php } ?>
                </table>
            </div>
        </div>
    </div>



    <!-- Edit Customer -->
    <?php foreach ($customers as $customer) { ?>
        <div class="modal fade" id="customerEditModal<?php echo $customer['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="customerModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Edit Customer Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group row align-items-center justify-content-center">
                                <label for="id-edit-<?php echo $customer['id']; ?>" class="col-2 col-form-label"><strong>ID</strong></label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="<?php echo $customer['id']; ?>" id="id-edit-<?php echo $customer['id']; ?>" disabled>
                                </div>
                                <span class="text-danger" id="idErr"></span>
                            </div>
                            <div class="form-group row align-items-center justify-content-center">
                                <label for="name-edit-<?php echo $customer['id']; ?>" class="col-2 col-form-label"><strong>Name</strong></label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="<?php echo $customer['name']; ?>" id="name-edit-<?php echo $customer['id']; ?>">
                                </div>
                                <span class="text-danger" id="nameErr"></span>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="email-edit-<?php echo $customer['id']; ?>" class="col-2 col-form-label"><strong>Email</strong></label>
                                <div class="col-10">
                                    <input class="form-control" type="email" value="<?php echo $customer['email']; ?>" id="email-edit-<?php echo $customer['id']; ?>">
                                    <input class="form-control" type="email" value="<?php echo $customer['email']; ?>" id="original-email-edit-<?php echo $customer['id']; ?>" hidden>
                                </div>
                                <span class="text-danger" id="emailErr"></span>
                            </div>
                            <div class="form-group row align-items-center justify-content-center">
                                <label for="phone-edit-<?php echo $customer['id']; ?>" class="col-2 col-form-label"><strong>Phone</strong></label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="<?php echo $customer['phone']; ?>" id="phone-edit-<?php echo $customer['id']; ?>">
                                </div>
                                <span class="text-danger" id="phoneErr"></span>
                            </div>
                            <div class="form-group row align-items-center justify-content-center">
                                <label for="birthday-edit-<?php echo $customer['id']; ?>" class="col-2 col-form-label"><strong>Birthday</strong></label>
                                <div class="col-10">
                                    <input class="form-control" type="date" value="<?php echo $customer['birthdate']; ?>" id="birthday-edit-<?php echo $customer['id']; ?>">
                                </div>
                                <span class="text-danger" id="birthdayErr"></span>
                            </div>
                            <div class="form-group row align-items-center justify-content-center">
                                <label for="register_at-edit-<?php echo $customer['id']; ?>" class="col-2 col-form-label"><strong>Register At</strong></label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="<?php echo $customer['registered_at']; ?>" id="register_at-edit-<?php echo $customer['id']; ?>" disabled>
                                </div>
                                <span class="text-danger" id="register_atErr"></span>
                            </div>
                            <div class="form-group row align-items-center justify-content-center">
                                <label for="active-edit-<?php echo $customer['id']; ?>" class="col-2 col-form-label"><strong>Active</strong></label>
                                <div class="col-10">
                                    <input class="form-control" type="number" value="<?php echo $customer['active']; ?>" id="active-edit-<?php echo $customer['id']; ?>">
                                </div>
                                <span class="text-danger" id="activeErr"></span>
                            </div>
                            <div class="form-group row align-items-center justify-content-center">
                                <label for="avatar-edit-<?php echo $customer['id']; ?>" class="col-2 col-form-label"><strong>Avatar</strong></label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="<?php echo $customer['avatar']; ?>" id="avatar-edit-<?php echo $customer['id']; ?>">
                                </div>
                                <span class="text-danger" id="avatarErr"></span>
                            </div>

                            <!-- <span class="text-danger" id="activeErr"></span> -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="editCustomer(<?php echo $customer['id']; ?>)">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <script>
        // Delete Customer
        function deleteCustomer(customer_id, customer_email) {
            if (confirm("DELETE this Customer?")) {
                $.post(
                    "../post/customer_func.php", {
                        action: "delete_customer",
                        id: customer_id,
                        email: customer_email
                    },
                    function(data, status) {
                        alert(data);
                        if (data == "Delete Customer SUCCESSFULLY!")
                            window.location.href = "index.php";
                    }
                );
            }
        }


        function editCustomer(customer_id) {
            var id = $("#id-edit-" + customer_id).val();
            var name = $("#name-edit-" + customer_id).val();
            var email = $("#email-edit-" + customer_id).val();
            var originalEmail = $("#original-email-edit-" + customer_id).val();
            var phone = $("#phone-edit-" + customer_id).val();
            var birthday = $("#birthday-edit-" + customer_id).val();
            var register_at = $("#register_at-edit-" + customer_id).val();
            var active = $("#active-edit-" + customer_id).val();
            var avatar = $("#avatar-edit-" + customer_id).val();
            $.post(
                "../post/customer_func.php", {
                    action: "edit_customer",
                    id: id,
                    name: name,
                    email: email,
                    originalEmail: originalEmail,
                    phone: phone,
                    birthday: birthday,
                    register_at: register_at,
                    active: active,
                    avatar: avatar,
                },
                function(data, status) {
                    alert(data);
                    if (data == "Update Customer Information SUCCESSFULLY!")
                        window.location.href = "index.php";
                }
            );
        }
    </script>
</body>

</html>