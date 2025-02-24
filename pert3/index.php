<?php
include 'config.php';
$sql = "SELECT * FROM datamahasiswa";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mahasiswa</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<style>
    table, th,td {
    border: 1px solid rgba(0, 0, 0, 0.212);
   
    padding: 8px;
    text-align: left;
}
table{
   
}
td{
    border: none;
}
th {
    background-color: #f2f2f2;
    border: none;
}
body,html{
    height: 100%;
    margin: 0;
    font-family: "Poppins", serif;
}
.utama{
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.tabel{
   
}
.table2{
    max-height: 200px;
    overflow-y: auto;
}
</style>
<body class="">
<div class="utama container">
<div class="tabel shadow pt-5 pb-5 ps-5 pe-5 rounded-5">
<h2 class="pb-3">Daftar Mahasiswa</h2>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-4 " data-bs-toggle="modal" data-bs-target="#exampleModal">
  Tambah Data
</button>
<div class="table2">
<table class="border border-secondary-subtle">
    <tr>
        <th>NPM</th>
        <th>Nama Mahasiswa</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>Aksi</th>
    </tr>
    
    <?php if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['npm']}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['kelas']}</td>
                        <td>{$row['jurusan']}</td>
                        <td><a href='hapusmahasiswa.php?npm={$row['npm']}' class='btn btn-danger me-3' onClick='return confirm(\"Yakin Ingin Menghapus?\")'><i class='fa-solid fa-trash-can'></i></a><button class='btn btn-warning btn-edit' data-bs-toggle='modal' data-bs-target='#editform' data-npm='{$row['npm']}'data-nama='{$row['nama']}'data-kelas='{$row['kelas']}'data-jurusan='{$row['jurusan']}'><i class='fa-solid fa-pen-to-square'></i></button></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
        }
        $conn->close();
    ?>
</table>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="mahasiswa.php" method="post">
            <div class="form-group">
            <label for="npm">NPM</label><br>
            <input type="text" class="npm form-control" name="npm" required><br>
            <label for="nama">Nama</label><br>
            <input type="text" class="nama form-control" name="nama" required><br>
            <label for="kelas">Kelas</label><br>
            <input type="text" class="kelas form-control" name="kelas" required><br>
            <label for="jurusan">Jurusan</label><br>
            <input type="text" class="jurusan form-control" name="jurusan" required><br>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="editform" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="update.php" method="post">
                    <input type="hidden" id="edit-npm" name="npm">
                        <div class="mb-3">
                            <label for="edit-nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="edit-nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="edit-kelas" name="kelas" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" id="edit-jurusan" name="jurusan" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/c1808f546b.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $(".btn-edit").click(function () {
        var npm = $(this).data("npm");
        var nama = $(this).data("nama");
        var kelas = $(this).data("kelas");
        var jurusan = $(this).data("jurusan");

        $("#edit-npm").val(npm);
        $("#edit-nama").val(nama);
        $("#edit-kelas").val(kelas);
        $("#edit-jurusan").val(jurusan);
    });
});
</script>
</body>
</html>