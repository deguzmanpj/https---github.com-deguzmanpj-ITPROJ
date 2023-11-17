var selectUnit = document.querySelector('#unit_dropdown');
var selectedUnitValue = selectUnit.value;
var unitCode = document.querySelector("#unit_code");

var unitsDataElement = document.getElementById('unitsData');
var unitsData = JSON.parse(unitsDataElement.getAttribute('data-results'));


var officeDropdown = document.querySelector('#office_dropdown');
officeDropdown.innerHTML = ""; // Clear existing options

for (var i = 0; i < unitsData.length; i++) {
    // Access individual objects in the array
    var unit = unitsData[i];

    // Check if the unitName matches the selected value
    if (unit.unit === selectedUnitValue) {
        console.log(unit.unit)
        // Create an option element and add it to the dropdown
        var option = document.createElement("option");
        option.value = unit.office;
        option.text = unit.office;
        officeDropdown.appendChild(option);
        unitCode.value = unit.unit_code;
    }
}

var office_copy = document.querySelector("#office_copy");
var unit_copy = document.querySelector("#unit_copy");

office_copy.value = officeDropdown.value;
unit_copy.value = selectedUnitValue;



function updateOfficeOptions() {
    selectUnit = document.querySelector('#unit_dropdown');
    selectedUnitValue = selectUnit.value;
    officeDropdown.innerHTML = "";

    for (var i = 0; i < unitsData.length; i++) {
        // Access individual objects in the array
        var unit = unitsData[i];

        // Check if the unitName matches the selected value
        if (unit.unit === selectedUnitValue) {
            // Create an option element and add it to the dropdown
            var option = document.createElement("option");
            option.value = unit.office;
            option.text = unit.office;
            officeDropdown.appendChild(option);
            unitCode.value = unit.unit_code;
        }
    }
    office_copy.value = officeDropdown.value;
    unit_copy.value = selectedUnitValue;

}

function setACbValue() {
    var cb_a = document.querySelector('#cb_a');

    var selectedOption = document.querySelector('input[name="a_cb"]:checked');
    var textOtherInput = document.getElementById('text_other');

    if (selectedOption) {
        // If an option is selected, get its value
        var selectedValue = selectedOption.value;
        cb_a.value = selectedValue;
        // If the checkbox is unchecked, remove the required attribute and make the input editable
        textOtherInput.required = true;
        textOtherInput.readOnly = true;
        textOtherInput.value = ""; // Clear the input field
        console.log(textOtherInput);
    }
}

function specifyOther() {
    var cb_a = document.querySelector('#cb_a');

    var selectedOption = document.querySelector('input[name="a_cb"]:checked');
    var textOtherInput = document.getElementById('text_other');


    textOtherInput.addEventListener('input', function () {
        // get value of input
        cb_a.value = textOtherInput.value;
    });

    if (selectedOption) {
        textOtherInput.required = false;
        textOtherInput.readOnly = false;
        textOtherInput.value = "INPUT REQUIRED";
        cb_a.value = "INPUT REQUIRED";
    }
}

function setDCbValue() {
    var cb_d = document.querySelector('#cb_d');
    var selectedOption = document.querySelector('input[name="d_cb"]:checked');
    var textOtherInputAu = document.getElementById('text_other');

    if (selectedOption) {
        // If an option is selected, get its value
        var selectedValue = selectedOption.value;
        cb_d.value = selectedValue;
        // If the checkbox is unchecked, remove the required attribute and make the input editable
        textOtherInputAu.required = true;
        textOtherInputAu.readOnly = true;
        textOtherInputAu.value = ""; // Clear the input field
    }
}

function specifyOtherAu() {
    var cb_d = document.querySelector('#cb_d');
    var selectedOption = document.querySelector('input[name="d_cb"]:checked');
    var textOtherInputAu = document.getElementById('text_other');


    textOtherInputAu.addEventListener('input', function () {
        // get value of input
        cb_d.value = textOtherInputAu.value;
    });

    if (selectedOption) {
        textOtherInputAu.required = false;
        textOtherInputAu.readOnly = false;
        textOtherInputAu.value = "INPUT REQUIRED";
        cb_d.value = "INPUT REQUIRED";
    }
}

// Get references to the input fields
var rrNoInput = document.querySelector('#rr_no');
var rrCopyOneInput = document.querySelector('#rr_copy_one');
var rrCopyTwoInput = document.querySelector('#rr_copy_two');
var rrCopyThreeInput = document.querySelector('#rr_copy_three');
rrCopyOneInput.value = rrNoInput.value;
rrCopyTwoInput.value = rrNoInput.value;
rrCopyThreeInput.value = rrNoInput.value;

// Add an event listener to the "rr_no" input
rrNoInput.addEventListener('input', function () {
    // Update the value of "rr_copy_one" with the value of "rr_no"
    rrCopyOneInput.value = rrNoInput.value;
    rrCopyTwoInput.value = rrNoInput.value;
    rrCopyThreeInput.value = rrNoInput.value;
});


var date_acq = document.querySelector("#date_acq");
var date_acq_copy = document.querySelector("#date_acq_copy");
var date_acq_copy_two = document.querySelector("#date_acq_copy_two");
date_acq_copy.value = date_acq.value;
date_acq_copy_two.value = date_acq.value;

// Add an event listener to the "rr_no" input
date_acq.addEventListener('input', function () {
    // Update the value of "rr_copy_one" with the value of "rr_no"
    date_acq_copy.value = date_acq.value;
    date_acq_copy_two.value = date_acq.value;
});

var reference = document.querySelector("#reference");
var reference_copy = document.querySelector("#reference_copy");
reference_copy.value = reference.value;

// Add an event listener to the "rr_no" input
reference.addEventListener('input', function () {
    // Update the value of "rr_copy_one" with the value of "rr_no"
    reference_copy.value = reference.value;
});

var received_from = document.querySelector("#received_from");
var received_from_copy = document.querySelector("#received_from_copy");
received_from_copy.value = received_from.value;

// Add an event listener to the "rr_no" input
received_from.addEventListener('input', function () {
    // Update the value of "rr_copy_one" with the value of "rr_no"
    received_from_copy.value = received_from.value;
});



