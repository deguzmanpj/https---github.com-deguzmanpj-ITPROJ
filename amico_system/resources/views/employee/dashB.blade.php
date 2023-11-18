dashB.blade.php

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
            width: 70%; 
            margin: auto;
        }
        .selected-unit {
            font-weight: bold;
            font-size: 30px;
            border-style: groove;
            margin-top: 10px;
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
                <a href="{{ route('employee/dashB') }}"id= "active_tab" class="item1">Dashboard</a>
                <a href="{{ route('employee/asset_info') }}" class="item1">Asset Management</a>
                <a href="{{ route ('employee/receiving_repo')}}" class="item1">Forms</a>
                <a href="{{ route('logout') }}" class="item1">Logout</a>>
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
    <form action="{{ route('employee/dashB') }}" method="GET">
        <label for="unit">Select Unit:</label>
        <select name="unit" id="unit">
            <!-- Add options for each unit -->
            <option value="" @if(!$unitFilter) selected @endif>All Units</option>
            <option value="Asset Management and Inventory Control Office" @if($unitFilter == "Asset Management and Inventory Control Office") selected @endif>Asset Management and Inventory Control Office</option>
            <option value="Basic Education School - Laboratory Elementary School"@if($unitFilter == "Basic Education School - Laboratory Elementary School") selected @endif>Basic Education School - Laboratory Elementary School</option>
            <option value="Basic Education School - Laboratory Junior High School"@if($unitFilter == "Basic Education School - Laboratory Junior High School") selected @endif>Basic Education School - Laboratory Junior High School</option>
            <option value="Basic Education School - Laboratory Senior High School"@if($unitFilter == "Basic Education School - Laboratory Senior High School") selected @endif>Basic Education School - Laboratory Senior High School</option>
            <option value="Campus Planning, Maintenance, and Security Department"@if($unitFilter == "Campus Planning, Maintenance, and Security Department") selected @endif>Campus Planning, Maintenance, and Security Department</option>
            <option value="Center for Campus Ministry"@if($unitFilter == "Center for Campus Ministry") selected @endif>Center for Campus Ministry</option>
            <option value="Center for Counseling and Wellness"@if($unitFilter == "Center for Counseling and Wellness") selected @endif>Center for Counseling and Wellness</option>
            <option value="Center for Culture and the Arts"@if($unitFilter == "Center for Culture and the Arts") selected @endif>Center for Culture and the Arts</option>
            <option value="Center for Sports Development"@if($unitFilter == "Center for Sports Development") selected @endif>Center for Sports Development</option>
            <option value="CICM Residence"@if($unitFilter == "CICM Residence") selected @endif>CICM Residence</option>
            <option value="Community Extension and Outreach Programs Office"@if($unitFilter == "Community Extension and Outreach Programs Office") selected @endif>Community Extension and Outreach Programs Office</option>
            <option value="Data Protection Office"@if($unitFilter == "Data Protection Office") selected @endif>Data Protection Office</option>
            <option value="Finance Office - Accounting Section"@if($unitFilter == "Finance Office - Accounting Section") selected @endif>Finance Office - Accounting Section</option>
            <option value="Finance Office - Bookstore"@if($unitFilter == "Finance Office - Bookstore") selected @endif>Finance Office - Bookstore</option>
            <option value="Finance Office - Payroll Section"@if($unitFilter == "Finance Office - Payroll Section") selected @endif>Finance Office - Payroll Section</option>
            <option value="Finance Office - Purchasing Department"@if($unitFilter == "Finance Office - Purchasing Department") selected @endif>Finance Office - Purchasing Department</option>
            <option value="Finance Office - Student Account Support Services"@if($unitFilter == "Finance Office - Student Account Support Services") selected @endif>Finance Office - Student Account Support Services</option>
            <option value="Finance Office - Transportation Department"@if($unitFilter == "Finance Office - Transportation Department") selected @endif>Finance Office - Transportation Department</option>
            <option value="Health Services Unit - Dental Clinic"@if($unitFilter == "Health Services Unit - Dental Clinic") selected @endif>Health Services Unit - Dental Clinic</option>
            <option value="Health Services Unit - Medical Clinic"@if($unitFilter == "Health Services Unit - Medical Clinic") selected @endif>Health Services Unit - Medical Clinic</option>
            <option value="Human Resource Department"@if($unitFilter == "Human Resource Department") selected @endif>Human Resource Department</option>
            <option value="Museum of Igorot Cultures and Arts - Center for Indigenous Studies"@if($unitFilter == "Museum of Igorot Cultures and Arts - Center for Indigenous Studies") selected @endif>Museum of Igorot Cultures and Arts - Center for Indigenous Studies</option>
            <option value="Office for Legal Affairs"@if($unitFilter == "Office for Legal Affairs") selected @endif>Office for Legal Affairs</option>
            <option value="Office of Global Relations and Alumni Affairs"@if($unitFilter == "Office of Global Relations and Alumni Affairs") selected @endif>Office of Global Relations and Alumni Affairs</option>
            <option value="Office of Institutional Development and Quality Assurance"@if($unitFilter == "Office of Institutional Development and Quality Assurance") selected @endif>Office of Institutional Development and Quality Assurance</option>
            <option value="Office of Student Affairs and Services"@if($unitFilter == "Office of Student Affairs and Services") selected @endif>Office of Student Affairs and Services</option>
            <option value="Office of the Internal Auditor"@if($unitFilter == "Office of the Internal Auditor") selected @endif>Office of the Internal Auditor</option>
            <option value="Office of the President"@if($unitFilter == "Office of the President") selected @endif>Office of the President</option>
            <option value="Office of the Vice President for Academic Affairs"@if($unitFilter == "Office of the Vice President for Academic Affairs") selected @endif>Office of the Vice President for Academic Affairs</option>
            <option value="Office of the Vice President for Administration"@if($unitFilter == "Office of the Vice President for Administration") selected @endif>Office of the Vice President for Administration</option>
            <option value="Office of the Vice President for Finance"@if($unitFilter == "Office of the Vice President for Finance") selected @endif>Office of the Vice President for Finance</option>
            <option value="Office of the Vice President for Mission and Identity"@if($unitFilter == "Office of the Vice President for Mission and Identity") selected @endif>Office of the Vice President for Mission and Identity</option>
            <option value="Printing Operations Office"@if($unitFilter == "Printing Operations Office") selected @endif>Printing Operations Office</option>
            <option value="School of Accountancy, Management, Computing and Information Studies"@if($unitFilter == "School of Accountancy, Management, Computing and Information Studies") selected @endif>School of Accountancy, Management, Computing and Information Studies</option>
            <option value="School of Advanced Studies"@if($unitFilter == "School of Advanced Studies") selected @endif>School of Advanced Studies</option>
            <option value="School of Engineering and Architecture"@if($unitFilter == "School of Engineering and Architecture") selected @endif>School of Engineering and Architecture</option>
            <option value="School of Law"@if($unitFilter == "School of Law") selected @endif>School of Law</option>
            <option value="School of Medicine"@if($unitFilter == "School of Medicine") selected @endif>School of Medicine</option>
            <option value="School of Nursing, Allied Health and Biological Sciences"@if($unitFilter == "School of Nursing, Allied Health and Biological Sciences") selected @endif>Asset Management and Inventory Control Office</option>
            <option value="School of Teacher Education and Liberal Arts"@if($unitFilter == "School of Teacher Education and Liberal Arts") selected @endif>School of Teacher Education and Liberal Arts</option>
            <option value="SFW - Halfway Home for Boys"@if($unitFilter == "SFW - Halfway Home for Boys") selected @endif>SFW - Halfway Home for Boys</option>
            <option value="SFW - Pedagogical and Developmental Center"@if($unitFilter == "SFW - Pedagogical and Developmental Center") selected @endif>SFW - Pedagogical and Developmental Center</option>
            <option value="SFW - Sunflower Child and Youth Wellness Center"@if($unitFilter == "SFW - Sunflower Child and Youth Wellness Center") selected @endif>SFW - Sunflower Child and Youth Wellness Center</option>
            <option value="SLU Parish"@if($unitFilter == "SLU Parish") selected @endif>SLU Parish</option>
            <option value="SLU Residence Halls - Guest House"@if($unitFilter == "SLU Residence Halls - Guest House") selected @endif>SLU Residence Halls - Guest House</option>
            <option value="SLU Residence Halls - Ladies' Residence Halls"@if($unitFilter == "SLU Residence Halls - Ladies' Residence Halls") selected @endif>SLU Residence Halls - Ladies' Residence Halls</option>
            <option value="SLU Residence Halls - Maryheights Students' Residence Halls"@if($unitFilter == "SLU Residence Halls - Maryheights Students' Residence Halls") selected @endif>SLU Residence Halls - Maryheights Students' Residence Halls</option>
            <option value="SLU Residence Halls - Men's Residence Hall"@if($unitFilter == "SLU Residence Halls - Men's Residence Hall") selected @endif>SLU Residence Halls - Men's Residence Hall</option>
            <option value="SLU Sacred Heart Medical Center"@if($unitFilter == "SLU Sacred Heart Medical Center") selected @endif>SLU Sacred Heart Medical Center</option>
            <option value="Technology Management and Development Department"@if($unitFilter == "Technology Management and Development Department") selected @endif>Technology Management and Development Department</option>
            <option value="Theophile Verbist Resource and Documentation Center"@if($unitFilter == "Theophile Verbist Resource and Documentation Center") selected @endif>Theophile Verbist Resource and Documentation Center</option>
            <option value="University Information Office"@if($unitFilter == "University Information Office") selected @endif>University Information Office</option>
            <option value="University Libraries"@if($unitFilter == "University Libraries") selected @endif>University Libraries</option>
            <option value="University Registrar's Office"@if($unitFilter == "University Registrar's Office") selected @endif>University Registrar's Office</option>
            <option value="University Research and Innovation Center"@if($unitFilter == "University Research and Innovation Center") selected @endif>University Research and Innovation Center</option>
            <!-- Add other options for the remaining units -->
        </select>
        <button type="submit">Apply Filter</button>
    </form>
</div>

<!-- Add a canvas element where the chart will be rendered -->
<div id="chartContainer">
    <canvas id="assetStatusChart"></canvas>
</div>

<div class="container">
    <div class="real-time-monitoring">
        <h2>Real-Time Monitoring</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Count</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Condemned</td>
                    <td id="condemnedCount"></td>
                </tr>
                <tr>
                    <td>Maintenance</td>
                    <td id="maintenanceCount"></td>
                </tr>
                <tr>
                    <td>Borrowed</td>
                    <td id="borrowedCount"></td>
                </tr>
                <tr>
                    <td>Calibration</td>
                    <td id="calibrationCount"></td>
                </tr>
                <tr>
                    <td>Acknowledged</td>
                    <td id="acknowledgedCount"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../res/js/asset_information.js"></script>
<script src="../res/js/navbar.js"></script>
<script src="../res/js/users.js"></script>

<!-- SCRIPT FOR DASHBOARD -->
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
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Update real-time monitoring table
        $("#condemnedCount").text(data['condemned'] || 0);
        $("#maintenanceCount").text(data['maintenance'] || 0);
        $("#borrowedCount").text(data['borrowed'] || 0);
        $("#calibrationCount").text(data['calibration'] || 0);
        $("#acknowledgedCount").text(data['acknowledged'] || 0);
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