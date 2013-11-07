<!--
File: validate_token_form.php
Author: Swisscom

This page was built using the Twitter
Bootstrap front end framework:

http://getbootstrap.com/

The Twitter bootstrap framework is loaded via CDN in the includes/header.php file.

-->

<!-- Include sitewide page header -->
<?php include 'includes/header.php'; ?>

<div class="container">

  <!-- Just some hard coded text as an example -->
  <div class="starter-template">
    <h1>Humpty's BBQ Cafe</h1>
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

  <!-- The validate code form -->
  <form role="form" action="validate_token.php" method="POST" >
    <!-- Mobile number is a hidden field, used in validation call -->
    <?php if(isset($mobile_number)): ?>
      <input type="hidden" value="<?php echo $mobile_number; ?>" name="mobile_number">
    <? endif; ?>
    <!-- Form field for user to enter validation code from the SMS they received -->
    <div class="form-group">
      <label for="validation-code">Validation Code</label>
        <input type="text" name="validate_token" class="form-control" id="validation-code" placeholder="Enter code" value="">
      <p class="help-block">Enter the validation code sent to your phone.  This code is only valid for 3 minutes, so make it quick!</p>
    </div>
    <!-- Submit button -->
    <button type="submit" class="btn btn-primary">Validate</button>
  </form>

</div><!-- /.container -->

<!-- Include sitewide page footer -->
<?php include 'includes/footer.php'; ?>