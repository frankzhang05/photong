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
                <h1>How does Photong work?</h1>
                <p class="lead-override">
                    Very easy: Photong Index, a number ranging from -255 to 255, decides it all.
                </p>
                <p>
                    So how does Photong know which song to choose? There are <strong>4 steps</strong> in the process:
                </p>
                <ol>
                    <li>Extracting colours from the image;</li>
                    <li>Adding colours to Photong Index according to temperatures;</li>
                    <li>Deciding a genre based on Photong Index; and finally</li>
                    <li>Requesting for a song based on the genre.</li>
                </ol>

                <h2>Extracting colours from the image</h2>
                <p>
                    Photong uses a very simple <a href="http://www.coolphptools.com/color_extract" target="_blank">image
                    color extraction tool</a> that automatically gets the top 30 common colours, so that's not very hard.
                </p>

                <h2>Adding colours to Photong Index according to temperatures</h2>
                <figure>
                    <img style="width:50%" src="https://static-cse.canva.com/_next/static/assets/warm-cool-colors.1200x707.217f638962f8da17d66dc775cc16807a.png" alt="Warm and Cool Colours">
                    <figcaption>Warm and cool colours definition from <a href="https://www.canva.com/colors/color-wheel/" target="_blank">Canva.com.</a></figcaption>
                </figure>
                <p>
                    So a quick look at the colour wheel can give us the conclusion that blue is the main cold colour, and
                    red is the main warm colour. Thus, combining with the colours we extracted before, we can simply
                    convert the result to RGB values, then subtract the R value from the B value. This is how currently
                    Photong Index works. However, this system is extremely inaccurate, so please do email me if you have
                    a better idea!
                </p>

                <h2>Deciding a genre based on Photong Index</h2>
                <p>
                    Again, this is also very subjective. Here is the relationship between Photong Index and genres currently used by
                    Photong:
                </p>
                <table class="table table-striped table-bordered table-hover">
                    <thead class="thead-light">
                        <tr><th>Photong Index Range</th><th>Genre</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Index >= 50</td><td>Blues</td></tr>
                        <tr><td>35 <= Index < 50</td><td>Jazz</td></tr>
                        <tr><td>20 <= Index < 35</td><td>R&B</td></tr>
                        <tr><td>5 <= Index < 20</td><td>Rock</td></tr>
                        <tr><td>-10 <= Index < 5</td><td>Hip-hop</td></tr>
                        <tr><td>-25 <= Index < -10</td><td>Pop</td></tr>
                        <tr><td>-50 <= Index < -25</td><td>Electronic</td></tr>
                        <tr><td>Index < -50</td><td>Dance</td></tr>
                    </tbody>
                </table>
                <p>
                    Although theoretically it's possible to get over 50 and under -50, it's very unlikely unless the
                    photo is a block of pure red or blue.
                </p>

                <h2>Requesting for a song based on the genre</h2>
                <p>
                    Photong uses the <a href="https://affiliate.itunes.apple.com/resources/documentation/itunes-store-web-service-search-api"
                    target="_blank">iTunes Search API</a> to search for songs. However, it seems like the API is poorly
                    maintained; there were no official docs about searching by genre. After a bit of digging, I found
                    the secret top chart API: <code class="text-white">https://itunes.apple.com/us/rss/topsongs/genre=[genreID]/json</code>.
                    It took some time to find the genreID <a href="https://web.archive.org/web/20190920135004/https://affiliate.itunes.apple.com/resources/documentation/genre-mapping/"
                    target="_blank">here</a>, as Apple for some reason removed it. After finding the link to the song,
                    it's easy to get the ID part and embed it into an iFrame.
                </p>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>
</body>
</html>