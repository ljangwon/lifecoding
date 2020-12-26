<?php
$dbh = new PDO('mysql:host=leanedu.net;dbname=test', 'root', '111111');
$stmt = $dbh->prepare('SELECT * FROM test');
$stmt->execute();
$list = $stmt->fetchAll();
if(!empty($_GET['id'])) {
	$stmt = $dbh->prepare('SELECT * FROM test WHERE id = :id');
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$id = $_GET['id'];
	$stmt->execute();
	$selected = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<style type="text/css">
			a {
				text-decoration: none;
			}
			body {
				font-size: 1em;
				font-family: dotum;
				line-height: 1.6em;
			}
			header {
				border-bottom: 1px solid #ccc;
				padding: 20px 0;
			}
			nav {
				float: left;
				margin-right: 20px;
				min-height: 1000px;
				min-width:150px;
				border-right: 1px solid #ccc;
			}
			nav ul {
				list-style: none;
				padding-left: 0;
				padding-right: 20px;
				padding-top: 10px;
			}
			article {
				float: left;
			}
			.description{
				width:200px;
			}
		</style>
	</head>

	<body id="body">
		<div>
			<nav>
				<ul>
					<?php
					foreach($list as $row) {
						echo "<li><a href=\"?id={$row['id']}\">".htmlspecialchars($row['title'])."</a></li>";         }
					?>
				</ul>
				<ul>
					<li><a href="test_insert_form.php">추가</a></li>
				</ul>
			</nav>
			<article>
				<?php
				if(!empty($selected)){
				?>
				<h2><?=htmlspecialchars($selected['title'])?></h2>
				<div class="description">
					<?=htmlspecialchars($selected['description'])?>
				</div>
				<div>
					<a href="test_update_form.php?id=<?=$selected['id']?>">수정</a>
					<form method="POST" action="test_process.php?mode=delete">
						<input type="hidden" name="id" value="<?=$selected['id']?>" />
						<input type="submit" value="삭제" />
					</form>
				</div>
				<?php
				}
				?>
			</article>
		</div>
	</body>
</html>