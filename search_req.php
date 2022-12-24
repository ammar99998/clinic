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
    <title>search request</title>
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
aside{
        
        background-color:silver;
        float:right;
        text-align:center;
        width:300px;
        padding:10px;
display:grid;
grid-template-columns:1fr;

        
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
    
        <h1>البحث حسب رقم الطلب</h1>
    رقم الطلب:   
 <input type="text" placeholder="رقم الطلب" name="req_num" id="nn" /><br/><br/><br/>
 
    <button name="search_req">البحث عن الإحالة</button><br/<br/><br/>

    <h1>البحث حسب رقم البطاقة</h1>
    رقم البطاقة:   
 <input type="text" placeholder="رقم البطاقة" name="un_nmber" /><br/><br/><br/>
 
    <button name="search_number">البحث عن الإحالة</button><br/<br/><br/>





    
    <h1>حسب حالة الإحالة</h1>
    حالة الإحالة : 
    <label for="gn">done</label>
    <input type="radio" id="stat3" name="stat_req" value="done">
    <label for="gn">canceled</label>
    <input type="radio" id="stat4" name="stat_req" value="canceled"><br>
   
    <br>
    <button name="search_state">البحث عن الإحالة</button>
   

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
     if(isset($_POST['search_req'])){
        require_once("connect.php");
          $request_num=$_POST['req_num'];
          $showDat=$conn->prepare("SELECT * FROM datainsert where request_num like $request_num ");
         
        
          $showDat->execute();
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
  
       }

       if(isset($_POST['search_state'])){
        require_once("connect.php");
          $stat_req=$_POST['stat_req'];
          $showDat=$conn->prepare("SELECT * FROM datainsert where status like '$stat_req' ");
         
        
          $showDat->execute();
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
  
       }

       if(isset($_POST['search_number'])){
        require_once("connect.php");
          $un_nmber=$_POST['un_nmber'];
          $showDat=$conn->prepare("SELECT * FROM datainsert where number_un like '$un_nmber' ");
         
        
          $showDat->execute();
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
  
       }


    ?>
    </table>
    </main>
    </form>

</div>

</body>
</html>