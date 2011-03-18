
<script src="<?php echo base_url(); ?>js/jquery.validate.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/cmxform.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/cmxformTemplate.css" />

<script type="text/javascript">
  $.validator.setDefaults({
    submitHandler: function() { alert("submitted!"); }
  });

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

    $("#signupForm").validate({
      rules: {
        co_name: {
          required: true,
          //username: true,
          minlength: 0,
          maxlength: 30
        },
        adress: {
          required: true
          //maxlength: 30
        },
        contactpers: {
          required: true
          //maxlength: 30
        },
        pnumber: {
          required: true
          //email: true
        },
        location: {
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
        country: {
          required: true,
          minlength: 6,
          maxlength: 255
          //equalTo: "#password"
        },
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
        agree: "Please accept our policy"
      }

    })
  });

</script>

<h1>Ange Er adress</h1>

<form class="cmxform" id="signupForm" method="get" action="">
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
      <label for="adress">Gatuadress</label>
      <input id="adress" name="adress" type="text"/>
    </p>

    <p>
      <label for="co">c/o</label>
      <input id="co" name="co" type="text"/>
    </p>

    <p>
      <label for="pnumber">Postnummer</label>
      <input id="pnumber" name="pnumber" type="text"/>
    </p>

    <p>
      <label for="location">Ort</label>
      <input id="location" name="location" type="text"/>
    </p>

    <p>
      <label for="email">E-postadress</label>
      <input id="email" name="email" type="text"/>
    </p>

    <p>
      <label for="phnumber">Telefonnummer</label>
      <input id="phnumber" name="phnumber" type="text"/>
    </p>

    <p>
      <label for="mobnumber">Mobilnummer</label>
      <input id="mobnumber" name="mobnumber" type="text"/>
    </p>

    <p>
      <label for="country">Land</label>
      <input id="country" name="country" type="text"/>
    </p>   

    <p>
      <input class="submit" type="submit" value="Gå vidare" />
    </p>

  </fieldset>
</form>
