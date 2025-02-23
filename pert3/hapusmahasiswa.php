<?php
include 'config.php';
if(isset($_GET['npm'])){
    $npm = $_GET['npm'];
    $sql = "delete from datamahasiswa where npm = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $npm);

    if($stmt->execute()){
        header("location: index.php");
        echo "data berhasil ditambahkan";
    } else{
        echo "error".$stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
