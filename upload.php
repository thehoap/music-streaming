<?php
include 'db_connect.php';
error_reporting(0);
session_start();
if(isset($_POST['submit']))
{   $user_id= $_SESSION['currUser'];
	$title = $_POST['title'];
    $category = $_POST['category'];
    $errors= array();
    $file_name = $_FILES['thumbnail']['name'];
    $file_size = $_FILES['thumbnail']['size']; 
    $file_tmp = $_FILES['thumbnail']['tmp_name'];
    $file_type = $_FILES['thumbnail']['type'];
    $file_parts =explode('.',$_FILES['thumbnail']['name']);

    $thumbnail = $_FILES['thumbnail']['name'];
    $target = "assets/img/songs".basename($thumbnail);
	$audio_location = $_FILES['audio_location']['name'];
	$audio_path="assets/music/songs".basename($audio_location);

    $sql = "INSERT INTO songs (user_id, title, category, thumbnail, audio_location)
                    VALUES ('$user_id','$title', '$category', '$thumbnail', '$audio_location')";
    $result = mysqli_query($conn, $sql);
	move_uploaded_file($_FILES['audio_location']['tmp_name'],$audio_path);
	move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target);
   
    echo "<script>alert('Tải lên thành công.')</script>";
    //chuyen de trang ca nhan                     
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
            href="https://cdn-icons-png.flaticon.com/512/1384/1384061.png"
            type="image/x-icon"
        />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap"
            rel="stylesheet"
        />
        <link
            rel="shortcut icon"
            href="./assets/Logo F5 ver2.svg"
            type="image/x-icon"
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
        <link rel="stylesheet" href="./css/search.css" />
    </head>
    <body>
        <div class="grid">
            <!-- Sidebar -->
            <div class="sidebar">
                <img src="./assets/Logo F5.svg" alt="" class="logo" />
                <nav class="nav">
                    <ul class="nav-top">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link selected">
                                <ion-icon name="home"></ion-icon>Trang chủ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="listloves.php" class="nav-link">
                                <ion-icon name="disc"></ion-icon>Bài hát đã
                                thích
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="album.php" class="nav-link">
                                <ion-icon name="disc"></ion-icon>Album
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="album.php" class="nav-link">
                                <ion-icon name="disc"></ion-icon>Tải lên
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-bottom">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <ion-icon name="settings"></ion-icon>Cài đặt
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <header class="header">
                <form action="search.php" method="post" class="search-engine">
                    <ion-icon name="search"></ion-icon>
                    <input
                        type="text" name="search1" id="search"
                        class="search-input"
                        placeholder="Tên nghệ sĩ hoặc bài hát" autocomplete="off" required
                    />
                    <ul class="search-hints"></ul>
                    <div class="listGroup">
                        <ul style ="list-style-type: none;padding: 0;margin: 0;" id="show-list">
                        </ul>
                    </div>
                </form>
                <?php if(isset($_SESSION['currUser'])){?>
                <div class="user">
                    <img
                        src="<?='./assets/avatar/'.$_SESSION['path']?>"
                        alt="Avatar"
                        class="user-avatar"
                    />
                    <span class="user-name"><?=$_SESSION['name']?></span>
                    <ion-icon name="chevron-down-outline"></ion-icon>
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="view_user.php" class="nav-link">
                                <ion-icon name="person"></ion-icon>Trang cá nhân
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">
                                <ion-icon name="log-out-outline"></ion-icon>Đăng
                                xuất
                            </a>
                        </li>
                    </ul>
                </div>
                <?php }else{?>
                <div class="user">
                    <img
                        src="./assets/img/iconTrang.jpg"
                        alt="Avatar"
                        class="user-avatar"
                    />
                    <span class="user-name">Chưa có tài khoản</span>
                    <ion-icon name="chevron-down-outline"></ion-icon>
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="login.php" class="nav-link">
                                <ion-icon name="log-out-outline"></ion-icon>Đăng
                                nhập
                            </a>
                        </li>
                    </ul>
                </div>
                <?php }?>
            </header>
            <main class="main">
                
                <form action="" method="POST" enctype="multipart/form-data">                   
                    <label>Tên bài hát:</label><input type="text" name="title" required/><br /><br />
                    <label>Thể loại:</label><input type="text" name="category" required/><br /><br />
                    <label>Ảnh nền:</label><input type="file" name="thumbnail" required/><br /><br />	
                    <label>Tệp bài hát:</label><input type="file" name="audio_location"required/><br /><br />
                    <input type="submit" value="Đăng" name="submit"/>
                </form>
            </main>
            <!-- Music Player -->
            <div class="music-player">
            <div class="waveform" style="display: none"></div>
                <div class="song">
                    <img
                        src="./assets/img/tron tim.jpg"
                        alt=""
                        class="song__thumb"
                    />
                    <div class="song__desc">
                        <h4 class="song__title">Trốn tìm</h4>
                        <p class="song__artist">Đen Vâu</p>
                    </div>
                    <div class="heart" onclick="favorite(this)">
                        <ion-icon name="heart-outline"></ion-icon>
                    </div>
                </div>
                <div class="player">
                    <div class="controls">
                        <ion-icon class="shuffle" name="shuffle"></ion-icon>
                        <ion-icon
                            class="play-skip-back"
                            name="play-skip-back"
                        ></ion-icon>
                        <div class="play">
                            <ion-icon class="play-icon" name="play"></ion-icon>
                        </div>
                        <ion-icon
                            class="play-skip-forward"
                            name="play-skip-forward"
                        ></ion-icon>
                        <ion-icon class="repeat" name="repeat"></ion-icon>
                    </div>
                    <div class="timer">
                        <div class="current">1:02</div>
                        <input
                            type="range"
                            name="track"
                            id="track"
                            class="range"
                        />
                        <audio
                            src="./assets/music/tron-tim-den-vau.mp3"
                            id="song"
                        ></audio>
                        <div class="duration">4:08</div>
                    </div>
                </div>
                <div class="action">
                    <a href="./assets/music/tron-tim-den-vau.mp3" download>
                        <ion-icon
                            class="cloud-download-outline"
                            name="cloud-download-outline"
                        ></ion-icon>
                    </a>
                    <div class="volume">
                        <div class="volume-icon">
                            <ion-icon
                                class="volume-high"
                                name="volume-high"
                            ></ion-icon>
                        </div>
                        <input
                            type="range"
                            name="volume"
                            id="volume"
                            class="range"
                            min="0"
                            max="1"
                            step="0.01"
                        />
                    </div>
                </div>
            </div>
        </div>
        <script src="https://unpkg.com/wavesurfer.js"></script>
        <script src="javascript/app.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="search.js"></script>        
    </body>
</html>