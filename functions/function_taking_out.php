<?php
require_once 'koneksi.php';
include_once 'helper.php';
function getData()
{
    global $conn;
    $sql     = "SELECT * FROM tb_taking_out_material ORDER BY id_taking_out_material DESC";
    $result    = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
}


function addData($post)
{
    global $conn;
    $plan_no = $post[0];
    $po_number = $post[1];
    $material_code = $post[2];
    $component_code = $post[3];
    $order_month = substr($plan_no, 0, 4) . substr($po_number, 1, 2);
    $sql = "INSERT INTO `tb_taking_out_material` (`id_taking_out_material`, `po_number`, `order_month`, `material_code`, `component_code`, `plan_no`, `material_taking_out_date`) VALUES (NULL, '$po_number', '$order_month', '$material_code', '$component_code', '$plan_no', CURRENT_TIMESTAMP)";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        // Display error message
        echo "Error: " . mysqli_error($conn);
        // Optionally, you can log the error as well
        // error_log("MySQL Error: " . mysqli_error($conn));
    }

    mysqli_close($conn); // Close the connection before returning

    return ($result) ? true : false;
}


function cekData($post)
{
    global $conn;
    $plan_no = $post[0];
    $po_number = $post[1];
    $material_code = $post[2];
    $component_code = $post[3];
    $order_month = substr($plan_no, 0, 4) . substr($po_number, 1, 2);
    // Buat query untuk mengecek apakah data sudah ada berdasarkan semua parameter
    $sql = "SELECT * FROM `tb_taking_out_material` WHERE `plan_no` = '$plan_no' AND `po_number` = '$po_number' AND `material_code` = '$material_code' AND `component_code` = '$component_code' AND `order_month`='$order_month'";

    // Lakukan query
    $result = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($result);
    if ($count > 0) {
        return false;
    } else {
        return true;
    }
}


function cekMaterial($post)
{
    global $conn;
    $material_code = $post[2];
    $sql = "SELECT * FROM `tb_material` WHERE `code` = '$material_code'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        return true;
    } else {
        $conn->query("INSERT INTO  `tb_material` VALUES (NULL, '$material_code', '-')");
        return true;
    }
}

function cekComponent($post)
{
    global $conn;
    $component_code = $post[3];
    $sql = "SELECT * FROM `tb_component` WHERE `code` = '$component_code'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}

function deleteData($id)
{
    global $conn;
    $sql     = "DELETE FROM tb_taking_out_material WHERE id_taking_out_material='$id'";
    $result    = mysqli_query($conn, $sql);
    return ($result) ? true : false;
    mysqli_close($conn);
}


if (isset($_POST['add'])) {
    $add         = addData($_POST);
    // session_start();
    unset($_SESSION["message"]);
    if ($add) {
        $_SESSION['message'] = $added;
    } else {
        $_SESSION['message'] = $failed;
    }
    // header("location:../data_taking_out_material.php");
} elseif (isset($_GET['hapus'])) {
    $id        = mysqli_real_escape_string($conn, $_GET['hapus']);
    $delete = deleteData($id);
    session_start();
    unset($_SESSION["message"]);
    if ($delete) {
        $_SESSION['message'] = $deleted;
    } else {
        $_SESSION['message'] = $failed;
    }
    header("location:../data_taking_out_material.php");
}


if (isset($_POST["action"])) {

    $value = $_POST['value'];
    if (!$value) {
        return false;
    }
    $data = explode(" ", $value);
    // cek data
    $cek = cekData($data);
    // $cekComponent = cekComponent($data);
    // $cekMaterial = cekMaterial($data);

   // if ($cekComponent == false) {
   //     echo json_encode([
    //        'code' => 400,
    //        'status' => 'error',
     //       'heading' => 'Proses Tambah Gagal!',
     //       'text' => 'Komponen di SPK Tidak Termasuk Kriteria.'
     //   ]);
     //   return 0;
   // }
  //  if ($cekMaterial == false) {
  //      echo json_encode([
  //          'code' => 400,
  //          'status' => 'error',
  //          'heading' => 'Proses Tambah Gagal!',
  //          'text' => 'Material di SPK Tidak Termasuk Kriteria.'
  //      ]);
    //    return 0;
 //   }
    if ($cek == false) {
       echo json_encode([
            'code' => 400,
            'status' => 'error',
            'heading' => 'Proses Tambah Gagal!',
            'text' => 'Data sudah ada didatabase.'
       ]);
        return 0;
    }
    $add = addData($data);
    if ($add) {
        echo json_encode([
            'code' => 200,
            'status' => 'success',
            'heading' => 'Proses Tambah Berhasil!',
            'text' => 'Data berhasil ditambahkan.'
        ]);
    } else {
        echo json_encode([
            'code' => 400,
            'status' => 'error',
            'heading' => 'Proses Tambah Gagal!',
            'text' => 'Data Gagal ditambahkan.'
        ]);
    }
}
