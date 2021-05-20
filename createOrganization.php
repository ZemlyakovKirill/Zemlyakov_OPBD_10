<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Organization</title>
</head>
<form method="GET">
<div style="text-align:center;">
    <h3>Создание Организации</h3>
    <div style="font-style:italic; margin:2px;">Наименование</div>
    <input type="text" name="name" placeholder="Например:Колледж..." required=true><br>
    <div style="font-style:italic; margin:2px;">Тип</div>
    <select name="type" size=1 required=true>
        <option value="СПО">Среднее профессиональное образование</option>
        <option value="ВПО">Высшее образование</option>
        <option value="СО">Среднее образование</option>
        <option value="СО(н)">Среднее образование(не полное)</option>
    </select><br>
    <div style="font-style:italic; margin:2px;">Адрес</div>
    <input type="text" name="address" placeholder="Например: Россия,г.Москва..." required=true><br><br>
    <input type="submit" value="Создать" name="sbmt_btn">
    <input type="button" value="Вернуться" name="red_btn" onclick="document.location='organizationList.php'">
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
        $query_id="select max(organizationid)+1 as maxid from opbd6.educationalorganization";
        $id=pg_query($db,$query_id);
        $id=pg_fetch_assoc($id);
        $items['organizationid']=$id['maxid'];
        $result=pg_insert($db,'opbd6.educationalorganization',$items);
        pg_close($db);
        header("Location:organizationList.php");
  }  

?>