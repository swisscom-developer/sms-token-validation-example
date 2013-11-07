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
  <div class="starter-template">
    <h1>Humpty's Cafe</h1>
    <p class="lead">Jack Spratt, complete your reservation for</p>
    <h2>Table for two for tonight at 18:00</h2>

  </div>

  <!-- Display errors and messages -->
  <?php if(isset($alert_error)): ?>
    <div class="alert alert-danger"><?php echo $alert_error; ?></div>
  <? endif; ?>

  <?php if(isset($alert_success)): ?>
    <div class="alert alert-success"><?php echo $alert_success; ?></div>
  <?php endif; ?>

  <!-- Only show the form if the reservation is not confirmed -->
  <?php if(!isset($reservation_confirmed)): ?>
  <form role="form" action="send_token.php" method="POST" >
    <!-- Mobile Number form field -->
    <div class="form-group">
      <label for="mobile-phone">Mobile Number</label>
      <div class="input-group">
        <span class="input-group-addon">+</span>
        <input type="text" name="mobile_number" class="form-control" id="mobile-phone" placeholder="41791234567" value="">
      </div>
      <p class="help-block">Your number should start with the country code, for example: 41791234567</p>
    </div>
    <!-- Submit button -->
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  <?php endif; ?>

</div><!-- /.container -->

<!-- Include sitewide page footer -->
<?php include 'includes/footer.php'; ?>