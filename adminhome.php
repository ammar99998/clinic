<?php
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['login'])){
echo "Welcome : " . $_SESSION['user'];

}
else{
    header('Location:index.php');
}
if(isset($_POST['logout'])){
    session_unset();
    header('Location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <style>
ul {
  float:left;
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;

height:38px;
width:100%;
}

li {
  float: left;
}

li a {
 display: block;
   color: white;
  text-align: center;
  padding:10px 10px;
  text-decoration: none;
}

/* Change the link color to #111 (black) on hover */
li a:hover {
  background-color: #111;
}
.img-sing{
  float:right;

}
.sing{
  float:right;
 
}
.dropdown{
  display: none;
  position:absolute;
  margin:0;
}

.list:hover .dropdown{
  display:block;
  background-color: #333;
  width:64px;


}


    </style>
</head>
<body dir="rtl">

<ul>
  <li><a href="adminhome.php">Home</a></li>
  <li><a href="insert-admin.php">Requests</a></li>

  <li><a href="invoice-admin.php">invoice</a></li>


  <li class="list"><a href="#">Search</a>
  <div class="dropdown">
 <a href="filter_req_num.php">invoice</a>
 <a href="search_req.php">request</a>
</div>
</li>

  <li><a href="edite-user.php">editeUser</a></li>
  <li class="sing" ><?php
echo "<form method='POST'>
<button type='submit' style='margin: 1;background-color: #4CAF50;border: none; color: white;
padding: 10px 10px;text-align: center;' name='logout'>Logout</button>
</form>";
?></li>
<li class="img-sing" >
<img  class="logo" alt="logo" src="img/user.png">
</li>

</ul> 



    
</body>
</html>