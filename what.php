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
        <div class="container hero">
            <div class="row">
                <div class="col">
                    <h1>What is Photong?</h1>
                    <p class="lead-override">
                        Photong (pronounced fow·tong, as a combination of "photo" and "song") is a simple tool that
                        analyses colour samples in an image and looks for a song that best matches with the temperature
                        of the colours.
                    </p>
                    <p>
                        It started off with a small idea in an Art class one day. (Thank you Mr. C!) We were learning
                        about remixes and appropriation in art, and then suddenly this idea jumped into my mind. What
                        if I combine existing artworks with existing songs, and somehow find a connection between them?
                    </p>
                    <p>
                        However, due to various reason I didn't start this project until schools were "suspended" due
                        to COVID-19. Thus, I had plenty of time to do what I'd love to do. Surprisingly, it wasn't
                        especially hard to build; I managed to finish it under a day. To be honest, the actual algorithm
                        part didn't take too long, but styling it with Bootstrap is definitely a pain in the neck.
                    </p>
                    <p>
                        Anyway, this tool was created on March 28, 2020. Hope you enjoy it.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>
</html>