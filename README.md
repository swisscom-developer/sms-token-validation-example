Swisscom SMS Token Validation Example
=====================================

An example PHP website that uses the Swisscom Token Validation API to validate
a user's mobile phone number before allowing them to reserve a table at a
fictional restaurant.

For more information on how to use this example, go to:

https://developer.swisscom.com

Getting Started
---------------

You should already have a PHP environment setup on your local machine. Check
out this code from the GitHub repository into the web application document
root.

The home page (index.php) should be accessible, but in order to send calls
to the Swisscom API, you need to register and get an application key by
registering at:

https://developer.swisscom.com

See the getting started section for more information on how to get an
API key.

Once you have your API Key, add the key to the settings.ini file.

__Note:__ For SMS Token Validation API, the API secret is not used, only the key.
