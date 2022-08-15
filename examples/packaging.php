
<?php
require 'function.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            .custom-text-blue{
                color: #585858
            }
            .custom-text-blue:hover{
                color:0084B6;
            }
        </style>

             <style>
            .custom-text-green{
                color: #D4EDDA
            }
            .custom-text-green:hover{
                color:0084B6;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">PT.Astra Juoku Indonesia</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        
       </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion" style="border: solid 2px #f5f5f5"  id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                    
                            <a class="nav-link custom-text-blue" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stock WHSPT
                            </a>
                            <a class="nav-link custom-text-blue" href="pulling.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Pulling
                            </a>
                            <a class="nav-link custom-text-blue" href="delivery.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Delivery
                            </a>
                               <a class="nav-link custom-text-blue" href="webgl_loader_gltf_sheen.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Live View
                            </a>
                               <a class="nav-link custom-text-blue" href="packaging.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Packaging
                            </a>
                             <a class="nav-link custom-text-blue" href="Logout.php">
                                Logout
                            </a>

                        </div>
                    </div>
            
                </nav>
            </div>
			<div id="layoutSidenav_content">
			                <main>
			                    <div class="container-fluid">
			                        <h1 class="mt-4">PACKAGING</h1>
			                        
			                        <div class="card mb-4">
			                            <div class="card-header">
			                                  <!-- Button to Open the Modal -->
			                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
			                             Tambah Part Keluar
			                       </button>
			                         </button>
                          <a href="export.php" class="btn btn-info">Export Data</a>

                        </div>
                           
			                       
			                        <div class="card mb-4">
			                            <div class="card-header">
			                                <i class="fas fa-table mr-1"></i>
			                                DataTable Delivery
			                            </div>
			                            <div class="card-body">
			                                <div class="table-responsive">
			                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			                                        <thead>
			                                            <tr>
			                                                <th>Tanggal</th>
			                                                <th>Nama Barang</th>
			                                                <th>Jumlah</th>
			                                                <th>Customer</th>
			                                                <th>Aksi</th>
                                                       </tr>
			                                        </thead>
			                                        <tbody>
			                                             <?php


			                                            $ambilsemuadatastock = mysqli_query($conn,"select * from delivery k, stock s where s.idpart = k.idpart");
			                                            while($data=mysqli_fetch_array($ambilsemuadatastock)){
			                                                $idk = $data['iddelivery'];
			                                                $idb = $data['idpart'];
			                                                $tanggal = $data['tanggal'];
			                                                $namapart = $data['namapart'];
			                                                $qty = $data['qty'];
			                                                $customer = $data['customer'];

                                            ?>
                                            <tr>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$namapart;?></td>
                                                <td><?=$qty;?></td>
                                                <td><?=$customer;?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idk;?>">
                                                            Edit
                                                    </button>
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
                                                        <h4 class="modal-title">Edit Barang</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                            
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                        <div class="modal-body">
                                                        <input type="text" name="customer" value="<?=$customer;?>" class="form-control" required>
                                                        <br>    
                                                        <input type="number" name="qty" value="<?=$qty;?>" class="form-control" required>
                                                        <br>    
                                                        <input type="hidden" name="idb" value="<?=$idb;?>">
                                                        <input type="hidden" name="idk" value="<?=$idk;?>">
                                                        <button type="submit" class="btn btn-primary" name="updatebarangkeluar">Sumbit</button>
                                                        </div>
                                                        </form>
                                                            
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete<?=$idk;?>">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                        <h4 class="modal-title">Hapus barang?</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                            
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                        <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus <?=$namapart;?>?
                                                        <input type="hidden" name="idb" value="<?=$idb;?>">
                                                        <input type="hidden" name="kty" value="<?=$qty;?>">
                                                        <input type="hidden" name="idk" value="<?=$idk;?>"> 
                                                        <br>  
                                                        <br>
                                                        <button type="submit" class="btn btn-danger" name="hapusbarangkeluar">Hapus</button>
                                                        </div>
                                                        </form>
                                                            
                                                    </div>
                                                    </div>
                                                </div>

                                            <?php
                                            };
                                            
                                            ?>

			                                        </tbody>
			                                    </table>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                </main>
			                
			            </div>
			        </div>
			        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
			        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
			        <script src="js/scripts.js"></script>
			        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
			        <script src="assets/demo/chart-area-demo.js"></script>
			        <script src="assets/demo/chart-bar-demo.js"></script>
			        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
			        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
			        <script src="assets/demo/datatables-demo.js"></script>
			    </body>
			          <!-- The Modal -->
			      <div class="modal fade" id="myModal">
			        <div class="modal-dialog">
			          <div class="modal-content">
			          
			            <!-- Modal Header -->
			            <div class="modal-header">
			              <h4 class="modal-title">Tambah Part</h4>
			              <button type="button" class="close" data-dismiss="modal">&times;</button>
			            </div>
			            
			            <!-- Modal body -->
			            <form method="post">
			            <div class="modal-body">
			        	<select name="barangnya" class="form-control">
			        		<?php
			        			$ambilsemuadatanya = mysqli_query($conn,"select * from stock");
			        			while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
			        				$namabarangnya = $fetcharray['namapart'];
			        				$idbarangnya = $fetcharray['idpart'];
			        		?>
			        		
			        		<option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>

			        		<?php		
			        			}
			        		?>
			        	</select>
			        	 <br>
            			<input type="number" name="qty" placeholder="Quantity" class="form-control" required>	
			            <br>
			            <input type="text" name="customer" placeholder="Customer" class="form-control" required>
			            <br>
			            <button type="submit" class="btn btn-primary" name="barangkeluar">Submit</button>
			            </div>
			            </form>
			            <!-- Modal footer -->
			          
			            
			          </div>
			          </div>
			      </div>
			</html>
