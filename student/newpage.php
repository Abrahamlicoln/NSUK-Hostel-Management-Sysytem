<?php
// Check if state name is passed as POST data
if (isset($_POST['state'])) {
    // Fetch LGAs based on the selected state
    $curl = curl_init();
    $url = "https://locus.fkkas.com/api/regions/" . $_POST['state'];
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ]);

    $response = curl_exec($curl);
    $lgas = json_decode($response, true);

    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        // Generate new HTML code for LGAs dropdown list options
        $options = '<option value="">---Select LGA----</option>';
        foreach ($lgas['data'] as $lga) {
            $options .= '<option value="' . $lga['name'] . '">' . $lga['name'] . '</option>';
        }
        // Return the new HTML code as AJAX response
        echo $options;
    }
} else {
    // Return error message if state name is not passed
    echo 'Error: State name not provided!';
}
