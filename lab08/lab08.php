<?php
ob_start(); 

$selectedImage = isset($_COOKIE['favoriteImage']) ? $_COOKIE['favoriteImage'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedImage = $_POST['image'];
    setcookie('favoriteImage', $selectedImage, time() + 86400, "/");
    header("Refresh:0");
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Greeting</title>
    <style>
        body {
            margin: 10px;
            font-family: Arial, sans-serif;
            background-color: lightpink;
            color: white;
            font-family:  Arial, Helvetica, sans-serif;
        }
        .greeting {
            height: 50vh; 
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            font-size: 20px;
            font-weight: bold;
            -webkit-text-stroke: 1px grey;
            background-size: cover; 
            background-repeat: no-repeat;
            background-position: center;
            border: green 2px;
        }

        form {
            margin-bottom: 20px;
        }
        input {
            margin: 5px;
            padding: 5px;
        }
        button {
            padding: 5px 10px;
            cursor: pointer;
            background-color: pink;
            border-radius: 40px;
            color: grey;
            transition: opacity 0.3s ease;
        }
        button:hover {
            opacity: 0.5; 
        }
        .error {
            color: red;
            font-weight: bold;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #ddd;
        }

        .top-right-image {
            position: fixed;
            top: 10px;
            right: 10px;
            opacity: 0.5; 
            max-width: 150px;
            max-height: 150px;
        }
        .current-image {
            font-size: 30px;
            font-weight: bold;
            margin-top: 20px;

        }
    </style>

<script>
    function validateForm(event) {
        const num1Element = document.getElementById('num1'); 
        const num2Element = document.getElementById('num2'); 
        const num1 = num1Element.value; 
        const num2 = num2Element.value; 
        const error = document.getElementById('error'); 
        
        if (num1 < 3 || num1 > 12 || num2 < 3 || num2 > 12) {
            error.textContent = "Both numbers must be between 3 and 12."; 
            event.preventDefault(); 
            num1Element.value = ""; 
            num2Element.value = ""; 
        } else {
            error.textContent = ""; 
        }
    }
</script>

</head>
<body>
<?php
    $currentHour = date("H");

    if ($currentHour >= 5 && $currentHour < 12) {
        $greeting = "Good Morning";
        $background = "morning.png"; 
    } elseif ($currentHour >= 12 && $currentHour < 17) {
        $greeting = "Good Afternoon";
        $background = "afternoon.png";
    } elseif ($currentHour >= 17 && $currentHour < 20) {
        $greeting = "Good Evening";
        $background = "evening.png"; 
    } else {
        $greeting = "Good Night";
        $background = "night.png"; 
    }

?>

<div class="greeting" style="background-image: url('<?php echo $background; ?>');">
    <?php echo $greeting; ?>
</div>
  <h1>Multiplication Table Generator</h1>
  <form action="problem2.php" method="POST" onsubmit="validateForm(event)">
          <label for="num1">Enter Number of Rows (3-12):</label>
          <input type="number" id="num1" name="num1"  required>
          <label for="num2">Enter Number of Columns (3-12):</label>
          <input type="number" id="num2" name="num2" required>
          <button type="submit">Generate Table</button>
          <p id="error" class="error"></p>
      </form>
      <iframe id="resultFrame" name="resultFrame" style="width:100%; height: 20px; border: 2px black;"></iframe>
      <h1>Pick Your Favorite Holiday Image</h1>
    
    <form method="POST">
        <label>
            <input type="radio" name="image" value="turkey.png" <?php echo ($selectedImage === "turkey.png" ? "checked" : ""); ?>> Turkey
        </label><br>
        <label>
            <input type="radio" name="image" value="pumpkin.gif" <?php echo ($selectedImage === "pumpkin.gif" ? "checked" : ""); ?>> Pumpkin
        </label><br>
        <label>
            <input type="radio" name="image" value="zombie.gif" <?php echo ($selectedImage === "zombie.gif" ? "checked" : ""); ?>> Zombie 
        </label><br>

        <label>
            <input type="radio" name="image" value="thanksgiving.gif" <?php echo ($selectedImage === "thanksgiving.gif" ? "checked" : ""); ?>> Thanksgiving
        </label><br><br>
        <button type="submit">Set as Favorite</button>
    </form>

    <?php if ($selectedImage): ?>
        <img src="<?php echo $selectedImage; ?>" alt="Favorite Image" class="top-right-image">
        <div class="current-image">Current image: <?php echo $selectedImage; ?></div>
    <?php else: ?>
        <p>No favorite image selected yet. Please choose one above!</p>
    <?php endif; ?>

</body>
</html>
