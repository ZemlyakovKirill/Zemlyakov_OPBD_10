<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Program</title>
</head>
<?php
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query="select * from opbd6.educationalprogram order by programid";
    $res=pg_query($db,$query);
    echo "<div style=text-align:center;>
    <h2 class=font-italic>Программы</h2>";
    while($row=pg_fetch_assoc($res)){
        echo "<h4>(".$row['programid'].") ".$row['name']."</h4>";
    };
    echo "</div>";

?>