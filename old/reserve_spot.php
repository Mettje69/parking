<?php
session_start();
include('includes/dbconnection.php');

// Check if ParkingSpot is set
if (isset($_POST['ParkingSpot'])) {
    $spot = mysqli_real_escape_string($con, $_POST['ParkingSpot']);
    
    // Check if spot is currently free
    $checkQuery = "SELECT Status FROM tblvehicle WHERE ParkingSpot='$spot'";
    $checkResult = mysqli_query($con, $checkQuery);
    $row = mysqli_fetch_assoc($checkResult);

    if ($row['Status'] === 'Free') {
        // Update spot status to Reserved
        $updateQuery = "UPDATE tblvehicle SET Status='Reserved' WHERE ParkingSpot='$spot'";
        if (mysqli_query($con, $updateQuery)) {
            echo "Spot $spot reserved successfully!";
        } else {
            echo "Failed to reserve spot. Please try again.";
        }
    } else {
        echo "Spot is already reserved.";
    }
} else {
    echo "Invalid request.";
}
?>
