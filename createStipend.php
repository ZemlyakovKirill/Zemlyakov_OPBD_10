<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Stipend</title>
</head>
<?php
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query_jobless="select joblessid,joblesslastname,joblessfirstname from opbd6.jobless";
    $res=pg_query($db,$query_jobless);
?>
<form method="GET">
<div style="text-align:center;">
    <h3>Создание пособия</h3>
    <div style="font-style:italic; margin:2px;">Безработный</div>
    <select name="joblessid" required=true>
    <?php
        while($row=pg_fetch_row($res)){
            echo "<option value='$row[0]'>$row[1] $row[2]</option>";
        }
    ?>
    </select>
    <div style="font-style:italic; margin:2px;">Величина</div>
    <input type="number" name="value" min='0' placeholder="Например:1000" required=true><br>
    <div style="font-style:italic; margin:2px;">Дата начала предоставления</div>
    <input type="date" name="provisionstart" placeholder="Например:2000-01-01" required=true><br>
    <div style="font-style:italic; margin:2px;">Дата окончания предоставления</div>
    <input type="date" name="provisionfin" placeholder="Например:2000-01-01" required=true pattern="[+][0-9]{11}"><br><br>
    <input type="submit" value="Создать" name="sbmt_btn">
    <input type="button" value="Вернуться" name="red_btn" onclick="document.location='joblessList.php'">
</div>
</form>

<?php
  if (isset($_GET["sbmt_btn"])){
        $items=$_GET;
        unset($items['sbmt_btn']);
        unset($items['red_btn']);
        $query_id="select max(stipendid)+1 as maxid from opbd6.stipend";
        $id=pg_query($db,$query_id);
        $id=pg_fetch_assoc($id);
        $items['stipendid']=$id['maxid'];
        $result=pg_insert($db,'opbd6.stipend',$items);
        pg_close($db);
        header("Location:stipendList.php");
  }  
?>