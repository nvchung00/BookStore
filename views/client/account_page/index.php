<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Account</title>
    <?php 
    include('../include/stylesheet.php'); ?>


</head>

<body>
    <?php include( "../include/header.php"); ?>
    <?php 
        $id = $_SESSION['id'];
        require ('../../../data/config.php'); 
        $query = "SELECT * FROM customer WHERE id=$id";
        $result = $mysql_db->query($query);
        $customer = array();
        if ($result){
            while ($item = mysqli_fetch_assoc($result)) {
                $customer = $item;
            }
        }
    ?>
    <?php include("./main.php"); ?>
    <?php include("../include/footer.php"); ?>
    <?php include('../include/script.php'); ?>
    
    <script>
        $(document).ready(function() {
            $("#orders").hide();
            
            $("#order_link").click(function() {
                // Hide profile
                $("#profile_link").removeClass("active");
                $("#profile").hide();
                // Show orders
                $("#order_link").addClass("active");
                $("#orders").show();
            });

            $("#profile_link").click(function() {
                // Show profile
                $("#profile_link").addClass("active");
                $("#profile").show();
                // Hide orders
                $("#order_link").removeClass("active");
                $("#orders").hide();
            });
        });
        
        // Update information
        function updateInfor(customer_id) {
            // Get form
            var form = $('#fileUploadForm')[0];
    
            // Create an FormData object 
            var data = new FormData(form);

            data.append('action', "update_info")
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "account_func.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    console.log(data)
                    location.reload(true); 
                }
            })
        }

        // Change Password
        function changePassword(customer_id) {
            var oldPass = $("#oldPassword").val();
            var oldHashPass = $("#oldHashPassword").val();
            var newPass = $("#newPassword").val();
            var newPassConfirm = $("#confirmNewPassword").val();
            if (oldPass == '') {
                $("#oldPassErr").text("Please enter your current password!");
                setTimeout(function(){$("#oldPassErr").text('');}, 2000);
                return;
            }
            if (newPass == '') {
                $("#newPassErr").text("Please enter new password!");
                setTimeout(function(){$("#newPassErr").text('');}, 2000);
                return;
            }
            if (newPassConfirm == '') {
                $("#newPassConfErr").text("Please enter confirm password!");
                setTimeout(function(){$("#newPassConfErr").text('');}, 2000);
                return;
            }
            if (newPass == oldPass) {
                $("#newPassErr").text("New password must be different from current password!");
                setTimeout(function(){$("#newPassErr").text('');}, 2000);
                return;
            }
            if (newPass != newPassConfirm) {
                $("#newPassConfErr").text("Confirm password does not match!");
                setTimeout(function(){$("#newPassConfErr").text('');}, 2000);
                return;
            }
            $.post(
                "account_func.php",
                {
                    action: "change_password",
                    id: customer_id,
                    oldPass: oldPass,
                    oldHashPass: oldHashPass,
                    newPass: newPass
                },
                function(data, status) {
                    if (data == "incorrect_old_password") {
                        $("#oldPassErr").text("Current password is incorrect!");
                        setTimeout(function(){$("#oldPassErr").text('');}, 2000);
                        return;
                    }
                    alert(data);
                    if (data == "Change Password SUCCESSFULLY!")
                        window.location.href = "index.php";
                }
            );

        }
    </script>
</body>

</html>