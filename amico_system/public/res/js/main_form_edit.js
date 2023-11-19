var selectUnit = document.querySelector('#unit_dropdown');
var selectedUnitValue = selectUnit.value;
var unitCode = document.querySelector("#unit_code");
console.log(selectedUnitValue);

var unitsDataElement = document.getElementById('unitsData');
var unitsData = JSON.parse(unitsDataElement.getAttribute('data-results'));

var resultsDataElement = document.getElementById('resultsData');
var resultsData = JSON.parse(resultsDataElement.getAttribute('data-results'));


var officeDropdown = document.querySelector('#office_dropdown');
officeDropdown.innerHTML = ""; // Clear existing options

for (var i = 0; i < unitsData.length; i++) {
    // Access individual objects in the array
    var unit = unitsData[i];

    // Check if the unitName matches the selected value
    if (unit.unit === selectedUnitValue) {

        // Create an option element and add it to the dropdown
        var option = document.createElement("option");

        // Use ternary operator to set the selected attribute
        var selected = (unit.office === resultsData[0].office) ? 'selected' : '';

        // Set the value and selected attribute of the option
        option.value = unit.office;
        option.selected = selected;

        // Set the text content of the option
        option.textContent = unit.office;

        // Output the option with the selected attribute as needed
        officeDropdown.appendChild(option);

        // Assuming unitCode, position, and person are input elements
        unitCode.value = unit.unit_code;
        position.value = unit.position;
        person.value = unit.head_name;
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
    // unit_copy.value = selectedUnitValue;

}



function setWarranty() {
    var checkbox = document.getElementById('cb_warranty');
    var cb_warranty_po_no = document.getElementById('cb_warranty_po_no');
    var cb_warranty_po_date = document.getElementById('cb_warranty_po_date');
    var supplier = document.getElementById('supplier');

    if (checkbox.checked) {
        // If the checkbox is checked, make the input required and readonly
        cb_warranty_po_no.required = false;
        cb_warranty_po_no.readOnly = false;

        cb_warranty_po_date.required = false;
        cb_warranty_po_date.readOnly = false;

        supplier.required = false;
        supplier.readOnly = false;

        cb_warranty_po_no.value = "po number";
        supplier.value = "supplier";
    } else {
        // If the checkbox is unchecked, remove the required attribute and make the input editable
        cb_warranty_po_no.required = true;
        cb_warranty_po_no.readOnly = true;

        cb_warranty_po_date.required = true;
        cb_warranty_po_date.readOnly = true;

        supplier.required = true;
        supplier.readOnly = true;

        cb_warranty_po_no.value = "";
        supplier.value = "";
    }
}

function setOther() {
    var cb_other = document.querySelector('#cb_other');
    var textOtherInputAu = document.querySelector('#other');

    textOtherInputAu.addEventListener('input', function () {
        // get value of input
        cb_other.value = textOtherInputAu.value;
    });

    if (cb_other.checked) {
        // If the checkbox is checked, make the input required and readonly
        textOtherInputAu.required = false;
        textOtherInputAu.readOnly = false;
        textOtherInputAu.value = "INPUT REQUIRED";
    } else {
        // If the checkbox is unchecked, remove the required attribute and make the input editable
        textOtherInputAu.required = true;
        textOtherInputAu.readOnly = true;
        textOtherInputAu.value = ""; // Clear the input field
    }
}


// Get references to the input fields
var ms_no = document.querySelector('#ms_no');
var ms_copy = document.querySelector('#ms_copy');
ms_copy.value = ms_no.value;

ms_no.addEventListener('input', function() {
    ms_copy.value = ms_no.value;
});

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



