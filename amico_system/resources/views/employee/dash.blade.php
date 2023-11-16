<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"> 
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../res/css/asset_information.css"> 
        <link rel="stylesheet" href="../res/css/navbar.css">

    <style>
        #chartContainer {
            width: 80%; 
            margin: auto;
        }
    </style>

</head>
<body>

<div class="navigation">
    <div class="nav-bar">
        <button class="notification-button">
            <i class="fas fa-bell"></i>
        </button>
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
                <a href="{{ route('admin/users') }}" id="active_tab" class="item1">Users</a>
                <a href="#" class="item" id="active_tab">Asset Management</a>
                <a href="{{ route ('admin/pending')}}" class="item1">Pending Requests</a>
                <a href="#" class="item">Forms</a>
                <a href="#" class="item">Logout</a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="header">
        <div><p class="amicoLogo">AMICO ASSET MANAGEMENT</p></div>
        <div><p class="pageTitle">DASHBOARD</p></div>
    </div>
</div>

<div class="container">
    <div id="selectedUnit" class="selected-unit">
    @if($unitFilter)
        Selected Unit: {{ $unitFilter }}
    @else
        All Units
    @endif
    </div>
</div>

<!-- Filter -->
<div class="container">
    <form action="{{ route('admin/dash') }}" method="GET">
        <label for="unit">Select Unit:</label>
        <select name="unit" id="unit">
            <!-- Add options for each unit -->
            <option value="">All Units</option>
            <option value="Asset Management and Inventory Control Office">Asset Management and Inventory Control Office</option>
            <option value="Basic Education School - Laboratory Elementary School">Basic Education School - Laboratory Elementary School</option>
            <option value="Basic Education School - Laboratory Junior High School">Basic Education School - Laboratory Junior High School</option>
            <option value="Basic Education School - Laboratory Senior High School">Basic Education School - Laboratory Senior High School</option>
            <option value="Campus Planning, Maintenance, and Security Department">Campus Planning, Maintenance, and Security Department</option>
            <option value="Center for Campus Ministry">Center for Campus Ministry</option>
            <option value="Center for Counseling and Wellness">Center for Counseling and Wellness</option>
            <option value="Center for Culture and the Arts">Center for Culture and the Arts</option>
            <option value="Center for Sports Development">Center for Sports Development</option>
            <option value="CICM Residence">CICM Residence</option>
            <option value="Community Extension and Outreach Programs Office">Community Extension and Outreach Programs Office</option>
            <option value="Data Protection Office">Data Protection Office</option>
            <option value="Finance Office - Accounting Section">Finance Office - Accounting Section</option>
            <option value="Finance Office - Bookstore">Finance Office - Bookstore</option>
            <option value="Finance Office - Payroll Section">Finance Office - Payroll Section</option>
            <option value="Finance Office - Purchasing Department">Finance Office - Purchasing Department</option>
            <option value="Finance Office - Student Account Support Services">Finance Office - Student Account Support Services</option>
            <option value="Finance Office - Transportation Department">Finance Office - Transportation Department</option>
            <option value="Health Services Unit - Dental Clinic">Health Services Unit - Dental Clinic</option>
            <option value="Health Services Unit - Medical Clinic">Health Services Unit - Medical Clinic</option>
            <option value="Human Resource Department">Human Resource Department</option>
            <option value="Museum of Igorot Cultures and Arts - Center for Indigenous Studies">Museum of Igorot Cultures and Arts - Center for Indigenous Studies</option>
            <option value="Office for Legal Affairs">Office for Legal Affairs</option>
            <option value="Office of Global Relations and Alumni Affairs">Office of Global Relations and Alumni Affairs</option>
            <option value="Office of Institutional Development and Quality Assurance">Office of Institutional Development and Quality Assurance</option>
            <option value="Office of Student Affairs and Services">Office of Student Affairs and Services</option>
            <option value="Office of the Internal Auditor">Office of the Internal Auditor</option>
            <option value="Office of the President">Office of the President</option>
            <option value="Office of the Vice President for Academic Affairs">Office of the Vice President for Academic Affairs</option>
            <option value="Office of the Vice President for Administration">Office of the Vice President for Administration</option>
            <option value="Office of the Vice President for Finance">Office of the Vice President for Finance</option>
            <option value="Office of the Vice President for Mission and Identity">Office of the Vice President for Mission and Identity</option>
            <option value="Printing Operations Office">Printing Operations Office</option>
            <option value="School of Accountancy, Management, Computing and Information Studies">School of Accountancy, Management, Computing and Information Studies</option>
            <option value="School of Advanced Studies">School of Advanced Studies</option>
            <option value="School of Engineering and Architecture">School of Engineering and Architecture</option>
            <option value="School of Law">School of Law</option>
            <option value="School of Medicine">School of Medicine</option>
            <option value="School of Nursing, Allied Health and Biological Sciences">Asset Management and Inventory Control Office</option>
            <option value="School of Teacher Education and Liberal Arts">School of Teacher Education and Liberal Arts</option>
            <option value="SFW - Halfway Home for Boys">SFW - Halfway Home for Boys</option>
            <option value="SFW - Pedagogical and Developmental Center">SFW - Pedagogical and Developmental Center</option>
            <option value="SFW - Sunflower Child and Youth Wellness Center">SFW - Sunflower Child and Youth Wellness Center</option>
            <option value="SLU Parish">SLU Parish</option>
            <option value="SLU Residence Halls - Guest House">SLU Residence Halls - Guest House</option>
            <option value="SLU Residence Halls - Ladies' Residence Halls">SLU Residence Halls - Ladies' Residence Halls</option>
            <option value="SLU Residence Halls - Maryheights Students' Residence Halls">SLU Residence Halls - Maryheights Students' Residence Halls</option>
            <option value="SLU Residence Halls - Men's Residence Hall">SLU Residence Halls - Men's Residence Hall</option>
            <option value="SLU Sacred Heart Medical Center">SLU Sacred Heart Medical Center</option>
            <option value="Technology Management and Development Department">Technology Management and Development Department</option>
            <option value="Theophile Verbist Resource and Documentation Center">Theophile Verbist Resource and Documentation Center</option>
            <option value="University Information Office">University Information Office</option>
            <option value="University Libraries">University Libraries</option>
            <option value="University Registrar's Office">University Registrar's Office</option>
            <option value="University Research and Innovation Center">University Research and Innovation Center</option>
            <!-- Add other options for the remaining units -->
        </select>
        <button type="submit">Apply Filter</button>
    </form>
</div>

<!-- Add a canvas element where the chart will be rendered -->
<div id="chartContainer">
    <canvas id="assetStatusChart"></canvas>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../res/js/asset_information.js"></script>
<script src="../res/js/navbar.js"></script>
<script src="../res/js/users.js"></script>

        <nav>
            <a href="{{ route ('admin/asset_info')}}" class="one">Asset Information</a>
            <a href="{{ route ('admin/receiving_repo')}}" class="item1" >Receiving Report</a>
            <a href="{{ route ('admin/ack_repo')}}" class="item1"  id = "active_page" >Acknowledgement Report</a>
            <a href="{{ route ('admin/prop_borr')}}" class="item1">Property Borrowing</a>
            <a href="{{ route ('admin/main_req')}}" class="item1">Maintenance Request</a>
            <a href="{{ route ('admin/condemn_req')}}" class="item1">Condemnation Request</a>
        </nav>

<script>
     $(document).ready(function () {
        // Mock data for testing
        var data = {!! json_encode($assetStatusCounts) !!};

        // Extract data for the chart
        var statuses = Object.keys(data);
        var counts = Object.values(data);

        // Check if there is no data for the selected unit
        var hasData = counts.some(function(count) {
            return count > 0;
        });

        if (hasData) {
            // Create a pie chart
            var ctx = document.getElementById('assetStatusChart').getContext('2d');
            var assetStatusChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: statuses,
                    datasets: [{
                        data: counts,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(128, 0, 128, 1)'
                            // 
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                    //
                }
            });
        } else {
            // Display "No data available" message
        var noDataMessage = document.createElement('p');
        noDataMessage.textContent = 'No data available';
        noDataMessage.style.textAlign = 'center';  // Center the text
        noDataMessage.style.marginTop = '20px';   // Add top margin for better spacing
        document.getElementById('chartContainer').appendChild(noDataMessage);
        }
    });
</script>

</body>
</html>