<?php
session_start();
require "../../../data/config.php";

function validUserName($data)
{
    if (empty($data)) {
        return "Username is required";
    }
    if (!preg_match('/^[a-zA-Z0-9]{6,}$/', $data)) { // for english chars + numbers only
        // valid username, alphanumeric & longer than or equals 5 chars
        return "Username contains only letters, number and longer than 5 chars";
    }
    global $mysql_db;
    $query = "select id from admin where user_name = '" . $data . "' and id != '" . $_SESSION['id_admin'] . "'";
    $result = $mysql_db->query($query);
    if ($result) {
        if ($result->num_rows > 0) {
            return "Username already exists";
        }
    } else {
        return 'Something wrong with server. Cannot validate now';
    }
    return '';
}
function validFirstName($data)
{
    if (empty($data)) {
        return "First Name is required";
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $data)) {
            return "Only letters and white space allowed";
        }
    }
    return '';
}
function validLastName($data)
{
    if (empty($data)) {
        return "Last Name is required";
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $data)) {
            return "Only letters and white space allowed";
        }
    }
    return '';
}
function validEmail($data)
{
    if (empty($data)) {
        return "Email is required";
    } else {
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format";
        }
    }
    global $mysql_db;
    $query = "select id from admin where email = '" . $data . "' and id != '" . $_SESSION['id_admin'] . "'";
    $result = $mysql_db->query($query);
    if ($result) {
        if ($result->num_rows > 0) {
            return "Email already exists";
        }
    } else {
        return 'Something wrong with server. Cannot validate now';
    }
    return '';
}

function validPhone($data)
{
    $filtered_phone_number = filter_var($data, FILTER_SANITIZE_NUMBER_INT);
    // Remove "-" from number
    $phone_to_check = str_replace("-", "", $filtered_phone_number);
    if (!preg_match("/^([0-9-])*$/", $data)) {
        return 'Phone must contain only numbers and -';
    }
    if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
        return 'Phone must have between 10 and 14 number';
    }
    return '';
}
function validBirthday($data)
{
    $arr  = explode('-', $data);
    if (count($arr) == 3) {
        if (checkdate($arr[1], $arr[2], $arr[0])) {
            // valid date ...
        } else {
            return "Date is not existed";
        }
    } else {
        return "Invalid form of date";
    }
    $minAge = strtotime("-18 YEAR");
    if ($data > $minAge) {
        return "Sorry, you are too young";
    }
    return '';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "../../../assets/images/admin/";
$target_file = $target_dir . basename($_FILES["avatar"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["avatar"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  $uploadOk = 0;
}

// Check file size
if ($_FILES["avatar"]["size"] > 500000) {
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);

    $message = array(
        "username" => "",
        "firstName" => "",
        "lastName" => "",
        "email" => "",
        "phone" => "",
        "birthday" => "",
        'avatar' => "",
        "systemError" => "",
        "success" => true
    );
    $message['userName'] = validUserName($_POST['username']);
    $message['firstName'] = validFirstName($_POST['fistName']);
    $message['lastName'] = validFirstName($_POST['lastName']);
    $message['email'] = validEmail($_POST['email']);
    $message['phone'] = validPhone($_POST['phone']);
    $message['birthday'] = validBirthday($_POST['birthday']);
    $message['avatar'] = $target_file;
    if ($message['userName'] || $message['firstName'] ||   $message['email'] || $message['phone'] || $message['birthday'] || $message['lastName']) 
    {
        $message['success'] = false;
    } else {
        $query = "update admin set 
        user_name = '" . $_POST['username'] . "' , 
        first_name = '" . $_POST['fistName'] . "' , 
        last_name = '" . $_POST['lastName'] . "' , 
        email = '" . $_POST['email'] . "' ,
        phone = '" . $_POST['phone'] . "' ,
        birthdate = '" . $_POST['birthday'] . "' ,
        avatar = '" . $target_file . "'
        where id='" . $_SESSION['id_admin'] . "'  
        ";
        $result = $mysql_db->query($query);
        if (!$result) {
            $message['success'] = false;
            $message['systemError'] = $mysql_db->error;
        } else {
            $_SESSION["first_name"] = $_POST['firstName'];
            $_SESSION["avatar"] = $target_file;
        }
    }
    echo json_encode($message);
}
?>
