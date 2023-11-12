<!DOCTYPE html>
<html lang="en"> 
    <head> 
        <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>User Management</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
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
                </button> <div id="menuToggle" class="toggle-menu active"> 
                    <span class="bar"></span> 
                    <span class="bar"></span>
                    <span class="bar"></span> 
                </div>
            </div>

                <div class="main">
                <div id="sideMenu" class="side-menu">
                    <div class="menu-items">
                    <a href="#" class="item">Dashboard</a>
                    <a href="{{ route('admin/users') }}" id="active_tab" class="item1">Users</a>
                    <a href="#" class="item" id="active_tab">Asset Management</a>
                    <a href="{{ route ('admin/pending')}}" class="item1">Pending Requests</a> <!-- item -->
                    <a href="#" class="item">Forms</a>
                    <a href="#" class="item">Logout</a>
                    </div>
                </div>
            </div> 
        </div> 
        
    <div class = "container">
        <div class="header">
            <div><p class="amicoLogo">AMICO ASSET MANAGEMENT</p></div>
            <div><p class="pageTitle">USER MANAGEMENT</p> </div>
        </div>
    </div>
        
        <div class="table-title">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <input type="text" id="userSearch" placeholder="Search" class="form-control">
                </div>
                <button type="button" id="sortByUserId" class="btn btn-info"><i class="fa fa-sort"></i>Sort by User ID</button>
                <button id="sortByName" class="btn btn-info">Sort by Name</button>
                <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i>Add User</button> 
            </div> 
        </div>
    </div> 
                
                    <div class="row pop-up">
                        <button class="close-button"> x </button> <div class=entry> <div class="form">
                            <form action="/add-user" method="POST"> 
                                <!-- cross-site request forgery --> 
                                @csrf 
                                @if($errors->any()) 
                                <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                    </div>
                        @endif
                                <label for="userId">User ID</label>
                                <input class="inputForm" type=text id="userId" name="userId" required>

                                <label for="name">Name</label>
                                <input class="inputForm" type=text id="name" name="name" required>

                                <label for="pass">Password</label>
                                <input class="inputForm" type=text id="pass" name="pass" required>

                                <label for="email">Email</label>
                                <input class="inputForm" type=text id="email" name="email" required>

                                <label for="contact_no">Contact Number</label>
                                <input class="inputForm" type=text id="contact_no" name="contact_no" required>

                                <label for="role">Role</label>
                                <input class="inputForm" type=text id="role" name="role" required>

                                <button type="submit" id="submit" value="Submit"> Add User </button>
                                </form>
                                </div>
                            </div>
                        </div>

                <div class="wrapper">
                <section class="section section--large" id="part1">
                    <div class="container">
                    <div class="table-wrapper">
                    <div class="table-title">
                        </div>

                        <script>
                        // Wait for the document to be ready
                        $(document).ready(function () {
                        // Add a click event listener to all buttons with the class "edit-user"
                        $('.edit-user ').on('click ', function () {
                        var userId = $(this).data('userid '); // Get the "data-userid" attribute value
                        $('#editUserId').val(userId); // Set the value of the hidden input field in the edit modal
                        });

                        // Add a click event listener to all buttons with the class "delete-user"
                        $('.delete-user').on('click', function () {
                        var userId = $(this).data('userid'); // Get the "data-userid" attribute value
                        // You can use this "userId" value for any further actions related to deletion
                        $('#deleteUserModal' + userId).modal('show'); // Show the delete modal
                        });
                        });
                        </script>

                        <table class="table table-bordered" id="user-table">
                            <thead>
                            <tr>
                            <th>UserID</th>
                            <th>Name</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Role</th>
                            <th>Edit or Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(isset($userId))
                                <tr>
                                <td>User ID: {{ $userId }}</td>
                                <td>Name: {{ $user->name }}</td>
                                <td>Password: {{ $user->pass }}</td>
                                <td>Email: {{ $user->email }}</td>
                                <td>Contact Number: {{ $user->contact_no }}</td>
                                <td>Role: {{ $user->role }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-primary edit-user" data-toggle="modal"
                                        data-target="#editUserModal{{ $user->userId }}"
                                        data-userid="{{ $user->userId }}">Edit</button>
                                    <!-- Delete Button -->
                                    <button class="btn btn-danger delete-user" data-toggle="modal"
                                        data-target="#deleteUserModal{{ $user->userId }}" 
                                        data-userid="{{ $user->userId }}" 
                                        data-username="{{ $user->name }}">Delete</button>
                                </td>
                                </tr>
                                @elseif(isset($userData) && count($userData) > 0)
                                @foreach($userData as $user)
                                <tr>
                                    <td>{{ $user->userId }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->pass }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->contact_no }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <button class="btn btn-primary edit-user" data-toggle="modal"
                                            data-target="#editUserModal{{ $user->userId }}"
                                            data-userid="{{ $user->userId }}">Edit</button>
                                        <!-- Delete Button -->
                                        <button class="btn btn-danger delete-user" data-toggle="modal"
                                            data-target="#deleteUserModal{{ $user->userId }}"
                                            data-userid="{{ $user->userId }}" 
                                            data-username="{{ $user->name }}">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="7">No user data available</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

                <nav>
                    <!-- Your navigation links here -->
                    <a href="{{ route('admin/receiving_repo') }}" class="item1">Receiving Report</a>
                    <a href="{{ route('admin/asset_info') }}" class="one" id="active_page">Asset Information</a>
                    <a href="{{ route('admin/ack_repo') }}" class="item1">Acknowledgement Report</a>
                    <a href="{{ route('admin/prop_borr') }}" class="item1">Property Borrowing</a>
                    <a href="{{ route('admin/main_req') }}" class="item1">Maintenance Request</a>
                    <a href="{{ route('admin/condemn_req') }}" class="item1">Condemnation Request</a>
                </nav>
                </div>

                @foreach($userData as $user)
                <!-- Edit User Modal -->
                <div class="modal fade" id="editUserModal{{ $user->userId }}" tabindex="-1" role="dialog"
                aria-labelledby="editUserModalLabel{{ $user->userId }}">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editUserModalLabel{{ $user->userId }}">Edit User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin/users.update', $user->userId) }}" method="POST">
                                    @csrf
                                    <input type="hidden" id="editUserId{{ $user->userId }}" name="userId"
                                        value="{{ $user->userId }}">

                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" value="{{ $user->name }}" required>

                                    <label for="pass">Password</label>
                                    <input type="text" id="pass" name="pass" value="{{ $user->pass }}" required>

                                    <label for="email">Email</label>
                                    <input type="text" id="email" name="email" value="{{ $user->email }}" required>

                                    <label for="contact_no">Contact Number</label>
                                    <input type="text" id="contact_no" name="contact_no" value="{{ $user->contact_no }}"
                                        required>

                                    <label for="role">Role</label>
                                    <input type="text" id="role" name="role" value="{{ $user->role }}" required>

                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                

                <!-- Delete User Modal -->
                <div class="modal fade" id="deleteUserModal{{ $user->userId }}" tabindex="-1" role="dialog"
                    aria-labelledby="deleteUserModalLabel{{ $user->userId }}">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteUserModalLabel{{ $user->userId }}">Confirm Deletion</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h4>Are you sure you want to delete this user "{{ $user->name }}"?</h4>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('admin/users.delete', $user->userId) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
                                    
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <script src="../res/js/asset_information.js"></script>
                <script src="../res/js/navbar.js"></script>

                <!-- Place this script in the head or at the end of the body -->
                <script>
                    $(document).ready(function () {
                        // Function to sort the table by name
                        function sortTable() {
                            var table, rows, switching, i, x, y, shouldSwitch;
                            table = document.getElementById("user-table");
                            switching = true;

                            // Run loop until no switching is needed
                            while (switching) {
                                switching = false;
                                rows = table.rows;

                                // Loop through all table rows (except the header)
                                for (i = 1; i < (rows.length - 1); i++) {
                                    shouldSwitch = false;

                                    // Compare the two names
                                    x = rows[i].getElementsByTagName("td")[1]; // Change index if the name column is different
                                    y = rows[i + 1].getElementsByTagName("td")[1];

                                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                                        shouldSwitch = true;
                                        break;
                                    }
                                }

                                if (shouldSwitch) {
                                    // Swap the rows and mark that switching is done
                                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                                    switching = true;
                                }
                            }
                        }

                        // Add click event listener to the sort button
                        $("#sortByName").on("click", function () {
                            sortTable();
                        });
                    });
                </script>

                <script>
                    $(document).ready(function () {
                        // Add a click event listener to the "Sort by User ID" button
                        $('#sortByUserId').on('click', function () {
                            sortTableByUserId();
                        });

                        // Add a click event listener to all buttons with the class "edit-user"
                        $('.edit-user').on('click', function () {
                            var userId = $(this).data('userid');
                            $('#editUserId').val(userId);
                        });

                        // Add a click event listener to all buttons with the class "delete-user"
                        $('.delete-user').on('click', function () {
                            var userId = $(this).data('userid');
                            $('#deleteUserModal' + userId).modal('show');
                        });

                        // Function to sort the table by User ID
                        function sortTableByUserId() {
                            var table, rows, switching, i, x, y, shouldSwitch;
                            table = document.getElementById("user-table");
                            switching = true;

                            while (switching) {
                                switching = false;
                                rows = table.getElementsByTagName("tr");

                                for (i = 1; i < (rows.length - 1); i++) {
                                    shouldSwitch = false;
                                    x = rows[i].getElementsByTagName("td")[0];
                                    y = rows[i + 1].getElementsByTagName("td")[0];

                                    if (parseInt(x.innerHTML) > parseInt(y.innerHTML)) {
                                        shouldSwitch = true;
                                        break;
                                    }
                                }

                                if (shouldSwitch) {
                                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                                    switching = true;
                                }
                            }
                        }
                    });
                </script>

                <script>
                    $(document).ready(function () {
                        // Add an input event listener to the search input field
                        $('#userSearch').on('input', function () {
                            searchTable();
                        });

                        function searchTable() {
                            var input, filter, table, tr, td, i, j, txtValue;
                            input = document.getElementById("userSearch");
                            filter = input.value.toUpperCase();
                            table = document.getElementById("user-table");
                            tr = table.getElementsByTagName("tr");

                            // Loop through all table rows
                            for (i = 0; i < tr.length; i++) {
                                var display = false;
                                td = tr[i].getElementsByTagName("td");

                                // Loop through all columns in the current row
                                for (j = 0; j < td.length; j++) {
                                    txtValue = td[j].textContent || td[j].innerText;

                                    // If any column matches the search query, set display to true
                                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                        display = true;
                                        break; // No need to check other columns in this row
                                    }
                                }

                                // Show or hide the row based on the search result
                                if (display) {
                                    tr[i].style.display = "";
                                } else {
                                    tr[i].style.display = "none";
                                }
                            }
                        }
                    });
                </script>

            </body>

        </html>