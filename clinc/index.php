<?php
session_start();
//include the connection from connect page.
require_once("connect.php");
//test the connection if connected or not.
	         if($conn == false){
		die ("your can not connect to database");
		                 }

						 //testing if we have post or not and including password and user in session
		 if($_SERVER["REQUEST_METHOD"]=="POST"){
			 $username=$_POST["username"];
			  $password=sha1(trim($_POST['password']));//encryption the password and delet the empty by trim method.
	
//get sql statment and include it in conn bject then put them in $showData varibable.
			 $showDat=$conn->prepare("SELECT * FROM login where username = :username AND password=:password ");
			//we use bindparam to securtiy.
			 $showDat->bindparam("username",$username);
			 $showDat->bindparam("password",$password);

			 $showDat->execute();
			 ///this command to show error ----> var_dump($showDat->errorInfo());
			 $count=$showDat->rowCount();//to return the number row 
			 $showDat=$showDat->fetch(PDO::FETCH_ASSOC);//to fetch one row from sql quiry
			
//check if the result return row or not
		if($count>0){
			if($showDat['type']=="admin"){
$_SESSION['user']=$_POST["username"];
$_SESSION['login']=true;
				header('Location:adminhome.php');//redirection the page to adminhome page.
				
			}
			
			if($showDat['type']=="clinic"){
				$_SESSION['user']=$_POST["username"];
                $_SESSION['login']=true;
				header('Location:insert.php');
				echo "user1";
			}
			if($showDat['type']=="area"){
				$_SESSION['user']=$_POST["username"];
                $_SESSION['login']=true;
				header('Location:check.php');
				echo "user2";
			} 
			
		}

		
	



		else{
			echo "<p style='color:red; text-align:center;'>Username or Password is incorrect </p> ";
		}
			 
			 
	

  }

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
        <link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
		<div class="login">
			<h1>Login</h1>
			<form action="#" method="POST">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username"  required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login">
			</form>
		</div>
	</body>
</html>