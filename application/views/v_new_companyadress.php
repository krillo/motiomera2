
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

    <h1 style="color: red;">Faktureringsadress<span style="color:grey; font-size: 15px;"> (<span style="color:red;"> *</span> = obligatoriska uppgifter.)</span></h1>

    <p>
      <label for="co_name">Företagsnamn <span style="color:red;">*</span></label>
      <input id="co_name" name="co_name" type="text" />
    </p>

    <p>
      <label for="adress">Gatuadress <span style="color:red;">*</span></label>
      <input id="adress" name="adress" type="text"/>
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
      <label for="pnumber">Postnummer <span style="color:red;">*</span></label>
      <input id="pnumber" name="pnumber" type="text"/>
    </p>

    <p>
      <label for="location">Ort <span style="color:red;">*</span></label>
      <input id="location" name="location" type="text"/>
    </p>

    <p>
      <label for="email">E-postadress <span style="color:red;">*</span></label>
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
      <label for="country">Land <span style="color:red;">*</span></label>
      <input id="country" name="country" type="text"/>
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
      <input id="lev_country" name="lev_country" type="text"/>
    </p>

    <p>
      <input class="submit" type="submit" value="Gå vidare" />
    </p>



  </fieldset>
</form>
<!--p>
  <label for="length">Tävlingslängd (antal veckor)</label>
  <select name="length" id="length">
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
    <option value="25">25</option>
    <option value="26">26</option>
    <option value="27">27</option>
    <option value="28">28</option>
    <option value="29">29</option>
    <option value="30">30</option>
    <option value="31">31</option>
    <option value="32">32</option>
    <option value="33">33</option>
    <option value="34">34</option>
    <option value="35">35</option>
    <option value="36">36</option>
    <option value="37">37</option>
    <option value="38">38</option>
    <option value="39">39</option>
    <option value="40">40</option>
    <option value="41">41</option>
    <option value="42">42</option>
    <option value="43">43</option>
    <option value="44">44</option>
    <option value="45">45</option>
    <option value="46">46</option>
    <option value="47">47</option>
    <option value="48">48</option>
    <option value="49">49</option>
    <option value="50">50</option>
    <option value="51">51</option>
    <option value="52">52</option>
  </select>
</p>

<p>
  <label for="route">Gemensam rutt</label>
  <select name="route" id="route">
    <option value="yes">Ja</option>
    <option value="no">Nej</option>
  </select><span> Mer info klicka <a href="">här</a></span>
</p>

<p>
  <label for="start">Start datum</label>
  <input name="start" id="start" type="radio"/><span> Den stora vårtävlingen 9 maj</span>
</p>
<p>
  <label></label>
  <input type="radio"  name="start"/>
  <select name="">
    <option value="">Måndagen den 4 april</option>
  </select>
</p>

<p>
  <label for="bransch">Vilken bransch tillhör företaget?</label>
  <select name="bransch" id="bransch">
    <option value="">Välj...</option>
    <option value="">Bemanning & Arbetsförmedling</option>
    <option value="it">Data, It & Telekommunikation</option>
    <option value="">Detaljhandel</option>
    <option value="house">Fastighetsverksamhet</option>
    <option value="hair">Hår & Skönhetsvård</option>
    <option value="media">Media</option>
    <option value="hotell">Hotell & Restaurang</option>
    <option value="health">Hälsa & Sjukvård</option>
    <option value="design">Bygg-, Design- & Inredningsverksamhet</option>
    <option value="finance">Bank, Finans & Försäkring</option>
    <option value="industry">Tillverkning & Industri</option>
    <option value="pr">Reklam, Pr & Marknadsundersökning</option>
  </select>
</p>

<p>
  <label for="membership">Medlemskap</label>
  <input name="code" id="code" type="radio"/><span>Jag har kampanjkod</span>
  <a href="">Läs mer</a>
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
</form-->



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