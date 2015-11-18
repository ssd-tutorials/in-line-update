<?php
if (!empty($_POST['key']) && !empty($_POST['value']) && !empty($_POST['id'])) {
	
	$keys = array('full_name', 'comment');
	
	$key = $_POST['key'];
	$value = $_POST['value'];
	$id = $_POST['id'];
	
	if (in_array($key, $keys)) {
		
		try {
		
			$objDb = new PDO('mysql:host=localhost;dbname=comments', 'root', 'password');
			$objDb->exec('SET CHARACTER SET utf8');
			
			$sql = "UPDATE `comments`
					SET `{$key}` = ?
					WHERE `id` = ?";
			$statement = $objDb->prepare($sql);
			
			if ($statement->execute(array($value, $id))) {
				echo json_encode(array('error' => false));
			} else {
				echo json_encode(array('error' => true, 'case' => 4));
			}
			
		} catch(Exception $e) {
			echo json_encode(array('error' => true, 'case' => 3));
		}
		
	} else {
		echo json_encode(array('error' => true, 'case' => 2));
	}

} else {
	echo json_encode(array('error' => true, 'case' => 1));
}