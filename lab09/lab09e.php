<?php
$connect = mysqli_connect("localhost", "pzare", "jfahrbe0", "pzare") or die(mysqli_error($connect));

$countQuery = "SELECT COUNT(*) AS total FROM photographs";
$countResult = mysqli_query($connect, $countQuery);

if (!$countResult) {
    die("<div>Error fetching total count: " . mysqli_error($connect) . "</div>");
}
$totalImages = mysqli_fetch_assoc($countResult)['total'];

$randomQuery = "SELECT subject, location, picture_url FROM photographs ORDER BY RAND() LIMIT 1";
$randomResult = mysqli_query($connect, $randomQuery);

if (!$randomResult) {
    die("<div>Error fetching random image: " . mysqli_error($connect) . "</div>");
}
$randomImage = mysqli_fetch_assoc($randomResult);

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
        justify-content: center;
        min-height: 100vh;
    }
    h1 {
        text-align: center;
        color: #4CAF50;
        font-size: 24px;
        margin-bottom: 20px;
    }
    .random-image {
        background-color: #ffffff;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        text-align: center;
        padding: 20px;
        margin-bottom: 20px;
        width: 300px;
    }
    .random-image img {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }
    .caption {
        margin-top: 10px;
        font-size: 16px;
        color: #333;
    }
    .total-images {
        font-size: 18px;
        color: #555;
        margin-top: 20px;
    }
</style>
";

echo "<h1>Random Image Viewer</h1>";


if ($randomImage) {
    echo "<div class='random-image'>";
    echo "<img src='" . htmlspecialchars($randomImage['picture_url']) . "' alt='" . htmlspecialchars($randomImage['subject']) . "'>";
    echo "<div class='caption'>Subject: " . htmlspecialchars($randomImage['subject']) . "<br>Location: " . htmlspecialchars($randomImage['location']) . "</div>";
    echo "</div>";
} else {
    echo "<div class='random-image'>No images found in the database.</div>";
}

echo "<div class='total-images'>Total Images in the Database: $totalImages</div>";

mysqli_close($connect);
?>
