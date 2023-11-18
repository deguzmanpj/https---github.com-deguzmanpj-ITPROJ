function filterTableByUnitAndStatus() {
    var unitFilter = document.getElementById("unitFilter").value;
    var statusFilter = document.getElementById("statusFilter").value.toLowerCase();

    var table = document.getElementById("9table1");
    var rows = table.getElementsByTagName("tr");

    for (var i = 1; i < rows.length; i++) {
        var unitColumn = rows[i].getElementsByTagName("td")[0]; // Assuming unit code is in the first column
        var statusColumn = rows[i].getElementsByTagName("td")[7]; // Assuming status is in the eighth column

        var unitMatch = (unitFilter === "all" || unitColumn.querySelector("input").value === unitFilter);
        var statusMatch = (statusFilter === "all" || statusColumn.querySelector("input").value.toLowerCase() === statusFilter);

        if (unitMatch && statusMatch) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}

function filterTableByUnit() {
    var selectedUnitCode = document.getElementById('unitFilter').value;
    var tableRows = document.querySelectorAll('.table tbody tr');

    tableRows.forEach(function(row) {
        var unitCodeCell = row.cells[0].querySelector('input').value.trim(); // Assuming the unit code is in the first column input field

        if (selectedUnitCode === 'all' || unitCodeCell === selectedUnitCode) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}