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
        include "./imports.html";
        include "./navBar.php";
        router();
    }


    runApp();
?>

<script type="module">
    import { SettingsManager } from "./js/manager/SettingsManager.js"
    import { Settings } from "./js/class/Settings.js"
    import { App } from "./js/class/App.js"

    const app = new App(new SettingsManager());
</script>

