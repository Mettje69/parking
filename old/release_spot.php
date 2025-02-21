<?php
session_start();
include('includes/dbconnection.php');

if (isset($_POST['ParkingSpot'])) {
    $spot = mysqli_real_escape_string($con, $_POST['ParkingSpot']);

    // Check if the spot is currently reserved
    $checkQuery = "SELECT Status FROM tblvehicle WHERE ParkingSpot = '$spot'";
    $result = mysqli_query($con, $checkQuery);
    $row = mysqli_fetch_assoc($result);

    if ($row['Status'] === 'Reserved') {
        // Update the spot to Free
        $updateQuery = "UPDATE tblvehicle SET Status = 'Free' WHERE ParkingSpot = '$spot'";
        if (mysqli_query($con, $updateQuery)) {
            echo "Spot $spot released successfully.";
        } else {
            echo "Failed to release spot. Please try again.";
        }
    } else {
        echo "Spot is already free.";
    }
} else {
    echo "Invalid request.";
}
?>
