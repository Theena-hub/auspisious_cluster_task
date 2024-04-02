<?php
include ('../db.php');
class Category
{
    function Add()
    {
        extract($_REQUEST);
        global $conn;
        $data = json_encode($_REQUEST);
        $query = "INSERT INTO tbl_category (data) VALUES ('$data')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo 'Data Added Successfully';
        } else {
            echo 'Error:' . $mysqli->error;
        }
    }
    function Delete()
    {
        extract($_REQUEST);
        global $conn;
        $query = "UPDATE tbl_category SET status=0 WHERE id='$id'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo 'Data Deleted Successfully';
        } else {
            echo 'Error:' . $mysqli->error;
        }
    }
    function Get()
    {
        extract($_REQUEST);
        global $conn;
        $query = "SELECT * FROM tbl_category WHERE id = '$id' AND status = 1";
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
        $query = "UPDATE tbl_category SET data='$data' WHERE id='$edit_id'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo 'Data Updated Successfully';
        } else {
            echo 'Error:' . $mysqli->error;
        }
    }
}

$func_type = new Category;
if ($_REQUEST['req_type'] == 'add') {
    $func_type->Add();
} else if ($_REQUEST['req_type'] == 'delete') {
    $func_type->Delete();
} else if ($_REQUEST['req_type'] == 'get') {
    $func_type->Get();
} else if ($_REQUEST['req_type'] == 'update') {
    $func_type->Update();
}
?>