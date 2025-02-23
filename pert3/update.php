<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];

    $sql = "UPDATE datamahasiswa SET nama = ?, kelas = ?, jurusan = ? WHERE npm = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nama, $kelas, $jurusan, $npm);

    if ($stmt->execute()) {
        header("location: index.php");
        exit; // Pastikan script berhenti setelah redirect
    } else {
        echo "Gagal memperbarui data: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
