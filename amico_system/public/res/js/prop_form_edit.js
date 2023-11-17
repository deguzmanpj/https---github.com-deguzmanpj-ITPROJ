var selectUnit = document.querySelector('#unit_dropdown');
var selectedUnitValue = selectUnit.value;
console.log(selectedUnitValue);

var resultsDataElement = document.getElementById('unitsData');
var resultsData = JSON.parse(resultsDataElement.getAttribute('data-results'));


var officeDropdown = document.querySelector('#office_dropdown');
officeDropdown.innerHTML = ""; // Clear existing options

for (var i = 0; i < resultsData.length; i++) {
    // Access individual objects in the array
    var unit = resultsData[i];

    // Check if the unitName matches the selected value
    if (unit.unit === selectedUnitValue) {
        // Create an option element and add it to the dropdown
        var option = document.createElement("option");
        option.value = unit.office;
        option.text = unit.office;
        officeDropdown.appendChild(option);
    }
}


var unit_copy = document.querySelector("#unit_copy");


unit_copy.value = selectedUnitValue;



function updateOfficeOptions() {
    selectUnit = document.querySelector('#unit_dropdown');
    selectedUnitValue = selectUnit.value;
    officeDropdown.innerHTML = "";

    for (var i = 0; i < resultsData.length; i++) {
        // Access individual objects in the array
        var unit = resultsData[i];

        // Check if the unitName matches the selected value
        if (unit.unit === selectedUnitValue) {
            // Create an option element and add it to the dropdown
            var option = document.createElement("option");
            option.value = unit.office;
            option.text = unit.office;
            officeDropdown.appendChild(option);
        }
    }
    unit_copy.value = selectedUnitValue;

}

var e_borrow = document.querySelector('#e_borrow');
var i_borrow = document.querySelector('#i_borrow');
var ii_borrow = document.querySelector('#ii_borrow');
var iii_borrow = document.querySelector('#iii_borrow');

function setEB() {
    var selectedOption = document.querySelector('input[name="e_borrow"]:checked');
    var e_borrower = document.getElementById('e_borrower');

    if (selectedOption) {
        // If an option is selected, get its value
        var selectedValue = selectedOption.value;
        e_borrow.value = selectedValue;
        // If the checkbox is unchecked, remove the required attribute and make the input editable
        e_borrower.required = true;
        e_borrower.readOnly = true;
        e_borrower.value = ""; // Clear the input field
    }
}

function specifyOtherEB() {
    var selectedOption = document.querySelector('input[name="e_borrow"]:checked');
    var e_borrower = document.getElementById('e_borrower');


    e_borrower.addEventListener('input', function () {
        // get value of input
        e_borrow.value = selectedOption.value;
    });

    if (selectedOption) {
        e_borrower.required = false;
        e_borrower.readOnly = false;
        e_borrower.value = "INPUT REQUIRED";
        e_borrow.value = "INPUT REQUIRED";
    }
}

function setIB() {
    var selectedOption = document.querySelector('input[name="i_borrow"]:checked');
    var i_borrowers = document.querySelectorAll('#i_borrower');

    if (selectedOption) {
        // If an option is selected, get its value
        var selectedValue = selectedOption.value;
        i_borrow.value = selectedValue;

        i_borrowers.forEach(function (i_borrower) {
            // If the checkbox is unchecked, remove the required attribute and make the input editable
            i_borrower.required = true;
            i_borrower.readOnly = true;
            i_borrower.value = ""; // Clear the input field
        });

    }
    console.log(i_borrow);
}

function specifyOtherIB() {
    var selectedOption = document.querySelector('input[name="i_borrow"]:checked');
    var i_borrowers = document.querySelectorAll('#i_borrower');


    // Add event listener to each 'i_borrower' element
    i_borrowers.forEach(function (i_borrower) {
        i_borrower.addEventListener('input', function () {
            // Concatenate all 'i_borrower' values
            var concatenatedValue = Array.from(i_borrowers).map(function (element) {
                return element.value;
            }).join('|||');

            // Update 'i_borrow' value
            i_borrow.value = concatenatedValue;
            console.log(i_borrow);
        });
    });

    if (selectedOption) {
        i_borrowers.forEach(function (i_borrower) {
            i_borrower.required = false;
            i_borrower.readOnly = false;
            i_borrowers[0].value = "INPUT REQUIRED";
            i_borrow.value = "INPUT REQUIRED";
        });

    }
    console.log(i_borrow);
}

function setIIB() {
    var selectedOption = document.querySelector('input[name="ii_borrow"]:checked');
    var ii_borrowers = document.querySelectorAll('#ii_borrower');

    if (selectedOption) {
        // If an option is selected, get its value
        var selectedValue = selectedOption.value;
        ii_borrow.value = selectedValue;

        ii_borrowers.forEach(function (ii_borrower) {
            // If the checkbox is unchecked, remove the required attribute and make the input editable
            ii_borrower.required = true;
            ii_borrower.readOnly = true;
            ii_borrower.value = ""; // Clear the input field
        });

    }
}

function specifyOtherIIB() {
    var selectedOption = document.querySelector('input[name="ii_borrow"]:checked');
    var ii_borrowers = document.querySelectorAll('#ii_borrower');


    // Add event listener to each 'i_borrower' element
    ii_borrowers.forEach(function (ii_borrower) {
        ii_borrower.addEventListener('input', function () {
            // Concatenate all 'i_borrower' values
            var concatenatedValue = Array.from(ii_borrowers).map(function (element) {
                return element.value;
            }).join('|||');

            // Update 'i_borrow' value
            ii_borrow.value = concatenatedValue;
        });
    });

    if (selectedOption) {
        ii_borrowers.forEach(function (ii_borrower) {
            ii_borrower.required = false;
            ii_borrower.readOnly = false;
            ii_borrowers[0].value = "INPUT REQUIRED";
            ii_borrow.value = "INPUT REQUIRED";
        });

    }
}

function setIIIB() {
    var selectedOption = document.querySelector('input[name="iii_borrow"]:checked');
    var iii_borrowers = document.querySelectorAll('#iii_borrower');

    if (selectedOption) {
        // If an option is selected, get its value
        var selectedValue = selectedOption.value;
        iii_borrow.value = selectedValue;

        iii_borrowers.forEach(function (iii_borrower) {
            // If the checkbox is unchecked, remove the required attribute and make the input editable
            iii_borrower.required = true;
            iii_borrower.readOnly = true;
            iii_borrower.value = ""; // Clear the input field
        });

    }
}

function specifyOtherIIIB() {
    var selectedOption = document.querySelector('input[name="iii_borrow"]:checked');
    var iii_borrowers = document.querySelectorAll('#iii_borrower');


    // Add event listener to each 'i_borrower' element
    iii_borrowers.forEach(function (iii_borrower) {
        iii_borrower.addEventListener('input', function () {
            // Concatenate all 'i_borrower' values
            var concatenatedValue = Array.from(iii_borrowers).map(function (element) {
                return element.value;
            }).join('|||');

            // Update 'i_borrow' value
            iii_borrow.value = concatenatedValue;
            console.log(i_borrow);
        });
    });

    if (selectedOption) {
        iii_borrowers.forEach(function (iii_borrower) {
            iii_borrower.required = false;
            iii_borrower.readOnly = false;
            iii_borrowers[0].value = "INPUT REQUIRED";
            iii_borrow.value = "INPUT REQUIRED";
        });

    }
    console.log(i_borrow);
}

// Get references to the input fields
var pbInput = document.querySelector('#pb_no');
var pbCopyFields = document.querySelectorAll('#pb_no_copy');
pbCopyFields.forEach(function (field) {
    field.value = pbInput.value;
});

// Add an event listener to the "pb_no" input
pbInput.addEventListener('input', function () {
    // Loop through each element in the NodeList
    pbCopyFields.forEach(function (field) {
        field.value = pbInput.value;
    });
});

var dateAcq = document.querySelector("#pb_date");
var dateAcqCopyFields = document.querySelectorAll("#date_copy");
dateAcqCopyFields.forEach(function (field) {
    field.value = dateAcq.value;
});

dateAcq.addEventListener('input', function () {
    // Loop through each element in the NodeList
    dateAcqCopyFields.forEach(function (field) {
        field.value = dateAcq.value;
    });
});


var name_emp = document.querySelector("#person_accountable");
var name_copy = document.querySelector("#name_copy");
name_copy.value = name_emp.value;

name_emp.addEventListener('input', function () {
    name_copy.value = name_emp.value;
});




