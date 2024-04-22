<html>
<body>


Results of Prerequisite Database<br><br>

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
 
//retrieve all the prerequisites for the specified course
$query = "SELECT PrereqID FROM 'Prerequisites' WHERE 'CourseID'=?";
//Use prepared statement to prevent SQL injection
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $courseID);
$stmt->execute();
$results = $stmt->get_result();

echo "The Student ID is: $studentID<br><br>";

//print out the results
if ($results->num_rows > 0) {
    $hasPrerequisites = true; //assume the student has prerequisites
    while ($prerequisite = $results->fetch_asspc()) {
        //print out the info
        $prereqID = $prerequisite['PrereqID'];

        echo "Prerequisite: $prereqID: ";

        //check if the student has the prerequisite
        $query1 = "SELECT Grade FROM Grades WHERE 'studentID'=? AND 'CourseID'=? AND 'Grade' IN ('A', 'B', 'C')";

        ///Use prepared statement to prevent SQL injection
        $stmt1 = $conn->prepare($query1);
        $stmt1->bind_param("ss", $studentID, $prereqID);
        $stmt1->execute();
        $results2 = $stmt1->get_result();

        if ($results2->num_rows > 0)
        {
            echo "You have the prerequisite.<br>";
        }
        else
        {
            echo "You do not have the prerequisite completed.<br>";
            $hasPrerequisites = false;
            break;
        }
    }

    if ($hasPrerequisites) {
        echo "You have all the prerequisites; you may register for the course.<br>";
    } else{
        echo "You are missing some prerequisites; you may not register for the course.<br>";
    }
}

$conn->close();
?>

</body>
</html>
