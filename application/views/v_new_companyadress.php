
<script src="<?php echo base_url(); ?>js/jquery.validate.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/cmxform.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/cmxformTemplate.css" />

<script type="text/javascript">
  $().ready(function() {
    $('#signupForm').submit(function(e){ //  This selector needs to point to your form.
      if ($('#country').val() == "") {
        $("#country-error").show();
        $("#country-error").html('Choose a country.');
        e.preventDefault();
        return false;
      }});

    $("#signupForm").validate({
      rules: {
        company: {
          required: true,
          minlength: 0,
          maxlength: 30
        },
        street: {
          required: true
          //maxlength: 30
        },
        contactpers: {
          required: true
          //maxlength: 30
        },
        zip: {
          required: true,
          number: true
        },
        city: {
          required: true
        },
        email: {
          required: true,
          email: true,
          minlength: 6,
          maxlength: 255
        },
        phone: {
          required: true,
          number: true
        },
        mobile: {
          number: true
        },
        agree: {
          required: true
        }
      },
      messages: {
        email: {
          required: "Please provide a email"
        },
        agree: "Please accept our policy"
      }
    })
  });
</script>

<h1>Ange Er adress</h1>

<div style="border: 2px solid red; padding-left: 10px;">   <?php echo validation_errors(); ?> </div>
<form class="cmxform" id="signupForm" method="post" action="/validate/companyaddress">
  <fieldset>
    <legend>Fyll i formuläret</legend>
    <h1 style="color: red;">Faktureringsadress<span style="color:grey; font-size: 15px;"> (<span style="color:red;"> *</span> = obligatoriska uppgifter.)</span></h1>
    <p>
      <label for="company">Företagsnamn <span style="color:red;">*</span></label>
      <input id="comany" name="company" type="text" />
    </p>
    <p>
      <label for="street">Gatuadress <span style="color:red;">*</span></label>
      <input id="street" name="street" type="text"/>
    </p>
    <p>
      <label for="co">c/o</label>
      <input id="co" name="co" type="text"/>
    </p>
    <p>
      <label for="level">Avdelning</label>
      <input id="level" name="level" type="text"/>
    </p>
    <p>
      <label for="contactpers">Kontaktperson <span style="color:red;">*</span></label>
      <input id="contactpers" name="contactpers" type="text"/>
    </p>
    <p>
      <label for="zip">Postnummer <span style="color:red;">*</span></label>
      <input id="zip" name="zip" type="text"/>
    </p>
    <p>
      <label for="city">Ort <span style="color:red;">*</span></label>
      <input id="city" name="city" type="text"/>
    </p>
    <p>
      <label for="email">E-postadress <span style="color:red;">*</span></label>
      <input id="email" name="email" type="text"/>
    </p>
    <p>
      <label for="phone">Telefonnummer <span style="color:red;">*</span></label>
      <input id="phone" name="phone" type="text"/>
    </p>
    <p>
      <label for="mobile">Mobilnummer</label>
      <input id="mobile" name="mobile" type="text"/>
    </p>
    <p>
      <label for="country">Land <span style="color:red;">*</span></label>
      <?php
      $this->load->helper('form');
      $options = array(
          '' => 'Choose...',
          'sweden' => 'Sverige',
          'denmark' => 'Danmark',
          'norway' => 'Norge',
          'finland' => 'Finland',
          'island' => 'Island',
      );
      echo form_dropdown('country', $options, 'Choose...', 'id="country"');
      ?>
      <span> Utanför Sverige? Läs mer <a href="">här</a></span>
      <span id="country-error" style="color:red;"></span>
    </p>
    <h1 style="color:red;">Leveransadress <span style="color:grey; font-size: 15px;">(Ska det skickas till en annan adress än ovan? Ange den här.)</span></h1>
    <p>
      <label for="lev_co_name">Företagsnamn</label>
      <input id="lev_co_name" name="lev_co_name" type="text" />
    </p>
    <p>
      <label for="lev_adress">Gatuadress</label>
      <input id="lev_adress" name="lev_adress" type="text"/>
    </p>
    <p>
      <label for="lev_co">c/o</label>
      <input id="lev_co" name="lev_co" type="text"/>
    </p>
    <p>
      <label for="lev_level">Avdelning</label>
      <input id="lev_level" name="lev_level" type="text"/>
    </p>
    <p>
      <label for="lev_contact">Kontaktperson</label>
      <input id="lev_contact" name="lev_contact" type="text"/>
    </p>
    <p>
      <label for="lev_pnumber">Postnummer</label>
      <input id="lev_pnumber" name="lev_pnumber" type="text"/>
    </p>
    <p>
      <label for="lev_location">Ort</label>
      <input id="lev_location" name="lev_location" type="text"/>
    </p>
    <p>
      <label for="lev_email">E-postadress</label>
      <input id="lev_email" name="lev_email" type="text"/>
    </p>
    <p>
      <label for="lev_phnumber">Telefonnummer</label>
      <input id="lev_phnumber" name="lev_phnumber" type="text"/>
    </p>
    <p>
      <label for="lev_mobnumber">Mobilnummer</label>
      <input id="lev_mobnumber" name="lev_mobnumber" type="text"/>
    </p>
    <p>
      <label for="lev_country">Land</label>
      <?php
      $this->load->helper('form');
      $options = array(
          '' => 'Choose...',
          'sweden' => 'Sverige',
          'denmark' => 'Danmark',
          'norway' => 'Norge',
          'finland' => 'Finland',
          'island' => 'Island',
      );
      echo form_dropdown('lev_country', $options, 'Choose...', 'id="lev_country"');
      ?>
      <span> Utanför Sverige? Läs mer <a href="">här</a></span>
    </p>
    <p>
      <input class="submit" type="submit" value="Gå vidare" />
    </p>
  </fieldset>
</form>
