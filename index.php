<?php
  include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Daftar Buku</title>
    <style type="text/css">
      * {
        font-family: "Trebuchet MS";
      }
      h1 {
        position: relative;
        left: 24
        text-transform: uppercase;
        color: Black;
      }
    table {
      border: solid 1px #C0C0C0;
      border-collapse: collapse;
      border-spacing: 0;
      width: 70%;
      margin: 10px auto 10px auto;
    }
    table thead th {
        background-color: #A9A9A9;
        border: solid 1px #C0C0C0;
        color: #6495ED;
        padding: 10px;
        text-align: left;
        text-shadow: 1px 1px 1px #fff;
        text-decoration: none;
    }
    table tbody td {
        border: solid 1px #C0C0C0;
        color: #333;
        padding: 10px;
        text-shadow: 1px 1px 1px #fff;
    }

    .tambah{
      position: relative;
      right : 420px;
      color : #FFFAF0;
      background-color : 	#00BFFF
    }

    .edit{
      background-color : green
    }

    .delete{
      background-color : red
    }

    .tabel{
      background-color : #FFDEAD
    }

    .tabel2{
      background-color : #FFFACD
    }


    </style>
  </head>

  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!-- Bootstrap -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
      <!-- Bootstrap Icons -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
      <!-- Data Tables -->
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
      <!-- Font Google -->
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
      <!-- Own CSS -->
      <link rel="stylesheet" href="css/style.css">

      <title>CRUD Data Buku</title>
  </head>

  <body>
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
          <div class="container">
              <a class="navbar-brand" href="index.php">CRUD Data Buku</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav ms-auto">
                      <li class="nav-item">
                          <a class="nav-link" aria-current="page" href="index.php">Home</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#about">About</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="logout.php">Logout</a>
                      </li>
                  </ul>
              </div>
          </div>
      </nav>
      <!-- Close Navbar -->

    <!-- Container -->
    <div class="container">
      <div class="row my-2">
        <div class="col-md">
          <h3 class="text-center fw-bold text-uppercase">Daftar Buku</h3>
        </div>
      </div>
      <div class="row my-2">
        <div class="col-md">
          <a href="tambah_produk.php" class="btn btn-primary"><i class="bi bi-person-plus-fill"></i>&nbsp;Tambah Data</a>
        </div>
      </div>
      <table class="table table-striped table-responsive table-hover text-center" style="width:100%">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Gambar Buku</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
          $query = "SELECT * FROM buku ORDER BY id ASC";
          $result = mysqli_query($koneksi, $query);
          //mengecek apakah ada error ketika menjalankan query
          if(!$result){
            die ("Query Error: ".mysqli_errno($koneksi).
              " - ".mysqli_error($koneksi));
          }

          //buat perulangan untuk element tabel dari data buku
          $no = 1; //variabel untuk membuat nomor urut
          // hasil query akan disimpan dalam variabel $data dalam bentuk array
          // kemudian dicetak dengan perulangan while
          while($row = mysqli_fetch_assoc($result))
          {
          ?>
          <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $row['judul']; ?></td>
              <td><?php echo substr($row['pengarang'], 0, 20); ?></td>
              <td><?php echo substr($row['penerbit'],0, 20); ?></td>
              <td><?php echo $row['tahun']; ?></td>
              <td style="text-align: center;"><img src="../gambar<?php echo $row['gambar']; ?>" style="width: 120px;"></td>
              <td>
                  <a href="edit_produk.php?id=<?php echo $row['id']; ?>" class="edit">Edit</a> 
                  <a href="proses_hapus.php?id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
              </td>
            </tr>
            
          <?php
            $no++; //untuk nomor urut terus bertambah 1
          }
          ?>
        </tbody>
      </table>
    </div>
    <!-- Close Container -->

    <!-- Footer -->
    <div class="container-fluid">
        <div class="row bg-dark text-white">
            <div class="col-md-6 my-2" id="about">
                <h4 class="fw-bold text-uppercase">About</h4>
                <p>Daffa Abhi Nandarifka</p>
                <p>13</p>
                <p>XII RPL 2</p>
            </div>
            <div class="col-md-6 my-2 text-center link">
                <h4 class="fw-bold text-uppercase">Account Links</h4>
                <a href="https://www.facebook.com/profile.php?id=100009427584197" target="_blank"><i class="bi bi-facebook fs-3"></i></a>
                <a href="https://github.com/daffaabhi" target="_blank"><i class="bi bi-github fs-3"></i></a>
                <a href="https://www.instagram.com/daffaabhi24/" target="_blank"><i class="bi bi-instagram fs-3"></i></a>
                <a href="https://twitter.com/996Abhi" target="_blank"><i class="bi bi-twitter fs-3"></i></a>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-white text-center" style="padding: 5px;">
        <p>Created with <i style="color: red;"></i> by <u style="color: #fff;">Daffa Abhi</u></p>
    </footer>
    <!-- Close Footer -->

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Data Tables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
  </body>
</html>