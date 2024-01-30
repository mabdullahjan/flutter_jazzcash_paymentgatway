<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JazzCash Response</title>
</head>
<body>
    <pre id="response" style="display: none;"></pre>

    <script>
        // Function to display the JazzCash response in the <pre> element
        function displayJazzCashResponse(responseData) {
            // Get the <pre> element
            var preElement = document.getElementById('response');

            // Display the response data in the <pre> element
            if (preElement) {
                // Extract required fields
                var responseList = [
                    'Response Code: ' + responseData['pp_ResponseCode'],
                    'Message: ' + responseData['pp_ResponseMessage'],
                    'Transaction Ref No: ' + responseData['pp_TxnRefNo']
                ];

                // Display the response data as a list in the <pre> element
                preElement.innerText = responseList.join('\n');
            } else {
                console.log("No <pre> element found.");
            }
        }

        // Call the function to display JazzCash response when the page loads
        window.onload = function() {
            // Fetch the response data from the PHP script
            fetch(window.location.href, { method: 'POST', body: new FormData() })
            .then(response => response.json())
            .then(data => {
                // Call the displayJazzCashResponse function with the response data
                displayJazzCashResponse(data);
            })
            .catch(error => {
                console.error('Error fetching response:', error);
            });
        };
    </script>

    <?php
    // Retrieve the POST data sent by JazzCash
    $responseData = $_POST;

    // Remove <br> tags from the response
    foreach ($responseData as $key => $value) {
        $responseData[$key] = str_replace('<br>', '', $value);
    }

    // Output the response data as JSON
    echo '<script>displayJazzCashResponse(' . json_encode($responseData) . ');</script>';
    ?>
</body>
</html>
