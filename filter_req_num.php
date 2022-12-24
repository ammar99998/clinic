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
    <title>filterByRequestNumber</title>
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
  <li><a href="#">News</a></li>
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
    <div>
    <h2> بحث حسب رقم الفاتورة </h2>
    رقم الفاتورة : 
   
   <input type="text" placeholder="رقم الفاتورة" name="id_invoice" /><br><br>
    
      <button name="search">بحث عن فاتورة</button>
    
    
    </div>

    <div>
    <h2> بحث حسب اسم المريض </h2>
    اسم المريض : 
   
   <input type="text" placeholder="اسم المريض"  name="name_p" /><br><br>
    
      <button name="search">بحث عن فاتورة</button>
    
    
    </div>







    <div>
    <h2>بحث حسب التاريخ </h2>
    من تاريخ : 
    <input type="date"  name="date_get_start"   value="<?= date('Y-m-d', time()); ?>"/><br><br>
    إلى تاريخ: 
    <input type="date"  name="date_get_end"  value="<?= date('Y-m-d', time()); ?>" /><br><br>


      
      <button name="search_date">بحث حسب التاريخ</button>
    
    
    </div>

    
   
    </aside>
    <main >
    <table id="tbl" >
    <tr>
    <th>رقم الفاتورة</th>
    <th>رقم الإحالة</th>
    <th>اسم المشفى</th>
    <th>اسم المريض</th>
    <th>التشخيص</th>
    <th>تاريخ صدور الفاتورة من المشفى</th>
    <th>قيمة الفاتورة </th>
    
    <th>تاريخ استلام الفتورة المريض</th>
    <th>تاريخ انجاز الفاتورة</th>
    
    
    </tr>
    <?php
     if(isset($_POST['search'])){
      require_once("connect.php");
        $id_invoice=$_POST['id_invoice'];
        $showDat=$conn->prepare("SELECT * FROM invoice where id_invoice like $id_invoice ");
       
      
        $showDat->execute();
        foreach($showDat as $result){
           echo ' <tr>';
           echo '<td>'.  $result['id_invoice'].'</td>';
           echo '<td>'.  $result['request_un'].'</td>';
           echo '<td>'.  $result['hospital'].'</td>';
           echo '<td>'.  $result['name_p'].'</td>';
           echo '<td>'.  $result['description'].'</td>';
           echo '<td>'.  $result['date_inv_hospital'].'</td>';
           echo '<td>'.  $result['inv_cost'].'</td>';
           echo '<td>'.  $result['date_inv_un'].'</td>';
           echo '<td>'.  $result['date_inv_finish'].'</td>';
           echo '</tr>';
        
        }

     }



     if(isset($_POST['search_date'])){
      require_once("connect.php");
      $date_get_start=$_POST['date_get_start'];
      $date_get_end=$_POST['date_get_end'];
      $showDat=$conn->prepare("SELECT * FROM invoice where date_inv_un  BETWEEN $date_get_start AND  $date_get_end ");
     
    
      $showDat->execute();
      foreach($showDat as $result){
         echo ' <tr>';
         echo '<td>'.  $result['id_invoice'].'</td>';
         echo '<td>'.  $result['request_un'].'</td>';
         echo '<td>'.  $result['hospital'].'</td>';
         echo '<td>'.  $result['name_p'].'</td>';
         echo '<td>'.  $result['description'].'</td>';
         echo '<td>'.  $result['date_inv_hospital'].'</td>';
         echo '<td>'.  $result['inv_cost'].'</td>';
         echo '<td>'.  $result['date_inv_un'].'</td>';
         echo '<td>'.  $result['date_inv_finish'].'</td>';
         echo '</tr>';
      
      }

   }


   if(isset($_POST['name_p'])){
    require_once("connect.php");
      $name_p=$_POST['name_p'];
      $showDat=$conn->prepare("SELECT * FROM invoice where name_p like  '$name_p' ");
     
    
      $showDat->execute();
      foreach($showDat as $result){
         echo ' <tr>';
         echo '<td>'.  $result['id_invoice'].'</td>';
         echo '<td>'.  $result['request_un'].'</td>';
         echo '<td>'.  $result['hospital'].'</td>';
         echo '<td>'.  $result['name_p'].'</td>';
         echo '<td>'.  $result['description'].'</td>';
         echo '<td>'.  $result['date_inv_hospital'].'</td>';
         echo '<td>'.  $result['inv_cost'].'</td>';
         echo '<td>'.  $result['date_inv_un'].'</td>';
         echo '<td>'.  $result['date_inv_finish'].'</td>';
         echo '</tr>';
      
      }

   }


    
    ?>
    </table>
    </main>
    </form>

</body>
</html>