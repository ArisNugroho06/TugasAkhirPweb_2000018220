<?php
 
	//membuat koneksi ke databse
	$conn = mysqli_connect("localhost","root","","alatlab");

	//menambah alat baru
	if(isset($_POST['addnewalat'])){
		$namaalat = $_POST['namaalat'];
		$deskripsi = $_POST['deskripsi'];
		$jumlah = $_POST['jumlah'];

		$addtotable = mysqli_query($conn,"insert into jumlah (namaalat, deskripsi, jumlah) values('$namaalat','$deskripsi','$jumlah')");
		if($addtotable){
			header('location:index.php');
		} else {
			echo 'Gagal';
			header('location:index.php');
		}
	}

	//menambah alat baru
	if(isset($_POST['addnewmasuk'])){
		$alatnya = $_POST['alatnya'];
		$lab = $_POST['lab'];
		$qty = $_POST['qty'];

		$cekjumlahsekarang = mysqli_query($conn,"select * from jumlah where idalat ='$alatnya'");
		$ambildatanya = mysqli_fetch_array($cekjumlahsekarang);

		$jumlahsekarang = $ambildatanya['jumlah'];
		$tambahkanjumlahsekarangdenganquantity = $jumlahsekarang+$qty;

		$addtomasuk = mysqli_query($conn,"insert into masuk (idalat, keterangan, qty) values('$alatnya','$lab','$qty')");
		$updatejumlahmasuk = mysqli_query($conn,"update jumlah set jumlah='$tambahkanjumlahsekarangdenganquantity' where idalat='$alatnya'");

	if($addtomasuk&&$updatejumlahmasuk){
			header('location:masuk.php');
		} else {
			echo 'Gagal';
			header('location:masuk.php');
		}
	}

	//menambah alat rusak
	if(isset($_POST['addalatrusak'])){
		$alatnya = $_POST['alatnya'];
		$keterangan = $_POST['keterangan'];
		$qty = $_POST['qty'];

		$cekjumlahsekarang = mysqli_query($conn,"select * from jumlah where idalat ='$alatnya'");
		$ambildatanya = mysqli_fetch_array($cekjumlahsekarang);

		$jumlahsekarang = $ambildatanya['jumlah'];
		$tambahkanjumlahsekarangdenganquantity = $jumlahsekarang-$qty;

		$addtorusak = mysqli_query($conn,"insert into keluar (idalat, kondisi, qty) values('$alatnya','$keterangan','$qty')");
		$updatejumlahmasuk = mysqli_query($conn,"update jumlah set jumlah='$tambahkanjumlahsekarangdenganquantity' where idalat='$alatnya'");

	if($addtorusak&&$updatejumlahmasuk){
			header('location:rusak.php');
		} else {
			echo 'Gagal';
			header('location:rusak.php');
		}
	}

	//update alat
	if(isset($_POST['updatealat'])){
		$idb = $_POST['idb'];
		$namaalat = $_POST['namaalat'];
		$deskripsi = $_POST['deskripsi'];

		$update = mysqli_query($conn,"update jumlah set namaalat='$namaalat', deskripsi='$deskripsi' where idalat ='$idb'");
		if($update){
			header('location:index.php');
		} else {
			echo 'Gagal';
			header('location:index.php');
		}
	}

	//hapus alat dari tabel jumlah
	if(isset($_POST['hapusalat'])){
		$idb = $_POST['idb'];

		$hapus = mysqli_query($conn,"delete from jumlah where idalat='$idb'");
		if($hapus){
			header('location:index.php');
		} else {
			echo 'Gagal';
			header('location:index.php');
		}
	}


	//mengubah alat masuk
	if(isset($_POST['updatealatmasuk'])){
		$idb = $_POST['idb'];
		$idm = $_POST['idm'];
		$keterangan = $_POST['keterangan'];
		$qty = $_POST['qty'];

		$lihatjumlah = mysqli_query($conn,"select * from jumlah where idalat='$idb'");
		$jumlahnya = mysqli_fetch_array($lihatjumlah);
		$jumlahsekarang = $jumlahnya['jumlah'];

		$qtysekarang = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
		$qtynya = mysqli_fetch_array($qtysekarang);
		$qtysekarang = $qtynya['qty'];

		if($qty > $qtysekarang){
			$selisih = $qty-$qtysekarang;
			$kurangin = $jumlahsekarang+$selisih;
			$kurangijumlahnya = mysqli_query($conn, "update jumlah set jumlah='$kurangin' where idalat='$idb'");
			$updatenya = mysqli_query($conn,"update masuk set qty='$qty', keterangan='$keterangan' where idmasuk='$idm'");
				if($kurangijumlahnya&&$updatenya){
					header('location:masuk.php');
				} else {
					echo 'Gagal';
					header('location:masuk.php');
				}
		} else {
			$selisih = $qtysekarang-$qty;
			$kurangin = $jumlahsekarang - $selisih;
			$kurangijumlahnya = mysqli_query($conn,"update jumlah set jumlah='$kurangin' where idalat='$idb'");
			$updatenya = mysqli_query($conn,"update masuk set qty='$qty', keterangan='$keterangan' where idmasuk='$idm'");
			if($kurangijumlahnya&&$updatenya){
				header('location:masuk.php');
			} else {
				echo 'Gagal';
				header('location:masuk.php');
			}
		}
	}

	//menghapus alat masuk
	if(isset($_POST['hapusalatmasuk'])){
		$idb = $_POST['idb'];
		$qty = $_POST['kty'];
		$idm = $_POST['idm'];

		$getdatajumlah = mysqli_query($conn,"select * from jumlah where idalat='$idb'");
		$data = mysqli_fetch_array($getdatajumlah);
		$jum = $data['jumlah'];

		$selisih = $jum-$qty;

		$update = mysqli_query($conn,"update jumlah set jumlah='$selisih' where idalat='$idb'");
		$hapusdata = mysqli_query($conn,"delete from masuk where idmasuk='$idm'");

		if($update&&$hapusdata){
			header('location:masuk.php');
		} else {
			echo 'Gagal';
			header('location:masuk.php');
		}

	}


	//mengubah alat rusak
	if(isset($_POST['updatealatrusak'])){
		$idb = $_POST['idb'];
		$idk = $_POST['idk'];
		$kondisi = $_POST['kondisi'];
		$qty = $_POST['qty'];

		$lihatjumlah = mysqli_query($conn,"select * from jumlah where idalat='$idb'");
		$jumlahnya = mysqli_fetch_array($lihatjumlah);
		$jumlahsekarang = $jumlahnya['jumlah'];

		$qtysekarang = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
		$qtynya = mysqli_fetch_array($qtysekarang);
		$qtysekarang = $qtynya['qty'];

		if($qty > $qtysekarang){
			$selisih = $qty-$qtysekarang;
			$kurangin = $jumlahsekarang-$selisih;
			$kurangijumlahnya = mysqli_query($conn, "update jumlah set jumlah='$kurangin' where idalat='$idb'");
			$updatenya = mysqli_query($conn,"update keluar set qty='$qty', kondisi='$kondisi' where idkeluar='$idk'");
				if($kurangijumlahnya&&$updatenya){
					header('location:rusak.php');
				} else {
					echo 'Gagal';
					header('location:rusak.php');
				}
		} else {
			$selisih = $qtysekarang-$qty;
			$kurangin = $jumlahsekarang + $selisih;
			$kurangijumlahnya = mysqli_query($conn,"update jumlah set jumlah='$kurangin' where idalat='$idb'");
			$updatenya = mysqli_query($conn,"update keluar set qty='$qty', kondisi='$kondisi' where idkeluar='$idk'");
			if($kurangijumlahnya&&$updatenya){
				header('location:rusak.php');
			} else {
				echo 'Gagal';
				header('location:rusak.php');
			}
		}
	}

	//menghapus alat rusak
	if(isset($_POST['hapusalatrusak'])){
		$idb = $_POST['idb'];
		$qty = $_POST['kty'];
		$idk = $_POST['idk'];

		$getdatajumlah = mysqli_query($conn,"select * from jumlah where idalat='$idb'");
		$data = mysqli_fetch_array($getdatajumlah);
		$jum = $data['jumlah'];

		$selisih = $jum+$qty;

		$update = mysqli_query($conn,"update jumlah set jumlah='$selisih' where idalat='$idb'");
		$hapusdata = mysqli_query($conn,"delete from keluar where idkeluar='$idk'");

		if($update&&$hapusdata){
			header('location:rusak.php');
		} else {
			echo 'Gagal';
			header('location:rusak.php');
		}

	}


	//menembah admin baru
	if(isset($_POST['addadmin'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		$queryinsert = mysqli_query($conn, "insert into login(email, password) values ('$email','$password')");

		if($queryinsert){
			header('location:admin.php');
		} else {
			header('location:admin.php');
		}
	}



	//edit data admin
	if(isset($_POST['updateadmin'])){
		$newemail = $_POST['emailadmin'];
		$newpassword = $_POST['newpass'];
		$idnya = $_POST['iduser'];

		$queryupdate = mysqli_query($conn,"update login set email='$newemail', password='$newpassword' where iduser='$idnya'");

		if($queryupdate){
			header('location:admin.php');
		} else {
			header('location:admin.php');
		}

	}

	//hapus admin
	if(isset($_POST['hapusadmin'])){
		$id = $_POST['iduser'];


	$querydelete = mysqli_query($conn,"delete from login where iduser='$id'");
	if($querydelete){
			header('location:admin.php');
		} else {
			header('location:admin.php');
		}
	}

?>