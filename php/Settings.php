<?php

switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        fetch();
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

    $sql = "SELECT * FROM settings where userId = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION["user"]);
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

function change(): void {
    $_PATCH = (array)json_decode(file_get_contents('php://input'));
    session_start();

    if(!isset($_SESSION["user"])) {
        echo "{'status': 'brak użytkownika'}";
        exit();
    }

    if(isset($_PATCH["nextSlide"]) && isset($_PATCH["reset"])) {
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