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
        
        <link rel="stylesheet" href="../res/css/asset_information_employee.css">
        <link rel="stylesheet" href="../res/css/navbar.css">

    </head>

<body>

<style>
  table {
  table-layout: fixed;
  width: 400px;
  font: larger monospace;
  border-collapse: collapse;
}

#td {
  position: relative;
  border: solid 2px blue;
  width: 100px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  transition: all 0.3s;
}

#td:hover {
  white-space: normal;
  width: 1000px;
  z-index: 1;
  position: absolute;
  left: 5;
}




</style>

    <div class="navigation">
    <div class="nav-bar">
            <div id="menuToggle" class="toggle-menu active">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>

        <style type = "text/css">.user{font-size: 100%; position: absolute;
            right: 0;}</style>


        <div class="main">
            <div id="sideMenu" class="side-menu">
                <div class="menu-items">
                    <a href="{{ route ('employee/dashB')}}" class="item1">Dashboard</a>
                    <a href="{{ route ('employee/asset_info')}}" id="active_tab" class="one">Asset Information</a>
                    <a href="{{ route ('employee/receiving_repo')}}"  class="item1">Forms</a>
                    <a href="{{ route('logout') }}" class="item1">Logout</a>>
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

    <div class="container">
        <div class="form">
            <form action="/upload" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="file-input-container">
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


    </div>

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
                                  foreach($results as $result){
                                    echo ' <tr>
                                    <td><input type = "text"name = "'.$result->unit_code.'" value = "'.$result->unit_code.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->asset_tag.'" value = "'.$result->asset_tag.'"readonly> </td>
                                    <td><input type = "text"name = "'.$result->asset_desc.'" value = "'.$result->asset_desc.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->brand.'" value = "'.$result->brand.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->model.'" value = "'.$result->model.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->serial_no.'" value = "'.$result->serial_no.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->asset_class.'" value = "'.$result->asset_class.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->status.'" value = "'.$result->status.'" readonly> </td>
                                    </td>
                                    
                                   <td class="toggleBtns">
                                    <a class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></a>
                                    <a class="edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>
                                    <a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>
                                  </td>
                                  </tr>';
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
                                  foreach($results as $result){
                                    echo ' <tr>
                                    <td><input type = "text"name = "'.$result->cost.'" value = "'.$result->cost.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->warranty.'" value = "'.$result->warranty.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->build_loc.'" value = "'.$result->build_loc.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->floor.'" value = "'.$result->floor.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->spec_area.'" value = "'.$result->spec_area.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->note.'" value = "'.$result->note.'" readonly> </td>
                                    </td>
                                    
                                   <td class="toggleBtns">
                                    <a class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></a>
                                    <a class="edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>
                                    <a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>
                                  </td>
                                  </tr>';
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
                                  foreach($results as $result){
                                    echo ' <tr>
                                    <td><input type = "text"name = "'.$result->rr_no.'" value = "'.$result->rr_no.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->date_acq.'" value = "'.$result->date_acq.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->reference.'" value = "'.$result->reference.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->reference_date.'" value = "'.$result->reference_date.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->funded_by.'" value = "'.$result->funded_by.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->rs_no_transferred.'" value = "'.$result->rs_no_transferred.'" readonly> </td>
                                    </td>
                                    
                                   <td class="toggleBtns">
                                    <a class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></a>
                                    <a class="edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>
                                    <a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>
                                  </td>
                                  </tr>';
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
                                  foreach($results as $result){
                                    echo ' <tr>
                                    <td><input type = "text"name = "'.$result->rs_date.'" value = "'.$result->rs_date.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->from_loc.'" value = "'.$result->from_loc.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->doc_no.'" value = "'.$result->doc_no.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->doc_no_date.'" value = "'.$result->doc_no_date.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->received_from.'" value = "'.$result->received_from.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->received_by.'" value = "'.$result->received_by.'" readonly> </td>
                                    </td>
                                    
                                   <td class="toggleBtns">
                                    <a class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></a>
                                    <a class="edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>
                                    <a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>
                                  </td>
                                  </tr>';
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
                                  foreach($results as $result){
                                    echo ' <tr>
                                    <td><input type = "text"name = "'.$result->pb_no.'" value = "'.$result->pb_no.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->pb_date.'" value = "'.$result->pb_date.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->id_no.'" value = "'.$result->id_no.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->person_accountable.'" value = "'.$result->person_accountable.'" readonly> </td>
                            
                                    </td>
                                    
                                   <td class="toggleBtns">
                                    <a class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></a>
                                    <a class="edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>
                                    <a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>
                                  </td>
                                  </tr>';
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
                                  foreach($results as $result){
                                    echo ' <tr>
                                    <td><input type = "text"name = "'.$result->ms_no.'" value = "'.$result->ms_no.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->ms_date.'" value = "'.$result->ms_date.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->moni_log.'" value = "'.$result->moni_log.'" readonly> </td>
                                    </td>
                                    
                                   <td class="toggleBtns">
                                    <a class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></a>
                                    <a class="edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>
                                    <a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>
                                  </td>
                                  </tr>';
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
                                  foreach($results as $result){
                                    echo ' <tr>
                                    <td><input type = "text"name = "'.$result->cr_no.'" value = "'.$result->cr_no.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->cr_date.'" value = "'.$result->cr_date.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->remarks.'" value = "'.$result->remarks.'" readonly> </td>
                                    </td>
                                    
                                   <td class="toggleBtns">
                                    <a class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></a>
                                    <a class="edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>
                                    <a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>
                                  </td>
                                  </tr>';
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
                                  foreach($results as $result){
                                    echo ' <tr>
                                    <td><input type = "text"name = "'.$result->ar_no.'" value = "'.$result->ar_no.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->ar_date.'" value = "'.$result->ar_date.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->id_number.'" value = "'.$result->id_number.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->name_employee.'" value = "'.$result->name_employee.'" readonly> </td>
                                    </td>
                                    
                                   <td class="toggleBtns">
                                    <a class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></a>
                                    <a class="edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>
                                    <a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>
                                  </td>
                                  </tr>';
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
                                  foreach($results as $result){
                                    echo ' <tr>

                                    <td><input type = "text"name = "'.$result->cs_no.'" value = "'.$result->cs_no.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->cs_date.'" value = "'.$result->cs_date.'" readonly> </td>
                                    <td><input type = "text"name = "'.$result->moni_log_calibration.'" value = "'.$result->moni_log_calibration.'" readonly> </td>
                                    </td>
                                    
                                   <td class="toggleBtns">
                                    <a class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></a>
                                    <a class="edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>
                                    <a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>
                                  </td>
                                  </tr>';
                                  }
                                   
                              ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../res/js/asset_information.js"></script>
<script src="../res/js/navbar.js"></script>
<script src="../res/js/filterTableScript.js"></script>

</html>