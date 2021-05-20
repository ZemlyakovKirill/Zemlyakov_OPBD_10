<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Jobless</title>
</head>
<?php
        if(!isset($_COOKIE['id']))
            header("Location:joblessList.php");
        $jid=$_COOKIE['id'];
        $query2="select * from opbd6.jobless where joblessid=$jid";
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $res2=pg_query($db,$query2);
        $res2=pg_fetch_assoc($res2);
        echo "<form id=F2 method=GET action=\"\">
            <div style=text-align:center;>
                <h3>Редактирование Безработного</h3>
                <div style=font-style:italic; margin:2px;>Фамилия</div>
                <input type=text name=last_name placeholder=Например:Иванов value='$res2[joblesslastname]' required=true><br>
                <div style=font-style:italic; margin:2px;>Имя</div>
                <input type=text name=first_name placeholder=Например:Иван value='$res2[joblessfirstname]' required=true><br>
                <div style=font-style:italic; margin:2px;>Отчество</div>
                <input type=text name=middle_name placeholder=Например:Иванович required=false value='$res2[joblessmiddlename]'><br>
                <div style=font-style:italic; margin:2px;>Номер телефона</div>
                <input type=tel name=phone placeholder=Например:+7999... value='$res2[joblessphone]' required=true pattern=[+][0-9]{11}><br>
                <div style=font-style:italic; margin:2px;>Адрес</div>
                <input type=text name=address placeholder=Например:Россия,г.Москва... required=false value='$res2[joblessaddress]'><br>
                <div style=font-style:italic; margin:2px;>Паспорт</div>
                <input type=text name=passport placeholder=Например:4020202020 value='$res2[joblesspassport]' required=true><br>
                <div style=font-style:italic; margin:2px;>Опыт работы</div>
                <input type=number name=exp placeholder=Work Experience required=true min=0 max=100 value='$res2[workexperience]'><br><br>
                <input type=submit value=Обновить name=update_btn>
            </div>
        </form>";
        if(isset($_GET['update_btn'])){
            if($res2!=null){
                if(isset($_GET['update_btn'])){
                    $query3="update opbd6.jobless set(joblessaddress,joblesslastname,joblessphone,joblesspassport,workexperience,joblessfirstname,joblessmiddlename)=(
                    '$_GET[address]',
                    '$_GET[last_name]',
                    '$_GET[phone]',
                    '$_GET[passport]',
                    $_GET[exp],
                    '$_GET[first_name]',
                    '$_GET[middle_name]')
                    where joblessid=$jid;";
                    $res3=pg_query($db,$query3);
                    pg_close($db);
                    header("Location:joblessList.php");
                }
            }
        }
?>