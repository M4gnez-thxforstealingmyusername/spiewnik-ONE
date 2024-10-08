<?php

switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        fetch();
        break;
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