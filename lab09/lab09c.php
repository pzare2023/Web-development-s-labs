<?php
$connect = mysqli_connect("localhost", "pzare", "jfahrbe0", "pzare") or die(mysqli_error($connect));

echo "
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    h1 {
        text-align: center;
        margin-top: 20px;
        color: #4CAF50;
        font-size: 24px;
    }
    .gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        padding: 20px;
        width: 80%;
        margin: 20px auto;
    }
    .photo {
        background-color: #ffffff;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        text-align: center;
    }
    .photo img {
        width: 100%;
        height: auto;
    }
    .caption {
        padding: 10px;
        font-size: 16px;
        color: #333;
    }
    .no-photos {
        text-align: center;
        color: #333;
        font-size: 18px;
        margin-top: 20px;
    }
</style>
";

$query = "SELECT subject, location, picture_url FROM photographs WHERE location LIKE '%, Ontario'";
$result = mysqli_query($connect, $query);

if (!$result) {
    die("<div>Error in query: " . mysqli_error($connect) . "</div>");
}

if (mysqli_num_rows($result) > 0) {
    echo "<h1>Photos Taken in Ontario</h1>";
    echo "<div class='gallery'>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='photo'>";
        echo "<img src='" . htmlspecialchars($row['picture_url']) . "' alt='" . htmlspecialchars($row['subject']) . "'>";
        echo "<div class='caption'>" . htmlspecialchars($row['subject']) . "<br>" . htmlspecialchars($row['location']) . "</div>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<h1>Photos Taken in Ontario</h1>";
    echo "<div class='no-photos'>No photos were found in Ontario.</div>";
}

mysqli_close($connect);
?>
