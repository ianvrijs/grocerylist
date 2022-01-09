<?php
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'db.php');

$oDb = new db('localhost', 'grocery', 'root', '');
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Grocery list</title>
</head>
<body>
    <div class="container">
        <form method="POST" action="index.php">
            <input type="text" name="boodschap" placeholder="item*" required>
            <input type="text" name="comment" placeholder="comment"> <br />
            <input type="submit">
        </form>
<?php
    if(isset($_POST))
    {
        //define 
        $boodschap = $_POST['boodschap'];
        $comment = $_POST['comment'];
        //statement
        $sql = "INSERT INTO `boodschappen` (`boodschap`, `comment`, `datum`)
        VALUES ('". $boodschap ."', '". $comment ."', '". date("h:i:sa") . "');";
        //execute
        $oDb->execute($sql);
        $sql = "SELECT * FROM `boodschappen`";
        $aRecords = $oDb->select($sql);
    }
        echo ' <h1>Grocery list</h1>';
        foreach($aRecords as $aRecords) 
        {
            echo "<b>". $aRecords['boodschap'] . "<br /></b>" . "<p>" . $aRecords['comment'] . "</p><br />";
        }
        ?>
    </div>
</body>
</html>