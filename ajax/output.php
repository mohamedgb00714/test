<?php 

include '../dbconnect.php';

if (isset($_POST['ID'])) {
	# code...


$ID_color=$_POST['ID'];
if ($result = $DB->query("SELECT sum(votes) FROM votes WHERE ID_color=$ID_color  ")) {
    //printf("Select returned %d rows.\n", $result->num_rows);
if ($result->num_rows>0) {
	# code...

while($row = $result->fetch_array(MYSQLI_ASSOC))
{
if (is_null ( $row['sum(votes)'] )) {
	# code...
	echo "0";
}else{
	echo $row['sum(votes)'];
}
}
}else{
	echo "0";
}
    /* free result set */
    $result->close();
}
}

 ?>