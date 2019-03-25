<?php
	$pdo = new PDO(
		"mysql::host=localhost;port=3306;dbname=test",
		"root",
		"root",
		array(
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8';",
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_PERSISTENT => true ,
		)
	);

	// foreach ($pdo->query('select * from test1') as $row) {
	//        dump($row); //你可以用 echo($GLOBAL); 来看到这些值
	//    }

	$sth = $pdo->prepare('select * from test1');
	$sth->execute();

	$result = $sth->fetchAll();
	dump($result);
	/* 获取第一列所有值 */
	// $result = $sth->fetchAll(PDO::FETCH_COLUMN, 1);
	// dump($result);
    
	// dump($res);

	function dump($info){
		echo "<pre>";
		var_dump($info);
		echo "</pre>";
	}
?>