<?php

    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            fetch();
            break;
    }

    function fetch(): void {
            require_once("./conn.php");

            $sql = "SELECT * FROM settings where userId = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $_SESSION["userId"]); //TODO: add server userId
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