<?php
session_start();


$conn = mysqli_connect("localhost","root","","stockwhspt");

if(isset($_POST['addnewpart'])){
	$namapart = $_POST['namapart'];
	$deskripsi = $_POST['deskripsi'];
	$stock = $_POST['stock'];

	$addtotable = mysqli_query($conn, "insert into stock (namapart, deskripsi, stock) values('$namapart','$deskripsi','$stock')");
	if($addtotable){
		header('location:index.php');
	} else {
		echo 'Gagal';
		header('location:index.php');
	}


};



if(isset($_POST['barangmasuk'])){
	$barangnya = $_POST['barangnya'];
	$penerima = $_POST['penerima'];
	$qty = $_POST['qty'];

	$cekstocksekarang = mysqli_query($conn,"select * from stock where idpart ='$barangnya'");
	$ambildatanya = mysqli_fetch_array($cekstocksekarang);

	$stocksekarang = $ambildatanya['stock'];
	$tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;


	$addtopulling = mysqli_query($conn,"insert into pulling (idpart, keterangan, qty) values('$barangnya','$penerima','$qty')");
	$updatestockmasuk = mysqli_query($conn,"update stock set stock='$tambahkanstocksekarangdenganquantity' where idpart='$barangnya'");
	if($addtopulling&&$updatestockmasuk){
		header('location:pulling.php');	
	} else {
		echo 'Gagal';
		header('location:pulling.php');
	}
}

if(isset($_POST['barangkeluar'])){
	$barangnya = $_POST['barangnya'];
	$penerima = $_POST['customer'];
	$qty = $_POST['qty'];

	$cekstocksekarang = mysqli_query($conn,"select * from stock where idpart ='$barangnya'");
	$ambildatanya = mysqli_fetch_array($cekstocksekarang);

	$stocksekarang = $ambildatanya['stock'];
	$tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;


	$addtopulling = mysqli_query($conn,"insert into delivery (idpart, customer, qty) values('$barangnya','$penerima','$qty')");
	$updatestockmasuk = mysqli_query($conn,"update stock set stock='$tambahkanstocksekarangdenganquantity' where idpart='$barangnya'");
	if($addtopulling&&$updatestockmasuk){
		header('location:delivery.php');	
	} else {
		echo 'Gagal';
		header('location:delivery.php');
	}
}


//Update info barang
if(isset($_POST['updatebarang'])){
    $idb = $_POST['idb'];
    $namapart = $_POST['namapart'];
    $deskripsi = $_POST['deskripsi'];

    $update= mysqli_query($conn,"update stock set namapart='$namapart', deskripsi='$deskripsi' where idpart ='$idb'");
    if($update){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header ('location:index.php');
    }
}


if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb'];

    $hapus = mysqli_query($conn, "delete from stock where idpart='$idb'");
    if($hapus){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
};

//Mengubah data barang masuk
if(isset($_POST['updatebarangmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $deskripsi = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn,"select * from stock where idpart='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrng = $stocknya['stock'];

    $qtyskrng = mysqli_query($conn, "select * from pulling where idpulling='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrng);
    $qtyskrng = $qtynya['qty'];

    if($qty>$qtyskrng){
        $selisih = $qty-$qtyskrng;
        $kurangin = $stockskrng + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idpart='$idb'");
        $updatenya = mysqli_query($conn,"update pulling set qty='$qty', keterangan='$deskripsi' where idpulling'$idm'"); 
            if($kurangistocknya&&$updatenya){
                header('location:masuk.php');
            } else {
                echo 'Gagal';
                header('location:masuk.php');
            }
    } else {
        $selisih = $qtyskrng-$qty;
        $kurangin = $stockskrng - $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idpart='$idb'");
        $updatenya = mysqli_query($conn,"update pulling set qty='$qty', keterangan='$deskripsi' where idpulling='$idm'");
            if($kurangistocknya&&$updatenya){
                header('location:pulling.php');
                } else {
                    echo 'Gagal';
                    header('location:pulling.php');
                }
    }
}


//Menghapus barang masuk
	if(isset($_POST['hapusbarangmasuk'])){
	    $idb = $_POST['idb'];
	    $qty = $_POST['kty'];
	    $idm = $_POST['idm'];

	    $getdatastock = mysqli_query($conn,"select * from stock where idpart='$idb'");
	    $data = mysqli_fetch_array($getdatastock);
	    $stok = $data['stock'];

	    $selisih = $stok-$qty;

	    $update = mysqli_query($conn,"update stock set stock='$selisih' where idpart='$idb'");
	    $hapusdata = mysqli_query($conn,"delete from pulling where idpulling='$idm'");

	    if($update&&$hapusdata){
	        header('location:pulling.php');
	    } else {
	        header('location:pulling.php');
	    }

	}

	//Mengubah data barang keluar
	//Mengubah data barang masuk
if(isset($_POST['updatebarangkeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $customer = $_POST['customer'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn,"select * from stock where idpart='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrng = $stocknya['stock'];

    $qtyskrng = mysqli_query($conn, "select * from delivery where iddelivery='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrng);
    $qtyskrng = $qtynya['qty'];

    if($qty>$qtyskrng){
        $selisih = $qty-$qtyskrng;
        $kurangin = $stockskrng + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idpart='$idb'");
        $updatenya = mysqli_query($conn,"update delivery set qty='$qty', customer='$customer' where iddelivery'$idk'"); 
            if($kurangistocknya&&$updatenya){
                header('location:delivery.php');
            } else {
                echo 'Gagal';
                header('location:delivery.php');
            }
    } else {
        $selisih = $qtyskrng-$qty;
        $kurangin = $stockskrng - $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idpart='$idb'");
        $updatenya = mysqli_query($conn,"update delivery set qty='$qty', customer='$customer' where iddelivery='$idk'");
            if($kurangistocknya&&$updatenya){
                header('location:delivery.php');
                } else {
                    echo 'Gagal';
                    header('location:delivery.php');
                }
    }
}


//Menghapus barang masuk
	if(isset($_POST['hapusbarangkeluar'])){
	    $idb = $_POST['idb'];
	    $qty = $_POST['kty'];
	    $idk = $_POST['idk'];

	    $getdatastock = mysqli_query($conn,"select * from stock where idpart='$idb'");
	    $data = mysqli_fetch_array($getdatastock);
	    $stok = $data['stock'];

	    $selisih = $stok-$qty;

	    $update = mysqli_query($conn,"update stock set stock='$selisih' where idpart='$idb'");
	    $hapusdata = mysqli_query($conn,"delete from delivery where iddelivery='$idk'");

	    if($update&&$hapusdata){
	        header('location:delivery.php');
	    } else {
	        header('location:delivery.php');
	    }

	};

	//Mengubah data barang keluar

?>