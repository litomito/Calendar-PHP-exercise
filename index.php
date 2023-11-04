<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<style>

    table {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;   
        border: 1px solid #ccc;
        border-radius: 20px;
        background-color: #fff;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        max-width: 100%; 
        margin: 10px auto;
    }

    table th {
        background-color: #3498db;
        border-radius: 5px;
        color: #fff;
        font-size: 20px;
        padding: 10px;
    }

    table td {
        text-align: center;
        font-size: 18px;
        padding: 10px;     
    }

    button {
        margin: 20px;
        width: 100px;
        height: 40px;
        border: none;
        border-radius: 5px;
        background-color: #3498db;
        color: #fff;
        font-weight: bold;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    button:hover {
        background-color: #2675b0;
    }

    a {
        text-decoration: none;
        color: #fff;
    }

    table {
        display: flex;
        justify-content: center;
        text-align: center;
        margin: 30px;
        border-collapse: inherit;
    }

    .header {
        display: flex;
        justify-content: space-evenly;
    }

    .size{
        font-size: 40px;
    }
</style>

<body>
    <?php
    include 'emojiMonth.php';

    $month = isset($_GET['month']) ? $_GET['month'] : date('n');
    $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

    if ($month == 1) {
        $prevMonth = 12;
        $prevYear = $year - 1;
    } else {
        $prevMonth = $month - 1;
        $prevYear = $year;
    }

    $currEmoji = $emoji[$month]; 

    include 'namnsdag.php';

    echo("<table>");
    echo("<tr>");
    echo("<td>");
    echo("<button><a href='?month=" . $prevMonth . "&year=" . $prevYear . "'>Previous</a></button>");
    echo("</td>");
    echo("<td class='size'>");
    echo $currEmoji . " " . date('F Y', strtotime("$year-$month-01")) . " " . $currEmoji;
    echo("</td>");
    echo("<td>");
    echo("<button><a href='?month=" . (($month % 12) + 1) . "&year=" . ($month == 12 ? $year + 1 : $year) . "'>Next</a></button>");
    echo("</td>");
    echo("</tr>");
    echo("</table>");

    echo("<table>");
    echo("<tr>");

    $daysOfWeek = array('Week', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

    foreach ($daysOfWeek as $day) {
        echo("<th>");
        echo $day;
        echo("</th>");
    }
    echo("</tr>");

    $firstDayOfWeek = date('N', strtotime("$year-$month-01"));
    $emptyCells = $firstDayOfWeek - 1;

    echo("<tr>");
    echo("<td>");
    echo date("W", strtotime("$year-$month-01"));
    echo("</td>");

    for ($x = 1; $x <= date("t", strtotime("$year-$month-01")); $x++) {
        if ($x == 1) {
            for ($i = 1; $i <= $emptyCells; $i++) {
                echo("<td></td>");
            }
        }

        echo("<td");
        if (($x + $emptyCells) % 7 == 0) {
            echo(" style='color: red;'");
        }
        echo(">");

        echo date("d", strtotime("$year-$month-$x"));
        $dayOfYear = date("z", strtotime("$year-$month-$x")) + 1;
        echo " <br>" . "Dag: " . $dayOfYear . "";

        if (array_key_exists($dayOfYear, $namnsdag)) {
            $names = implode(', ', $namnsdag[$dayOfYear]);
            echo "<br>" . $names;
        }

        echo("</td>");

        if (($x + $emptyCells) % 7 == 0) {
            echo("</tr>");
            echo("<tr>");
            echo("<td>");
            echo date("W", strtotime("$year-$month-$x"));
            echo("</td>");
        }
    }

    echo("</table>");
    ?>
</body>
</html>