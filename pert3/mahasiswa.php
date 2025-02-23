<?php
include 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $npm = $_POST["npm"];
    $nama = $_POST["nama"];
    $kelas = $_POST["kelas"];
    $jurusan = $_POST["jurusan"];

    $sql = "insert into datamahasiswa(npm,nama,kelas,jurusan) values(?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $npm, $nama, $kelas, $jurusan);

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