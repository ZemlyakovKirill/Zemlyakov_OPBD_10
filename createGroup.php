<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Group</title>
</head>
<?php
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query_group="select * from opbd6.educationalprogram";
    $res=pg_query($db,$query_group);
?>
<form method="GET">
<div style="text-align:center;">
    <h3>Создание группы</h3>
    <div style="font-style:italic; margin:2px;">Образовательная группа</div>
    <select name="programid" required=true>
    <?php
        while($row=pg_fetch_assoc($res)){
            echo "<option value='$row[programid]'>$row[name] $row[cost]</option>";
        }
    ?>
    </select>
    <div style="font-style:italic; margin:2px;">Максимальное кол-во студентов</div>
    <input type="number" name="maxquantitystudents" min='0' placeholder="Например:100" required=true><br>
    <div style="font-style:italic; margin:2px;">Текущее кол-во студентов</div>
    <input type="number" name="studentcount" min='0' placeholder="Например:10" required=true><br><br>
    <input type="submit" value="Создать" name="sbmt_btn">
    <input type="button" value="Вернуться" name="red_btn" onclick="document.location='groupList.php'">
</div>
</form>

<?php
  if (isset($_GET["sbmt_btn"])){
        $items=$_GET;
        unset($items['sbmt_btn']);
        unset($items['red_btn']);
        $query_id="select max(groupid)+1 as maxid from opbd6.educationalgroup";
        $id=pg_query($db,$query_id);
        $id=pg_fetch_assoc($id);
        $items['groupid']=$id['maxid'];
        $result=pg_insert($db,'opbd6.educationalgroup',$items);
        pg_close($db);
        header("Location:groupList.php");
  }  
?>