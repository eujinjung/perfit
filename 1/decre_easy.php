<?php
// 데이터베이스 연결 설정
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "mydb";

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM recommendtbl ORDER BY number ASC;";
echo $sql;
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>감량-EASY</title>
    <link rel="stylesheet" type="text/css" href="./header.css">
    <link rel="stylesheet" type="text/css" href="./alltab.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div xmlns:th="http://www.thymeleaf.org" xmlns:sec="http://www.thymeleaf.org/extras/spring-security"></div>
    <header>
        <div class="header-background">
            <div class="header-wrap">
                <div class="header-logo">
                    <a href="./main.html">
                        <img src="./img/PERFIT_logo.png" alt="logo" class="logo">
                    </a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="./health.html">Health</a></li>
                            <li><a href="./diet.html">Diet</a></li>
                            <li><a href="./calculator.html">calculator</a></li>
                        </ul>

                        <div class="background">
                            <div class="background-bg"></div>
                        </div>
                    </div>
                    <ul class="nav">
                        <li><a href="./join.html"><button>JOIN US</button></a></li>
                        <li><a href="./login.html"><button>LOG IN</button></a></li>
                        <li><a href="./mypage.html"><button>MY PAGE</button></a></li>
                    </ul>.
                </div>
            </div>
        </div>
    </header>
    <!--본문---------------------------------------------------------------------------------------------->
    <div class="tab-container">
    <div class="tabs">
        <ul>
            <?php
            for ($i = 1; $i <= 7; $i++) {
                $query = "SELECT * FROM recommendtbl WHERE number = $i";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($result);
                $exerciseName = $row['exercise_name'];
                ?>
                <li onclick="showContent1(<?=$i-1?>)"><?=$exerciseName?></li>
            <?php } ?>
        </ul>
    </div>
    <div class="content">
        <?php
        for ($i = 1; $i <= 7; $i++) {
            $query = "SELECT * FROM recommendtbl WHERE number = $i";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($result);
            ?>
            <div id="<?=$i-1?>" class="tab-content">
                <h1><?=$row['exercise_name'] ?></h1>
                <h3>코치의 코멘트</h3>
                <p><?=$row['comment'] ?></p>
                <h3>시작 자세</h3>
                <p><?=$row['posture'] ?></p>
                <h3>운동 동작</h3>
                <p><?=$row['movement'] ?></p>
                <h3>호흡법</h3>
                <p><?=$row['breathing_method'] ?></p>
                <h3>주의사항</h3>
                <p><?=$row['caution'] ?></p>
            </div>
        <?php } ?>
    </div>
</div>
    <!-- <script src="alltab.js"></script> -->
    <!--푸터------------------------------------------------------------------------------------------------------------->
    <footer>
        <div class="footer-wrap">
            <div class="footer-content">
                <div class="footer-item customer-center">
                    <h3>CUSTOMER CENTER</h3>
                    <p>(+82)10-2123-5024</p>
                    <ul>
                        <li>Mon~Fri AM 10:00-PM 18:00</li>
                        <li>Lunch PM 12:00-PM 13:00</li>
                        <li>SAT SUN HOLIDAY OFF</li>
                    </ul>
                </div>
                <div class="footer-item favorite-menu">
                    <h3>QUICK MENU</h3>
                    <ul>
                        <li><a href="./join.html">JOIN US</a></li>
                        <li><a href="./login.html">LOG IN</a></li>
                        <li><a href="./mypage.html">MY PAGE</a></li>
                        <li><a href="./health.html">Health</a></li>
                        <li><a href="./diet.html">Diet</a></li>
                        <li><a href="./calculator.html">calculator</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
<script>

function showContent1(index) {
    var contentDivs = document.getElementsByClassName("tab-content");
    var tabs = document.getElementsByTagName("li");

    for (var i = 0; i < contentDivs.length; i++) {
        contentDivs[i].classList.add("hidden");
        contentDivs[i].classList.remove("active");
    }

    $("#"+index).addClass('active');
    $("#"+index).removeClass('hidden');

    // document.getElementById(index).classList.remove("hidden");
    // document.getElementById(index).classList.add("active");
}
</script>
</html>