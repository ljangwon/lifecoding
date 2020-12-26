<?php
$dsn = "mysql:host=leanedu.net;port=3306;dbname=test;charset=utf8";
try {
    $db = new PDO($dsn, "test", "111111");
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $keyword = "%user%";
    $no = 1;

    $query = "SELECT name, phone FROM USER WHERE name LIKE ? ";

    $stmt = $db->prepare($query);
    $stmt->execute(array($keyword));
    $result = $stmt->fetchAll(PDO::FETCH_NUM);

    for($i = 0; $i < count($result); $i++) {
        printf ("%s : %s <br />", $result[$i][0], $result[$i][1]);
    }

} catch(PDOException $e) {
    echo $e->getMessage();
}
?>