<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Passage</title>
</head>
<?php
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query_group="select * from opbd6.educationalgroup g  join opbd6.educationalprogram p on g.programid=p.programid;";
    $query_jobless="select * from opbd6.jobless;";
    $res_group=pg_query($db,$query_group);
    $res_jobless=pg_query($db,$query_jobless);
?>
<form method="GET">
<div style="text-align:center;">
    <h3>Создание Прохождения</h3>
    <div style="font-style:italic; margin:2px;">Образовательная группа</div>
    <select name="groupid" required=true>
    <?php
        while($row_group=pg_fetch_assoc($res_group)){
            echo "<option value='$row_group[groupid]'>$row_group[name] $row_group[studentcount]/$row_group[maxquantitystudents] </option>";
        }
    ?>
    </select>
    <div style="font-style:italic; margin:2px;">Безработный</div>
    <select name="joblessid" required=true>
    <?php
        while($row_jobless=pg_fetch_assoc($res_jobless)){
            echo "<option value='$row_jobless[joblessid]'>$row_jobless[joblesslastname] $row_jobless[joblessfirstname]</option>";
        }
    ?>
    </select>
    <div style="font-style:italic; margin:2px;">Статус принятия в группу</div>
    <input type="checkbox"name="statusofadoption"><br>
    <div style="font-style:italic; margin:2px;">Документ об окончании</div>
    <input type="checkbox"name="completiondocument"><br><br>
    <input type="submit" value="Создать" name="sbmt_btn">
    <input type="button" value="Вернуться" name="red_btn" onclick="document.location='passageList.php'">
</div>
</form>

<?php
  if (isset($_GET["sbmt_btn"])){
        $items=$_GET;
        if(!isset($_GET['statusofadoption']))
            $items['statusofadoption']=FALSE;
        else
            $items['statusofadoption']=TRUE;
        if(!isset($_GET['completiondocument']))
            $items['completiondocument']=FALSE;
        else
            $items['completiondocument']=TRUE;
        unset($items['sbmt_btn']);
        unset($items['red_btn']);
        $query_id="select max(passageid)+1 as maxid from opbd6.passage";
        $id=pg_query($db,$query_id);
        $id=pg_fetch_assoc($id);
        $items['passageid']=$id['maxid'];
        $result=pg_insert($db,'opbd6.passage',$items);
        pg_close($db);
        header("Location:passageList.php");
  }  
?>