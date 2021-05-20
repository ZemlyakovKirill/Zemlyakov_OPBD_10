<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Stipend</title>
</head>
<?php
        if(!isset($_COOKIE['id']))
            header("Location:stipendList.php");
        $stpid=$_COOKIE['id'];
        $query2="select * from opbd6.jobless a join opbd6.stipend b on a.joblessid = b.joblessid where b.stipendid=$stpid";
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $res2=pg_query($db,$query2);
        $res2=pg_fetch_assoc($res2);
        $res3=pg_query($db,"select joblessid,joblesslastname,joblessfirstname from opbd6.jobless");
        echo "<form id=F2 method=GET action=\"\">
            <div style=text-align:center;>
                <h3>Редактирование Пособия</h3>
                <div style=font-style:italic; margin:2px;>Безработный</div>
                <select name=joblessid>";
                while($row=pg_fetch_row($res3)){
                    if($row[0]==$res2['joblessid'])
                        echo "<option selected value='$row[0]'> $row[1] $row[2]</option>";
                    else
                        echo "<option value='$row[0]'> $row[1] $row[2]</option>";
                }
                echo "</select><br>
                <div style=font-style:italic; margin:2px;>Величина</div>
                <input type=number name=value min=0 placeholder=Например:Иван value='$res2[value]' required=true><br>
                <div style=font-style:italic; margin:2px;>Дата начала предоставления</div>
                <input type=date name=provisionstart placeholder=Например:Иванович required=true value='$res2[provisionstart]'><br>
                <div style=font-style:italic; margin:2px;>Номер телефона</div>
                <input type=date name=provisionfin placeholder=Например:+7999... value='$res2[provisionfin]' required=true pattern=[+][0-9]{11}><br><br>
                <input type=submit value=Обновить name=update_btn>
                <input type=button value=Вернуться name=red_btn onclick=document.location='stipendList.php'>
            </div>
        </form>";
        if(isset($_GET['update_btn'])){
            if($res2!=null){
                if(isset($_GET['update_btn'])){
                    $cond['stipendid']=$stpid;
                    $items=$_GET;
                    unset($items['red_btn']);
                    unset($items['update_btn']);
                    $res3=pg_update($db,'opbd6.stipend',$items,$cond);
                    pg_close($db);
                    header("Location:stipendList.php");
                }
            }
        }
?>