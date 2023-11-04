<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friday</title>
    <link rel="stylesheet" href="./css/friday.css">
</head>
<body>

<form action="#" method="POST">
        <input type="date" name="date">
        <input name="send" type="submit" value="Is it friday?">
    </form>

    <?php
        if (isset($_POST['date'])) {
            $friday = $_POST['date'];   
    
            $time = strtotime($friday);
            $today = date('w', $time);
            $toFriday = 5 - $today;
    
            if ($toFriday === 0) {
                echo "<br> <img src='https://www.icegif.com/wp-content/uploads/friday-icegif.gif' alt='Friday GIF' />";
            } else {
                if ($toFriday < 0) {
                    $toFriday += 7;
                }
                echo "<p> It is $toFriday days left to friday. </p>";
            }
        }
        
    ?>
    
</body>
</html>