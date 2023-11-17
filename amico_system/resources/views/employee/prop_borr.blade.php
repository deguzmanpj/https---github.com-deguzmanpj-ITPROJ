<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../res/css/asset_information.css">
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
                <a href="#" class="item">Dashboard</a>
                    <a href="#" class="item">Users</a>
                    <a href="{{ route ('employee/asset_info')}}" class="one">Asset Information</a>
                    <a href="{{ route ('employee/receiving_repo')}}" id="active_tab" class="item1">Forms</a>
                    <a href="#" class="item">Logout</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class ="container">
        <div class="header">
            <div><p class="amicoLogo">AMICO ASSET MANAGEMENT</p></div>
            <div><p class="pageTitle">PROPERTY BORROWING</p></div>
        </div>
    </div>

    <div class="container">
        <div class="form">
            <form action="/upload" method="POST" enctype="multipart/form-data">
                @csrf
                <input class="upload" type="file" name="csvFile" accept=".csv">
                <button class="uploadbtn" type="submit">Upload File</button>
            </form>


            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
        </div>


        <div class="table-title">
            <div class="row">
                <a href="{{ route ('employee/prop_form')}}" class="btn btn-info add-new"><i class="fa fa-plus"></i>Add Entry</a>
            </div>
        </div>
    </div>


    <div class="wrapper">
    <section class="section section--large five" id="part5">
            <div class="container">
                <div class="table-wrapper">
                    <div class="table-title">
                    </div>
                    <table class="table table-bordered" id="7table5">
                        <thead>
                            <tr>
                            <th>Asset</th>
                                    <th>Borrowed On</th>
                                    <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if (!empty($results)) {
                                for ($num = 0; $num < sizeof($results); $num++) {
                                    $data = $results[$num];
                                    $pbNo = $data->pb_no;
                                    $reqStatus = $data->status;
                                    echo '<input type = "hidden" class = "status" value ="' .  $reqStatus . '">';
                                    echo '<tr>';
                                    echo '<td>' . 'pb_no: ' . $pbNo . '</td>';
                                    echo '<td>'  . $data->pb_date . '</t   d>';  
                                    echo '<td>';

                                    echo '<div style="display: inline-block;">'; // Container for inline display
                                    
                                    echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                                    echo '<input type="hidden" class="pb_no" name="pb_no" value="' . $pbNo . '">';
                                    echo '<input type="text" class="status" id = "reqStatus" value = "'.$reqStatus.'"readonly>';
                                    echo '<style>#reqStatus{border: none;}</style>';
                                   
                                    echo '</div>';

                                    echo '<div style="display: inline-block;">'; // Container for inline display
                                    echo '<form action="/see_prop_borr" method="post">'; // decline form
                                    echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                                    echo '<input type="hidden" class="id" name="id" value = "employee">';
                                    echo '<button type="submit" class="decline">see form</button>';
                                    echo '<input type="hidden" class="pb_no" name="pb_no" value="' . $pbNo . '">';
                                    echo '</form>';
                                    echo '</div>';

                                    echo '</td>';

                                    echo '</tr>';
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>


    </div>

    <nav>
    <a href="{{ route ('employee/receiving_repo')}}" class="two">Receiving Report</a>
        <a href="{{ route ('employee/ack_repo')}}" class="three">Acknowledgement Report</a>
        <a href="{{ route ('employee/prop_borr')}}" class="four"   id = "active_page" >Property Borrowing</a>
        <a href="{{ route ('employee/main_req')}}" class="five">Maintenance Request</a>
        <a href="{{ route ('employee/condemn_req')}}" class="six">Condemnation Request</a>
        <a href="{{ route ('employee/calib_req')}}" class="six">Calibration Request</a>
    </nav>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../res/js/asset_information.js"></script>
<script src="../res/js/navbar.js"></script>

</html>