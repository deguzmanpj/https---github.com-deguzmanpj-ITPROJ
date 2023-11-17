<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="res/css/loginpage.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../res/css/asset_information.css">
        <link rel="stylesheet" href="../res/css/pending.css">
        <link rel="stylesheet" href="../res/css/navbar.css">

    </head>

<body>

    <div class="navigation">
        <div class="nav-bar">
            <div id="menuToggle" class="toggle-menu active">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>

        <div class="main">
            <div id="sideMenu" class="side-menu">
                <div class="menu-items">
                    <a href="{{ route ('employee/dashB')}}" class="item1">Dashboard</a>
                    <a href="{{ route ('employee/receiving_repo')}}" class="item1">Asset Information</a>
                    <a href="{{ route ('employee/pending')}}"  id = "active_tab" class="item1">Pending Requests</a> <!-- item -->
                    <a href="#" class="item">Forms</a>
                    <a href="#" class="item">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <div class="header">
        <p class="pageTitle">Pending Request</p>
        <p>Amico Asset Management</p>
    </div>



    <div class="wrapper">
        <section class="section section--large" id="part1">
            <div class="container">
                <div class="table-wrapper">
                    <div class="table-title">
                    </div>
                    <table class="table table-bordered" id="8table3">
                        <thead>
                            <tr>
                                <th>Unit</th>
                                    <th>Unit Code</th>
                                    <th>Type</th>
                                    <th>RR Number</th>
                                    <th>Date</th>
                                    <th>PO No.</th>
                                    <th>Received from</th>
                                    <th>Reference</th>  
                            </tr>
                        </thead>
                        <?php
                        if (!empty($results)) {
                            for ($num = 0; $num < sizeof($results); $num++) {
                                $data = $results[$num];
                                echo '<form action="/edit_asset" method="POST">'; // edit form
                                echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                                echo '<input type = "hidden" class = "serial_no" name = "serial_no" value ="' .  $data->serial_no . '">';
                                echo '<tr>';
                                echo '<td>' . '<input type = "text" class = "serial_no" name = "serial_no" value ="' .  $data->unit . '"readonly>';
                                echo '<td>' . '<input type="text" class="form-control" name="rr_no" value = "' . '"readonly></td>';
                                echo '<td>' . '<input type="text" class="form-control" name="rr_date" value = "' . '"readonly></td>';
                                echo '<td>' . '<input type="text" class="form-control" name="po_no" value = "'. $data->rr_no . '"readonly></td>';
                                echo '<td>' . '<input type="text" class="form-control" name="po_date" value = "'. $data->date_acq . '"readonly></td>';
                                echo '<td>' . '<input type="text" class="form-control" name="serial_no" value = "'. $data->po_no . '"readonly></td>';
                                echo '<td>' . '<input type="text" class="form-control" name="asset_desc" value = "'. $data->from_supplier . '"readonly></td>';
                                echo '<td>' . '<input type="text" class="form-control" name="funded_by" value = "'. $data->ref_invoice . '"readonly></td>';

                                echo '<td class="toggleBtns">'; // Add the class for the buttons container
                                echo '<button type = "submit" class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></button>';
                                echo '<a class="edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>';


                                echo '</tr>';
                                echo '<input class="inputForm" type = "hidden" id = "status" name="req_status" value="pending">';
                                echo '<input class="inputForm" type = "hidden" id = "user" name="user" value="employee">';
                                echo '</form>';
                            }
                        }
                        ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </section>
        <section class="section section--dark section--small" id="part2">
            <div class="container">
                <div class="table-wrapper">
                    <div class="table-title">
                    </div>
                    <table class="table table-bordered" id="8table3">
                        <thead>
                            <tr>
                            <th>Asset Tag</th>
                                    <th>Asset Description</th>
                                    <th>Serial Number</th>
                                    <th>Asset Class</th>
                                    <th>Qty</th>
                                    <th>Received By</th>
                            </tr>
                        </thead>
                        <?php

                        use Illuminate\Support\Facades\Log;

                        if (!empty($results)) {
                            for ($num = 0; $num < sizeof($results); $num++) {
                                $data = $results[$num];
                                Log::info($results);
                                echo '<form action="/edit_asset" method="POST">'; // edit form
                                echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                                echo '<input type = "hidden" class = "serial_no" name = "serial_no" value ="' .  $data->serial_no . '">';
                                echo '<tr>';
                                echo '<td>' . '<input type = "text" class = "serial_no" name = "serial_no" value ="' .  $data->asset_tag . '"readonly>';
                                echo '<td>' . '<input type="text" class="form-control" name="po_no" value = "'. $data->asset_desc . '"readonly></td>';
                                echo '<td>' . '<input type="text" class="form-control" name="po_date" value = "'. $data->serial_no . '"readonly></td>';
                                echo '<td>' . '<input type="text" class="form-control" name="serial_no" value = "'. $data->asset_class . '"readonly></td>';
                                echo '<td>' . '<input type="text" class="form-control" name="asset_desc" value = "'. $data->qty . '"readonly></td>';
                                echo '<td>' . '<input type="text" class="form-control" name="funded_by" value = "' . '"readonly></td>';
                                echo '<td>' . '<input type="text" class="form-control" name="user_id" value="' . $data->req_status . '" disabled></td>';


                                echo '<td class="toggleBtns">'; // Add the class for the buttons container
                                echo '<button type = "submit" class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></button>';
                                echo '<a class="edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>';

                                echo '</td>';

                                echo '</tr>';
                                echo '<input class="inputForm" type = "hidden" id = "status" name="req_status" value="pending">';
                                echo '<input class="inputForm" type = "hidden" id = "user" name="user" value="employee">';


                                echo '</form>';
                            }
                        }
                        ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </section>

    </div>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../res/js/pending.js"></script>
<script src="../res/js/asset_information.js"></script>
<script src="../res/js/navbar.js"></script>


</html>