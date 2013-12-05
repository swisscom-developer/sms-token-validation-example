<?php
/**
 * Send Token: Receive input from index.php and send SMS token validation to the
 * mobile number entered in the form.
 *
 * This script, once complete will load the validate_token_form.php for the user
 * to enter the validation code they received.
 */

// Get the mobile number from our form.
$mobile_number = $_POST['mobile_number'];

// You would usually do some error checking after this to make sure it is a
// valid number, but we are going to trust you in this demo.

// Get the API Key and base URL from the ini file
$settings = parse_ini_file("settings.ini", TRUE);

// The URL to send the request to.
$service_url = $settings['swisscom_general']['swisscom_api_base_url'] . '/' . $settings['sms_token_validation']['sms_token_send_url'];
$curl = curl_init($service_url);

// Set the default headers and the all important API key from the settings file.
// You didn't forget to update the settings.ini file, did you?
$header = array(
  "client_id: " . $settings['swisscom_general']['swisscom_api_key'],
  "Accept: application/json; charset=utf-8",
  "Content-Type: application/json; charset=utf-8"
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

// Data to send in the post request instead of form parameters.  See Swisscom's
// SMS Token validation documentation for details.
// Some strange comment ....
$curl_post_data = array(
  "to" => $mobile_number,
  "text" => $settings['sms_token_validation']['sms_token_text'],
  "tokenType" =>  $settings['sms_token_validation']['sms_token_type'],
  "expireTime" => $settings['sms_token_validation']['sms_token_expire_time'],
  "tokenLength" => $settings['sms_token_validation']['sms_token_length'],
);

// Encode the post data in JSON.
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
$curl_response = curl_exec($curl);

// Get the response back from the call.
$curl_info = curl_getinfo($curl);

// Check for any errors and show error on screen if there is an issue
$http_response_code = $curl_info['http_code'];
if(curl_error($curl) || $http_response_code != 200) {
  $curl_response = print_r($curl_response,true);
  $alert_error = 'Error ' . $http_response_code . ' ' . curl_error($curl) . ' API server response: ' . $curl_response;
} else {
  $alert_success = "We sent you a verification code to: +" . htmlspecialchars($mobile_number) . '.';
}
curl_close($curl);

return require 'validate_token_form.php';