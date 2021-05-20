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
    $query="select * from opbd6.educationalgroup a join opbd6.educationalprogram b on a.programid=b.programid order by groupid";
    $res=pg_query($db,$query);
    echo "<div style=text-align:center;>
    <h2 class=font-italic>Группы</h2>";
    while($row=pg_fetch_assoc($res)){
        echo "<h4>(".$row['groupid'].") ".$row['name']."</h4>";
    };
    echo "</div>";
?>