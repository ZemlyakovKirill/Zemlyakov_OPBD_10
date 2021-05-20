<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Program</title>
</head>
<form method="GET">
<div style="text-align:center;">
    <h3>Создание программы</h3>
    <div style="font-style:italic; margin:2px;">Наименование</div>
    <input type="text" name="name" placeholder="Например:Программа..." required=true><br>
    <div style="font-style:italic; margin:2px;">Дата начала обучения</div>
    <input type="date" name="startdate" placeholder="Например: 01-01-2000" required=true><br>
    <div style="font-style:italic; margin:2px;">Дата окончания обучения</div>
    <input type="date" name="finishdate" placeholder="Например: 01-01-2000" required=true><br>
    <div style="font-style:italic; margin:2px;">Стоимость обучения</div>
    <input type="text" name="cost" placeholder="Например:1000" required=true><br>
    <div style="font-style:italic; margin:2px;">Тип</div>
    <input type="text" name="type" placeholder="Например:пов. квалификации" required=true><br><br>
    <input type="submit" value="Создать" name="sbmt_btn">
    <input type="button" value="Вернуться" name="red_btn" onclick="document.location='programList.php'">
</div>
</form>

<?php
  if (isset($_GET["sbmt_btn"])){
        $items=$_GET;
        unset($items['sbmt_btn']);
        unset($items['red_btn']);
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $query_id="select max(programid)+1 as maxid from opbd6.educationalprogram;";
        $id=pg_query($db,$query_id);
        $id=pg_fetch_assoc($id);
        $items['programid']=$id['maxid'];
        $result=pg_insert($db,'opbd6.educationalprogram',$items);
        pg_close($db);
        header("Location:programList.php");
  }  

?>