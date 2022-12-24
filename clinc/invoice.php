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
  <li><a href="check.php">Home</a></li>
 
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
    رقم الفاتورة : 
   
 <input type="text" placeholder="رقم الفاتورة" name="id_invoice" id="nn" required/><br>
 رقم الإحالة : 
    <input type="text" placeholder="رقم الإحالة" name="number_req" id="n_req" required/><br>
   
   اسم المشفى :
    <input type="text" placeholder="اسم المشفى" name="hosp_name" id="h_n" required/><br>
    اسم المريض :
    <input type="text" placeholder="اسم المريض" name="name_p" id="pa_name" required/><br>
   
    التشخيص:
    <textarea row="50"  column="20" name="desc_p" id="n4"></textarea><br>
    
    تاريخ اصدار الفاتورة من المشفى : 
    <input type="date"  name="d_invoice" id="d_v_h"  value="<?= date('Y-m-d', time()); ?>" required/><br>
    قيمة الفاتورة : 
    <input type="text" placeholder="قيمة الفاتورة"  name="cost" id="n2" required/><br>
    تاريخ استلام الفتورة من المريض : 
    <input type="date"  name="date_get" id="n5"  value="<?= date('Y-m-d', time()); ?>" /><br>
    تاريخ انجاز الفتورة   : 
    <input type="date"  name="date_finish" id="n6"  value="<?= date('Y-m-d', time()); ?>" /><br>
    <button name="add">اضافة فاتورة</button>
    <button name="update"> تعديل على الفاتورة</button>
    <button name="update_give">استلام فاتورة</button>
    <button name="finish">انجازالفاتورة</button>
   
    </aside>
    <main >
    <table id="tbl" >
    <tr>
    <th></th>
    <th>رقم الفاتورة</th>
    <th>رقم الإحالة</th>
    <th>اسم المشفى</th>
    <th>اسم المريض</th>
    <th>التشخيص</th>
    <th>تاريخ صدور الفاتورة من المشفى</th>
    <th>قيمة الفاتورة </th>
    
    <th>تاريخ استلام الفاتورة من المريض</th>
    <th>تاريخ انجاز الفاتورة</th>
    
    
    </tr>
    <?php
    require_once("connect.php");
   $user= $_SESSION['user'];
    $showDat=$conn->prepare("SELECT * FROM invoice where user='$user' ORDER BY id DESC LIMIT 25");
    $showDat->execute();
    foreach($showDat as $result){
       echo ' <tr>';
       echo '<td>'.  "<input type='radio' name='rad-check' id='rr' />".'</td>';
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
    
  

    require_once("connect.php");
    
    if(isset($_POST['add'])){
      
   
      $id_invoice=$_POST['id_invoice'];
        $number_req=$_POST['number_req'];
        $hosp_name=$_POST['hosp_name'];
        $name_p=$_POST['name_p'];
        $desc_p=$_POST['desc_p'];
        $d_invoice=$_POST['d_invoice'];
        
        $cost=$_POST['cost'];
        $date_get=$_POST['date_get'];
        $date_finish=$_POST['date_finish'];

$user=$_SESSION['user'];


          


$addDat=$conn->prepare("INSERT INTO invoice(id_invoice ,request_un, hospital, name_p, description, date_inv_hospital, inv_cost,user)
VALUES (:id_invoice,:number_req,:hosp_name,:name_p,:desc_p,:d_invoice,:cost,:user)") ;

$addDat->bindParam("id_invoice",$id_invoice);

  $addDat->bindParam("number_req",$number_req);
      $addDat->bindParam("hosp_name",$hosp_name);
      $addDat->bindParam("name_p",$name_p);
    $addDat->bindParam("desc_p",$desc_p);
  $addDat->bindParam("d_invoice",$d_invoice);
    $addDat->bindParam("cost",$cost);
    $addDat->bindParam("user",$user);
    if($addDat->execute()) {
        echo "تم اضافة البيانات بنجاح";
     
        echo"<script> location.replace('invoice.php'); </script>";
 
    }else{
     echo "فشل اضافة ";
     echo"<script> location.replace('invoice.php'); </script>";
  
    }

      }

       

      if(isset($_POST['update_give'])){
        $id_invoice=$_POST['id_invoice'];
        $date_get=$_POST['date_get'];
       
        
          
         $addDat=$conn->prepare("UPDATE invoice SET date_inv_un=:date_get WHERE id_invoice= $id_invoice" );
       
         $addDat->bindParam("number_req",$number_req);
      $addDat->bindParam("hosp_name",$hosp_name);
      $addDat->bindParam("name_p",$name_p);
    $addDat->bindParam("desc_p",$desc_p);
  $addDat->bindParam("d_invoice",$d_invoice);
    $addDat->bindParam("cost",$cost);
    $addDat->bindParam("user",$user);
    if($addDat->execute()) {
        echo "تم اضافة البيانات بنجاح";
     
        echo"<script> location.replace('invoice.php'); </script>";
 
    }else{
     echo "فشل اضافة ";
     echo"<script> location.replace('invoice.php'); </script>";
  
    }

      }

////update the invoice
       
      if(isset($_POST['update'])){
        $id_invoice=$_POST['id_invoice'];
        $number_req=$_POST['number_req'];
        $hosp_name=$_POST['hosp_name'];
        $name_p=$_POST['name_p'];
        $desc_p=$_POST['desc_p'];
        $d_invoice=$_POST['d_invoice'];
        
        $cost=$_POST['cost'];
        $date_get=$_POST['date_get'];
        $date_finish=$_POST['date_finish'];


       
       
          
         $addDat=$conn->prepare("UPDATE invoice SET  request_un=:number_req, hospital=:hosp_name, name_p=:name_p, description=:desc_p, date_inv_hospital=:d_invoice, inv_cost=:cost,user=:user WHERE id_invoice= $id_invoice" );
      
         $addDat->bindParam("number_req",$number_req);
      $addDat->bindParam("hosp_name",$hosp_name);
      $addDat->bindParam("name_p",$name_p);
    $addDat->bindParam("desc_p",$desc_p);
  $addDat->bindParam("d_invoice",$d_invoice);
    $addDat->bindParam("cost",$cost);
    $addDat->bindParam("user",$user);
    if($addDat->execute()) {
        echo "تم اضافة البيانات بنجاح";
     
        echo"<script> location.replace('invoice.php'); </script>";
 
    }else{
     echo "فشل اضافة ";
     echo"<script> location.replace('invoice.php'); </script>";
  
    }

      }





       if(isset($_POST['finish'])){
        $id_invoice=$_POST['id_invoice'];
        $date_finish=$_POST['date_finish'];
       
        
          
         $addDat=$conn->prepare("UPDATE invoice SET  date_inv_finish=:date_finish WHERE id_invoice= :id_invoice" );
       
       $addDat->bindParam("date_finish",$date_finish);
       $addDat->bindParam("id_invoice",$id_invoice);
      
       
          if($addDat->execute()) {
              echo "تم التعديل البيانات بنجاح";
           
              echo"<script> location.replace('invoice.php'); </script>";
          
      
       
          }else{
           echo "فشل التعديل ";
           echo"<script> location.replace('invoice.php'); </script>";
        
          }
       
        
       }



    ?>


    </table>
    </main>
    </form>

</div>

<script>

var tab=document.getElementById('tbl');
for(var x=1;x<=tab.rows.length;x++){
    tab.rows[x].onclick=function(){

      this.cells[0].querySelector('input[type="radio"]').checked=true;
        document.getElementById('nn').value=this.cells[1].innerHTML;
        document.getElementById('n_req').value=this.cells[2].innerHTML;
        document.getElementById('h_n').value=this.cells[3].innerHTML;
      
       document.getElementById('pa_name').value=this.cells[4].innerHTML;
     
       document.getElementById('n4').value=this.cells[5].innerHTML;
       document.getElementById('d_v_h').value=this.cells[6].innerHTML;
       document.getElementById('n2').value=this.cells[7].innerHTML;
       document.getElementById('n5').value=this.cells[8].innerHTML;
       document.getElementById('n6').value=this.cells[9].innerHTML;
    }
}

</script>
</body>
</html>