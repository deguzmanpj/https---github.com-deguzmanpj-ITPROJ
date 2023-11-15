

// Wait for the document to be ready
$(document).ready(function () {
// Add a click event listener to all buttons with the class "edit-user"
$('.edit-user ').on('click ', function () {
var userId = $(this).data('userid '); // Get the "data-userid" attribute value
$('#editUserId').val(userId); // Set the value of the hidden input field in the edit modal
});

// Add a click event listener to all buttons with the class "delete-user"
$('.delete-user').on('click', function () {
        event.stopPropagation();
    var userId = $(this).data('userid'); // Get the "data-userid" attribute value
    // You can use this "userId" value for any further actions related to deletion
    $('#deleteUserModal' + userId).modal('show'); // Show the delete modal
});

// Add a click event listener to the sort button
$('#sortNameBtn').on('click', function () {
    // Get the table body and all its rows
    var tbody = $('#user-table tbody');
    var rows = tbody.find('tr').toArray();

    // Sort the rows based on the text content of the second column (name)
    rows.sort(function (a, b) {
        var nameA = $(a).find('td:eq(1)').text().toLowerCase();
        var nameB = $(b).find('td:eq(1)').text().toLowerCase();
        return nameA.localeCompare(nameB);
    });

    // Remove existing rows from the table
    tbody.empty();

    // Append the sorted rows to the table
    $.each(rows, function (index, row) {
        tbody.append(row);
    });
});

$('#sortUserIdBtn').on('click', function () {
    // Get the table body and all its rows
    var tbody = $('#user-table tbody');
    var rows = tbody.find('tr').toArray();

    // Sort the rows based on the text content of the first column (userID)
    rows.sort(function (a, b) {
        var userIdA = $(a).find('td:eq(0)').text().toLowerCase();
        var userIdB = $(b).find('td:eq(0)').text().toLowerCase();
        return userIdA.localeCompare(userIdB);
    });

    // Remove existing rows from the table
    tbody.empty();

    // Append the sorted rows to the table
    $.each(rows, function (index, row) {
        tbody.append(row);
    });
});

});

function searchUsers() {
    // Get the input value from the search bar
    var keyword = $('#search').val().toLowerCase();

    // Loop through each table row
    $('#user-table tbody tr').each(function () {
        // Get the text content of each column in the current row
        var userId = $(this).find('td:eq(0)').text().toLowerCase();
        var name = $(this).find('td:eq(1)').text().toLowerCase();
        var pass = $(this).find('td:eq(2)').text().toLowerCase();
        var email = $(this).find('td:eq(3)').text().toLowerCase();
        var contact_no = $(this).find('td:eq(4)').text().toLowerCase();
        var role = $(this).find('td:eq(5)').text().toLowerCase();

        // Check if any column contains the search keyword
        if (
            userId.includes(keyword) ||
            name.includes(keyword) ||
            pass.includes(keyword) ||
            email.includes(keyword) ||
            contact_no.includes(keyword) ||
            role.includes(keyword)
        ) {
            // If a match is found, show the row; otherwise, hide it
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

