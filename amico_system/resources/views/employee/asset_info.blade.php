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

        <div class="main">
            <div id="sideMenu" class="side-menu">
                <div class="menu-items">
                    <a href="{{ route ('employee/dashB')}}" class="item1">Dashboard</a>
                    <a href="{{ route ('employee/asset_info')}}" id="active_tab" class="one">Asset Information</a>
                    <a href="{{ route ('employee/receiving_repo')}}"  class="item1">Forms</a>
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


        <div class="table-title">

            <div class="row">
                <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Leave Note</button>
            </div>
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
                                use Illuminate\Support\Facades\Log;
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

        <nav>
        <!-- <a href="{{ route ('employee/receiving_repo')}}" class="two">Receiving Report</a>
        <a href="{{ route ('employee/asset_info')}}" class="one"   id = "active_page" >Asset Information</a>
        <a href="{{ route ('employee/ack_repo')}}" class="three">Acknowledgement Report</a>
        <a href="{{ route ('employee/prop_borr')}}" class="four">Property Borrowing</a>
        <a href="{{ route ('employee/main_req')}}" class="five">Maintenance Request</a>
        <a href="{{ route ('employee/condemn_req')}}" class="six">Condemnation Request</a>
        <a href="{{ route ('employee/calib_req')}}" class="six">Calibration Request</a> -->
        </nav>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../res/js/asset_information.js"></script>
<script src="../res/js/navbar.js"></script>

</html>