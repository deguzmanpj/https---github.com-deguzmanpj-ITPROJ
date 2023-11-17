var selectUnit = document.querySelector('#unit_dropdown');
var selectedUnitValue = selectUnit.value;
var unitCode = document.querySelector("#unit_code");
console.log(selectedUnitValue);

var resultsDataElement = document.getElementById('units');
var resultsData = JSON.parse(resultsDataElement.getAttribute('data-results'));


var officeDropdown = document.querySelector('#office_dropdown');
officeDropdown.innerHTML = ""; //// Clear existing options

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
        unitCode.value = unit.unit_code;
        console.log(unitCode)
    }
}

// var office_copy = document.querySelector("#office_copy");
// var unit_copy = document.querySelector("#unit_copy"); 

// office_copy.value = officeDropdown.value;
// unit_copy.value = selectedUnitValue;



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
            unitCode.value = unit.unit_code;
        }
    }
    // office_copy.value = officeDropdown.value;
    unit_copy.value = selectedUnitValue;

}

var cb_condition = document.querySelector("#cb_condition");



function setCond() {
    var selectedOption = document.querySelector('input[name="cb_condition"]:checked');
    var textOtherInput = document.getElementById('other');

    if (selectedOption) {
        // If an option is selected, get its value
        var selectedValue = selectedOption.value;
        cb_condition.value = selectedValue;
        // If the checkbox is unchecked, remove the required attribute and make the input editable
        textOtherInput.required = true;
        textOtherInput.readOnly = true;
        textOtherInput.value = ""; // Clear the input field
    }
}

function setOther() {
    var selectedOption = document.querySelector('input[name="cb_condition"]:checked');
    var textOtherInput = document.getElementById('other');


    textOtherInput.addEventListener('input', function () {
        // get value of input
        cb_condition.value = textOtherInput.value;
    });

    if (selectedOption) {
        textOtherInput.required = false;
        textOtherInput.readOnly = false;
        textOtherInput.value = "INPUT REQUIRED";
        cb_condition.value = "INPUT REQUIRED";
    }
}

// Get references to the input fields
var cr_no = document.querySelector('#cr_no');
var cr_copy = document.querySelector('#cr_copy');
cr_copy.value = cr_no.value;
cr_no.addEventListener('input', function() {
    cr_copy.value = cr_no.value;
});

// // Get references to the input fields
// var rrNoInput = document.querySelector('#rr_no');
// var rrCopyOneInput = document.querySelector('#rr_copy_one');
// var rrCopyTwoInput = document.querySelector('#rr_copy_two');
// var rrCopyThreeInput = document.querySelector('#rr_copy_three');

// // Add an event listener to the "rr_no" input
// rrNoInput.addEventListener('input', function() {
//     // Update the value of "rr_copy_one" with the value of "rr_no"
//     rrCopyOneInput.value = rrNoInput.value;
//     rrCopyTwoInput.value = rrNoInput.value;
//     rrCopyThreeInput.value = rrNoInput.value;
// });

// var date_acq = document.querySelector("#date_acq");
// var date_acq_copy = document.querySelector("#date_acq_copy"); 
// var date_acq_copy_two = document.querySelector("#date_acq_copy_two"); 

// // Add an event listener to the "rr_no" input
// date_acq.addEventListener('input', function() {
//     // Update the value of "rr_copy_one" with the value of "rr_no"
//     date_acq_copy.value = date_acq.value;
//     date_acq_copy_two.value = date_acq.value;
// });

// var reference = document.querySelector("#reference");
// var reference_copy = document.querySelector("#reference_copy"); 

// // Add an event listener to the "rr_no" input
// reference.addEventListener('input', function() {
//     // Update the value of "rr_copy_one" with the value of "rr_no"
//     reference_copy.value = reference.value;
// });

// var received_from = document.querySelector("#received_from");
// var received_from_copy = document.querySelector("#received_from_copy"); 

// // Add an event listener to the "rr_no" input
// received_from.addEventListener('input', function() {
//     // Update the value of "rr_copy_one" with the value of "rr_no"
//     received_from_copy.value = received_from.value;
// });



