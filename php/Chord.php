<?php

switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        fetch();
        break;
    case "POST":
        push();
        break;
    case "PATCH":
        change();
        break;
    default:
        echo "{'status': 'niepoprawna metoda zapytania'}";
}

function fetch(): void {
    require_once("./conn.php");
    session_start();

    $sql = "SELECT * FROM chord";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $rows = mysqli_fetch_assoc($result);

        echo json_encode($rows, JSON_UNESCAPED_UNICODE);
    }
    else {
        echo json_encode(null, JSON_UNESCAPED_UNICODE);
    }
}

function push(): void {
    if(isset($_POST["songId"]) && isset($_POST["chords"])){
        session_start();

        if(!isset($_SESSION["user"])) {
            echo "{'status': 'brak użytkownika'}";
            exit();
        }

        require_once("./AccountManagement.php");

        if(!AccountManagement::isLevel(1)) {
            echo "{'status': 'Poziom niewystarczający'}";
            exit();
        }

        $songId = $_POST["songId"];
        $chords = $_POST["chords"];

        require("./conn.php");

        $sql = "INSERT INTO `chord` (`id`, `songId`, `userId`, `uploadDate`, `editUserId`, `editDate`, `chords`, `verified`) VALUES (NULL, ?, ?, current_timestamp(), NULL, NULL, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $songId, $_SESSION["user"], $chords, AccountManagement::isLevel(2));
        $stmt->execute();

    }
    else
        echo "{'status': 'dane niepoprawne'}";
}

//TODO
function change(): void {
    $_PATCH = (array)json_decode(file_get_contents('php://input'));
    session_start();

    if(isset($_PATCH["lyricsId"]) && isset($_PATCH["reset"])) {
        $nextSlide = $_PATCH["nextSlide"];
        $reset = $_PATCH["reset"];

        require_once("./conn.php");

        $sql = "UPDATE `settings` SET `nextSlide` = ?, `reset` = ? WHERE `settings`.`userId` = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nextSlide, $reset, $_SESSION["user"]);
        $stmt->execute();

        echo "{'status': 'zaktualizowano'}";
    }
    else
        echo "{'status': 'dane niepoprawne'}";
}