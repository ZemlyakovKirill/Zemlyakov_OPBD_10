<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Group</title>
</head>
<?php
        if(!isset($_COOKIE['id']))
            header("Location:groupList.php");
        $grpid=$_COOKIE['id'];
        $query2="select * from opbd6.educationalgroup where groupid=$grpid";
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $res2=pg_query($db,$query2);
        $res2=pg_fetch_assoc($res2);
        $qry_program="select * from opbd6.educationalprogram";
        $res_program=pg_query($db,$qry_program);
        echo "<form method=GET>
            <div style=text-align:center;>
                <h3>Редактирование Группы</h3>
                <div style=font-style:italic; margin:2px;>Программа</div>
                <select name=programid required=true>";
                while($row=pg_fetch_assoc($res_program)){
                    if($res2['programid']==$row['programid']){
                        echo "<option selected value='$row[programid]'>$row[name] $row[cost]</option>";
                    }
                    else{
                        echo "<option value='$row[programid]'>$row[name] $row[cost]</option>";
                    }
                }
        echo "</select>
                <div style=font-style:italic; margin:2px;>Максимальное кол-во студентов</div>
                <input type=number name=maxquantitystudents min=0 placeholder=Например:100required=true value='$res2[maxquantitystudents]'><br>
                <div style=font-style:italic; margin:2px;>Текущее кол-во студентов</div>
                <input type=number name=studentcount min=0 placeholder=Например:10 required=true value='$res2[studentcount]'><br><br>
                <input type=submit value=Обновить name=update_btn>
                <input type=button value=Вернуться onclick=document.location='groupList.php'>
            </div>
        </form>";
        
        if(isset($_GET['update_btn'])){
            if($res2!=null){
                if(isset($_GET['update_btn'])){
                    $query3="update opbd6.educationalgroup set(programid,maxquantitystudents,studentcount)=(
                     $_GET[programid],
                     $_GET[maxquantitystudents],
                     $_GET[studentcount])
                    where groupid=$grpid;";
                    $res3=pg_query($db,$query3);
                    pg_close($db);
                    header("Location:groupList.php");
                }
            }
        }
?>