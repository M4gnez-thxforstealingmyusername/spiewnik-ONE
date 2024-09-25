<link id="themeSheet" rel="stylesheet" href="lightTheme.css">
<link rel="stylesheet" href="style.css">
<?php

    function router() {
        $uri = substr($_SERVER["REQUEST_URI"], 9);

        switch($uri) {
            case "":
            case "/":
                include("./home.php");
            break;
            case "/piesni":
            case "/piesni/":
                include("./songs.php");
            break;

            default:
                include("404.php");
        }
    }

    function runApp() {
        include "./navBar.php";
        router();
    }


    runApp();
?>

<script type="module">
    import { UserSettings } from "./js/class/UserSettings.js"

    var a = new UserSettings();

    a.setDefaultLocalSettings();
</script>

