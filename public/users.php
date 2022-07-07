{"records":[<?php
$servername = "localhost";
$username = "root";
$password = "300793";
$dbname = "miniproject";
$port = "3306";

$conn=new mysqli($servername, $username, $password, $dbname, $port);

if($conn->connect_error){
    die("Error connecting to ".$conn->connect_error);

}

$sql = "SELECT email,name FROM users";
$result = $conn->query($sql);
$currentrow=0;
if ($result->num_rows>0){
    while ($row = $result->fetch_assoc()){
        $currentrow +=1;
    
    echo '{"Name":"'.$row["name"].'","Email":"'.$row["email"].'"}';
    if ($result ->num_rows >$currentrow) {echo ',';}
}
}else{
    echo"0 results";
}
$conn->close();
?>]}