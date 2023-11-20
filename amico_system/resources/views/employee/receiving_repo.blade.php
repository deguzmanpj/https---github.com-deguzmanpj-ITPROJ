@if (!isset($_COOKIE['name']))
    <script>console.log("hello")</script>
    {{-- Optionally, include a JavaScript redirect if needed --}}
    <script>window.location.href = "{{ route('/') }}";</script>
@endif
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
                    <a href="{{ route ('employee/asset_info')}}" class="one">Asset Information</a>
                    <a href="{{ route ('employee/receiving_repo')}}" id="active_tab" class="item1">Forms</a>
                    <a href="{{ route('logout') }}" class="item1">Logout</a>>
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

            <div>
                <label for="statusFilter">Filter by Status:</label>
                    <select id="statusFilter">
                        <option value="all">All</option>
                        <option value="pending">Pending</option>
                        <option value="accepted">Accepted</option>
                        <option value="declined">Declined</option>
                    </select>
            </div>

            <div class="table-title">
                <div class="row">
                    <input type="text" id="searchInput" placeholder="Search for asset...">
                    <a href="{{ route ('employee/rr_form')}}" class="btn btn-info add-new"><i class="fa fa-plus"></i>Add Entry</a>
                    <!-- <button href="{{ route ('employee/asset_info')}}" type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add Entry</button> -->
                    <button type="button" class="btn btn-info leave-note"><i class="fa fa-plus"></i> Leave Note</button>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $processedRRNOs = []; // Array to store processed RR_NO values

                            $name = DB::select('select * from users where contact_no = "' . $_COOKIE['name'] . '"');

                            if (!empty($results)) {
                                for ($num = 0; $num < sizeof($results); $num++) {

                                    $data = $results[$num];
                                    $rrNo = $data->rr_no;

                                    if ($data->submitted_by === $name[0]->name) {

                                        // Check if RR_NO has been processed, if yes, skip the iteration
                                        if (in_array($rrNo, $processedRRNOs)) {
                                            continue;
                                        }

                                        // Add the RR_NO to the processed array
                                        $processedRRNOs[] = $rrNo;

                                        $reqStatus = $data->req_status;
                                        echo '<input type = "hidden" class = "status" value ="' .  $reqStatus . '">';
                                        echo '<tr>';
                                        echo '<td>' . 'rr_no: ' . $rrNo . '</td>';
                                        echo '<td>'  . $data->date_acq . '</td>';
                                        echo '<td>';

                                        echo '<div style="display: inline-block;">'; // Container for inline display

                                        echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                                        echo '<input type="hidden" class="rr_no" name="rr_no" value="' . $rrNo . '">';
                                        echo '<input type="text" class="status" id="reqStatus" value="' . $reqStatus . '"readonly>';
                                        echo '<style>#reqStatus{border: none;}</style>';

                                        echo '</div>';

                                        if ($reqStatus === "pending") {
                                            echo '<div style="display: inline-block;">'; // Container for inline display
                                            echo '<form action="/see_form" method="post">'; // decline form
                                            echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                                            echo '<input type="hidden" class="id" name="id" value="employee">';
                                            echo '<button type="submit" class="decline">see form</button>';
                                            echo '<input type="hidden" class="rr_no" name="rr_no" value="' . $rrNo . '">';
                                            echo '</form>';
                                            echo '</div>';
                                        }

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
                <a href="{{ route ('employee/receiving_repo')}}" class="two" id="active_page">Receiving Report</a>
                <a href="{{ route ('employee/ack_repo')}}" class="item1">Acknowledgement Report</a>
                <a href="{{ route ('employee/prop_borr')}}" class="item1">Property Borrowing</a>
                <a href="{{ route ('employee/main_req')}}" class="item1">Maintenance Request</a>
                <a href="{{ route ('employee/condemn_req')}}" class="item1">Condemnation Request</a>
                <a href="{{ route ('employee/calib_req')}}" class="six">Calibration Request</a>
            </nav>

        </div>
    </div>

    <!-- <div class="row pop-up">
        <button class="close-button"> x </button>
        <div class=entry>


            <div class="form">

                <form action="/report" method="POST">
                    @csrf
                    <label for="rrNumber">RR Number</label>
                    <input class="inputForm" type=text id="rrNumber" name="rrNumber">
                    <label for="rrDate">RR Date</label>
                    <input class="inputForm" type=date id="rrDate" name="rrDate">
                    <label for="poNo">PO No.</label>
                    <input class="inputForm" type=text id="poNo" name="poNo">
                    <label for="poDate">PO Date</label>
                    <input class="inputForm" type=date id="poDate" name="poDate">
                    <label for="assetDesc">Asset Description</label>
                    <input class="inputForm" type=text id="assetDesc" name="assetDesc">
                    <label for="fundedBy">Funded By</label>
                    <input class="inputForm" type=text id="fundedBy" name="fundedBy">
                    <label for="rsNo">RS No.-Transferred</label>
                    <input class="inputForm" type=text id="rsNo" name="rsNo">

                    <label for="rsDate">RS Date</label>
                    <input class="inputForm" type=date id="rsDate" name="rsDate">

                    <label for="docNo">Doc No. - Donation/Grant</label>
                    <input class="inputForm" type=text id="docNo" name="docNo">

                    <label for="dateRec">Date Received</label>
                    <input class="inputForm" type=date id="dateRec" name="dateRec">
                    <label for="location">From - Location.</label>
                    <input class="inputForm" type=text id="location" name="location">
                    <label for="donator">From - Donator/Grantor</label>
                    <input class="inputForm" type=text id="donator" name="donator">
                    <label for="dateAcq">Date Acquired</label>
                    <input class="inputForm" type=date id="dateAcq" name="dateAcq">
                    <label for="receivedBy">Received By</label>
                    <input class="inputForm" type=text id="receivedBy" name="receivedBy">
                    <label for="receivedBy">Brand</label>
                    <input class="inputForm" type=text id="brand" name="brand">
                    <label for="receivedBy">Model</label>
                    <input class="inputForm" type=text id="model" name="model">
                    <label for="receivedBy">Unit</label>
                    <input class="inputForm" type=text id="unit" name="unit">
                    <label for="receivedBy">Quantity</label>
                    <input class="inputForm" type=text id="qty" name="qty">
                    <label for="serialNo">Serial No.</label>
                    <input class="inputForm" type=text id="serialNo" name="serialNo">
                    <button type="submit" id="submit" value="Submit">
                    <input class="inputForm" type = "text" id = "user" name="user" value="employee">
                </form>
            </div>

        </div>
    </div> -->

</body>
<!-- <script src="../res/js/loginpage.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../res/js/asset_information.js"></script>
<script src="../res/js/navbar.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var searchInput = document.getElementById("searchInput");
        var table = document.getElementById("8table3");
        var rows = table.getElementsByTagName("tr");

        searchInput.addEventListener("input", function () {
            var searchText = searchInput.value.toLowerCase();

            for (var i = 1; i < rows.length; i++) { // Start from index 1 to skip the header row
                var row = rows[i];
                var assetColumn = row.getElementsByTagName("td")[0]; // Assuming asset is in the first column
                var receivedOnColumn = row.getElementsByTagName("td")[1]; // Assuming Received On is in the second column
                var submittedByColumn = row.getElementsByTagName("td")[2]; // Assuming Submitted By is in the third column

                if (assetColumn && receivedOnColumn && submittedByColumn) {
                    var assetText = assetColumn.textContent.toLowerCase();
                    var receivedOnText = receivedOnColumn.textContent.toLowerCase();
                    var submittedByText = submittedByColumn.textContent.toLowerCase();

                    if (assetText.includes(searchText) || receivedOnText.includes(searchText) || submittedByText.includes(searchText)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }
            }
        });
    });
</script>

</html>