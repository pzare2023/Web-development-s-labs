<?php
$connect = mysqli_connect("localhost", "pzare", "jfahrbe0", "pzare") or die(mysqli_error($connect));

$yearsQuery = "SELECT DISTINCT YEAR(date_taken) AS year FROM photographs";
$yearsResult = mysqli_query($connect, $yearsQuery);

if (!$yearsResult) {
    die("<div>Error fetching years: " . mysqli_error($connect) . "</div>");
}

$locationsQuery = "SELECT DISTINCT location FROM photographs";
$locationsResult = mysqli_query($connect, $locationsQuery);

if (!$locationsResult) {
    die("<div>Error fetching locations: " . mysqli_error($connect) . "</div>");
}

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
    form {
        margin: 20px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #ffffff;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    form select, form input[type='submit'] {
        margin: 10px;
        padding: 10px;
        font-size: 16px;
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

<h1>Filter Photos</h1>
<form method='GET' action='lab09d.php'>
    <label for='year'>Choose a Year:</label>
    <select name='year' id='year'>
        <option value=''>-- All Years --</option>";
while ($row = mysqli_fetch_assoc($yearsResult)) {
    echo "<option value='" . htmlspecialchars($row['year']) . "'>" . htmlspecialchars($row['year']) . "</option>";
}
echo "
    </select>
    <label for='location'>Choose a Location:</label>
    <select name='location' id='location'>
        <option value=''>-- All Locations --</option>";
while ($row = mysqli_fetch_assoc($locationsResult)) {
    echo "<option value='" . htmlspecialchars($row['location']) . "'>" . htmlspecialchars($row['location']) . "</option>";
}
echo "
    </select>
    <input type='submit' value='Filter'>
</form>
";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'GET' && (!empty($_GET['year']) || !empty($_GET['location']))) {
    $year = !empty($_GET['year']) ? mysqli_real_escape_string($connect, $_GET['year']) : null;
    $location = !empty($_GET['location']) ? mysqli_real_escape_string($connect, $_GET['location']) : null;

    // Build the query dynamically based on selected filters
    $query = "SELECT subject, location, picture_url FROM photographs WHERE 1=1";
    if ($year) {
        $query .= " AND YEAR(date_taken) = $year";
    }
    if ($location) {
        $query .= " AND location = '$location'";
    }

    $result = mysqli_query($connect, $query);

    if (!$result) {
        die("<div>Error in query: " . mysqli_error($connect) . "</div>");
    }

    // Display results
    if (mysqli_num_rows($result) > 0) {
        echo "<h1>Filtered Photos</h1>";
        echo "<div class='gallery'>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='photo'>";
            echo "<img src='" . htmlspecialchars($row['picture_url']) . "' alt='" . htmlspecialchars($row['subject']) . "'>";
            echo "<div class='caption'>" . htmlspecialchars($row['subject']) . "<br>" . htmlspecialchars($row['location']) . "</div>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<h1>Filtered Photos</h1>";
        echo "<div class='no-photos'>No photos match the selected criteria.</div>";
    }
}

mysqli_close($connect);
?>
