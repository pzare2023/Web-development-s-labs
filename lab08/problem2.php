<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = intval($_POST['num1']);
    $num2 = intval($_POST['num2']);

    if ($num1 < 3 || $num1 > 12 || $num2 < 3 || $num2 > 12) {
        echo "<p style='color: red; font-weight: bold;'>Error: Both numbers must be between 3 and 12. Please go back and correct your input.</p>";
        exit();
    }

    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Multiplication Table</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                color: #333;
                padding: 20px;
                background-color: lightpink;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                background-color: white;
            }
            th, td {
                border: 1px solid #000;
                text-align: center;
                padding: 10px;
            }
            th {
                background-color: #ddd;
            }
            h1{
                color: white;
                display: flex;

                justify-content: center;
                align-items: center;
                text-align: center;
            }

        </style>
    </head>
    <body>
        <h1>Multiplication Table ($num1 × $num2)</h1>
        <table>";
    for ($i = 1; $i <= $num1; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= $num2; $j++) {
            echo "<td>" . ($i * $j) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>
    </body>
    </html>";
}
?>
