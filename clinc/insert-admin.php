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
    <title>InsertData</title>
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
    رقم البطاقة : 
   
 <input type="text" placeholder="رقم البطاقة" name="number_un" id="nn" required/><br>
 رقم الطلب : 
    <input type="text" placeholder="رقم الطلب" name="number_req" id="n_req" required/><br>
   
   اسم المريض :
    <input type="text" placeholder="اسم المريض" name="name_p" id="n1" required/><br>
    العمر : 
    <input type="text" placeholder="العمر"  name="age_p" id="n2" required/><br>
    الجنس : 
    <input type="radio" id="gn1" name="gen_p" value="Male">
    <label for="gn">Male</label>
    <input type="radio" id="gn2" name="gen_p" value="Female">
    <label for="gn">Female</label>
    تاريخ الإحالة : 
    <input type="date"  name="date_p" id="n3"  value="<?= date('Y-m-d', time()); ?>" required/><br>
    التشخيص:
    <textarea row="50"  column="20" name="desc_p" id="n4"></textarea><br>
    تاريخ تسليم الأوراق للمريض : 
    <input type="date"  name="date_get" id="n5"  value="<?= date('Y-m-d', time()); ?>" required/><br>

    <button name="add">اضافة إحالة</button>
    <button name="update">تعديل احالة</button>
    <button name="delete">حذف احالة</button>
    <button name="upd_req">تسليم الأحالة للمريض</button>
    </aside>
    <main >
    <table id="tbl" >
    <tr>
    <th></th>
    <th>رقم البطاقة</th>
    <th>اسم المريض</th>
    <th>العمر</th>
    <th>الجنس</th>
    <th>التشخيص</th>
    <th>تاريخ الإحالة</th>
    <th>رقم الطلب</th>
    <th>حالة الإحالة</th>
    <th>تاريخ  تدقيق الإحالة</th>
    <th>ملاحظات  على الإحالة </th>
    <th>تاريخ تسليم الأحالة للمريض</th>
    
    
    </tr>
    <?php
    require_once("connect.php");
    //to get the data from database 
    $user=$_SESSION['user'];
    $showDat=$conn->prepare("SELECT * FROM datainsert where user= '$user' ORDER BY id_service DESC LIMIT 25  ");
    $showDat->execute();

    //to show the data by table in the page.
    foreach($showDat as $result){
       echo ' <tr>';
       echo '<td>'.  "<input type='radio' name='rad-check' id='rr' />".'</td>';
       echo '<td>'.  $result['number_un'].'</td>';
       echo '<td>'.  $result['name_p'].'</td>';
       echo '<td>'.  $result['age'].'</td>';
       echo '<td>'.  $result['gender'].'</td>';
       echo '<td>'.  $result['description_P'].'</td>';
       echo '<td>'.  $result['date_service'].'</td>';
       echo '<td>'.  $result['request_num'].'</td>';
       echo '<td>'.  $result['status'].'</td>';
       echo '<td>'.  $result['date_of_check'].'</td>';
       echo '<td>'.  $result['notice'].'</td>';
       echo '<td>'.  $result['req_give_date'].'</td>';

       echo '</tr>';
    
    
    }
    
    ?>
    
    </table>
    </main>
    </form>

</div>
    

<?php
  require_once("connect.php");
//this page to add requred.
 if(isset($_POST['add'])){
   
 $number_un=$_POST['number_un'];
    $name_p=$_POST['name_p'];
    $number_req=$_POST['number_req'];
 
    $age_p=$_POST['age_p'];
    $gen_p=$_POST['gen_p'];
   $desc_p=$_POST['desc_p'];
 $date_p=$_POST['date_p'];

   $user=$_SESSION['user'];
   
  $addDat=$conn->prepare("INSERT INTO datainsert(number_un,name_p,age,gender,description_P,date_service,request_num,user ) VALUES (:number_un,:name_p,:age_p,:gen_p, :desc_p, :date_p ,:number_req,:user)");

 $addDat->bindParam("number_un",$number_un);
    $addDat->bindParam("name_p",$name_p);
    $addDat->bindParam("number_req",$number_req);
     $addDat->bindParam("age_p",$age_p);
    $addDat->bindParam("gen_p",$gen_p);
   $addDat->bindParam("desc_p",$desc_p);
  $addDat->bindParam("date_p",$date_p);
  $addDat->bindParam("user",$user);

   if($addDat->execute()) {
       echo "تم اضافة البيانات بنجاح";
    
       header('Location:insert.php');

   }else{
    echo "فشل اضافة ";
    header('Location:insert.php');
 
   }

 
}

//to update required after click the button
if(isset($_POST['update'])){
   
    $number_un=$_POST['number_un'];

       $name_p=$_POST['name_p'];
       $age_p=$_POST['age_p'];
       $gen_p=$_POST['gen_p'];
      $desc_p=$_POST['desc_p'];
    $date_p=$_POST['date_p'];
   
    
      
     $addDat=$conn->prepare("UPDATE datainsert SET number_un=:number_un,name_p=:name_p,age=:age_p,gender=:gen_p,description_P= :desc_p,date_service=:date_p   WHERE number_un= $number_un" );
   
    $addDat->bindParam("number_un",$number_un);
       $addDat->bindParam("name_p",$name_p);
        $addDat->bindParam("age_p",$age_p);
       $addDat->bindParam("gen_p",$gen_p);
      $addDat->bindParam("desc_p",$desc_p);
     $addDat->bindParam("date_p",$date_p);
   
      if($addDat->execute()) {
          echo "تم اضافة البيانات بنجاح";
       
          echo"<script> location.replace('insert.php'); </script>";
          
   
      }else{
       echo "فشل اضافة ";
       echo"<script> location.replace('insert.php'); </script>";
    
      }
   
    
   }
   //to delete required after click the button

if(isset($_POST['delete'])){
    $number_un=$_POST['number_un'];
    
    $delDat=$conn->prepare("DELETE FROM datainsert WHERE number_un=$number_un;");


   
      if( $delDat->execute()) {
          echo "تم حذف البيانات بنجاح";
       
      
          echo"<script> location.replace('insert.php'); </script>";
   
      }else{
       echo "فشل حذف البيانات ";
     
       echo"<script> location.replace('insert.php'); </script>";
    
      }


}
if(isset($_POST['upd_req'])){
    $number_un=$_POST['number_un'];
    $req_give_date=$_POST['date_get'];
   
    
      
     $addDat=$conn->prepare("UPDATE datainsert SET req_give_date= '$req_give_date'  WHERE number_un= $number_un" );
   
    $addDat->bindParam("number_un",$number_un);
  
     $addDat->bindParam("req_give_date",$req_give_date);
   
      if($addDat->execute()) {
          echo "تم التعديل البيانات بنجاح";
       
          
          echo"<script> location.replace('insert.php'); </script>";
   
      }else{
       echo "فشل التعديل ";
      
       echo"<script> location.replace('insert.php'); </script>";
    
      }
   
    
   }



?>
<script>
//to bind data on table by the data in input box.
var tab=document.getElementById('tbl');
for(var x=1;x<=tab.rows.length;x++){
    tab.rows[x].onclick=function(){
      this.cells[0].querySelector('input[type="radio"]').checked=true;
        document.getElementById('nn').value=this.cells[1].innerHTML;
        document.getElementById('n1').value=this.cells[2].innerHTML;
        document.getElementById('n2').value=this.cells[3].innerHTML;
       var  gg=this.cells[4].innerHTML;
       if(gg=='Male'){
        document.getElementById("gn1").checked = true;
       }
       
       if(gg=='Female'){
        document.getElementById("gn2").checked = true;
       }
       
       document.getElementById('n_req').value=this.cells[7].innerHTML;
       document.getElementById('n4').value=this.cells[5].innerHTML;
       document.getElementById('n5').value=this.cells[11].innerHTML;

       
    }
}

</script>
</body>
</html>