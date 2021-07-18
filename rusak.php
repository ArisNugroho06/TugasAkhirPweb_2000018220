<?php
require 'function.php';
include "tanggal.php";
date_default_timezone_set("ASIA/JAKARTA");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Alat Rusak</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Laboratorium Informatika</div>
            </a>

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Alat</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="masuk.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Alat Baru</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="rusak.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Alat Rusak</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Kelola admin</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="logout.php">
                    <i></i>
                    <span> &nbsp; &nbsp;Logout</span></a>
            </li>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>Aris Afrianto Nugroho</strong></p>
                <a class="btn btn-success btn-sm">2000018220</a>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <br>
                    <h1 class="h3 mb-2 text-gray-800">Alat Rusak</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- Button to Open the Modal -->
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Alat Rusak
                              </button>    
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Barang</th>
                                            <th>Kondisi</th>
                                            <th>Quantiry</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ambilsemuadatajumlah = mysqli_query($conn,"select * from keluar k, jumlah s where s.idalat = k.idalat");
                                        while($data=mysqli_fetch_array($ambilsemuadatajumlah)){
                                            $idk = $data['idkeluar'];
                                            $idb = $data['idalat'];
                                            $tanggal = $data['tanggal'];
                                            $namaalat = $data['namaalat'];
                                            $kondisi = $data['kondisi'];
                                            $qty = $data['qty'];
                                        ?>
                                        <tr>
                                            <td><?=tgl_indonesia($tanggal)?></td>
                                            <td><?=$namaalat;?></td>
                                            <td><?=$kondisi;?></td>
                                            <td><?=$qty;?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idk;?>">
                                                Edit
                                                </button>  
                                                <input type="hidden" name="idalatyangmaudihapus" value="<?=$idb;?>">
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idk;?>">
                                                Delete
                                                </button>
                                            </td>
                                        </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?=$idk;?>">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                  
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                      <h4 class="modal-title">Edit Alat Rusak</h4>
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                      <input type="text" name="kondisi" value="<?=$kondisi;?>" class="form-control" required>
                                                      <br>
                                                      <input type="number" name="qty" value="<?=$qty;?>" class="form-control" required>
                                                      <br>
                                                      <input type="hidden" name="idb" value="<?=$idb;?>">
                                                      <input type="hidden" name="idk" value="<?=$idk;?>">
                                                      <button type="submit" class="btn btn-primary" name="updatealatrusak">Edit</button>
                                                    </div>
                                                    </form>
                                                  </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="delete<?=$idk;?>">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                  
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                      <h4 class="modal-title">Delete Alat Masuk</h4>
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                      Apakah anda yakin ingin menghapus <?=$namaalat;?>?
                                                      <input type="hidden" name="idb" value="<?=$idb;?>">
                                                      <input type="hidden" name="kty" value="<?=$qty;?>">
                                                      <input type="hidden" name="idk" value="<?=$idk;?>">
                                                      <br>
                                                      <br>
                                                      <button type="submit" class="btn btn-primary" name="hapusalatrusak">Delete</button>
                                                    </div>
                                                    </form>
                                                  </div>
                                                </div>
                                            </div>

                                        <?php
                                            }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

        <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Alat Rusak</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
        <div class="modal-body">

        <select name="alatnya" class="form-control">
            <?php
                $ambilsemuadatanya = mysqli_query($conn,"select * from jumlah");
                while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                    $namaalatnya = $fetcharray['namaalat'];
                    $idalatnya = $fetcharray['idalat'];    
            ?>

            <option value="<?=$idalatnya;?>"><?=$namaalatnya;?></option>

            <?php
                }
            ?>
        </select>

          <br>
          <input type="number" name="qty" placeholder="Quantity..." class="form-control" required>
          <br>
          <input type="text" name="keterangan" placeholder="Keterangan..." class="form-control" required>
          <br>
          <button type="submit" class="btn btn-primary" name="addalatrusak">Submit</button>
        </div>
        </form>


</html>