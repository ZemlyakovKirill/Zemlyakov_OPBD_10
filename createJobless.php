<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Jobless</title>
</head>
<form method="GET">
<div style="text-align:center;">
    <h3>Создание безработного</h3>
    <div style="font-style:italic; margin:2px;">Фамилия</div>
    <input type="text" name="last_name" placeholder="Например:Иванов" required=true><br>
    <div style="font-style:italic; margin:2px;">Имя</div>
    <input type="text" name="first_name" placeholder="Например:Иван" required=true><br>
    <div style="font-style:italic; margin:2px;">Отчество</div>
    <input type="text" name="middle_name" placeholder="Например:Иванович" required=false><br>
    <div style="font-style:italic; margin:2px;">Номер телефона</div>
    <input type="tel" name="phone" placeholder="Например:+7999...)" required=true pattern="[+][0-9]{11}"><br>
    <div style="font-style:italic; margin:2px;">Адрес</div>
    <input type="text" name="address" placeholder="Например: Россия,г.Москва..."  required=false><br>
    <div style="font-style:italic; margin:2px;">Паспорт</div>
    <input type="text" name="passport" placeholder=" Например:4020202020"  required=true><br>
    <div style="font-style:italic; margin:2px;">Опыт работы</div>
    <input type="number" name="exp" placeholder="Work Experience" min="0" max="100"  required=true><br><br>
    <input type="submit" value="Создать" name="sbmt_btn">
    <input type="button" value="Вернуться" onclick="document.location='joblessList.php'">
</div>
</form>
<?php
  if (isset($_GET["sbmt_btn"])){
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $query_id="select max(joblessid)+1 as maxid from opbd6.jobless";
        $id=pg_query($db,$query_id);
        $id=pg_fetch_assoc($id);
        $query="insert into opbd6.jobless (joblessid,joblessaddress,joblesslastname,joblessphone,joblesspassport,workexperience,joblessfirstname,joblessmiddlename)
              values (".$id['maxid'].",'"
              .$_GET['address']."','"
              .$_GET['last_name']."','"
              .$_GET['phone']."','"
              .$_GET['passport']."',"
              .$_GET['exp'].",'"
              .$_GET['first_name']."','"
              .$_GET['middle_name']."')";
        $result=pg_query($db,$query);
        pg_close($db);
        header("Location:joblessList.php");
  }  

?>