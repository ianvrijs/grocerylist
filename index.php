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
    <link rel="stylesheet" href="style1.css">
    <title>Grocery list</title>
</head>
<body>
    <div class="container">
        <form method="POST" action="index.php">
            <input type="text" name="boodschap" placeholder="item*" required>
            <input type="text" name="comment" placeholder="comment">
            <input type="text" name="todo" placeholder="to do" class="todo"> <br />
            <input type="submit">
        </form>
<?php
    $boodschap = '';
    $comment = '';
    function secure($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    if($_SERVER['REQUEST_METHOD'] == "POST" && empty($_POST['todo']))
        {
        
            //define 
            $boodschap = secure($_POST['boodschap']);
            $comment = secure($_POST['comment']);
            //statement
            $sql = "INSERT INTO `boodschappen` (`boodschap`, `comment`, `datum`)
            VALUES ('". $boodschap ."', '". $comment ."', '". date("h:i:sa") . "');";
            //execute
            $oDb->execute($sql);
            $sql = "SELECT * FROM `boodschappen`";
            $aRecords = $oDb->select($sql);
        }
        else
        {
            die('error');
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