<?php

switch($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        login();
        break;
}


function login() {
    include "./conn.php";
    if(isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if(password_verify($password, $row["password"]))
                {
                    session_start();
                    $_SESSION["user"] = $row["id"];

                    echo json_encode('{logged: true, message: "Zalogowano pomyślnie"}', JSON_UNESCAPED_UNICODE);
                }
                else
                echo json_encode('{logged: false, message: "Hasło niepoprawne"}', JSON_UNESCAPED_UNICODE);
            }
        }
        else
            echo json_encode('{logged: false, message: "Użytkownik nie istnieje"}', JSON_UNESCAPED_UNICODE);
    }
    else
        echo json_encode('{logged: false, message: "Niewystarczające dane logowania"}', JSON_UNESCAPED_UNICODE);
}