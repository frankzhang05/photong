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
            <div id="uploading" class="alert alert-info fade show" role="alert">
                Uploading your photo...
            </div>
            <div id="error-no-photo" class="alert alert-danger alert-dismissible fade show" role="alert">
                Please choose a photo first.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="error-file-type" class="alert alert-danger alert-dismissible fade show" role="alert">
                Hmm... Doesn't look like an image. Maybe try again?
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="error-upload-error" class="alert alert-danger alert-dismissible fade show" role="alert">
                Sorry, we encountered an error when uploading your file. Please try again.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="container hero">
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-5 offset-xl-1">
                    <h1>Welcome to Photong!</h1>
                    <p>To get started, upload a photo.</p>
                    <form method="post" enctype="multipart/form-data">
                        <div class="custom-file form-group" style="margin-bottom:1rem;">
                            <label for="userImage" class="form-control custom-file-label">Select an image</label>
                            <input type="file" class="form-control custom-file-input" name="userImage" id="userImage" accept="image/*">
                        </div>
                        <input type="submit" class="form-control btn btn-primary" value="Upload!" name="submit">
                        <small id="privacyNotice" class="form-text text-white">All photos are deleted from our server as soon as analysis finishes.</small>
                        <small id="privacy-tnc" class="form-text text-white">Please read our <a href="tnc.php" target="_blank" class="text-white">Terms and Conditions</a> and <a href="privacy.php" target="_blank" class="text-white">Privacy Policy</a> before using our service.</small>
                    </form>
                    <script>
                        $(".custom-file-input").on("change", function() {
                            const fileName = $(this).val().split("\\").pop();
                            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

    <?php include("footer.php"); ?>

    <?php
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["userImage"]["name"]);
    if (isset($_POST["submit"])) {
        if ($_FILES["userImage"]['name'] == '') {
            echo "<script>$('#error-no-photo').fadeIn();</script>";
        } else {
            echo "<script>$('#uploading').fadeIn();</script>";
            $tmpName = $_FILES["userImage"]["tmp_name"];
            $check = getimagesize($tmpName);
            if ($check !== false) {
                if (move_uploaded_file($tmpName, $target_file)) {
                    echo "<script>createCookie('url', '$target_file');</script>";
                    echo "<script>window.location.href = \"analyse.php\";</script>";
                } else {
                    echo "<script>$('#error-upload-error').fadeIn();</script>";
                }
            } else {
                echo "<script>$('#error-file-type').fadeIn();</script>";
            }
        }
    }
//    $img = $_FILES['userImage'];
//    if (isset($_POST['submit'])) {
//        if ($img['name'] == '') {
//            echo "<script>document.getElementById(\"error-no-photo\").style.display = \"initial\";</script>";
//        } else {
//            echo "<script>document.getElementById(\"uploading\").style.display = \"initial\";</script>";
//            $filename = $img['tmp_name'];
//            $client_id = "6efd0169f51cd98";
//            $handle = fopen($filename, "r");
//            $data = fread($handle, filesize($filename));
//            $pvars = array('image' => base64_encode($data));
//            $timeout = 30;
//            $curl = curl_init();
//            curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image');
//            curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
//            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID $client_id'));
//            curl_setopt($curl, CURLOPT_POST, 1);
//            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//            curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
//            $out = curl_exec($curl);
//            curl_close($curl);
//            $pms = json_decode($out, true);
//            $url = $pms['data']['link'];
//            if ($url != "") {
//                setcookie("url", $url);
//                echo "<script> window.location.href = \"analyse.php\"; </script>";
//            } else {
//                echo "<script> document.getElementById(\"error-upload-error\").innerHTML = \"$pms['data']['error']\"; document.getElementById(\"error-upload-error\").style.display = \"initial\"; </script>";
//            }
//        }
//    }
    ?>
</body>
</html>