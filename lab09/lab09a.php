<?php
$connect = mysqli_connect("localhost", "pzare", "jfahrbe0", "pzare") or die(mysqli_error());

echo "
<style>
    div.p{
      justify-content: center;
      align-items: center;
      text-align: center;
      padding-top: 10px;
      margin-top: 10px;
    }
    h1 {
      text-align: center;
      margin-top: 50px;
      font-size: 24px;
      color: #4CAF50;
  }
  body {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    font-family: Arial, sans-serif;
}


    table {
        margin: 50px auto;
        border-collapse: collapse;
        text-align: center;
        background-color: #ffffff;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;


    }
    th, td {
        border: 1px solid #ddd;
        padding: 10px;
    }
    th {
        background-color: #4CAF50;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
    img {
        max-width: 150px;
        height: auto;
    }
</style>
";

$createTableQuery = "
CREATE TABLE IF NOT EXISTS photographs (
    picture_number INT AUTO_INCREMENT PRIMARY KEY,
    subject VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    date_taken DATE NOT NULL,
    picture_url VARCHAR(255) NOT NULL
)";

$insertDataQuery = "
INSERT INTO photographs (subject, location, date_taken, picture_url) VALUES
('Ripleys Aquarium', 'Toronto, Ontario', '2024-06-03', 'aquarium.jpeg'),
('Swan at high park', 'Toronto, Ontario', '2024-05-06', 'highpark.jpeg'),
('Whirlpool Aero Car', 'Niagara, Ontario', '2024-08-26', 'niagara.jpeg'),
('Notre-Dome Basilica of Montreal', 'Montreal, Quebec', '2024-07-05', 'notredome.jpeg'),
('Family trip to Bass Lake', 'Orilia, Ontario', '2024-08-11', 'orilia.jpeg'),
('Quebec Trip', 'Quebec City, Quebec', '2024-07-04', 'quebeccity.jpeg'),
('Ramen and Sansotei', 'Toronto, Ontario', '2024-11-20', 'ramen.jpeg'),
('TMU in Fall', 'Toronto, Ontario', '2024-10-18', 'tmu.jpeg'),
('Tulips Farm', 'Ridgeville, Ontario', '2024-05-04', 'tulips.jpeg'),
('UofT', 'Toronto, Ontario', '2024-11-06', 'uoft.jpeg')
";

if (mysqli_query($connect, $insertDataQuery)) {
    echo "<div class='p'>Data inserted into 'photographs' table successfully.</div>";
} else {
    echo "<div class='p'>Error inserting data: " . mysqli_error($connect) . "</div>";
}

$query = "SELECT * FROM photographs LIMIT 10";
$result = mysqli_query($connect, $query);


if (mysqli_num_rows($result) > 0) {
    echo "<h1>Photographs Gallery</h1>";
    echo "<table border='1' >";
    echo "<tr>
            <th>Picture Number</th>
            <th>Subject</th>
            <th>Location</th>
            <th>Date Taken</th>
            <th>Picture</th>
          </tr>";
    

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['picture_number'] . "</td>";
        echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
        echo "<td>" . htmlspecialchars($row['location']) . "</td>";
        echo "<td>" . htmlspecialchars($row['date_taken']) . "</td>";
        echo "<td><img src='" . htmlspecialchars($row['picture_url']) . "' alt='" . htmlspecialchars($row['subject']) . "' width='150'></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No photographs found in the database.</p>";
}


mysqli_close($connect);
?>
