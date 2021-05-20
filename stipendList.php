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
    $query="select * from opbd6.jobless a join opbd6.stipend b on a.joblessid = b.joblessid order by b.stipendid;";
    $res=pg_query($db,$query);
    echo "<div style=text-align:center;>
    <h2 class=font-italic>Пособия</h2>";
    while($row=pg_fetch_row($res)){
        echo "<h4>(".$row[9].") ".$row[2]." ".$row[7]." ".$row[11]."</h4>";
    };
    echo "</div>";
?>