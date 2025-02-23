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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</head>
<body>
<h2>Daftar Mahasiswa</h2>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Tambah Data
</button>

<table>
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
                        <td><a href='hapusmahasiswa.php?npm={$row['npm']}' class='btn btn-danger' onClick='return confirm(\"Yakin Ingin Menghapus?\")'>Hapus</a></td>
                        <td><button class='btn btn-warning btn-edit' data-bs-toggle='modal' data-bs-target='#editform' data-npm='{$row['npm']}'data-nama='{$row['nama']}'data-kelas='{$row['kelas']}'data-jurusan='{$row['jurusan']}'>Edit</button></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
        }
        $conn->close();
    ?>
</table>
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