<!--
File: index.php
Author: Swisscom

This page was built using the Twitter
Bootstrap front end framework:

http://getbootstrap.com/

The Twitter bootstrap framework is loaded via CDN in the includes/header.php file.
-->

<!-- Include sitewide page header -->
<?php include 'includes/header.php'; ?>

<div class="container">

  <!-- Display confirmation details (hardcoded for an example) -->
  <h1>About</h1>
  <div class="jumbotron">
    <h2>SMS Token Validation Example</h2>
    <p >An example PHP website that uses the Swisscom Token Validation API to validate
      a user's mobile phone number before allowing them to reserve a table at a
      fictional restaurant.

      For more information on how to use this example and to register for an
      API key for using our APIs, learn more at the
      <a href="https://developer.swisscom.ch">Swisscom Developer Portal</a>.
    <p><a href="https://developer.swisscom.ch"class="btn btn-primary btn-lg" role="button">Learn more</a></p>

  </div>


</div><!-- /.container -->

<!-- Include sitewide page footer -->
<?php include 'includes/footer.php'; ?>