<!DOCTYPE html>
<html>
<body>

Results of Student Database <br><br>

<?php
// Display Data in the database

// Connect to the server
$dbcnx = @mysqli_connect("localhost", "quickme1_4211", "csci4211");

if (!$dbcnx) {
    echo "<p>Unable to connect to the database server at this time.</p>";
    exit();
}

// Select the database
if (!@mysqli_select_db($dbcnx, "quickme1_4211")) {
    echo "<p>Unable to locate the student database at this time.</p>";
    exit();
}

$studentID = '1234567890';
$thecourseID = 'csci4211';

// Retrieve all the Prerequisites for csci4211
$query = "SELECT PrereqID, courseID FROM `Prerequisites` WHERE `courseID`='$thecourseID'";

$results = mysqli_query($dbcnx, $query);
echo "The Studentid is: " . $studentID . "<br>";

$hasAllPrerequisites = true;

// Print out the results
if ($results) {
    while ($results1 = mysqli_fetch_object($results)) {
        // Print out the info
        $PrereqID = $results1->PrereqID;
        echo "$PrereqID<br>";
        echo "$studentID<br>";

        // Check if the student has the prerequisites
        $query1 = "SELECT Grade FROM Grades WHERE `studentID`='$studentID' AND `CourseID`='$PrereqID' AND `Grade` IN ('A', 'B', 'C')";
        
        $results2 = mysqli_query($dbcnx, $query1);

        if (!$results2 || mysqli_num_rows($results2) == 0) {
            $hasAllPrerequisites = false;
        }
    }

    if ($hasAllPrerequisites) {
        echo "You have the prerequisites, you may register<br>";
    } else {
        echo "You do not have all the prerequisites<br>";
    }
}

// Close the database connection
mysqli_close($dbcnx);

?>

</body>
</html>
