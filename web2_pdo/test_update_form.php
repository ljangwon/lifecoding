<?php
$dbh = new PDO('mysql:host=leanedu.net;dbname=test', 'root', '111111');
$stmt = $dbh->prepare('SELECT * FROM test WHERE id = :id');
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$id = $_GET['id'];
$stmt->execute();
$selected = $stmt->fetch();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
    </head>   
    <body>
        <form action="./test_process.php?mode=update" method="POST">
            <input type="hidden" name="id" value="<?=$selected['id']?>" />
            <p>제목 : <input type="text" name="title" value="<?=htmlspecialchars($selected['title'])?>"></p>
            <p>본문 : <textarea name="description" id="" cols="30" rows="10"><?=htmlspecialchars($selected['description'])?></textarea></p>
            <p><input type="submit" /></p>
        </form>
    </body>
</html>