<?php
include('includes/dbconnection.php');
header('Content-Type: application/json');

// Get all parking spots
if ($_GET['action'] == 'get_parking_spots') {
    $query = mysqli_query($con, "SELECT * FROM parking_spots");
    $spots = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $spots[] = $row;
    }
    echo json_encode($spots);
    exit;
}

// Update parking spot status
if ($_POST['action'] == 'update_parking_status') {
    $id = intval($_POST['id']);
    $status = $_POST['status'] == 'free' ? 'reserved' : 'free';
    $update_query = mysqli_query($con, "UPDATE parking_spots SET status='$status' WHERE id=$id");
    echo json_encode(['success' => $update_query]);
    exit;
}

// Add a new parking spot
if ($_POST['action'] == 'add_parking_spot') {
    $name = mysqli_real_escape_string($con, $_POST['spot_name']);
    $latitude = floatval($_POST['latitude']);
    $longitude = floatval($_POST['longitude']);

    $insert_query = mysqli_query(
        $con,
        "INSERT INTO parking_spots (spot_name, latitude, longitude, status) 
      VALUES ('$name', $latitude, $longitude, 'free')"
    );

    echo json_encode(['success' => $insert_query]);
    exit;
}
?>