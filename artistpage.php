<?php
//session_start();
include 'config.php';
$pdo = pdo_connect_mysql();

if (isset($_GET['id'])){
    $stmt1 = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt1->execute([ $_GET['id'] ]); $user = $stmt1->fetch(PDO::FETCH_ASSOC);
$stmt2 = $pdo->prepare('SELECT *,stagename FROM songs LEFT JOIN users on
songs.user_id=users.id WHERE songs.user_id = ?'); $stmt2->execute([ $_GET['id']
]); $songs = $stmt2->fetchAll(PDO::FETCH_ASSOC); } else{ exit(); } ?>

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
                        type="text"
                        name="search1"
                        id="search"
                        class="search-input"
                        placeholder="Tên nghệ sĩ hoặc bài hát"
                        autocomplete="off"
                        required
                    />
                    <ul class="search-hints"></ul>
                    <div class="listGroup">
                        <ul
                            style="list-style-type: none; padding: 0; margin: 0"
                            id="show-list"
                        ></ul>
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
                <!-- Persional Page -->
                <section class="profile">
                    <img src="<?=($_SESSION["avatar"] ="./assets/avatar/".$user['image'])?>" alt="" class="profile__img" />
                    <div class="profile__info">
                        <div class="profile__auth">
                            <ion-icon name="checkmark-circle"></ion-icon>
                            Nghệ sĩ được xác minh
                        </div>
                        <h2 class="profile__name"><?= $user['stagename']?></h2>
                    </div>
                </section>
                <!-- Artist Playlist -->
                <section class="cards">
                    <div class="cards-top">
                        <h3 class="cards-title">Bài hát phổ biến</h3>
                    </div>
                    <div class="cards-bottom">
                        <?php if ($songs){ ?>
                        <?php foreach($songs as $song): ?>
                        <a
                            href="songpage.php?audio_id=<?=$song['audio_id']?>"
                            class="card card-song"
                        >
                            <!-- <a class="card card-song"> -->
                            <img src="<?=($_SESSION["links_pictures"].$song['thumbnail'])?>"
                            alt="" class="card-img" />
                            <div class="card-content">
                                <h4 class="card-title"><?=$song['title']?></h4>
                                <span class="card-desc"
                                    ><?=$song['stagename']?></span
                                >
                            </div>
                            <button class="play-song-btn">
                                <ion-icon
                                    class="play-icon"
                                    name="play"
                                ></ion-icon>
                            </button>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <?php } ?>
                </section>
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