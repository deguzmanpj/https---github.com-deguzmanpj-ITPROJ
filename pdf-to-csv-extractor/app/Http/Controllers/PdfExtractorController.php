<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PdfExtractorController extends Controller
{
    public function extractPdf(Request $request)
    {
        Log::info($request->input("apiKey"));


        // Get submitted form data
        $apiKey = $request->input('apiKey').""; // The authentication key (API Key). Get your own by registering at https://app.pdf.co
        //"gentampinco@gmail.com_84854962ae450245db41468bd80474eb5ebfd56468b942277b3f94c982434b73ff997857"


        // Create URL
        $url = "https://api.pdf.co/v1/file/upload/get-presigned-url" .
            "?name=" . urlencode($request->file("pdf")) .
            "&contenttype=application/octet-stream";

        // Create request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apiKey));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // Execute request
        $result = curl_exec($curl);

        if (curl_errno($curl) == 0) {
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($status_code == 200) {
                $json = json_decode($result, true);

                // Get URL to use for the file upload
                $uploadFileUrl = $json["presignedUrl"];
                // Get URL of uploaded file to use with later API calls
                $uploadedFileUrl = $json["url"];

                // 2. UPLOAD THE FILE TO CLOUD.

                $localFile = $request->file("pdf");
                $fileHandle = fopen($localFile, "r");

                curl_setopt($curl, CURLOPT_URL, $uploadFileUrl);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array("content-type: application/octet-stream"));
                curl_setopt($curl, CURLOPT_PUT, true);
                curl_setopt($curl, CURLOPT_INFILE, $fileHandle);
                curl_setopt($curl, CURLOPT_INFILESIZE, filesize($localFile));

                // Execute request
                curl_exec($curl);

                fclose($fileHandle);

                if (curl_errno($curl) == 0) {
                    $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

                    if ($status_code == 200) {
                        // 3. CONVERT UPLOADED PDF FILE TO CSV






                        // Create URL
                        $url = "https://api.pdf.co/v1/pdf/convert/to/csv";

                        // Prepare requests params
                        $parameters = array();
                        $parameters["url"] = $uploadedFileUrl;

                        // Create Json payload
                        $data = json_encode($parameters);

                        // Create request
                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apiKey, "Content-type: application/json"));
                        curl_setopt($curl, CURLOPT_URL, $url);
                        curl_setopt($curl, CURLOPT_POST, true);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                        // Execute request
                        $result = curl_exec($curl);

                        // Check for errors
                        if (curl_errno($curl) == 0) {
                            // Get the status code
                            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

                            // If the status code is 200, the request was successful
                            if ($status_code == 200) {
                                // Decode the JSON response
                                $json = json_decode($result, true);

                                // Check for errors in the response
                                if (!isset($json["error"]) || $json["error"] == false) {
                                    // Get the URL of the converted CSV file
                                    $resultFileUrl = $json["url"];

                                    // // Create a new file in the public folder
                                    // $csvFile = fopen("public/converted_csv.csv", "w");

                                    // // Write the CSV data to the file
                                    // fwrite($csvFile, $resultFileUrl);

                                    // // Close the file
                                    // fclose($csvFile);





                                        // Store the file in the designated folder
                                        $resultFileUrl->storeAs('public/files', 'new.csv');






                                    // Display a message that the CSV file was successfully converted and saved
                                    echo "<p>CSV file successfully converted and saved to public folder.</p>";
                                } else {
                                    // Display the error message from the response
                                    echo "<p>Error: " . $json["message"] . "</p>";
                                }
                            } else {
                                // Display the request error
                                echo "<p>Status code: " . $status_code . "</p>";
                                echo "<p>" . $result . "</p>";
                            }
                        } else {
                            // Display the CURL error
                            echo "Error: " . curl_error($curl);
                        }

                        // Cleanup
                        curl_close($curl);







                        
                    } else {
                        // Display request error
                        echo "<p>Status code: " . $status_code . "</p>";
                        echo "<p>" . $result . "</p>";
                    }
                } else {
                    // Display CURL error
                    echo "Error: " . curl_error($curl);
                }
            } else {
                // Display service reported error
                echo "<p>Status code: " . $status_code . "</p>";
                echo "<p>" . $result . "</p>";
            }

            curl_close($curl);
        } else {
            // Display CURL error
            echo "Error: " . curl_error($curl);
        }
    }

}