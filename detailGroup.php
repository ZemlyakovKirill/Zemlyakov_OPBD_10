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
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query="select * from opbd6.educationalgroup a join opbd6.educationalprogram b on a.programid=b.programid where a.groupid=$grpid";
    $res=pg_query($db,$query);
    $res=pg_fetch_assoc($res);
    echo "<h3>Программа: $res[name]</h3>";
    echo "<h3>Максимальное кол-во студентов: $res[maxquantitystudents]</h3>";
    echo "<h3>Текущее кол-во студентов: $res[studentcount]</h3>";

?>