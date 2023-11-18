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
                                  
$int = 0;                                  foreach($results as $result){ 
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
                                  
$int = 0;                                  foreach($results as $result){ 
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
                                  
$int = 0;                                  foreach($results as $result){ 
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
                                  
$int = 0;                                  foreach($results as $result){ 
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
                                  
$int = 0;                                  foreach($results as $result){ 
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
                                  
$int = 0;                                  foreach($results as $result){ 
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
                                  
$int = 0;                                  foreach($results as $result){ 
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
                                  
$int = 0;                                  foreach($results as $result){ 
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

</html>