<?php


switch($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        register();
        break;
    }


function register() {
    if(isset($_POST["cityId"]) && isset($_POST["username"])  && isset($_POST["displayName"]) && isset($_POST["password"])){
        $cityId = $_POST["cityId"];
        $username = $_POST["username"];
        $displayName = $_POST["displayName"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        include "./conn.php";

        $sql = "SELECT id FROM user where username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows == 0)  {

            $sql = "INSERT INTO `user`(`cityId`, `username`, `displayName`, `password`) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $cityId, $username, $displayName, $password);
            $registered = $stmt->execute();

            if($registered) {
                $sql = "SELECT id FROM user where username = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $username);
                $stmt->execute();

                $result = $stmt->get_result();

                $id;

                while($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                }

                session_start();
                $_SESSION["user"] = $id;
                echo json_encode('{logged: true, message: "Konto stworzone"}', JSON_UNESCAPED_UNICODE);
            }
        }
        else
            echo json_encode('{logged: false, message: "Nazwa zajęta"}', JSON_UNESCAPED_UNICODE);
    }
}
