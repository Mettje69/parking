<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['vpmsaid'] == 0)) {
    header('location:logout.php');
} else { ?>


    <!doctype html>

    <html class="no-js" lang="">

    <head>

        <title>Admin Dashboard</title>
        <!-- Leaflet CSS and JS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
        <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
        <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
        <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

        <style>
            #weatherWidget .currentDesc {
                color: #ffffff !important;
            }

            .traffic-chart {
                min-height: 335px;
            }

            #flotPie1 {
                height: 150px;
            }

            #flotPie1 td {
                padding: 3px;
            }

            #flotPie1 table {
                top: 20px !important;
                right: -10px !important;
            }

            .chart-container {
                display: table;
                min-width: 270px;
                text-align: left;
                padding-top: 10px;
                padding-bottom: 10px;
            }

            #flotLine5 {
                height: 105px;
            }

            #flotBarChart {
                height: 150px;
            }

            #cellPaiChart {
                height: 160px;
            }
        </style>

    </head>

    <body>

        <?php include_once('includes/sidebar.php'); ?>

        <?php include_once('includes/header.php'); ?>

        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                    <?php
                    //todays Vehicle Entries
                    $query = mysqli_query($con, "select ID from tblvehicle where date(InTime)=CURDATE();");
                    $count_today_vehentries = mysqli_num_rows($query);
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="pe-7s-car"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span
                                                    class="count"><?php echo $count_today_vehentries; ?></span></div>
                                            <div class="stat-heading">Todays Vehicle Entries</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <?php
                        //Yesterdays Vehicle Entrie
                        $query1 = mysqli_query($con, "select ID from tblvehicle where date(InTime)=CURDATE()-1;");
                        $count_yesterday_vehentries = mysqli_num_rows($query1);
                        ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="pe-7s-car"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span
                                                    class="count"><?php echo $count_yesterday_vehentries ?></span></div>
                                            <div class="stat-heading">Yesterdays Vehicle Entries</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <?php
                        //Last Sevendays Vehicle Entries
                        $query2 = mysqli_query($con, "select ID from tblvehicle where date(InTime)>=(DATE(NOW()) - INTERVAL 7 DAY);");
                        $count_lastsevendays_vehentries = mysqli_num_rows($query2);
                        ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="pe-7s-car"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span
                                                    class="count"><?php echo $count_lastsevendays_vehentries ?></span></div>
                                            <div class="stat-heading">Last 7 days Vehicle Entries</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <?php
                        //Total Vehicle Entries
                        $query3 = mysqli_query($con, "select ID from tblvehicle");
                        $count_total_vehentries = mysqli_num_rows($query3);
                        ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <i class="pe-7s-car"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span
                                                    class="count"><?php echo $count_total_vehentries ?></span></div>
                                            <div class="stat-heading">Total Vehicle Entries</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Widgets -->

            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <div class="card">
            <div class="container mt-4">
                <h2 class="text-center">Live Parking Status</h2>
                <div id="map" style="height: 500px; width: 100%; margin: 20px 0;"></div>
            </div>



            <!-- Footer -->
            <?php include_once('includes/footer.php'); ?>



            <!-- /#right-panel -->

            <!-- Scripts -->
            <script>
                // Initialize the map (Replace YOUR_LAT and YOUR_LNG with your preferred center point)
                // Initialize the map
                var map = L.map('map').setView([59.44205240681502, 24.890259043701153], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 18,
                }).addTo(map);

                // Fetch existing parking spots
                fetch('map-actions.php?action=get_parking_spots')
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(spot => {
                            addMarker(spot);
                        });
                    });

                // Function to add a marker on the map
                function addMarker(spot) {
                    var marker = L.marker([spot.latitude, spot.longitude]).addTo(map);
                    marker.bindPopup(spot.spot_name + '<br>Status: ' + spot.status)
                        .on('click', function () {
                            fetch('map-actions.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: `action=update_parking_status&id=${spot.id}&status=${spot.status}`
                            }).then(() => location.reload());
                        });

                    // Custom marker color based on status
                    marker.setIcon(L.divIcon({
                        className: 'custom-icon',
                        html: `<div style="background-color: ${spot.status == 'free' ? 'green' : 'red'}; width: 20px; height: 20px; border-radius: 50%;"></div>`
                    }));
                }

                // Add new parking spot by clicking on the map
                map.on('click', function (e) {
                    console.log('Map clicked at:', e.latlng);  // Debug line

                    var latitude = e.latlng.lat;
                    var longitude = e.latlng.lng;
                    var spotName = prompt("Enter a name for this parking spot:");

                    if (spotName) {
                        // Save new spot via AJAX
                        fetch('map-actions.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `action=add_parking_spot&spot_name=${encodeURIComponent(spotName)}&latitude=${latitude}&longitude=${longitude}`
                        })
                            .then(response => response.json())
                            .then(data => {
                                console.log('Response from server:', data);  // Debug line

                                if (data.success) {
                                    // Add the new marker on the map
                                    addMarker({ spot_name: spotName, latitude: latitude, longitude: longitude, status: 'free' });
                                    alert("New parking spot added!");
                                } else {
                                    alert("Failed to add parking spot.");
                                }
                            })
                            .catch(error => console.error('Error:', error));  // Debug line
                    }
                });
            </script>

            <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    fetchParkingData();

                    function fetchParkingData() {
                        fetch("get_parking_data.php")
                            .then(response => response.json())
                            .then(data => renderParkingMap(data))
                            .catch(error => console.error("Error fetching parking data:", error));
                    }

                    function renderParkingMap(data) {
                        const map = document.getElementById("parking-map");
                        map.innerHTML = ""; // Clear previous content

                        data.forEach(spot => {
                            const spotDiv = document.createElement("div");
                            spotDiv.style.width = "50px";
                            spotDiv.style.height = "50px";
                            spotDiv.style.margin = "5px";
                            spotDiv.style.display = "inline-block";
                            spotDiv.style.textAlign = "center";
                            spotDiv.style.lineHeight = "50px";
                            spotDiv.style.fontWeight = "bold";
                            spotDiv.innerText = spot.spot_id;

                            if (spot.status === "free") {
                                spotDiv.style.backgroundColor = "green";
                                spotDiv.style.color = "white";
                            } else {
                                spotDiv.style.backgroundColor = "red";
                                spotDiv.style.color = "white";
                            }

                            map.appendChild(spotDiv);
                        });
                    }
                });
            </script>
            <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
            <script src="assets/js/main.js"></script>

            <!--  Chart js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

            <!--Chartist Chart-->
            <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
            <script src="assets/js/init/weather-init.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
            <script src="assets/js/init/fullcalendar-init.js"></script>

            <!--Local Stuff-->
            <script>
                jQuery(document).ready(function ($) {
                    "use strict";

                    // Pie chart flotPie1
                    var piedata = [
                        { label: "Desktop visits", data: [[1, 32]], color: '#5c6bc0' },
                        { label: "Tab visits", data: [[1, 33]], color: '#ef5350' },
                        { label: "Mobile visits", data: [[1, 35]], color: '#66bb6a' }
                    ];

                    $.plot('#flotPie1', piedata, {
                        series: {
                            pie: {
                                show: true,
                                radius: 1,
                                innerRadius: 0.65,
                                label: {
                                    show: true,
                                    radius: 2 / 3,
                                    threshold: 1
                                },
                                stroke: {
                                    width: 0
                                }
                            }
                        },
                        grid: {
                            hoverable: true,
                            clickable: true
                        }
                    });
                    // Pie chart flotPie1  End
                    // cellPaiChart
                    var cellPaiChart = [
                        { label: "Direct Sell", data: [[1, 65]], color: '#5b83de' },
                        { label: "Channel Sell", data: [[1, 35]], color: '#00bfa5' }
                    ];
                    $.plot('#cellPaiChart', cellPaiChart, {
                        series: {
                            pie: {
                                show: true,
                                stroke: {
                                    width: 0
                                }
                            }
                        },
                        legend: {
                            show: false
                        }, grid: {
                            hoverable: true,
                            clickable: true
                        }

                    });
                    // cellPaiChart End
                    // Line Chart  #flotLine5
                    var newCust = [[0, 3], [1, 5], [2, 4], [3, 7], [4, 9], [5, 3], [6, 6], [7, 4], [8, 10]];

                    var plot = $.plot($('#flotLine5'), [{
                        data: newCust,
                        label: 'New Data Flow',
                        color: '#fff'
                    }],
                        {
                            series: {
                                lines: {
                                    show: true,
                                    lineColor: '#fff',
                                    lineWidth: 2
                                },
                                points: {
                                    show: true,
                                    fill: true,
                                    fillColor: "#ffffff",
                                    symbol: "circle",
                                    radius: 3
                                },
                                shadowSize: 0
                            },
                            points: {
                                show: true,
                            },
                            legend: {
                                show: false
                            },
                            grid: {
                                show: false
                            }
                        });
                    // Line Chart  #flotLine5 End
                    // Traffic Chart using chartist
                    if ($('#traffic-chart').length) {
                        var chart = new Chartist.Line('#traffic-chart', {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                            series: [
                                [0, 18000, 35000, 25000, 22000, 0],
                                [0, 33000, 15000, 20000, 15000, 300],
                                [0, 15000, 28000, 15000, 30000, 5000]
                            ]
                        }, {
                            low: 0,
                            showArea: true,
                            showLine: false,
                            showPoint: false,
                            fullWidth: true,
                            axisX: {
                                showGrid: true
                            }
                        });

                        chart.on('draw', function (data) {
                            if (data.type === 'line' || data.type === 'area') {
                                data.element.animate({
                                    d: {
                                        begin: 2000 * data.index,
                                        dur: 2000,
                                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                                        to: data.path.clone().stringify(),
                                        easing: Chartist.Svg.Easing.easeOutQuint
                                    }
                                });
                            }
                        });
                    }
                    // Traffic Chart using chartist End
                    //Traffic chart chart-js
                    if ($('#TrafficChart').length) {
                        var ctx = document.getElementById("TrafficChart");
                        ctx.height = 150;
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                                datasets: [
                                    {
                                        label: "Visit",
                                        borderColor: "rgba(4, 73, 203,.09)",
                                        borderWidth: "1",
                                        backgroundColor: "rgba(4, 73, 203,.5)",
                                        data: [0, 2900, 5000, 3300, 6000, 3250, 0]
                                    },
                                    {
                                        label: "Bounce",
                                        borderColor: "rgba(245, 23, 66, 0.9)",
                                        borderWidth: "1",
                                        backgroundColor: "rgba(245, 23, 66,.5)",
                                        pointHighlightStroke: "rgba(245, 23, 66,.5)",
                                        data: [0, 4200, 4500, 1600, 4200, 1500, 4000]
                                    },
                                    {
                                        label: "Targeted",
                                        borderColor: "rgba(40, 169, 46, 0.9)",
                                        borderWidth: "1",
                                        backgroundColor: "rgba(40, 169, 46, .5)",
                                        pointHighlightStroke: "rgba(40, 169, 46,.5)",
                                        data: [1000, 5200, 3600, 2600, 4200, 5300, 0]
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                tooltips: {
                                    mode: 'index',
                                    intersect: false
                                },
                                hover: {
                                    mode: 'nearest',
                                    intersect: true
                                }

                            }
                        });
                    }
                    //Traffic chart chart-js  End
                    // Bar Chart #flotBarChart
                    $.plot("#flotBarChart", [{
                        data: [[0, 18], [2, 8], [4, 5], [6, 13], [8, 5], [10, 7], [12, 4], [14, 6], [16, 15], [18, 9], [20, 17], [22, 7], [24, 4], [26, 9], [28, 11]],
                        bars: {
                            show: true,
                            lineWidth: 0,
                            fillColor: '#ffffff8a'
                        }
                    }], {
                        grid: {
                            show: false
                        }
                    });
                    // Bar Chart #flotBarChart End
                });
            </script>
    </body>

    </html>
<?php } ?>