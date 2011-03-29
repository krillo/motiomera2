
<script src="<?php echo base_url(); ?>js/jquery.validate.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/cmxform.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/cmxformTemplate.css" />

<script type="text/javascript">
 /* $.validator.setDefaults({
    submitHandler: function() { alert("submitted!"); }
  });*/

  $().ready(function() {
    /*$.validator.addMethod("username",function(value,element){
      return this.optional(element)|| /^[A-Za-z0-9]{4,20}$/i.test(value);
    },"You must type min 4, max 20 letters, and no å,ä,ö.");
    
    $.validator.addMethod("password",function(value,element){
      //return this.optional(element) || /^(?=.*\d)(?=.*[a-z]).{6,255}$/i.test(value);
      //return this.optional(element) || /^[A-Za-z\d]+$/i.test(value);
      return this.optional(element) || /^[A-Za-z0-9!@#$%^&*()_]{6,255}$/i.test(value);
    },"You must type min 6 max 255 letters, and no å,ä,ö.");*/

    $('#signupForm').submit(function(e){ // <<< This selector needs to point to your form.
        if ($('#country1').val() == "") {
            alert("Vänligen välj ett land.");
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
       /* country1: {
          required: true,
          country1: true
          //minlength: 6,
          //maxlength: 255
          
        },*/
        agree: {
          required: true
        }
      },

      messages: {
        email: {
          required: "Please provide a email"
        },
        /*country1: {
          required: "Please select one country"
        },*/
        agree: "Please accept our policy"
      }

    })
  });

</script>

<h1>Ange Er adress</h1>

<div style="border: 2px solid red;">   <?php echo validation_errors(); ?> </div>

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
      <label for="email">E-postadress</label>
      <input id="email" name="email" type="text"/>
    </p>

    <p>
      <label for="phone">Telefonnummer</label>
      <input id="phone" name="phone" type="text"/>
    </p>

    <p>
      <label for="mobnumber">Mobilnummer</label>
      <input id="mobnumber" name="mobnumber" type="text"/>
    </p>

    <!--p>
      <label for="country">Land</label>
      <input id="country" name="country" type="text"/>
    </p-->

    <p>
      <label for="country">Land</label>
      <select id="country" name="country">
        <option value="">Välj...</option>
        <option value="sweden">Sverige</option>
        <option value="denmark">Danmark</option>
        <option value="norway">Norge</option>
        <option value="finland">Finland</option>
        <option value="island">Island</option>
      </select><span> Utanför Sverige? Läs mer <a href="">här</a></span>
    </p>

    <p>
      <input class="" type="hidden" value="<?php echo $this->session->userdata('user_id'); ?>"  name="user_id" />
      <input class="submit" type="submit" value="Gå vidare" />
    </p>

  </fieldset>
</form>
