<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login/login_page.php");
    exit();
}

include 'config.php';


$search = isset($_GET['search']) ? $_GET['search'] : '';


$sql = "SELECT * FROM datamahasiswa 
        WHERE nama LIKE ? OR npm LIKE ?
        ORDER BY kelas ASC, nama ASC";  

$stmt = $conn->prepare($sql);
$searchParam = "%$search%";
$stmt->bind_param("ss", $searchParam, $searchParam);
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body class="">
<div class="utama container">
    <div>
    <h3 class="slmt mb-4 fs-2">Selamat Datang, <?php echo $_SESSION['username']; ?>!</h3>
<div class="tabel shadow pt-4 pb-5 ps-5 pe-5 rounded-5">
    <div class="d-flex justify-content-between">
<h2 class="pb-3 fs-3">Daftar Mahasiswa</h2>
<a href="logout.php" class="btn btn-danger ms-5 mb-4">Logout  <i class="fa-solid fa-right-from-bracket"></i></a>
</div>
<!-- Button trigger modal -->
 <div class="d-flex justify-content-between">
<button type="button" class="btn btn-primary mb-4 " data-bs-toggle="modal" data-bs-target="#exampleModal">
  Tambah Data
</button>
<div class="input-group mb-3">
    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
    <input type="text" id="searchInput" class="cari form-control" placeholder="Cari...">
</div>
</div>
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
<script>
document.getElementById("searchInput").addEventListener("keyup", function () {
    var input = this.value.toLowerCase(); // Ambil nilai input & ubah jadi huruf kecil
    var table = document.querySelector("table"); // Ambil tabel
    var rows = table.getElementsByTagName("tr"); // Ambil semua baris

    for (var i = 1; i < rows.length; i++) { // Looping mulai dari baris kedua (skip header)
        var cells = rows[i].getElementsByTagName("td"); // Ambil semua kolom
        var found = false;

        for (var j = 0; j < cells.length; j++) { // Looping tiap kolom
            if (cells[j].innerText.toLowerCase().includes(input)) {
                found = true;
                break; // Stop jika ada yang cocok
            }
        }
        
        rows[i].style.display = found ? "" : "none"; // Sembunyikan jika tidak cocok
    }
});
</script>

</body>
</html>