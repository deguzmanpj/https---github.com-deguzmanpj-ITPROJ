<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
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
    <button class="notification-button">
        <i class="fas fa-bell"></i> <!-- Bell icon -->
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
                    <a href="{{ route ('admin/dash')}}" class="item1">Dashboard</a>
                    <a href="{{ route ('admin/asset_info')}}" id="active_tab" class="one">Asset Information</a>
                    <a href="{{ route ('admin/receiving_repo')}}"  class="item1">Forms</a>
                    <a href="{{ route('admin/users') }}" class="item1">Users</a>
                    <a href="#" class="item">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class = "container">
        <div class="header">
            <div><p class="amicoLogo">AMICO ASSET MANAGEMENT</p></div>
            <div><p class="pageTitle">ASSET INFORMATION</p></div>
        </div>
    </div>

        <!-- Add this code above your existing table -->

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
            <h4>TABLE FILTER</h4>
            <select id="unitFilter" onchange="filterTable()">
                <option value="all">All Units</option>
                <option value="AMC">AMC - Asset Management and Inventory Control Office</option>
                <option value="BES">BES - Basic Education School - Laboratory Elementary School</option>
                <option value="BES">BES - Basic Education School - Laboratory Junior High School</option>
                <option value="BES">BES - Basic Education School - Laboratory Senior High School</option>
                <option value="CMS">CMS - Campus Planning, Maintenance, and Security Department</option>
                <option value="CCM">CCM - Center for Campus Ministry</option>
                <option value="CCW">CCW - Center for Counseling and Wellness</option>
                <option value="CCA">CCA - Center for Culture and the Arts</option>
                <option value="CSD">CSD - Center for Sports Development</option>
                <option value="CIR">CIR - CICM Residence</option>
                <option value="CEO">CEO - Community Extension and Outreach Programs Office</option>
                <option value="DPO">DPO - Data Protection Office</option>
                <option value="FIN">FIN - Finance Office - Accounting Section</option>
                <option value="FIN">FIN - Finance Office - Bookstore</option>
                <option value="FIN">FIN - Finance Office - Payroll Section</option>
                <option value="FIN">FIN - Finance Office - Purchasing Department</option>
                <option value="FIN">FIN - Finance Office - Student Account Support Services</option>
                <option value="FIN">FIN - Finance Office - Transportation Department</option>
                <option value="DEC">DEC - Health Services Unit - Dental Clinic</option>
                <option value="MEC">MEC - Health Services Unit - Medical Clinic</option>
                <option value="HRD">HRD - Human Resource Department</option>
                <option value="MIC">MIC - Museum of Igorot Cultures and Arts - Center for Indigenous Studies</option>
                <option value="OLA">OLA - Office for Legal Affairs</option>
                <option value="GRA">GRA - Office of Global Relations and Alumni Affairs</option>
                <option value="QMO">QMO - Office of Institutional Development and Quality Assurance</option>
                <option value="OSA">OSA - Office of Student Affairs and Services</option>
                <option value="OIA">OIA - Office of the Internal Auditor</option>
                <option value="OUP">OUP - Office of the President</option>
                <option value="VAA">VAA - Office of the Vice President for Academic Affairs</option>
                <option value="VAD">VAD - Office of the Vice President for Administration</option>
                <option value="VFI">VFI - Office of the Vice President for Finance</option>
                <option value="VMI">VMI - Office of the Vice President for Mission and Identity</option>
                <option value="POO">POO - Printing Operations Office</option>
                <option value="SMI">SMI - School of Accountancy, Management, Computing and Information Studies</option>
                <option value="SAS">SAS - School of Advanced Studies</option>
                <option value="SEA">SEA - School of Engineering and Architecture</option>
                <option value="SOL">SOL - School of Law</option>
                <option value="SOM">SOM - School of Medicine</option>
                <option value="SNA">SNA - School of Nursing, Allied Health and Biological Sciences</option>
                <option value="STL">STL - School of Teacher Education and Liberal Arts</option>
                <option value="HHB">HHB - SFW - Halfway Home for Boys</option>
                <option value="PDC">PDC - SFW - Pedagogical and Developmental Center</option>
                <option value="SFW">SFW - SFW - Sunflower Child and Youth Wellness Center</option>
                <option value="SLP">SLP - SLU Parish</option>
                <option value="GUH">GUH - SLU Residence Halls - Guest House</option>
                <option value="LRH">LRH - SLU Residence Halls - Ladies' Residence Halls</option>
                <option value="MSRH">MSRH - SLU Residence Halls - Maryheights Students' Residence Halls</option>
                <option value="MRH">MRH - SLU Residence Halls - Men's Residence Hall</option>
                <option value="SHMC">SHMC - SLU Sacred Heart Medical Center</option>
                <option value="TMD">TMD - Technology Management and Development Department</option>
                <option value="TRD">TRD - Theophile Verbist Resource and Documentation Center</option>
                <option value="UIO">UIO - University Information Office</option>
                <option value="UNL">UNL - University Libraries</option>
                <option value="URO">URO - University Registrar's Office</option>
                <option value="URI">URI - University Research and Innovation Center</option>
            </select>
            <button onclick="filterTableByUnit()">Filter by Unit</button>   

            <select id="statusFilter" onchange="filterTable()">
                <option value="all">All Status</option>
                <option value="condemned">Condemned</option>
                <option value="maintenance">Maintenance</option>
                <option value="borrowed">Borrowed</option>
                <option value="calibration">Calibration</option>
                <option value="acknowledged">Acknowledged</option>
            </select>
            <button onclick="filterTableByUnitAndStatus()">Filter by Unit and Status</button>
        </div>
        
    <!-- <div class="table-title">
        <div class="row">
            <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add Entry</button>
            </div>
        </div>
    </div> -->

    <form action = "/edit_asset" method = "post">
        @csrf
    <div class="wrapper">
            <section class="section section--large" id="part1">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                        </div>
                        <table class="table table-bordered" id="9table1">
                            <thead>
                                <tr>
                                    <th>Unit</th>
                                    <th>Tag Number</th>
                                    <th>Asset Description</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Serial No</th>
                                    <th>Asset Class</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                use Illuminate\Support\Facades\Log;
                                 $int = 0; 
                                foreach($results as $result){ 
                                    echo ' <tr>
                                    <td><input type = "text"name="unit_code'.$int.'"value = "'.$result->unit_code.'" readonly> </td>
                                    <td><input type = "text"name="asset_tag'.$int.'"value = "'.$result->asset_tag.'"readonly> </td>
                                    <td><input type = "text"name="asset_desc'.$int.'"value = "'.$result->asset_desc.'" readonly> </td>
                                    <td><input type = "text"name="brand'.$int.'"value = "'.$result->brand.'" readonly> </td>
                                    <td><input type = "text"name="model'.$int.'"value = "'.$result->model.'" readonly> </td>
                                    <td><input type = "text"name="serial_no'.$int.'"value = "'.$result->serial_no.'" readonly> </td>
                                    <td><input type = "text"name="asset_class'.$int.'"value = "'.$result->asset_class.'" readonly> </td>
                                    <td><input type = "text"name="status'.$int.'"value = "'.$result->status.'" readonly> </td>
                                    </td>
                                    
                                   <td class="toggleBtns">
                                    <button type = "submit" name ="button_pressed" value= "'.$int.'"  name ="button_pressed" value= "'.$int.'" class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></button>
                                    <a class = "edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>
                                    <a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>
                                  </td>
                                  </tr>';
                                  $int++;
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
                        <table class="table table-bordered" id="6table2">
                            <thead>
                                <tr>
                                    <th>Cost</th>
                                    <th>Warranty</th>
                                    <th>Building Loc</th>
                                    <th>Floor</th>
                                    <th>Specific Area</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php                                  
$int = 0;                           foreach($results as $result){ 
                                    echo ' <tr>
                                    <td><input type = "text"name="cost'.$int.'"value = "'.$result->cost.'" readonly> </td>
                                    <td><input type = "text"name="warranty'.$int.'"value = "'.$result->warranty.'" readonly> </td>
                                    <td><input type = "text"name="build_loc'.$int.'"value = "'.$result->build_loc.'" readonly> </td>
                                    <td><input type = "text"name="floor'.$int.'"value = "'.$result->floor.'" readonly> </td>
                                    <td><input type = "text"name="spec_area'.$int.'"value = "'.$result->spec_area.'" readonly> </td>
                                    <td><input type = "text"name="note'.$int.'"value = "'.$result->note.'" readonly> </td>
                                    </td>
                                    
                                   <td class="toggleBtns">
                                    <button type = "submit" name ="button_pressed" value= "'.$int.'"  class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></button>
                                    <a class = "edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>
                                    <a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>
                                  </td>
                                  </tr>';
                                  $int++;
                                  }
                              ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section class="section section--small" id="part3">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                        </div>
                        <table class="table table-bordered" id="6table3">
                            <thead>
                                <tr>
                                    <th>RR Number</th>
                                    <th>RR Date</th>
                                    <th>PO No.</th>
                                    <th>PO Date </th>
                                    <th>Funded By</th>
                                    <th>RS No. - Transferred</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php                       
$int = 0;                           foreach($results as $result){ 
                                    echo ' <tr>
                                    <td><input type = "text"name="rr_no'.$int.'"value = "'.$result->rr_no.'" readonly> </td>
                                    <td><input type = "text"name="date_acq'.$int.'"value = "'.$result->date_acq.'" readonly> </td>
                                    <td><input type = "text"name="reference'.$int.'"value = "'.$result->reference.'" readonly> </td>
                                    <td><input type = "text"name="reference_date'.$int.'"value = "'.$result->reference_date.'" readonly> </td>
                                    <td><input type = "text"name="funded_by'.$int.'"value = "'.$result->funded_by.'" readonly> </td>
                                    <td><input type = "text"name="rs_no_transferred'.$int.'"value = "'.$result->rs_no_transferred.'" readonly> </td>
                                    </td>
                                   <td class="toggleBtns">
                                    <button type = "submit" name ="button_pressed" value= "'.$int.'"  class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></button>
                                    <a class = "edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>
                                    <a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>
                                  </td>
                                  </tr>';
                                  $int++;
                                  }
                              ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section class="section section--large four" id="part4">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                        </div>
                        <table class="table table-bordered" id="6table4">
                            <thead>
                                <tr>
                                    <th>RS Date</th>
                                    <th>From - location</th>
                                    <th>Doc No. - Donation/Grant</th>
                                    <th>Date</th>
                                    <th>From - Donator/Grantor</th>
                                    <th>Received By</th>
                                    <td class="toggleBtns">
                                </tr>
                            </thead>
                            <tbody>
                            <?php        
$int = 0;                           foreach($results as $result){ 
                                    echo ' <tr>
                                    <td><input type = "text"name="rs_date'.$int.'"value = "'.$result->rs_date.'" readonly> </td>
                                    <td><input type = "text"name="from_loc'.$int.'"value = "'.$result->from_loc.'" readonly> </td>
                                    <td><input type = "text"name="doc_no'.$int.'"value = "'.$result->doc_no.'" readonly> </td>
                                    <td><input type = "text"name="doc_no_date'.$int.'"value = "'.$result->doc_no_date.'" readonly> </td>
                                    <td><input type = "text"name="received_from'.$int.'"value = "'.$result->received_from.'" readonly> </td>
                                    <td><input type = "text"name="received_by'.$int.'"value = "'.$result->received_by.'" readonly> </td>
                                    </td>
            
                                   <td class="toggleBtns">
                                    <button type = "submit" name ="button_pressed" value= "'.$int.'"  class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></button>
                                    <a class = "edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>
                                    <a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>
                                  </td>
                                  </tr>';
                                  $int++;
                                  }         
                              ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section class="section section--large five" id="part5">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                        </div>
                        <table class="table table-bordered" id="4table5">
                            <thead>
                                <tr>
                                    <th>PB No.</th>
                                    <th>PB Date</th>
                                    <th>ID No.</th>
                                    <th>Person Acountable</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php                            
$int = 0;                           foreach($results as $result){ 
                                    echo ' <tr>
                                    <td><input type = "text"name="pb_no'.$int.'"value = "'.$result->pb_no.'" readonly> </td>
                                    <td><input type = "text"name="pb_date'.$int.'"value = "'.$result->pb_date.'" readonly> </td>
                                    <td><input type = "text"name="id_no'.$int.'"value = "'.$result->id_no.'" readonly> </td>
                                    <td><input type = "text"name="person_accountable'.$int.'"value = "'.$result->person_accountable.'" readonly> </td>
                                    </td>
                                   <td class="toggleBtns">
                                    <button type = "submit" name ="button_pressed" value= "'.$int.'"  class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></button>
                                    <a class = "edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>
                                    <a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>
                                  </td>
                                  </tr>';
                                  $int++;
                                  }            
                              ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section class="section section--large six" id="part6">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                        </div>
                        <table class="table table-bordered" id="3table6">
                            <thead>
                                <tr>
                                    <th>MS No.</th>
                                    <th>MS Date</th>
                                    <th>Monitoring Log</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php                              
$int = 0;                           foreach($results as $result){ 
                                    echo ' <tr>
                                    <td><input type = "text"name="ms_no'.$int.'"value = "'.$result->ms_no.'" readonly> </td>
                                    <td><input type = "text"name="ms_date'.$int.'"value = "'.$result->ms_date.'" readonly> </td>
                                    <td><input type = "text"name="moni_log'.$int.'"value = "'.$result->moni_log.'" readonly> </td>
                                    </td>
                                    
                                   <td class="toggleBtns">
                                    <button type = "submit" name ="button_pressed" value= "'.$int.'"  class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></button>
                                    <a class = "edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>
                                    <a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>
                                  </td>
                                  </tr>';
                                  $int++;
                                  }              
                              ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section class="section section--large seven" id="part7">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                        </div>
                        <table class="table table-bordered" id="3table7">
                            <thead>
                                <tr>
                                    <th>CR No.</th>
                                    <th>CR Date</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                  
$int = 0;                           foreach($results as $result){ 
                                    echo ' <tr>
                                    <td><input type = "text"name="cr_no'.$int.'"value = "'.$result->cr_no.'" readonly> </td>
                                    <td><input type = "text"name="cr_date'.$int.'"value = "'.$result->cr_date.'" readonly> </td>
                                    <td><input type = "text"name="remarks'.$int.'"value = "'.$result->remarks.'" readonly> </td>
                                    </td>
                                   <td class="toggleBtns">
                                    <button type = "submit" name ="button_pressed" value= "'.$int.'"  class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></button>
                                    <a class = "edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>
                                    <a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>
                                  </td>
                                  </tr>';
                                  $int++;
                                  }
                              ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section class="section section--large eight" id="part8">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                        </div>
                        <table class="table table-bordered" id="3table8">
                            <thead>
                                <tr>
                                    <th>AR No.</th>
                                    <th>AR Date</th>
                                    <th>ID No.</th>
                                    <th>Employee Accountable</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php       
$int = 0;                           foreach($results as $result){ 
                                    echo ' <tr>
                                    <td><input type = "text"name="ar_no'.$int.'"value = "'.$result->ar_no.'" readonly> </td>
                                    <td><input type = "text"name="ar_date'.$int.'"value = "'.$result->ar_date.'" readonly> </td>
                                    <td><input type = "text"name="id_number'.$int.'"value = "'.$result->id_number.'" readonly> </td>
                                    <td><input type = "text"name="name_employee'.$int.'"value = "'.$result->name_employee.'" readonly> </td>
                                    </td>
                                   <td class="toggleBtns">
                                    <button type = "submit" name ="button_pressed" value= "'.$int.'"  class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></button>
                                    <a class = "edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>
                                    <a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>
                                  </td>
                                  </tr>';
                                  $int++;
                                  }
                              ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            </section>
            <section class="section section--large nine" id="part9">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                        </div>
                        <table class="table table-bordered" id="3table9">
                            <thead>
                                <tr>
                                    <th>CS No.</th>
                                    <th>CS Date</th>
                                    <th>Monitoring</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                  
$int = 0;                           foreach($results as $result){ 
                                    echo ' <tr>
                                    <td><input type = "text"name="cs_no'.$int.'"value = "'.$result->cs_no.'" readonly> </td>
                                    <td><input type = "text"name="cs_date'.$int.'"value = "'.$result->cs_date.'" readonly> </td>
                                    <td><input type = "text"name="moni_log_calibration'.$int.'"value = "'.$result->moni_log_calibration.'" readonly> </td>
                                    </td> 
                                   <td class="toggleBtns">
                                    <button type = "submit" name ="button_pressed" value= "'.$int.'"  class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></button>
                                    <a class = "edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>
                                    <a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>
                                  </td>
                                  </tr>';
                                  $int++;
                                  }
                                   
                              ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

    </form>
        <!--<nav>
        <a href="{{ route ('admin/receiving_repo')}}" class="item1">Receiving Report</a>
            <a href="{{ route ('admin/ack_repo')}}" class="item1">Acknowledgement Report</a>
            <a href="{{ route ('admin/prop_borr')}}" class="item1">Property Borrowing</a>
            <a href="{{ route ('admin/main_req')}}" class="item1">Maintenance Request</a>
            <a href="{{ route ('admin/condemn_req')}}" class="item1">Condemnation Request</a>
            <a href="{{ route ('admin/calib_req')}}" class="item1" >Calibration Request</a>
        </nav>
                                -->                       
    <script>
        window.csrf_token = "{{ csrf_token() }}";
    </script>

    <!-- Modal for delete confirmation -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this asset with an asset description of: <span id="assetDesc" style="font-weight: bold;"></span> 
                and serial number of: <span id="serialNumber" style="font-weight: bold;"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes</button>
            </div>
        </div>
    </div>
</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../res/js/asset_information.js"></script>
<script src="../res/js/navbar.js"></script>
<script src="../res/js/filterTableScript.js"></script>

</html>