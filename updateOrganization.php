<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Organization</title>
</head>
<?php
        if(!isset($_COOKIE['id']))
            header("Location:organizationList.php");
        $orgid=$_COOKIE['id'];
        $query2="select * from opbd6.educationalorganization where organizationid=$orgid";
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $res2=pg_query($db,$query2);
        $res2=pg_fetch_assoc($res2);
        echo "<form method=GET>
            <div style=text-align:center;>
                <h3>Редактирование Организации</h3>
                <div style=font-style:italic; margin:2px;>Наименование</div>
                <input type=text name=name placeholder=Например:Иванов value='$res2[name]' required=true><br>
                <div style=font-style:italic; margin:2px;>Тип</div>";
                if ($res2['type'] == 'СПО' ) {
                    echo "
                    <select required=true name=type>
                        <option selected value=СПО>Среднее профессиональное образование</option>
                        <option value=ВПО>Высшее образование</option>
                        <option value=СО>Среднее образование</option>
                        <option value=СО(н)>Среднее образование(не полное)</option>
                    </select><br>";
                }
                if ($res2['type'] == 'ВПО' ) {
                    echo "
                    <select required=true name=type>
                        <option value=СПО>Среднее профессиональное образование</option>
                        <option selected value=ВПО>Высшее образование</option>
                        <option value=СО>Среднее образование</option>
                        <option value=СО(н)>Среднее образование(не полное)</option>
                    </select><br>";
                }
                if ($res2['type'] == 'СО') {
                    echo "
                    <select required=true name=type>
                        <option value=СПО>Среднее профессиональное образование</option>
                        <option value=ВПО>Высшее образование</option>
                        <option selected value=СО>Среднее образование</option>
                        <option value=СО(н)>Среднее образование(не полное)</option>
                    </select><br>";
                }
                if ($res2['type'] == 'СО(н)') {
                    echo "
                    <select required=true name=type>
                        <option value=СПО>Среднее профессиональное образование</option>
                        <option value=ВПО>Высшее образование</option>
                        <option value=СО>Среднее образование</option>
                        <option selected value=СО(н)>Среднее образование(не полное)</option>
                    </select><br>";
                }        
                echo "
                <div style=font-style:italic; margin:2px;>Адрес</div>
                <input type=text name=address placeholder=Например:Россия,г.Москва... required=true value='$res2[address]'><br><br>
                <input type=submit value=Обновить name=update_btn>
                <input type=button value=Вернуться onclick=document.location='organizationList.php'>
            </div>
        </form>";
        
        if(isset($_GET['update_btn'])){
            if($res2!=null){
                if(isset($_GET['update_btn'])){
                    $query3="update opbd6.educationalorganization set(name,type,address)=(
                    '$_GET[name]',
                    '$_GET[type]',
                    '$_GET[address]')
                    where organizationid=$orgid;";
                    $res3=pg_query($db,$query3);
                    pg_close($db);
                    header("Location:organizationList.php");
                }
            }
        }
?>