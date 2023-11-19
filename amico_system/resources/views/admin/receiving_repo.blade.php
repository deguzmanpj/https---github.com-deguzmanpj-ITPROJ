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
        <link rel="stylesheet" href="../res/css/navbar.css">

    </head>

<body>

    <div class="navigation">
        <div class="nav-bar">
            <?php

            use Illuminate\Support\Facades\DB;

            $name = DB::select('select * from users where contact_no = "' . $_COOKIE['name'] . '"');
            echo  '<a class="user">' . $name[0]->name . ' - ' . $name[0]->role . '</a>';
            ?>
            <div id="menuToggle" class="toggle-menu active">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>

        <div class="main">
            <div id="sideMenu" class="side-menu">
                <div class="menu-items">
                    <a href="{{ route('admin/dash') }}" class="item1">Dashboard</a>
                    <a href="{{ route ('admin/asset_info')}}" class="one">Asset Information</a>
                    <a href="{{ route ('admin/receiving_repo')}}" class="item1">Forms</a>
                    <a href="{{ route('admin/users') }}" class="item1">Users</a>
                    <a href="{{ route('logout') }}" class="item1">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="header">
            <div>
                <p class="amicoLogo">AMICO ASSET MANAGEMENT</p>
            </div>
            <div>
                <p class="pageTitle">RECEIVING REPORT</p>
            </div>
        </div>
    </div>

    <div id="overlay" class="cover blur-in">


        <div class="container">
            <div class="form">
                <form action="/upload" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="feature-container">
                        <input class="upload" type="file" name="csvFile" accept=".csv">
                        <button class="uploadbtn" type="submit">Upload File</button>
                    </div>
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
                <a href="{{ route ('admin/rr_form')}}" class="btn btn-info add-new"><i class="fa fa-plus"></i>Add Entry</a>
                </div>
            </div>
        </div>


        <div class="wrapper">
            <section class="section section--large" id="part1">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                        </div>
                        <table class="table table" id="8table3">
                            <thead>
                                <tr>
                                    <th>Asset</th>
                                    <th>Received On</th>
                                    <th>Submitted By</th>
                                    <th></th>
                                </tr>
                            </thead>


                            <?php
                            if (!empty($results)) {
                                $processedRrNos = []; // Array to store processed rr_no values
                                foreach ($results as $data) {
                                    $rrNo = $data->rr_no;

                                    // Check if rr_no has already been processed
                                    if (!in_array($rrNo, $processedRrNos)) {
                                        $reqStatus = $data->req_status;
                                        echo '<input type = "hidden" id = "status" class = "status" value ="' .  $reqStatus . '">';
                                        echo '<tr>';
                                        echo '<td>' . 'rr_no: ' . $rrNo . '</td>';
                                        echo '<td>'  . $data->date_acq . '</td>';
                                        echo '<td>'  . $data->submitted_by . '</td>';
                                        echo '<td>';

                                        echo '<div style="display: inline-block;">'; // Container for inline display
                                        echo '<form action="/see_form" method="POST">'; // see form
                                        echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                                        echo '<input type="hidden" class="rr_no" name="rr_no" value="' . $rrNo . '">';
                                        echo '<input type="hidden" class="id" name="id" value = "admin">';
                                        echo '<button type="submit">SEE FORM</button>';
                                        echo '</form>';
                                        echo '</div>';


                                        
                                        if($reqStatus === "accepted"){
                                            echo '<div style="display: inline-block;">'; // Container for inline display
                                            echo '<form action="/add_to_asset_info" method="POST">'; // accept form
                                            echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                                            echo '<input type="hidden" class="rr_no" name="rr_no" value="' . $rrNo . '">';
                                            echo '<input type="hidden" class="id" name="id" value = "admin">';
                                            echo '<button type="submit" class="accept" disabled>ACCEPTED</button>';
                                            echo '</form>';
                                            echo '</div>';
                                            
                                        }

                                        if($reqStatus === "declined"){
                                            echo '<div style="display: inline-block;">'; // Container for inline display
                                            echo '<form action="/decline_request" method="POST">'; // decline form
                                            echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                                            echo '<button type="submit" class="decline" disabled>DECLINED</button>';
                                            echo '<input type="hidden" class="rr_no" name="rr_no" value="' . $rrNo . '">';
                                            echo '</form>';
                                            echo '</div>';
                                        }elseif($reqStatus === "pending"){
                                            echo '<div style="display: inline-block;">'; // Container for inline display
                                            echo '<form action="/add_to_asset_info" method="POST">'; // accept form
                                            echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                                            echo '<input type="hidden" class="rr_no" name="rr_no" value="' . $rrNo . '">';
                                            echo '<input type="hidden" class="id" name="id" value = "admin">';
                                            echo '<button type="submit" class="accept">ACCEPT</button>';
                                            echo '</form>';
                                            echo '</div>';
                                            
    
                                            echo '<div style="display: inline-block;">'; // Container for inline display
                                            echo '<form action="/decline_request" method="POST">'; // decline form
                                            echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                                            echo '<button type="submit" class="decline">DECLINE</button>';
                                            echo '<input type="hidden" class="rr_no" name="rr_no" value="' . $rrNo . '">';
                                            echo '</form>';
                                            echo '</div>';
                                        }

                               

                     
                                        // Update the processedRrNos array
                                        $processedRrNos[] = $rrNo;

                                        echo '</td>';
                                        echo '</tr>';

                                    }
                                    
                                }
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>


            <nav>
                <a href="{{ route ('admin/receiving_repo')}}" class="two" id="active_page">Receiving Report</a>
                <a href="{{ route ('admin/ack_repo')}}" class="item1">Acknowledgement Report</a>
                <a href="{{ route ('admin/prop_borr')}}" class="item1">Property Borrowing</a>
                <a href="{{ route ('admin/main_req')}}" class="item1">Maintenance Request</a>
                <a href="{{ route ('admin/condemn_req')}}" class="item1">Condemnation Request</a>
                <a href="{{ route ('admin/calib_req')}}" class="six">Calibration Request</a>
            </nav>

        </div>

</body>
<script src="../res/js/navbar.js"></script>
<script src="../res/js/receiving.js"></script>


</html>