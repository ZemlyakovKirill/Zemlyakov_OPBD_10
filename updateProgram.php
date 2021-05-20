<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Program</title>
</head>
<?php
        if(!isset($_COOKIE['id']))
            header("Location:programList.php");
        $progid=$_COOKIE['id'];
        $query2="select * from opbd6.educationalprogram where programid=$progid";
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $res2=pg_query($db,$query2);
        $res2=pg_fetch_assoc($res2);
        echo "<form method=GET>
            <div style=text-align:center;>
                <h3>Редактирование Программы</h3>
                <div style=font-style:italic; margin:2px;>Наименование</div>
                <input type=text name=name placeholder=Например:Иванов value='$res2[name]' required=true><br>
                <div style=font-style:italic; margin:2px;>Дата начала обучения</div>
                <input type=date name=startdate placeholder=Например:01-01-2000 required=true value='$res2[startdate]'><br>
                <div style=font-style:italic; margin:2px;>Дата окончания обучения</div>
                <input type=date name=finishdate placeholder=Например:01-01-2000 required=true value='$res2[finishdate]'><br>
                <div style=font-style:italic; margin:2px;>Стоимость обучения</div>
                <input type=text name=cost placeholder=Например:1000 required=true value='$res2[cost]'><br>
                <div style=font-style:italic; margin:2px;>Тип</div>
                <input type=text name=type placeholder=Например:пов.квал. required=true value='$res2[type]'><br><br>
                <input type=submit value=Обновить name=update_btn>
                <input type=button value=Вернуться onclick=document.location='programList.php'>
            </div>
        </form>";
        
        if(isset($_GET['update_btn'])){
            if($res2!=null){
                if(isset($_GET['update_btn'])){
                    $query3="update opbd6.educationalprogram set(name,startdate,finishdate,cost,type)=(
                    '$_GET[name]',
                    '$_GET[startdate]',
                    '$_GET[finishdate]',
                     $_GET[cost],
                    '$_GET[type]')
                    where programid=$progid;";
                    $res3=pg_query($db,$query3);
                    pg_close($db);
                    header("Location:programList.php");
                }
            }
        }
?>