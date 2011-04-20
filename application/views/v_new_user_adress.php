
<script src="<?php echo base_url(); ?>js/jquery.validate.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/cmxform.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/cmxformTemplate.css" />

<script type="text/javascript">
  $(document).ready(function() {
    $('#signupForm').submit(function(e){ // This selector needs to point to your form.
        if ($('#country').val() == "0") {
          $("#country-error").show();
          $("#country-error").html('Choose a country.');
            e.preventDefault();
            return false;
        }});

    $("#signupForm").validate({
      rules: {
        firstname: {
          required: true,
          minlength: 0,
          maxlength: 30
        },
        lastname: {
          required: true,
          maxlength: 30
        },
        street: {
          required: true,
          maxlength: 30
        },
        zip: {
          required: true,
          number: true
        },
        city: {
          required: true         
        },
        agree: {
          required: true
        }
      },
      messages: {
        agree: "Please accept our policy"
      }
    });
   });
</script>

<h1>Ange Er adress</h1>

<div style="border: 2px solid red; padding-left: 10px;">   <?php echo validation_errors(); ?> </div>

<form class="cmxform" id="signupForm" method="post" action="/validate/useraddress">
  <fieldset>
    <legend>Fyll i formuläret</legend>
    <p>
      <label for="firstname">Förnamn</label>
      <input id="firstname" name="firstname" type="text" />
    </p>
    <p>
      <label for="lastname">Efternamn</label>
      <input id="lastname" name="lastname" type="text"/>
    </p>
    <p>
      <label for="street">Gatuadress</label>
      <input id="street" name="street" type="text"/>
    </p>
    <p>
      <label for="co">c/o</label>
      <input id="co" name="co" type="text"/>
    </p>
    <p>
      <label for="zip">Postnummer</label>
      <input id="zip" name="zip" type="text"/>
    </p>
    <p>
      <label for="city">Ort</label>
      <input id="city" name="city" type="text"/>
    </p>
    <p>
      <label for="phone">Telefonnummer</label>
      <input id="phone" name="phone" type="text"/>
    </p>
    <p>
      <label for="mobile">Mobilnummer</label>
      <input id="mobile" name="mobile" type="text"/>
    </p>
    <p>
      <label for="country">Land</label>
      <?php
      $this->load->helper('form');
      $options = array(
          '0' => 'Choose...',
          '46' => 'Sverige',
          '45' => 'Danmark',
          '47' => 'Norge',
          '358' => 'Finland',
          '354' => 'Island',
      );
      echo form_dropdown('country', $options, 'valj', 'id="country"');
      ?>
      <span id="country-error" style="color:red;"></span>
      <span> Utanför Sverige? Läs mer <a href="">här</a></span>
    </p>
    <p>
      <input class="" type="hidden" value="<?php echo $this->session->userdata('user_id'); ?>"  name="user_id" />
      <input class="submit" type="submit" value="Gå vidare" />
    </p>

  </fieldset>
</form>
