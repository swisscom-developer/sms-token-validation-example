<?php

// Get the mobile number from hidden form field.
$mobile_number = $_POST['mobile_number'];

// Get the validate token from the form.
$validate_token = $_POST['validate_token'];

// You would usually do some error checking after this to make sure it is a
// valid number and token, but we are going to trust you in this demo.

// Get the API Key and base URL from the ini file
$settings = parse_ini_file("settings.ini", TRUE);

// The URL to send the request to.
$service_url = $settings['swisscom_general']['swisscom_api_base_url'] . '/' . $settings['sms_token_validation']['sms_token_validate_url'] . '/%2B' . $mobile_number;

$curl = curl_init($service_url);

// Set the default headers and the all important API key
$header = array(
  "client_id: " . $settings['swisscom_general']['swisscom_api_key'],
  "Accept: application/json; charset=utf-8",
  "Content-Type: application/json; charset=utf-8"
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

// The token you are validating is sent in the body of the request.
$curl_post_data = array(
  "token" => $validate_token
);

// Encode the post data in JSON
$json_post_data = json_encode($curl_post_data);

// Add the encoded data to the curl request.
curl_setopt($curl, CURLOPT_POSTFIELDS, $json_post_data);

// Makes curl_exec() return a string.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// We are sending a POST request.
curl_setopt($curl, CURLOPT_POST, true);

// Similar to cmd-line curl's -k option during development
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

// Ignore host verification for development
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);

// Must be present to get request headers
curl_setopt($curl, CURLINFO_HEADER_OUT, FALSE);

// Make the actual call to the Swisscom server to send the SMS token
$curl_response_json = curl_exec($curl);

// Get the response back from the call.
$curl_info = curl_getinfo($curl);
$http_response_code = $curl_info['http_code'];

// Check for any errors and show error on screen if there is an issue
if(curl_error($curl) || $http_response_code != 200) {
  $curl_response = print_r($curl_response,true);
  $alert_error = 'Error ' . $http_response_code . ' ' . curl_error($curl) . ' API server response: ' . $curl_response;
}
curl_close($curl);

// Decode the response from JSON into an array.
$curl_response = @json_decode($curl_response_json, TRUE);

// Is the token valid?
if($curl_response['validateSmsTokenResponse']['state'] == 'OK') {
  // The token was valid.
  $reservation_confirmed = TRUE;
  $alert_success = 'Great success! Your reservation has been confirmed. Make sure to ask your sever about our daily specials.';
  return require 'index.php';
} else {
  // The token was not valid.
  $alert_error = 'Invalid code. Please try again.';
  return require 'validate_token_form.php';
}

