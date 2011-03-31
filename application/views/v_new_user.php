
<script src="<?php echo base_url(); ?>js/jquery.validate.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/cmxform.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/cmxformTemplate.css" />

<script type="text/javascript">
  //$.validator.setDefaults({
  //submitHandler: function() { alert("submitted!"); }
  //});

  $(document).ready(function() {
    $.validator.addMethod("username",function(value,element){
      return this.optional(element)|| /^[A-Za-z0-9]{4,20}$/i.test(value);
    },"You must type min 4, max 20 letters, and no å,ä,ö.");
    
    $.validator.addMethod("password",function(value,element){
      return this.optional(element) || /^[A-Za-z0-9!@#$%^&*()_]{6,255}$/i.test(value);
    },"You must type min 6 max 255 letters, and no å,ä,ö.");

    $('#signupForm').submit(function(e){ 
      if ($('#muni').val() == "") {
        alert("Vänligen välj en kommun.");
        e.preventDefault();
        return false;
      }});

    $('#signupForm').submit(function(e){ 
      if ($('#source').val() == "") {
        alert("Vänligen välj ett svar.");
        e.preventDefault();
        return false;
      }});



    $("#signupForm").validate({
      rules: {
        username: {
          required: true,
          username: true,
          minlength: 4,
          maxlength: 20
        },
        firstname: {
          required: true,
          maxlength: 30
        },
        lastname: {
          required: true,
          maxlength: 30
        },
        email: {
          required: true,
          email: true
        },
        email2: {
          required: true,
          email: true,
          equalTo: "#email"
        },
        password: {
          required: true,
          password: true,
          minlength: 6,
          maxlength: 255
        },
        password2: {
          required: true,
          minlength: 6,
          maxlength: 255,
          equalTo: "#password"
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

    });
  });

</script>


<h1>Bli medlem</h1>

      <div style="border: 2px solid red;">   <?php echo validation_errors(); ?> </div>

<form class="cmxform" id="signupForm" method="post" action="/validate/userreg">
  <fieldset>
    <legend>Fyll i formuläret</legend>
    <div style="float: right; font-size: 20px;"><a href="/user/newcompany">Anmäl ditt företag</a></div>
    <p>
      <label for="username">Välj ett alias</label>
      <input id="username" name="username" type="text" value="<?php echo set_value('username'); ?>"/>
    </p>

    <p>
      <label for="firstname">Förnamn</label>
      <input id="firstname" name="firstname" type="text" value="<?php echo set_value('firstname'); ?>" />
    </p>

    <p>
      <label for="lastname">Efternamn</label>
      <input id="lastname" name="lastname" type="text" value="<?php echo set_value('lastname'); ?>" />
    </p>

    <p>
      <label for="sex">Kön</label>
      <select name="sex" id="sex">
        <option value="female">Kvinna</option>
        <option value="male">Man</option>
      </select>
    </p>

    <p>
      <label for="muni">Kommun</label>
      <select name="muni" id="muni">
        <option label="Välj..." value="">Välj...</option>
        <option label="Helsingborg" value="1">Helsingborg</option>
        <option label="Båstad" value="3">Båstad</option>
      </select>
    </p>

    <p>
      <label for="email">E-postadress</label>
      <input id="email" name="email" type="text" value="<?php echo set_value('email'); ?>"/><em> Har du inget e-postkonto? <a href="http://motiomera.se/pages/vanligafragor.php#Fraga_IngenEpost"> Läs mer här.</a></em>
    </p>

    <p>
      <label for="email2">Upprepa</label>
      <input id="email2" name="email2" type="text" value="<?php echo set_value('email2'); ?>"/>
    </p>

    <p>
      <label for="password">Välj lösenord</label>
      <input id="password" name="password"  type="text" class="required" value="<?php echo set_value('password'); ?>"/>
    </p>

    <p>
      <label for="password2">Upprepa</label>
      <input id="password2" name="password2" type="text" class="required" value="<?php echo set_value('password2'); ?>"/>
    </p>

    <p>
      <label for="membership">Medlemskap</label>
      <input name="membership" id="membership" value="" type="radio" /><span> <b>Jag har företagsnyckel</b> </span> <a href=""> Läs mer här.</a>
    </p>

    <p>
      <label></label>
      <input name="key" type="radio"/><span> <b>Jag har kampanjkod</b> </span> <a href=""> Läs mer här.</a>
    </p>

    <p>
      <label for="source">Hur hörde du talas om Motiomera?</label>
      <select name="source" id="source">
        <option value="">Välj...</option>
        <option value="email">Email</option>
        <option value="telefon">Telefon</option>
        <option value="direktreklam">Direktreklam</option>
        <option value="kontorspost">Kontorspost</option>
        <option value="tidningsannons">Tidningsannons</option>
        <option value="tidningskupong">Reklamblad i tidning</option>
        <option value="banner">Bannerannons på internet</option>
        <option value="bannerinyhetsbrev">Bannerannons i nyhetsbrev</option>
        <option value="sokmotor">Sökmotor på internet</option>
        <option value="fax">Faxannons</option>
        <option value="tipsbekant">Tips från en bekant</option>
        <option value="event">Mässa eller event</option>
        <option value="tidigarekund">Kund sedan tidigare</option>
        <option value="annat">Annat sätt</option>
      </select>
    </p>

    <p>
      <label for="agree">Ja, jag godkänner <a href="http://www.integritetspolicy.se/" target="_blank">Allers integritetspolicy</a> och är över 16 år. </label>
      <input type="checkbox" class="checkbox" id="agree" name="agree"/>
    </p>

    <p>
      <input class="submit" type="submit" value="Gå vidare"/>
    </p>

  </fieldset>
</form>



