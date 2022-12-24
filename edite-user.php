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
    <title>Users</title>
</head>
<style>
    body{
        background-color:whitesmoke;

    }
    main{
        float:right;
        border:1px solid gray;
        padding:5px;
    }
    input{
        padding:4px;
        border:2px solid black;
        text-align:center;
        font-size:17px;
    }
    textarea{
        padding:4px;
        border:2px solid black;
        text-align:center;
        font-size:17px;
    }
    aside{
        
        background-color:silver;
        float:right;
        text-align:center;
        width:300px;
        padding:10px;
display:grid;
grid-template-columns:1fr;

        

       
    }
    #tbl{
width:1000px;
font-size:20px;
text-align:center;


    }
    #tbl tr:hover{

        background-color:silver;
    }
    #tbl th{
background-color:silver;

    }
    #img1{
       
        margin-right:70px;
        border: 1px solid #ddd;
        border-radius: 60%;
       
  padding: 5px;
  width: 150px;
       
    }
    textarea {
   resize: none;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
  height: 35px;
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
  padding-right:10px;
}
.sing{
  float:right;
 
}

    </style>
</head>
<body dir="rtl">

<ul>
<li><a href="adminhome.php">Home</a></li>
  
  <li><a href="#">Contact</a></li>
  <li class="sing" ><?php
echo "<form method='POST'>
<button type='submit' style='margin: 0;background-color: #4CAF50;border: none; color: white;
padding: 10px 10px;text-align: center;' name='logout'>Logout</button>
</form>";
?></li>
<li class="img-sing" >
<img  class="logo" alt="logo" src="img/user.png">
</li>

</ul>
<div id="motherdiv" >
<form method="POST" >
    <aside>
    <img src="img/logo.png" alt="الشعار" id="img1"/><br>
رقم المستخدم :   
 <input type="text" placeholder="رقم المستخدم" name="number" id="u"/><br>
  : اسم المستخدم
   
 <input type="text" placeholder="اسم المستخدم" name="username" id="u1" required/><br>
كلمة السر: 
    <input type="text" placeholder="كلمة السر" name="password" id="u2" required/><br>
   
نوع الحساب:  
  
  <select name="type" id="u3">
      <option value="clinic">Clinic</option>
      <option value="area">Area</option>
      <option value="admin">Admininstor</option>
</select><br>

    <button name="add">اضافة مستخدم</button>
    <button name="update">تعديل مستخدم</button>
    <button name="delete">حذف مستخدم</button>
   
    </aside>
    <main >
    <table id="tbl" >
    <tr>
    <th></th>
    <th>رقم المستخدم</th>
    <th>اسم المستخدم</th>
    <th>كلمة السر</th>
    <th>النوع</th>

    </tr>
    <?php
  require_once("connect.php");
    $showDat=$conn->prepare("SELECT * FROM login ");
    $showDat->execute();
    foreach($showDat as $result){
       echo ' <tr>';
       echo '<td>'.  "<input type='radio' name='rad-check' id='rr' />".'</td>';
       echo '<td>'.  $result['id'].'</td>';
       echo '<td>'.  $result['username'].'</td>';
       echo '<td>'.  $result['password'].'</td>';
       echo '<td>'.  $result['type'].'</td>';
      

       echo '</tr>';
    
    
    }
    
    ?>
    
    </table>
    </main>
    </form>

</div>

<?php
 require_once("connect.php");
 if(isset($_POST['add'])){
   
 $username=$_POST['username'];
 $password=sha1(trim($_POST['password']));
    $type=$_POST['type'];

   
    $showDat=$conn->prepare("SELECT * FROM login where username = :username  ");
    $showDat->bindparam("username",$username);
    $showDat->execute();
    $count=$showDat->rowCount();
                 if($count>0){
                echo "<h1 style='color:red;text-align: center;'>This username is existing</h1>";
                 
                       }
                else{

                    $addDat=$conn->prepare("INSERT INTO login( username, password, type) VALUES (:username,:password,:type)");

                    $addDat->bindParam("username",$username);
                       $addDat->bindParam("password",$password);
                       $addDat->bindParam("type",$type);
                        
                   
                      if($addDat->execute()) {
                          echo "تم اضافة البيانات بنجاح";
                       
                          echo"<script> location.replace('edite-user.php'); </script>";
                   
                      }else{
                       echo "فشل اضافة ";
                       echo"<script> location.replace('edite-user.php'); </script>";
                    
                      }

                }


 
}
if(isset($_POST['update'])){
    $number=$_POST['number'];
    $username=$_POST['username'];
    $password=sha1(trim($_POST['password']));
    $type=$_POST['type'];
   
    
      
     $addDat=$conn->prepare("UPDATE login SET username='$username',password= '$password',type= '$type' WHERE id=$number " );
   
    $addDat->bindParam("username",$username);
       $addDat->bindParam("password",$password);
        $addDat->bindParam("type",$type);
        if($addDat->execute()) {
            echo "تم اضافة البيانات بنجاح";
         
            echo"<script> location.replace('edite-user.php'); </script>";
     
        }else{
         echo "فشل اضافة ";
         echo"<script> location.replace('edite-user.php'); </script>";
      
        }
   
    
   }

if(isset($_POST['delete'])){
    $username=$_POST['username'];
    
    $delDat=$conn->prepare("DELETE FROM login WHERE username='$username';");


    if( $delDat->execute()) {
        echo "تم حذف البيانات بنجاح";
     
    
        echo"<script> location.replace('edite-user.php'); </script>";
 
    }else{
     echo "فشل حذف البيانات ";
   
     echo"<script> location.replace('edite-user.php'); </script>";
  
    }


}

    
   



?>
<script>

var tab=document.getElementById('tbl');
for(var x=1;x<=tab.rows.length;x++){
    tab.rows[x].onclick=function(){
    
        this.cells[0].querySelector('input[type="radio"]').checked=true;
        document.getElementById('u').value=this.cells[1].innerHTML;
        document.getElementById('u1').value=this.cells[2].innerHTML;
        document.getElementById('u2').value="";
        document.getElementById('u3').value=this.cells[4].innerHTML;
        

       
    }
}

</script>  



</body>
</html>