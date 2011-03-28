
<script src="<?php echo base_url(); ?>js/jquery.validate.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/cmxform.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/cmxformTemplate.css" />

<script type="text/javascript">
  /*$.validator.setDefaults({
    submitHandler: function() { alert("submitted!"); }
  });*/

  $().ready(function() {
    //$('#register-submit').click({
    $.validator.addMethod("username",function(value,element){
      return this.optional(element)|| /^[A-Za-z0-9]{4,20}$/i.test(value);
    },"You must type min 4, max 20 letters, and no å,ä,ö.");
    
    $.validator.addMethod("password",function(value,element){
      //return this.optional(element) || /^(?=.*\d)(?=.*[a-z]).{6,255}$/i.test(value);
      //return this.optional(element) || /^[A-Za-z\d]+$/i.test(value);
      return this.optional(element) || /^[A-Za-z0-9!@#$%^&*()_]{6,255}$/i.test(value);
    },"You must type min 6 max 255 letters, and no å,ä,ö.");

    $('#signupForm').submit(function(e){ // <<< This selector needs to point to your form.
        if ($('#country').val() == "") {
            alert("Vänligen välj ett land.");
            e.preventDefault();
            return false;
        }});

    $("#signupForm").validate({
      rules: {
        company: {
          required: true,
          //username: true,
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
          //email: true,
          //equalTo: "#email"
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
        /*country: {
          required: true,
          country: true
          //minlength: 6,
          //maxlength: 255
          //equalTo: "#password"
        },*/
        agree: {
          required: true
        }
      },

      messages: {
        email: {
          required: "Please provide a email"
        },
        email2: {
          required: "Please provide a email",
          equalTo: "Please enter the same email as above"
        },
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 6 characters long",
          maxlength: ""
        },
        password2: {
          required: "Please provide a password",
          minlength: "Your password must be at least 6 characters long",
          maxlength: "",
          equalTo: "Please enter the same password as above"
        },
        country: {
          required: "Please select a country."
        },
        agree: "Please accept our policy"
      }

    })
  });

</script>

<h1>Ange Er adress</h1>

<div style="border: 2px solid red;">   <?php echo validation_errors(); ?> </div>

<form class="cmxform" id="signupForm" method="post" action="/validate/companyaddress">
  <fieldset>
    <legend>Fyll i formuläret</legend>

    <h1 style="color: red;">Faktureringsadress<span style="color:grey; font-size: 15px;"> (<span style="color:red;"> *</span> = obligatoriska uppgifter.)</span></h1>

    <p>
      <label for="company">Företagsnamn <span style="color:red;">*</span></label>
      <input id="comåany" name="company" type="text" />
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
      <label for="mobnumber">Mobilnummer</label>
      <input id="mobnumber" name="mobnumber" type="text"/>
    </p>

    <p>
      <label for="country">Land <span style="color:red;">*</span></label>
      <select id="country" name="country">
        <option value="">Välj...</option>
        <option value="sweden">Sverige</option>
        <option value="denmark">Danmark</option>
        <option value="norway">Norge</option>
        <option value="finland">Finland</option>
        <option value="island">Island</option>
      </select><span> Utanför Sverige? Läs mer <a href="">här</a></span>
    </p>

    <h1 style="color:red;">Leveransadress <span style="color:grey; font-size: 15px;">(Skickas till annan adress än ovan? Ange den här.)</span></h1>

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
      <select id="lev_country" name="lev_country">
        <option value="">Välj...</option>
        <option value="sweden">Sverige</option>
        <option value="denmark">Danmark</option>
        <option value="norway">Norge</option>
        <option value="finland">Finland</option>
        <option value="island">Island</option>
      </select>
    </p>

    <p>
      <input class="submit" type="submit" value="Gå vidare" />
    </p>

  </fieldset>
</form>
