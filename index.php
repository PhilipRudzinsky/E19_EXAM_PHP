<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forum o psach</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
<div class="banner">
    <h1>Forum miłośników psów</h1>
</div>
<div class="lewy">
    <img src="Avatar.png" alt="Użytkownik forum">
    <?php
    $conn = new mysqli("localhost", "root", "", "forumpsy");

    if ($conn->connect_error) {
        die("Bład polączenia: " . $conn->connect_error);
    }

    $sql = "SELECT konta.nick, konta.postow, pytania.pytanie FROM konta konta INNER JOIN pytania pytania ON konta.id = pytania.konta_id WHERE pytania.id = 1;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h4>Użytkownik: ";
        echo "<span>" . $row["nick"] . "</span></h4>";
        echo "<p>" . $row["postow"] . " postów na forum</p>";
        echo "<p>" . $row["pytanie"] . " postów na forum</p>";
    }


    ?>
    <video controls="controls" src="video.mp4"></video>
</div>
<div class="prawy">
    <form name="form">
        <textarea name="area" id="area" cols="40" rows="4"></textarea><br>
        <input type="submit" name="submit" value="Dodaj odpowiedź">
    </form>
    <h2>Odpowiedzi na pytanie</h2>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "forumpsy";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Bład polączenia: " . $conn->connect_error);
    }

    if(isset($_POST['submit']) && !empty($_POST['area'])){
        $odpowiedz = $_POST['area'];
        $sql = "INSERT INTO odpowiedzi VALUES(NULL,1,5,$odpowiedz);";
    }

    if ($result = $conn->query("SELECT odpowiedzi.konta_id, odpowiedzi.odpowiedz, konta.nick FROM odpowiedzi INNER JOIN konta ON odpowiedzi.konta_id = konta.id WHERE odpowiedzi.Pytania_id = 1;")) {
        if ($result->num_rows > 0) {
            echo "<ol>";
            while ($row = $result->fetch_assoc()) {
                echo "<li><em>" . $row["nick"] . "</em>: " . $row["odpowiedz"] . "<hr></li>";
            }
            echo "</ol>";
        } else {
            echo "Brak wyników";
        }
        $result->free();
    } else {
        echo "Błąd: " . $conn->error;
    }

    $conn->close();
    ?>
</div>
<footer>
    <p>Autor: Filip Rudzniński 3pir2 <a href="http://mojestrony.pl/"></a></p>
</footer>
</body>
</html>






