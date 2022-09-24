<?php  
// koneksi ke database
$conn = mysqli_connect('localhost','root','','dbrsp');

// baca table akun pada database latihan
function query($query){
	global $conn;
	$rows = [];
	$result = mysqli_query($conn, $query);
	while ( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	
	return $rows;
}

// menambah user baru
function registrasi($data){
	global $conn;

	$username = htmlspecialchars($data['username']);
	$email = htmlspecialchars($data['email']);
	$password1 = htmlspecialchars($data['password1']);
	$password2 = htmlspecialchars($data['password2']);

	// buat table akun_user
	$table_user = "CREATE TABLE akun_user(
				id INT(10) AUTO_INCREMENT PRIMARY KEY,
				username VARCHAR(50) NOT NULL,
				email VARCHAR(50) NOT NULL,
				password VARCHAR(255) NOT NULL
				)";

	mysqli_query($conn, $table_user);

	// cek ketersediaan username
	$query = mysqli_query($conn, "SELECT username FROM akun_user WHERE username = '$username'");

	if ( mysqli_fetch_assoc($query) ) {
		return 0;
	}

	// cek ketersediaan email
	$query = mysqli_query($conn, "SELECT username FROM akun_user WHERE email = '$email'");

	if ( mysqli_fetch_assoc($query) ) {
		return 0;
	}

	// cek kesesuaian password
	if ( $password1 !== $password2 ) {
		return -1;
	}

	// enkripsi password
	$password = password_hash($password1, PASSWORD_DEFAULT);

	// tmabhakan user baru
	mysqli_query($conn, "INSERT INTO akun_user VALUES('', '$username', '$email', '$password')");
	
	return mysqli_affected_rows($conn);
}

function create_data_user($username){
	global $conn;

	// buat table untuk data user
	$table_data = "CREATE TABLE data_$username(
				id INT(10) AUTO_INCREMENT PRIMARY KEY,
				photo VARCHAR(100) NOT NULL,
				play INT(10) NOT NULL,
				win INT(10) NOT NULL,
				lose INT(10) NOT NULL,
				percent VARCHAR(10) NOT NULL
				)";

	mysqli_query($conn, $table_data);

	mysqli_query($conn, "INSERT INTO data_$username VALUES('1', 'user-circle-solid.svg', '0', '0', '0', '0')");
}

function create_his_user($username){
	global $conn;

	// buat table untuk history user
	$table_data = "CREATE TABLE his_$username(
				id INT(10) AUTO_INCREMENT PRIMARY KEY,
				result VARCHAR(10) NOT NULL,
				score_user INT(10) NOT NULL,
				score_comp INT(10) NOT NULL,
				dates VARCHAR(20) NOT NULL
				)";

	mysqli_query($conn, $table_data);
}

function upload($username){
	global $conn;

	$name = $_FILES['gambar']['name'];
	$type = $_FILES['gambar']['type'];
	$tmp_name = $_FILES['gambar']['tmp_name'];
	$error = $_FILES['gambar']['error'];
	$size = $_FILES['gambar']['size'];

	// cek apakah gambar di upload
	if ( $error === 4 ) {
		return false;
	}

	// cek ekstensi file
	$ekstensiValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $name);
	$ekstensiGambar = strtolower(end($ekstensiGambar)); 

	if ( !in_array($ekstensiGambar, $ekstensiValid)  ) {
		return false;	}

	// Cek ukuran file
	if ( $size > 1000000 ) {
		return false;
	}

	// generate nama baru
	$namaBaru = uniqid();
	$namaBaru .= ".";
	$namaBaru .= $ekstensiGambar;

	move_uploaded_file($tmp_name, 'images/' . $namaBaru);

	// masukkan data ke table

	$ubah = "UPDATE data_$username SET 
            photo = '$namaBaru'
            WHERE id = '1'
          ";
    mysqli_query($conn, $ubah);
	
	return mysqli_affected_rows($conn);
}





?>