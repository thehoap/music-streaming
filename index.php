<?php
session_start();
include 'db_connect.php';

if(isset($_SESSION['currUser'])){
    $id=$_SESSION['currUser'];

    $sql = "SELECT * FROM users WHERE id='$id' ";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $name=$row['firstname']." ".$row['lastname'];
        $path=$row['image'];
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
    </head>
    <body>
        <div class="grid">
            <!-- Sidebar -->
            <div class="sidebar">
                <img src="./assets/Logo F5.svg" alt="" class="logo" />
                <nav class="nav">
                    <ul class="nav-top">
                        <li class="nav-item">
                            <a href="" class="nav-link selected">
                                <ion-icon name="home"></ion-icon>Trang chủ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <ion-icon name="disc"></ion-icon>Bài hát đã
                                thích
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
                <div class="search-engine">
                    <ion-icon name="search"></ion-icon>
                    <input
                        type="text"
                        class="search-input"
                        placeholder="Tên nghệ sĩ hoặc bài hát"
                    />
                    <ul class="search-hints"></ul>
                </div>
                <div class="user">
                    <?php
                    echo '<img src="./assets/avatar/'.$path.'" alt="Avatar" class="user-avatar" />'; 
                     ?>
                    <span class="user-name"><?php echo $name; ?></span>
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
            </header>
            <main class="main"></main>
            <!-- Music Player -->
            <div class="music-player">
                <div class="song">
                    <img
                        src="./assets/img/tron tim.jpg"
                        alt=""
                        class="song song__thumb"
                    />
                    <div class="song song__desc">
                        <h4 class="song song__title">Trốn tìm</h4>
                        <p class="song song__artist">Đen Vâu</p>
                    </div>
                    <ion-icon
                        class="heart-outline"
                        name="heart-outline"
                    ></ion-icon>
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
                    <ion-icon
                        class="cloud-download-outline"
                        name="cloud-download-outline"
                    ></ion-icon>
                    <div class="volume">
                        <ion-icon
                            class="volume-high"
                            name="volume-high"
                        ></ion-icon>
                        <input
                            type="range"
                            name="volume"
                            id="volume"
                            class="range"
                        />
                    </div>
                </div>
            </div>
        </div>
        <script src="app.js"></script>
    </body>
</html>
