<?php 

include 'db_connect.php';

session_start();

error_reporting(0);

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['currUser']  = $row['id'];
        

		if($row['type'] == 1){
			$_SESSION['currAdmin'] = $row['type'];
			header("location:manage_songs.php");
		}else{
			header("location:index.php");
		}
	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>F5MP3</title>
        <link
            rel="shortcut icon"
            href="./assets/Logo F5 ver2.svg"
            type="image/x-icon"
        />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap"
            rel="stylesheet"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
        />
        <script
            type="module"
            src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
        ></script>
        <script
            nomodule
            src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
        ></script>
        <link rel="stylesheet" href="./css/base.css" />
        <link rel="stylesheet" href="./css/app.css" />
    </head>
    <body>
        <form action="" method="post" class="form">
            <img src="./assets/Logo F5.svg" alt="F5MP3" class="logo" />
            <p class="desc">Trang chia s??? v?? t???i nh???c tr???c tuy???n</p>
            <div class="form-group">
                <input type="text" class="form-input" placeholder="T??n ????ng nh???p" name="username" />
            </div>
            <div class="form-group">
                <input type="password" class="form-input" placeholder="M???t kh???u" name ="password" />
            </div>
            <div class="form-group">
                <button name="submit" class="primary-btn">????ng nh???p</button>
            </div>
            <a href="" class="desc">Qu??n m???t kh???u?</a>
            <hr />
            <p class="login-register-text">
                B???n ch??a c?? t??i kho???n? <a href="register.php" class="login-register-link">????ng k?? ngay!</a>		
            </p>
        </form>
    </body>
</html>
