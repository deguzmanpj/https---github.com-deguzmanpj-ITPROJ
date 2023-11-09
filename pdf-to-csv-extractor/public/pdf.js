

// console.log("hihihi");

// // Use a callback function to ensure that pdfjsLib is defined
// pdfjsLib.getDocument('path/to/your.pdf').promise.then(function (pdf) {
//     // Perform operations with the PDF here
    
// const pdfUrl = '/fm-amc-001_r03%20receiving%20report%20form_2023.0206%20(dcf_amc-2023-001).pdf';


// fetch(pdfUrl)
//   .then(response => response.arrayBuffer())
//   .then(data => {
//     // Use pdf-parse to extract text while preserving structure
//     pdfjsLib.getDocument(data).then(pdf => {
//       pdf.getPage(1).then(page => {
//         page.getTextContent().then(content => {
//           const text = content.items.map(item => item.str).join(' ');
//           console.log(text);
//         });
//       });
//     });
//   });

// });
import pdf from 'pdf-parse';

const pdfUrl = '/fm-amc-001_r03 receiving report form_2023.0206 (dcf_amc-2023-001).pdf';

fetch(pdfUrl)
    .then(response => response.arrayBuffer())
    .then(dataBuffer => {
        parsePDF(dataBuffer);
    })
    .catch(err => {
        // Handle errors
        console.error(err);
    });

function parsePDF(dataBuffer) {
    // Use pdf-parse to parse the PDF
    pdf(dataBuffer).then(function(data) {
        // Access the extracted text
        console.log(data.text);
    }).catch(function(err) {
        // Handle errors
        console.error(err);
    });
}
