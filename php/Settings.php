<?php

class Settings{

    public static function Handle(): void {
        switch($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                Settings::fetch($_GET["userId"]);
                break;
            }
        }

        private static function fetch($userId): void {
                require_once("./conn.php");

                $sql = "SELECT * FROM settings where userId = ?";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $userId);
                $stmt->execute();

                $result = $stmt->get_result();

                if($result->num_rows > 0)
                {
                    $rows = mysqli_fetch_all($result);

                    echo json_encode($rows, JSON_UNESCAPED_UNICODE);
                }
        }
    }