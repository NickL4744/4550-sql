<p>Update Student Address</p>

<?php



$servername = "localhost";
$username = "quickme1_4211";
$password = "csci4211";
$dbname = "quickme1_4211";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
 
    
$courseid = $_REQUEST['courseid'];

   $prereqid = $_REQUEST['prereqid'];


$sql = "UPDATE prerequisites SET prereqid='$prereqid' WHERE courseid='$courseid'";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();

   

?>