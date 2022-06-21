<?php
if (isset($_POST['firstname']) && isset($_POST['lastname'])) {
	// забираем данные из формы по значению name
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];

	// дать некоторые данные для подключения к базе данных 
	$db_host = "localhost";
	$db_user = "root";
	$db_password = "";
	$db_base = "user";
	$db_table = "name";
}
	try {
		// подключаемся к базе данных
		$db = new PDO ("mysql:host=$db_host; dbname=$db_base", $db_user, $db_password);
		
		// собрать данные для запроса
		$data = array('firstname' => $firstname, 'lastname' => $lastname);
		// подготовка sql запроса
		$query = $db -> prepare("INSERT INTO $db_table (firstname, lastname) values (:firstname, :lastname)");
		// выполнить запрос к БД вместе с новыми данными из формы
		$query -> execute($data);
		$result = true;
	} catch (PDOException $e) {
		// если есть ошибка соединения или выполнения запроса, то выводим ошибку на экран
		print "Ошибка: " . $e -> getMessage() . "</br>";
	}
		if ($result) {
			echo "Успех. Информация занесена в БД";
		}

?>