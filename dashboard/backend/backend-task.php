<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include ("../db.php");
class Task
{
    function Add()
    {
        extract($_REQUEST);
        global $conn;
        $data = json_encode($_REQUEST);
        // query
        $query = "INSERT INTO tbl_task (data) VALUES ('$data')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo 'Data Added Successfully!';
        } else {
            echo 'Error:' . $mysqli->error;
        }
    }
    function Get()
    {
        extract($_REQUEST);
        global $conn;
        $query = "SELECT * FROM tbl_task WHERE id = '$id' AND status = 1";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            echo json_encode(['success' => true, 'data' => $data]);
        } else {
            echo 'Error:' . $mysqli->error;
        }
    }
    function Update()
    {
        extract($_REQUEST);
        global $conn;
        $data = json_encode($_REQUEST);
        $query = "UPDATE tbl_task SET data = '$data' WHERE id = '$edit_id'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo 'Data Updated Successfully!';
        } else {
            echo 'Error:' . $mysqli->error;
        }
    }
    function Delete()
    {
        extract($_REQUEST);
        global $conn;
        $query = "UPDATE tbl_task SET status = 0 WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo 'Data Deleted Successfully!';
        } else {
            echo 'Error:' . $mysqli->error;
        }
    }
    function EmailAvailability()
    {
        extract($_REQUEST);
        global $conn;
        $query = "SELECT COUNT(*) as count FROM tbl_task WHERE JSON_EXTRACT(`data`, '$.email') = '$email' AND status=1";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];
            if ($count > 0) {
                echo 'Email Already Taken';
            } else {
                echo 'Email is Available';
            }
        } else {
            // Error in query
            echo 'Error:' . $mysqli->error;
        }
    }
    function EditEmailAvailability()
    {
        extract($_REQUEST);
        global $conn;
        $query = "SELECT COUNT(*) as count FROM tbl_task WHERE JSON_EXTRACT(`data`, '$.email') = '$email' AND id != '$id' AND status=1";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];
            if ($count > 0) {
                echo 'Email Already Taken';
            } else {
                echo 'Email is Available';
            }
        } else {
            // Error in query
            echo 'Error:' . $mysqli->error;
        }
    }
    function PhoneAvailability()
    {
        extract($_REQUEST);
        global $conn;
        $query = "SELECT COUNT(*) as count FROM tbl_task WHERE JSON_EXTRACT(`data`, '$.phone') = '$phone' AND status=1";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];
            if ($count > 0) {
                echo 'Phone Already Taken';
            } else {
                echo 'Phone is Available';
            }
        } else {
            // Error in query
            echo 'Error:' . $mysqli->error;
        }
    }
    function EditPhoneAvailability()
    {
        extract($_REQUEST);
        global $conn;
        $query = "SELECT COUNT(*) as count FROM tbl_task WHERE JSON_EXTRACT(`data`, '$.phone') = '$phone' AND id != '$id' AND status=1";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];
            if ($count > 0) {
                echo 'Phone Already Taken';
            } else {
                echo 'Phone is Available';
            }
        } else {
            // Error in query
            echo 'Error:' . $mysqli->error;
        }
    }
}
$func_type = new Task;
// add data
if ($_REQUEST['req_type'] == 'add') {
    $func_type->Add();
}
// get data
elseif ($_REQUEST['req_type'] == 'get') {
    $func_type->Get();
}
// update data
elseif ($_REQUEST['req_type'] == 'update') {
    $func_type->Update();
}
// delete data 
elseif ($_REQUEST['req_type'] == 'delete') {
    $func_type->Delete();
}
// email availablity checking while add data
elseif ($_REQUEST['req_type'] == 'email_availability') {
    $func_type->EmailAvailability();
}
// email availablity checking while edit data
elseif ($_REQUEST['req_type'] == 'edit_email_availability') {
    $func_type->EditEmailAvailability();
}
// phone availablity checking while add data
elseif ($_REQUEST['req_type'] == 'phone_availability') {
    $func_type->PhoneAvailability();
}
// phone availablity checking while edit data
elseif ($_REQUEST['req_type'] == 'edit_phone_availability') {
    $func_type->EditPhoneAvailability();
}
?>