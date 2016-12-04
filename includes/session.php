<?php
ini_set("display_errors","1");
error_reporting(E_ALL);
date_default_timezone_set('UTC');
include("dbconnect.php");


class Session
{
	public $username;     //Username given on sign-up
	public $time;         //Time user was last active (page loaded)
	public $logged_in;    //True if user is logged in, false otherwise
	public $userinfo = array();  //The array holding all user info
	public $message;

	/* Class constructor */
	function __construct()
	{
		$this->time = time();
		$this->startSession();
	}
	
	function startSession()
	{
		global $database;  //The database connection
		session_start();   //Tell PHP to start the session
		
		/* Determine if user is logged in */
		$this->logged_in = $this->checkLogin();

	}

	function checkLogin()
	{
		global $database;  //The database connection
		/* Check if user has been remembered */

		/* Username and userid have been set and not guest */
		if(isset($_SESSION['username'])){

			/* User is logged in, set class variables */
			// $this->userinfo  = $this->getUserInfo($_SESSION['username']);
			// $this->username  = $this->userinfo['username'];
			return true;
		}
		/* User not logged in */
		else{
			return false;
		}
	}

//	function login($subuser, $subpass)
//	{
////		global $database;
//		$result = $this->confirmUserPass($subuser, $subpass);
//		if($result) { // They entered correct details
//			$this->userinfo  = $this->getUserInfo($subuser);
//			$this->username  = $_SESSION['username'] = $this->userinfo['username'];
//			setcookie("this_login", time(), time()+60*60*24*7300, '/');
//			return true;
//		} else {
//			return false;
//		}
//	}
//
	function logout()
	{
		global $database;  //The database connection
//		setcookie("last_login", $_COOKIE['this_login'], time()+60*60*24*7300, '/');
		/* Unset PHP session variables */
		unset($_SESSION['username']);
		/* Reflect fact that user has logged out */
		$this->logged_in = false;

		/* Destroy session */
		session_destroy();
	}
	
	function register($data)
	{
		global $database;
		if(!get_magic_quotes_gpc()){
			$firstname = addslashes($data['name']);
			$lastname = addslashes($data['surname']);
			$username = addslashes($data['username']);
			$password = addslashes($data['password']);  
	  	}
		else {
			$firstname=$data['name'];
			$lastname=$data['surname'];
			$username=$data['username'];
			$password=$data['password'];
		}
	  	$password = sha1($password);
	  	$sql = "SELECT * FROM users WHERE username = ? ";
	  	$stmt = $database->connection->prepare($sql);
		$stmt->execute(array($username));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
 		if(isset($result['username'])) {	
   			echo "<script type='text/javascript'> window.alert('Username already exists!'); </script>";
    		return 0;
   		} else{
			$sql = "INSERT INTO users SET name = ?, surname = ?, username = ?, password = ?";
	        $stmt = $database->connection->prepare($sql);
			$stmt->execute(array($firstname, $lastname, $username, $password));
			return 1;
   		}		
	}
		function getNormalPizza(){
		global $database;
		$sql = "SELECT pizza.* FROM pizza, category WHERE category.c_id = 1 AND category.c_id = pizza.category";
		$stmt = $database->connection->prepare($sql);
		$stmt->execute();
		$normalPizzas = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $normalPizzas;
		
	}
		function getIngredients(){
			global $database; 
			$sql = "SELECT * FROM ingredients";
			$stmt = $database->connection->prepare($sql);
			$stmt->execute();
			$ingredientsList = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $ingredientsList;

		}
		function getCategory(){
			global $database;
			$sql = "SELECT * FROM category";
			$stmt = $database->connection->prepare($sql);
			$stmt->execute();
			$categoryList = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $categoryList;

		}


		function getOneCategory($categoryId){
			global $database;
			$sql = "SELECT * FROM category WHERE c_id = :c_id";
			$stmt = $database->connection->prepare($sql);
			$stmt->bindParam('c_id', $categoryId);
			$stmt->execute();
			$cat = $stmt->fetch();

			return $cat;

		}
		function getOneIngredient($ingredientName){
			global $database;
			$sql = "SELECT * FROM ingredients WHERE i_name = :i_name";
			$stmt = $database->connection->prepare($sql);
			$stmt->bindParam('i_name', $ingredientName);
			$stmt->execute();
			$ing = $stmt->fetch();

			return $ing;
		}

		function getSize($sizeId){
			global $database;
			$sql = "SELECT * FROM size WHERE id = :id";
			$stmt = $database->connection->prepare($sql);
			$stmt->bindParam('id', $sizeId);
			$stmt->execute();
			$size = $stmt->fetch(); 

			return $size;

		}

		function addCategory($name) {
			global $database;
			try {
				$stmt = $database->connection->prepare('INSERT INTO category(c_name) VALUES(:name)');
	            
	            $stmt->bindParam(':name',$name);
	            $stmt->execute();
            } catch (Exception $e) {
				return $e->getMessage();
			}

			return 'Category '.$name.' created!';
		}


		function addSize($name, $dia) {
			global $database;
			try {
				$stmt = $database->connection->prepare('INSERT INTO size(name, diameter) VALUES(:name, :dia)');
	            
	            $stmt->bindParam(':name',$name);
	            $stmt->bindParam(':dia',$dia);
	            $stmt->execute();
            } catch (Exception $e) {
				return $e->getMessage();
			}

			return 'Size '.$name.' created!';
		}
		function addIngredient($name){
			global $database;
			try {
				$stmt = $database->connection->prepare('INSERT INTO ingredients(i_name) VALUES(:name)');
	            
	            $stmt->bindParam(':name',$name);
	            
	            $stmt->execute();
            } catch (Exception $e) {
				return $e->getMessage();
			}

			return 'Ingredient '.$name.' created!';
		}
		
		function getSizes(){
			global $database;
			$sql = "SELECT * FROM size";
			$stmt = $database->connection->prepare($sql);
			$stmt->execute();
			$sizesList = $stmt->fetchall(PDO::FETCH_ASSOC);

			return $sizesList;
		}

		function getNormalPizzaPrice(){
			global $database;
			$sql = "Select DISTINCT(price) from pizza inner join pizza_size inner join category where c_name = 'Normal Pizza'";
		$stmt = $database->connection->prepare($sql);
		$stmt->execute();
		$normalPizzasPrice = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $normalPizzasPrice;
		}

		function getPizzasForCategory($categoryId) {
			global $database;
			$sql = "Select * from pizza where Category = :category_id";

			$stmt = $database->connection->prepare($sql);
			$stmt->bindParam('category_id', $categoryId);
			$stmt->execute();
			$pizzas = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $pizzas;
		}

		function getPizzas() {
			global $database;
			$sql = "Select * from pizza";

			$stmt = $database->connection->prepare($sql);
			$stmt->execute();
			$pizzas = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $pizzas;
		}

		function getPizza($pizzaId) {
			global $database;
			$sql = "Select * from pizza WHERE p_id = :p_id";

			$stmt = $database->connection->prepare($sql);
			$stmt->bindParam('p_id', $pizzaId);
			$stmt->execute();
			$pizza = $stmt->fetch();

			return $pizza;
		}

		function deletePizza($pizzaId) {
			global $database;
			$sql = "DELETE from pizza WHERE p_id = :p_id";
			try {
				$stmt = $database->connection->prepare($sql);
				$stmt->bindParam('p_id', $pizzaId);
				$stmt->execute();
			} catch (Exception $e) {
				return $e->getMessage();
			}

			return 'Pizza successfully deleted!';
		}

		function deleteSize($sizeId) {
			global $database;
			$sql = "DELETE from size WHERE id = :id";
			try {
				$stmt = $database->connection->prepare($sql);
				$stmt->bindParam('id', $sizeId);
				$stmt->execute();
			} catch (Exception $e) {
				return $e->getMessage();
			}

			return 'Size successfully deleted!';
		}


		function deleteCategory($categoryId) {
			global $database;
			$sql = "DELETE from category WHERE c_id = :c_id";
			try {
				$stmt = $database->connection->prepare($sql);
				$stmt->bindParam('c_id', $categoryId);
				$stmt->execute();
			} catch (Exception $e) {
				return $e->getMessage();
			}

			return 'Category successfully deleted!';
		}
		function deleteIngredient($ingredientName) {
			global $database;
			$sql = "DELETE from ingredients WHERE i_name = :i_name";
			try {
				$stmt = $database->connection->prepare($sql);
				$stmt->bindParam('i_name', $ingredientName);
				$stmt->execute();
			} catch (Exception $e) {
				return $e->getMessage();
			}

			return 'Ingredient successfully deleted!';
		}



		function getPizzaPrices($pizzaId) {
			global $database;
			$sql = "SELECT DISTINCT(size.name), pizza_size.price FROM size, pizza, pizza_size WHERE pizza_size.pizza = :pizza_id AND size.id = pizza_size.size";

			$stmt = $database->connection->prepare($sql);
			$stmt->bindParam('pizza_id', $pizzaId);
			$stmt->execute();
			$sizes = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $sizes;
		}

		function getPizzaIngredients($pizzaId) {
			global $database;
			$sql = "SELECT ingredients.i_name FROM pizza, ingredients, pizza_ingredient WHERE pizza_ingredient.pizza = pizza.p_id AND pizza.p_id = :pizza_id AND pizza_ingredient.ingredient = ingredients.i_name";

			$stmt = $database->connection->prepare($sql);
			$stmt->bindParam('pizza_id', $pizzaId);
			$stmt->execute();
			$i = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $i;
		}

		

	function confirmUserPass($username, $password){
		global $database;
		if(!get_magic_quotes_gpc()) {
			$username = addslashes($username);
		}
		$query = "SELECT password FROM users WHERE username = ?";
		$stmt = $database->connection->prepare($query);
		$stmt->execute(array($username));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$password = stripslashes($password);
		$sqlpass = sha1($password);
		
		if($sqlpass == $result['password']) {
			return true;
		} else {
			return false;
		}
	}
	
	// function getUserInfo($username){
	// 	global $database;
	// 	$sql = "SELECT * FROM users WHERE username = ?";
	// 	$stmt = $database->connection->prepare($sql);
	// 	$stmt->execute(array($username));
	// 	$dbarray = $stmt->fetch(PDO::FETCH_ASSOC);  
	// 	/* Error occurred, return given name by default */
	// 	$result = count($dbarray);
	// 	if(!$dbarray || $result < 1){
	// 		return NULL;
	// 	}
	// 	/* Return result array */
	// 	return $dbarray;
	// }
	function getUserPosts(){
		global $database;
		$sql = "SELECT * from Postimet";
		$stmt = $database->connection->prepare($sql);
		$stmt->execute();
		$posts = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $posts;
	}
	function getServices(){
		global $database;
		$sql = "SELECT * from Services";
		$stmt = $database->connection->prepare($sql);
		$stmt->execute();
		$posts = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $posts;
	}

	function setMessage($message)
	{
		$_SESSION['message'] = $message;
	}
	
	function getMessage()
	{
		if(isset($_SESSION['message'])) {
			$message = $_SESSION['message'];
			unset($_SESSION['message']);
			return $message;
		} else {
			return false;
		}
	}
}

$session = new Session();
?>