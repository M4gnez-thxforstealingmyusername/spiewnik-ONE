<?php
class AccountManagement {
    public static function isLevel($level): bool {
        if(session_status() == 0)
            session_start();

        if(isset($_SESSION["user"])){

            $sql = "SELECT authorizationLevel FROM user WHERE id = ?";

            require("./conn.php");

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $_SESSION["user"]);
            $stmt->execute();

            $result = $stmt->get_result();

            $rows = mysqli_fetch_assoc($result);

            return $rows["authorizationLevel"] >= $level ? 1 : 0;

        }
        else
            return false;
    }
}