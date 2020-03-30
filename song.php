<?php
$special = $_GET["special"];
if ($special == "anime") $index = "Anime Time!";
else if ($special == "disney") $index = "WALT DISNEY";
else {
    if (!empty($_COOKIE["index"])) $index = $_COOKIE["index"];
    else echo "<script>window.location.replace(\"index.php\");</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Photong | Match Your Photo to a Song</title>
    <?php include("head-include.php"); ?>
    <link rel="stylesheet" href="include/bootstrap.min.css">
    <link rel="stylesheet" href="include/theme.css">
    <link rel="stylesheet" href="styles.css">
    <script src="include/jquery-3.4.1.min.js"></script>
    <script src="include/popper.min.js"></script>
    <script src="include/bootstrap.min.js"></script>
    <script src="cookies.js"></script>
</head>
<body>
    <div class="header-song">
        <?php include("header.php"); ?>
        <div class="container hero">
            <div class="row" style="display:block;">
                <h1>Your Photong Index is:
                    <span data-toggle="popover" data-placement="right" title="What is a Photong Index?"
                          data-content="A Photong Index ranges from -255 to 255. The higher it is, the &quot;sadder&quot;
                          the image. See <a href=&quot;how.php&quot; target=&quot;_blank&quot;>here</a> for more
                          information." class="question">
                        <i class="fas fa-question-circle"></i>
                    </span>
                </h1>
                <h2 id="index"></h2>
            </div>
            <div class="row" style="display:block;">
                <h1>So we recommend you...</h1>
                <iframe id="appleMusicEmbed" allow="autoplay *; encrypted-media *;" height="150" style="border:none;width:100%;max-width:660px;overflow:hidden;background:transparent;"
                        sandbox="allow-forms allow-popups allow-same-origin allow-scripts
                        allow-storage-access-by-user-activation allow-top-navigation-by-user-activation" src="">
                </iframe>
            </div>
            <div class="row" style="display:block;">
                <button onclick="document.location.href = 'index.php';" class="btn btn-primary"><i class="fas fa-undo"></i> Start Over</button>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>

    <script>
        $(document).ready(function(){
            $("[data-toggle=popover]").popover({html:true})
        });
    </script>

    <?php
    if ($index == "zero") $index = 0;

    if (is_numeric($index)) {
        $index = round($index, 2);
        if ($index >= 50) $url = "https://itunes.apple.com/us/rss/topsongs/genre=2/json"; // Blues
        else if (($index < 50) && ($index >= 35)) $url = "https://itunes.apple.com/us/rss/topsongs/genre=11/json"; // Jazz
        else if (($index < 35) && ($index >= 20)) $url = "https://itunes.apple.com/us/rss/topsongs/genre=15/json"; // R&B
        else if (($index < 20) && ($index >= 5)) $url = "https://itunes.apple.com/us/rss/topsongs/genre=21/json"; // Rock
        else if (($index < 5) && ($index >= -10)) $url = "https://itunes.apple.com/us/rss/topsongs/genre=18/json"; // Hip-hop
        else if (($index < -10) && ($index >= -25)) $url = "https://itunes.apple.com/us/rss/topsongs/genre=14/json"; // Pop
        else if (($index < -25) && ($index >= -50)) $url = "https://itunes.apple.com/us/rss/topsongs/genre=7/json"; // Electronic
        else $url = "https://itunes.apple.com/us/rss/topsongs/genre=17/json"; // Dance
    }
    else if ($index == "Anime Time!") $url = "https://itunes.apple.com/us/rss/topsongs/genre=29/json";
    else if ($index == "WALT DISNEY") $url = "https://itunes.apple.com/us/rss/topsongs/genre=50000063/json";

    echo "<script>document.getElementById(\"index\").innerHTML = \"$index\";</script>";

    $json = file_get_contents("$url");
    $rsp = json_decode($json, true);
    $trackLink = $rsp["feed"]["entry"][rand(0,9)]["link"][0]["attributes"]["href"];
    $embedLink = "https://embed.music.apple.com/us/album/" . substr($trackLink, 33, -5);
    echo "<script>document.getElementById(\"appleMusicEmbed\").src = \"$embedLink\";</script>";
    echo "<script>eraseCookie('index');</script>";
    unset($_COOKIE["index"]);
    ?>
</body>
</html>