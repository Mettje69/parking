<?php
session_start();
include('includes/dbconnection.php');

// Fetch parking spots and statuses
$query = "SELECT ParkingSpot, Status FROM tblvehicle ORDER BY ParkingSpot ASC";
$result = mysqli_query($con, $query);

$parkingSpots = [];
while ($row = mysqli_fetch_assoc($result)) {
    $parkingSpots[$row['ParkingSpot']] = $row['Status'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Map</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .parking-spot {
            width: 100px;
            height: 50px;
            margin: 10px;
            text-align: center;
            line-height: 50px;
            font-weight: bold;
            border-radius: 5px;
            position: relative;
        }

        .free {
            background-color: green;
            color: white;
        }

        .reserved {
            background-color: red;
            color: white;
        }

        .reserve-btn,
        .release-btn {
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Parking Map</h2>
        <div class="d-flex flex-wrap justify-content-center">
            <?php
            for ($i = 1; $i <= 20; $i++) { // 20 parking spots
                $spot = "P" . $i;
                $status = isset($parkingSpots[$spot]) ? $parkingSpots[$spot] : "Free";
                $class = $status === "Reserved" ? "reserved" : "free";
                echo "<div class='parking-spot $class' data-spot='$spot'>$spot";
                if ($status === "Free") {
                    echo "<button class='btn btn-warning reserve-btn' data-spot='$spot'>Reserve</button>";
                }
                if ($status === "Reserved") {
                    echo "<button class='btn btn-success release-btn' data-spot='$spot'>Release</button>";
                }

                echo "</div>";
            }
            ?>
        </div>
    </div>

    <script>
        $(document).on('click', '.reserve-btn', function () {
            let spot = $(this).data('spot');
            $.post('reserve_spot.php', { ParkingSpot: spot }, function (response) {
                alert(response);
                location.reload();
            });
        });

        $(document).on('click', '.release-btn', function () {
            let spot = $(this).data('spot');
            $.post('release_spot.php', { ParkingSpot: spot }, function (response) {
                alert(response);
                location.reload();
            });
        });
    </script>
</body>

</html>