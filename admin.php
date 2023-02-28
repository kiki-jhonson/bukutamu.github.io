<!-- panggil header.php -->
<?php include "header.php" ?>

<?php 

//Uji Jika tombol simpan di klik
if(isset ($_POST['simpan'])) {
 $tgl = date('Y-m-d');

//htmlpescialchars agar inputan lebih aman dari injection
 $nama = htmlspecialchars($_POST['nama'],ENT_QUOTES);
 $alamat = htmlspecialchars($_POST['alamat'],ENT_QUOTES);
 $tujuan = htmlspecialchars($_POST['tujuan'],ENT_QUOTES);
 $nope = htmlspecialchars($_POST['nope'],ENT_QUOTES);

 //persiapan query simpan data
 $simpan = mysqli_query($koneksi, "INSERT INTO db_tamu VALUES ('', '$tgl','$nama','$alamat','$tujuan','$nope')");

 //uji jika simpan data sukses
 if($simpan){
  echo "<script>alert('Simpan data sukses, Terima Kasih..!');
  document.location='?'</script>";
 } else echo "<script>alert('Simpan data gagal');
 document.location='?'</script>";

}

?>

    <!-- head -->
    <div class="head text-center">
        <img src="assets/img/Logo Haen outline putih.png" width="100" alt="">
        <h2 class="text-white">Sistem Informasi Buku Tamu <br>Hidayatunnajah</h2>
    </div>
    <!-- end head -->

    <!-- awal row -->
    <div class="row mt-2">
      <!-- col lg-7 -->
      <div class="col-lg-7 mb-3">
        <div class="card shadow bg-gradient-light">
          <!-- card-body -->
          <div class="card-body">
          
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Identitas Pengunjung</h1>
                </div>

                <form class="user" method="POST" action="">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" name="nama" placeholder="nama pengunjung" required>
                  </div>
                
                  <form class="user">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" name="alamat" placeholder="alamat pengunjung" required>
                  </div>

                  <form class="user">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" name="tujuan" placeholder="tujuan pengunjung" required>
                  </div>

                  <form class="user">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" name="nope" placeholder="No.Hp pengunjung" required>
                  </div>


                  <button type="submit" name="simpan" href="login.html" class="btn btn-primary btn-user btn-block" required> 
                    Simpan Data</button>
                  </form>
                <div class="text-center">
                  <a class="small" href="#">By : Kurniawan | 2022 - <?=date('Y')?></a>
                </div>

          </div>
          <!-- end card-body -->
        </div>
      </div>
      <!-- col lg-7 -->


    <!-- col lg-5 -->
    <div class="col-lg-5 mb-3">
      <!-- card -->
            <div class="card shadow">
              <!-- card-body -->
              <div class="card-body">
                <div class="">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Statistik Pengunjung</h1>
                </div>
                <?php 
                    // deklarasi tanggal

                    // menampilkan tanggal sekarang
                    $tgl_sekarang = date('Y-m-d');

                    // menampilkan tanggal kemarin
                    $kemarin = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));

                    // mendapatkan 6 hari sebelum tgl sekarang
                    $seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime($tgl_sekarang)));

                    $sekarang = date('Y-m-d h:i:s');

                    
                    // persiapan querry, tampilkan jumlah data pengunjung
                    $tgl_sekarang = mysqli_fetch_array(mysqli_query($koneksi,
                    "SELECT count(*) FROM db_tamu where tanggal like '%$tgl_sekarang%' 
                    "));

                    $kemarin = mysqli_fetch_array(mysqli_query($koneksi,
                    "SELECT count(*) FROM db_tamu where tanggal like '%$kemarin%'
                    "));

                    $seminggu = mysqli_fetch_array(mysqli_query($koneksi,
                    "SELECT count(*) FROM db_tamu where tanggal BETWEEN '$seminggu' and '$sekarang'
                    "));

                    $bulan_ini = date('m');

                    $sebulan = mysqli_fetch_array(mysqli_query($koneksi,
                    "SELECT count(*) FROM db_tamu where month(tanggal) = '$bulan_ini'
                    "));

                    $keseluruhan = date('m');

                    $keseluruhan = mysqli_fetch_array(mysqli_query($koneksi,
                    "SELECT count(*) FROM db_tamu
                    "));


                ?>
                <table class="table table-bordered">
                  <tr>
                    <td>Hari ini</td>
                    <td> : <?= $tgl_sekarang[0] ?></td>
                  </tr>
                  <tr>
                    <td>Kemarin</td>
                    <td> : <?php echo $kemarin[0] ?></td>
                  </tr>
                  <tr>
                    <td>Pekan ini</td>
                    <td> : <?php echo $seminggu[0] ?></td>
                  </tr>
                  <tr>
                    <td>Bulan ini</td>
                    <td> : <?php echo $sebulan[0] ?></td>
                  </tr>
                  <tr>
                    <td>Keseluruhan</td>
                    <td> : <?php echo $keseluruhan[0] ?></td>
                  </tr>
                </table>
                </div>
              </div>
              <!-- end card-body -->
            </div>
      <!-- end card -->
    </div>
    <!-- end col lg-5 -->

    </div>
    <!-- end row -->
    
<!-- DataTales Example -->
<div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung Hari Ini <?=date('d-m-y')  ?></h6>
              </div>
              <div class="card-body">
                <!-- tombol keluar dan rekapitulasi -->
              <a href="rekapitulasi.php" class="btn btn-success mb-3"><i class="fa fa-table"></i>Rekapitulasi Pengunjung</a>
              <a href="logout.php" class="btn btn-danger mb-3"><i class="fa fa-sign-out-alt"></i>Logout</a>

                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Pengunjung</th>
                        <th>Alamat</th>
                        <th>Tujuan</th>
                        <th>No. HP</th>
                      </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Pengunjung</th>
                        <th>Alamat</th>
                        <th>Tujuan</th>
                        <th>No. HP</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php 
                      $tgl = date('Y-m-d'); //hasinya 2023-02-19 
                      $tampil = mysqli_query($koneksi, "SELECT * FROM db_tamu where tanggal like '%$tgl%' order by id desc");
                      $no =1;
                      
                      while($data = mysqli_fetch_array($tampil)){
                      ?>
                      <tr>
                        <td><?= $no++  ?></td>
                        <td><?= $data['tanggal']?></td>
                        <td><?= $data['nama']?></td>
                        <td><?= $data['alamat']?></td>
                        <td><?= $data['tujuan']?></td>
                        <td><?= $data['nope']?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

<!-- panggil footer.php -->
<?php include "footer.php"; ?>
