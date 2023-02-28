<?php include "header.php" ?>
<!-- awal row -->
<div class="row">
    <!-- awal col md-12 -->
        <div class="col-md-12">
    <!-- awal card -->
        <div class="card shadow mb-3">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Pengunjung</h6>
              </div>
              <div class="card-body">
                <form method="POST" action="" class="text-center">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                        <div class="form-grub">
                            <label for="">Dari Tanggal</label>
                            <input class="from-control" type="date" name="tanggal1" value="<?= isset($_POST['tanggal1']) ? $_POST['tanggal1'] : date('Y-m-d') ?>" required>
                        </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-grub">
                            <label for="">Sampai Tanggal</label>
                            <input class="from-control" type="date" name="tanggal2" value="<?= isset($_POST['tanggal2']) ? $_POST['tanggal2'] : date('Y-m-d') ?>" required>
                        </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4"></div>
                            <div class="col-md-2">
                            <button class="btn btn-primary from-control" 
                            name="btampilkan"><i class="fa fa-search"></i> Tampilkan
                        </button> 
                        </div>
                        <div class="col-md-2">
                            <a href="admin.php" class="btn btn-danger from-control"><i class="fa fa-backward"></i> Kembali</a> 
                        </div> 
                    </div>
                </form>

                <?php 
                if(isset($_POST['btampilkan'])) : 
                
                ?>
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

                    $tgl1 = $_POST['tanggal1'];
                    $tgl2 = $_POST['tanggal2'];


                    $tampil = mysqli_query($koneksi, "SELECT * FROM db_tamu where tanggal BETWEEN '$tgl1' and '$tgl2' order by id desc");
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
                    <center>
                      <form method="POST" action="exportexcel.php">
                        <div class="col-md-4">
                          <!-- menyesuaikan dengan tanggal yang kita pilih diatas -->
                        <input type="hidden" name="tanggal_a" value="<?=@$_POST['tanggal1']?>">
                        <input type="hidden" name="tanggal_b" value="<?=@$_POST['tanggal2']?>">

                        <button class="btn btn-success form-control" name="bexport"> <i class="fa fa-download"></i> Export Data Exel</button>
                        </div>
                      </form>
                    </center>
                </div>

                <?php endif ?>

             </div>
        </div>
    <!-- akhir card -->
        </div>
    <!-- akhir col md-12 -->
    </div>
<!-- akhir row -->

<?php include "footer.php" ?>