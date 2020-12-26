<?php
$dbh = new PDO('mysql:host=leanedu.net;dbname=opentutorials', 'root', '111111', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
switch($_GET['mode']){
	case 'create':
		$stmt = $dbh->prepare("
		DROP TABLE if exists topic;
		CREATE TABLE topic (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			title varchar(45) NOT NULL,
			description text DEFAULT NULL,
			created datetime NOT NULL,
			author_id int(11) DEFAULT NULL
		);
		");
		$stmt->execute();
		header("Location: list.php"); 
		break;		

	case 'insert':
		$stmt = $dbh->prepare("INSERT INTO topic (title, description, created) VALUES (:title, :description, now())");
		$stmt->bindParam(':title',$title);
		$stmt->bindParam(':description',$description);

		$title = $_POST['title'];
		$description = $_POST['description'];
		var_dump($stmt->execute());
		
		header("Location: list.php"); 
		break;
	case 'delete':
		$stmt = $dbh->prepare('DELETE FROM topic WHERE id = :id');
		$stmt->bindParam(':id', $id);

		$id = $_POST['id'];
		$stmt->execute();
		header("Location: list.php"); 
		break;
	case 'modify':
		$stmt = $dbh->prepare('UPDATE topic SET title = :title, description = :description WHERE id = :id');
		$stmt->bindParam(':title', $title);
		$stmt->bindParam(':description', $description);
		$stmt->bindParam(':id', $id);

		$title = $_POST['title'];
		$description = $_POST['description'];
		$id = $_POST['id'];
		$stmt->execute();
		header("Location: list.php?id={$_POST['id']}");
		break;
}
?>