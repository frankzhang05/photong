<?php
if (!empty($_COOKIE["url"])) $url = $_COOKIE["url"];
else echo "<script>window.location.replace(\"index.php\");</script>";

function hexToRgb($hex, $alpha = false) {
    $hex      = str_replace('#', '', $hex);
    $length   = strlen($hex);
    $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
    $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
    $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
    if ( $alpha ) {
        $rgb['a'] = $alpha;
    }
    return $rgb;
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
    <div class="header">
        <?php include("header.php"); ?>
        <div id="status">
            <div id="error-no-delete" class="alert alert-danger alert-dismissible fade show" role="alert">
                The file cannot be deleted due to an error. Please try again.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="container hero">
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-5 offset-xl-1">
                    <h1>Hold on tight!</h1>
                    <p>We're analysing your photo!</p>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>

    <?php
    include_once("include/colors.php");
    $ex=new GetMostCommonColors();
    $colors=$ex->Get_Color($url, 30, 1, 1, 24);
    $index = 0;
    $i = 0;
    foreach ($colors as $hex => $count) {
        if ($count > 0) {
            $i += $count;
        }
    }
    foreach ($colors as $hex => $count) {
        if ($count > 0) {
            $rgb = hexToRgb($hex);
            $r = $rgb['r'];
            $g = $rgb['g'];
            $b = $rgb['b'];
            $index += ($b-$r)*($count/$i);
        }
    }

    if (!unlink($url)) {
        echo "<script>$('#error-no-delete').fadeIn();</script>";
    }
    else {
        echo "<script>eraseCookie('url');</script>";
        unset($_COOKIE["url"]);
        if ($index != 0) echo "<script>createCookie('index', '$index');</script>";
        else echo "<script>createCookie('index', 'zero');</script>";
        echo "<script>window.location.replace(\"song.php\");</script>";
    }
    ?>
</body>
</html>