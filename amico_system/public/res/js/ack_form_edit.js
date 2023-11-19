var selectUnit = document.querySelector('#unit_dropdown');
var selectedUnitValue = selectUnit.value;
console.log(selectedUnitValue);

var person = document.querySelector("#name_employee");
var ea_ackby= document.querySelector("#ea_ack_by");




 ea_ackby.value = person.value
person.addEventListener('input', function () {
    // Update the value of "rr_copy_one" with the value of "rr_no"
    ea_ackby.value = person.value
});


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
}

var cb_record = document.querySelector('#cb_record');

function setACbValue() {
    var selectedOption = document.querySelector('input[name="cb_record"]:checked');
    var textOtherInput = document.getElementById('new_record');

    if (selectedOption) {
        // If an option is selected, get its value
        var selectedValue = selectedOption.value;
        cb_record.value = selectedValue;
        // If the checkbox is unchecked, remove the required attribute and make the input editable
        textOtherInput.required = true;
        textOtherInput.readOnly = true;
        textOtherInput.value = ""; // Clear the input field
    }
}

function specifyOther() {
    var selectedOption = document.querySelector('input[name="cb_record"]:checked');
    var textOtherInput = document.getElementById('new_record');


    textOtherInput.addEventListener('input', function () {
        // get value of input
        cb_record.value = textOtherInput.value;
    });

    if (selectedOption) {
        textOtherInput.required = false;
        textOtherInput.readOnly = false;
        textOtherInput.value = "INPUT REQUIRED";
        cb_record.value = "INPUT REQUIRED";
    }
}



// Get references to the input fields
var arNoInput = document.querySelector('#ar_no');
var ar_copy = document.querySelector('#ar_copy');
ar_copy.value = arNoInput.value;

// Add an event listener to the "rr_no" input
arNoInput.addEventListener('input', function () {
    // Update the value of "rr_copy_one" with the value of "rr_no"
    ar_copy.value = arNoInput.value;
});

