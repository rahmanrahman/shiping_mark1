<?php
	session_start();
	require_once 'koneksi.php';
	$username	= mysqli_real_escape_string($conn, $_POST['username']);
	$password	= mysqli_real_escape_string($conn, $_POST['password']);
	$encrypted	= md5($password);
	$query		= mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$username' AND password='$encrypted'");
	$data 		= mysqli_num_rows($query);
	if ($data > 0) {
		$_SESSION['login'] = "yes";
		while ($key = mysqli_fetch_array($query)) {
			$_SESSION['username'] 	= $key['username'];
			$_SESSION['role'] 		= $key['role'];
		}
		$_SESSION['message'] = 'logged';
		header("location:../index.php");
	}else{
		$logfail = "<script>
                $.toast({
                    heading: 'Login Gagal!',
					text: 'Username / Password Salah!!,
					position: 'top-right',
					hideAfter: 3500,
					textAlign: 'center',
					icon: 'error'
                });
            </script>";
		$_SESSION['message'] = $logfail;
		header("location:../login.php");
	}
	mysqli_free_result($query);
    mysqli_close($conn);
?>