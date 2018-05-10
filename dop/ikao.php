 <?php
$sql_srv = "localhost"; //SQL server 
$sql_db = "ikao"; //SQL database 
$sql_usr = "user"; //SQL user 
$sql_psw = "pass"; //SQL password 

$mysqli = new mysqli($sql_srv, $sql_usr, $sql_psw, $sql_db); 
$query = $mysqli->query("SELECT ikao, DATE_FORMAT(dt, '%d.%m.%Y %H:%i') AS dt, ".
                        "wndd FROM metar_rt WHERE ikao='ULAA' OR ikao='ULMM' OR ikao='ULLI';"); 

header("Content-type: application/json"); 

echo "{\"data\":["; 

$f = false; 
while ($row = $query->fetch_assoc()) { 
   if ($f) 
     echo ","; 
   else 
     $f = true; 
 echo json_encode($row); 
} 
 $dt = new DateTime("now", new DateTimeZone("UTC")); 
 $st = $dt->format("d.m.Y H:i"); 

echo "],\"st\":\"$st\"}"; 

$query->free(); 
$mysqli->close(); 

?>
