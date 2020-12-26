<?php
$dbh = new PDO('mysql:host=leanedu.net;dbname=test', 'root', '111111', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
switch($_GET['mode']){
	case 'create':
		$stmt = $dbh->prepare("
		DROP TABLE if exists test;
		CREATE TABLE test (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			title varchar(45) NOT NULL,			
			description text DEFAULT NULL,
			cat varchar(5) DEFAULT NULL,
			total_q_num int(6) UNSIGNED DEFAULT NULL,
			total_point varchar(5) DEFAULT NULL,
			created datetime NOT NULL,
			creater_id INT(6) UNSIGNED DEFAULT NULL
		);
		");
		$stmt->execute();
		header("Location: test_list.php"); 
		break;		

	case 'insert':
		$stmt = $dbh->prepare("INSERT INTO test (title, description, cat, total_q_num, total_point, created, creater_id ) VALUES (:title, :description, null, null, null, now(), null)");
		$stmt->bindParam(':title',$title);
		$stmt->bindParam(':description',$description);

		$title = $_POST['title'];
		$description = $_POST['description'];
		var_dump($stmt->execute());
		
		header("Location: test_list.php"); 
		break;
	case 'delete':
		$stmt = $dbh->prepare('DELETE FROM test WHERE id = :id');
		$stmt->bindParam(':id', $id);

		$id = $_POST['id'];
		$stmt->execute();
		header("Location: test_list.php"); 
		break;
	case 'update':
		$stmt = $dbh->prepare('UPDATE test SET title = :title, description = :description WHERE id = :id');
		$stmt->bindParam(':title', $title);
		$stmt->bindParam(':description', $description);
		$stmt->bindParam(':id', $id);

		$title = $_POST['title'];
		$description = $_POST['description'];
		$id = $_POST['id'];
		$stmt->execute();
		header("Location: test_list.php?id={$_POST['id']}");
		break;
}
?>