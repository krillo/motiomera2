
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

    })
    });

</script>
    
   <h1>Bli medlem</h1>

<form class="cmxform" id="signupForm" method="get" action="">
	<fieldset>
    <legend>Fyll i formuläret</legend>
    <div style="float: right; font-size: 20px;"><a href="/user/newcompany">Anmäl ditt företag</a></div>
		<p>
			<label for="username">Välj ett alias</label>
			<input id="username" name="username" type="text" />
		</p>

		<p>
			<label for="firstname">Förnamn</label>
			<input id="firstname" name="firstname" type="text" />
		</p>

		<p>
			<label for="lastname">Efternamn</label>
			<input id="lastname" name="lastname" type="text" />
		</p>

    <p>
			<label for="gender">Kön</label>
			<select name="gender" id="gender">
      <option value="kvinna">Kvinna</option>
      <option value="man">Man</option>
  </select>
		</p>

		<p>
			<label for="email">E-postadress</label>
			<input id="email" name="email" type="text"/><em> Har du inget e-postkonto? <a href="http://motiomera.se/pages/vanligafragor.php#Fraga_IngenEpost"> Läs mer här.</a></em>
		</p>

    <p>
			<label for="email2">Upprepa</label>
			<input id="email2" name="email2" type="text" />
		</p>

    <p>
			<label for="password">Välj lösenord</label>
			<input id="password" name="password"  type="text" class="required"/>
		</p>

    <p>
			<label for="password2">Upprepa</label>
			<input id="password2" name="password2" type="text" class="required"/>
		</p>

    <p>
      <label for="membership">Medlemskap</label>
      <input name="key" id="key" value="" type="radio" /><span> <b>Jag har företagsnyckel</b> </span> <a href=""> Läs mer här.</a>
    </p>

    <p>
      <label></label>
      <input name="key" type="radio"/><span> <b>Jag har kampanjkod</b> </span> <a href=""> Läs mer här.</a>
    </p>

    <p>
      <label for="question">Hur hörde du talas om Motiomera?</label>
          <select name="question" id="question">
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
      <input type="checkbox" class="checkbox" id="agree" name="agree" />
		</p>
		

		
		<p>
      <input class="submit" type="submit" value="Gå vidare"/>
		</p>

	</fieldset>
</form>



<!--div style="float: left;">
    <form action="" method="post" id="motiomera_form_table">

      <table class="motiomer_form_table" border="0" cellpadding="1" cellspacing="1" >
        <tbody>
          <tr>
            <td>Välj ett alias</td>
            <td><input name="username" id="username" type="text"/></td>
          </tr>
          <tr>
            <th>Förnamn</th>
            <td><input name="firstname" id="firstname" type="text"/>
            </td>
          </tr>

          <tr>
            <th>Efternamn</th>
            <td><input name="lastname" id="lastname" type="text"/>
            </td>
          </tr>

          <tr>
            <th>Kön</th>
            <td><select name="gender" id="gender">
                <option value="Kvinna">Kvinna</option>
                <option value="Man">Man</option>
              </select>
            </td>
          </tr>

          <tr>
            <th>E-postadress <em>Anges 2 gånger</em></th>
            <td><input name="email" id="email" type="text"/><em>Har du inget e-postkonto? <a href="http://motiomera.se/pages/vanligafragor.php#Fraga_IngenEpost"> Läs mer här.</a></em>
            </td>
          </tr>
          <tr>
            <th>Upprepa</th>
            <td><input name="email2" id="email2" type="text"/>
            </td>
          </tr>

          <tr>
            <th>Välj lösenord</th>
            <td><input name="password" id="password" type="password"/>
            </td>
          </tr>
          <tr>
            <th>Upprepa</th>
            <td><input name="password2" id="password2" type="password"/>
            </td>
          </tr>

          <tr>
            <th>Medlemsskap</th>
            <td>
              <table class="" border="0" cellpadding="1" cellspacing="1">
                <tbody>
                  <tr>
                    <th><input name="key" id="key" value="key" type="radio"/><span>Jag har företagsnyckel</span>
                    <a href="">Läs mer</a>
                    </th>
                  </tr>

                  <tr>
                    <th><input name="code" id="code" type="radio"/><span>Jag har kampanjkod</span>
                    <a href="">Läs mer</a>
                    </th>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>          

          <tr>
            <th>Hur hörde du talas om Motiomera?</th>
            <td>
              <select name="kanal" id="kanal">
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

            </td></tr>
          <tr>
            <td colspan="2"><input name="agree" id="agree" value="1" type="checkbox"/>Ja, jag godkänner <a href="http://www.integritetspolicy.se/" target="_blank">Allers integritetspolicy</a> och är över 16 år.
            </td>
          </tr>
          <tr class="lastrow">
            <td><input id="register-submit" value="Gå vidare" type="submit"/></td>
          </tr>
        </tbody>
      </table>
    </form>
</div>

</div-->