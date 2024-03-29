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
                <p class="pageTitle">CALIBRATION REQUEST</p>
            </div>
        </div>
    </div>

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
                    <a href="{{ route ('employee/calib_form')}}" class="btn btn-info add-new"><i class="fa fa-plus"></i>Add Entry</a>
                <div class="filter-column">    
                </div>

            </div>

        


        <div class="wrapper">
            <section class="section section--large six" id="part6">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                        </div>
                        <table class="table table-bordered" id="5table6">
                            <thead>
                                <tr>
                                    <th>Asset</th>
                                    <th>Borrowed On</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $processedCSNOs = []; // Array to store processed CS_NO values

                                $name = DB::select('select * from users where contact_no = "'.$_COOKIE['name'].'"');

                                if (!empty($results)) {
                                    for ($num = 0; $num < sizeof($results); $num++) {
                                        $data = $results[$num];
                                        $csNo = $data->cs_no;
                                        
                                        if($data->submitted_by === $name[0]->name ){
                                        // Check if CS_NO has been processed, if yes, skip the iteration
                                        if (in_array($csNo, $processedCSNOs)) {
                                            continue;
                                        }

                                        // Add the CS_NO to the processed array
                                        $processedCSNOs[] = $csNo;

                                        $reqStatus = $data->status;
                                        echo '<input type = "hidden" class = "status" value ="' .  $reqStatus . '">';
                                        echo '<tr>';
                                        echo '<td>' . 'cs_no: ' . $csNo . '</td>';
                                        echo '<td>'  . $data->cs_date . '</td>';
                                        echo '<td>';

                                        echo '<div style="display: inline-block;">'; // Container for inline display

                                        echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                                        echo '<input type="hidden" class="cs_no" name="cs_no" value="' . $csNo . '">';
                                        echo '<input type="text" class="status" id="reqStatus" value="' . $reqStatus . '" readonly>';
                                        echo '<style>#reqStatus{border: none;}</style>';

                                        echo '</div>';

                                        if ($reqStatus === "pending") {
                                            echo '<div style="display: inline-block;">'; // Container for inline display
                                            echo '<form action="/see_calib" method="post">'; // decline form
                                            echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                                            echo '<input type="hidden" class="id" name="id" value="employee">';
                                            echo '<button type="submit" class="decline">see form</button>';
                                            echo '<input type="hidden" class="cs_no" name="cs_no" value="' . $csNo . '">';
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


        </div>

        <nav>
            <a href="{{ route ('employee/receiving_repo')}}" class="two">Receiving Report</a>
            <a href="{{ route ('employee/ack_repo')}}" class="three">Acknowledgement Report</a>
            <a href="{{ route ('employee/prop_borr')}}" class="four">Property Borrowing</a>
            <a href="{{ route ('employee/main_req')}}" class="five">Maintenance Request</a>
            <a href="{{ route ('employee/condemn_req')}}" class="six">Condemnation Request</a>
            <a href="{{ route ('employee/calib_req')}}" class="six" id="active_page">Calibration Request</a>
        </nav>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../res/js/asset_information.js"></script>
<script src="../res/js/navbar.js"></script>

<script>
    $(document).ready(function () {
        $("#searchInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#8table3 tbody tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<script>
        $(document).ready(function () {
            // Dropdown change event handler
            $("#statusFilter").change(function () {
                var selectedStatus = $(this).val();
                filterTable(selectedStatus);
            });

            // Function to filter the table based on status
            function filterTable(status) {
                $("table tbody tr").each(function () {
                    var rowStatus = $(this).find('.status').val().toLowerCase();
                    if (status === 'all' || rowStatus === status) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            // Initial table load (show all)
            filterTable('all');

            // Search input keyup event handler
            $("#searchInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>

</html>