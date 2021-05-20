<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Jobless</title>
</head>
<?php
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query="select joblessid,joblesslastname,joblessfirstname from opbd6.jobless order by joblessid";
    $res=pg_query($db,$query);
    echo "<div style=text-align:center;>
    <h2 class=font-italic>Безработные</h2>";
    while($row=pg_fetch_row($res)){
        echo "<h4>(".$row[0].") ".$row[1]." ".$row[2]."</h4>";
    };
    echo "</div>";

?>
