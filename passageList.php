<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Passage</title>
</head>
<?php
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query="select * from opbd6.passage p
    join opbd6.jobless j on p.joblessid = j.joblessid
    join opbd6.educationalgroup g on  p.groupid=g.groupid
    join opbd6.educationalprogram pr on pr.programid=g.programid order by passageid;";
    $res=pg_query($db,$query);
    echo "<div style=text-align:center;>
    <h2 class=font-italic>Прохождения</h2>";
    while($row=pg_fetch_assoc($res)){
        echo "<h4>(".$row['passageid'].") ".$row['joblesslastname']." ".$row['joblessfirstname']." -> ".$row['name']."</h4>";
    };
    echo "</div>";


?>