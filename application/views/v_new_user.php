
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
        <option value="kvinna">Kvinna</option>
        <option value="man">Man</option>
      </select>
    </p>

    <p>
      <label for="muni">Kommun</label>
      <select name="muni" id="muni">
        <option label="Välj..." value="">Välj...</option>
        <option label="Ale" value="150">Ale</option>
        <option label="Alingsås" value="171">Alingsås</option>
        <option label="Alvesta" value="81">Alvesta</option>
        <option label="Aneby" value="65">Aneby</option>
        <option label="Arboga" value="214">Arboga</option>
        <option label="Arjeplog" value="270">Arjeplog</option>
        <option label="Arvidsjaur" value="269">Arvidsjaur</option>
        <option label="Arvika" value="192">Arvika</option>
        <option label="Askersund" value="201">Askersund</option>
        <option label="Avesta" value="228">Avesta</option>
        <option label="Bengtsfors" value="159">Bengtsfors</option>
        <option label="Berg" value="251">Berg</option>
        <option label="Bjurholm" value="255">Bjurholm</option>
        <option label="Bjuv" value="110">Bjuv</option>
        <option label="Boden" value="280">Boden</option>
        <option label="Bollebygd" value="153">Bollebygd</option>
        <option label="Bollnäs" value="238">Bollnäs</option>
        <option label="Borgholm" value="97">Borgholm</option>
        <option label="Borlänge" value="225">Borlänge</option>
        <option label="Borås" value="172">Borås</option>
        <option label="Botkyrka" value="290">Botkyrka</option>
        <option label="Boxholm" value="55">Boxholm</option>
        <option label="Bromölla" value="119">Bromölla</option>
        <option label="Bräcke" value="247">Bräcke</option>
        <option label="Burlöv" value="106">Burlöv</option>
        <option label="Båstad" value="124">Båstad</option>
        <option label="Dals-Ed" value="148">Dals-Ed</option>
        <option label="Danderyd" value="297">Danderyd</option>
        <option label="Degerfors" value="197">Degerfors</option>
        <option label="Dorotea" value="262">Dorotea</option>
        <option label="Eda" value="179">Eda</option>
        <option label="Ekerö" value="288">Ekerö</option>
        <option label="Eksjö" value="76">Eksjö</option>
        <option label="Emmaboda" value="91">Emmaboda</option>
        <option label="Enköping" value="42">Enköping</option>
        <option label="Eskilstuna" value="49">Eskilstuna</option>
        <option label="Eslöv" value="126">Eslöv</option>
        <option label="Essunga" value="155">Essunga</option>
        <option label="Fagersta" value="212">Fagersta</option>
        <option label="Falkenberg" value="136">Falkenberg</option>
        <option label="Falköping" value="177">Falköping</option>
        <option label="Falu" value="224">Falu</option>
        <option label="Filipstad" value="190">Filipstad</option>
        <option label="Finspång" value="57">Finspång</option>
        <option label="Flen" value="48">Flen</option>
        <option label="Forshaga" value="184">Forshaga</option>
        <option label="Färgelanda" value="149">Färgelanda</option>
        <option label="Gagnef" value="217">Gagnef</option>
        <option label="Gislaved" value="69">Gislaved</option>
        <option label="Gnesta" value="45">Gnesta</option>
        <option label="Gnosjö" value="66">Gnosjö</option>
        <option label="Gotland" value="98">Gotland</option>
        <option label="Grums" value="185">Grums</option>
        <option label="Grästorp" value="154">Grästorp</option>
        <option label="Gullspång" value="157">Gullspång</option>
        <option label="Gällivare" value="276">Gällivare</option>
        <option label="Gävle" value="235">Gävle</option>
        <option label="Göteborg" value="6">Göteborg</option>
        <option label="Götene" value="7">Götene</option>
        <option label="Habo" value="68">Habo</option>
        <option label="Hagfors" value="191">Hagfors</option>
        <option label="Hallsberg" value="196">Hallsberg</option>
        <option label="Hallstahammar" value="208">Hallstahammar</option>
        <option label="Halmstad" value="134">Halmstad</option>
        <option label="Hammarö" value="182">Hammarö</option>
        <option label="Haninge" value="292">Haninge</option>
        <option label="Haparanda" value="281">Haparanda</option>
        <option label="Heby" value="39">Heby</option>
        <option label="Hedemora" value="227">Hedemora</option>
        <option label="Helsingborg" value="18">Helsingborg</option>
        <option label="Herrljunga" value="163">Herrljunga</option>
        <option label="Hjo" value="175">Hjo</option>
        <option label="Hofors" value="231">Hofors</option>
        <option label="Huddinge" value="289">Huddinge</option>
        <option label="Hudiksvall" value="239">Hudiksvall</option>
        <option label="Hultsfred" value="89">Hultsfred</option>
        <option label="Hylte" value="133">Hylte</option>
        <option label="Hällefors" value="198">Hällefors</option>
        <option label="Härjedalen" value="252">Härjedalen</option>
        <option label="Härnösand" value="242">Härnösand</option>
        <option label="Härryda" value="139">Härryda</option>
        <option label="Hässleholm" value="132">Hässleholm</option>
        <option label="Håbo" value="36">Håbo</option>
        <option label="Höganäs" value="125">Höganäs</option>
        <option label="Högsby" value="86">Högsby</option>
        <option label="Hörby" value="116">Hörby</option>
        <option label="Höör" value="117">Höör</option>
        <option label="Jokkmokk" value="271">Jokkmokk</option>
        <option label="Järfälla" value="287">Järfälla</option>
        <option label="Jönköping" value="71">Jönköping</option>
        <option label="Kalix" value="273">Kalix</option>
        <option label="Kalmar" value="92">Kalmar</option>
        <option label="Karlsborg" value="156">Karlsborg</option>
        <option label="Karlshamn" value="102">Karlshamn</option>
        <option label="Karlskoga" value="202">Karlskoga</option>
        <option label="Karlskrona" value="100">Karlskrona</option>
        <option label="Karlstad" value="188">Karlstad</option>
        <option label="Katrineholm" value="311">Katrineholm</option>
        <option label="Kil" value="178">Kil</option>
        <option label="Kinda" value="54">Kinda</option>
        <option label="Kiruna" value="282">Kiruna</option>
        <option label="Klippan" value="122">Klippan</option>
        <option label="Knivsta" value="38">Knivsta</option>
        <option label="Kramfors" value="244">Kramfors</option>
        <option label="Kristianstad" value="129">Kristianstad</option>
        <option label="Kristinehamn" value="189">Kristinehamn</option>
        <option label="Krokom" value="248">Krokom</option>
        <option label="Kumla" value="200">Kumla</option>
        <option label="Kungsbacka" value="138">Kungsbacka</option>
        <option label="Kungsör" value="207">Kungsör</option>
        <option label="Kungälv" value="166">Kungälv</option>
        <option label="Kävlinge" value="111">Kävlinge</option>
        <option label="Köping" value="213">Köping</option>
        <option label="Laholm" value="135">Laholm</option>
        <option label="Landskrona" value="20">Landskrona</option>
        <option label="Laxå" value="195">Laxå</option>
        <option label="Lekeberg" value="194">Lekeberg</option>
        <option label="Leksand" value="218">Leksand</option>
        <option label="Lerum" value="151">Lerum</option>
        <option label="Lessebo" value="79">Lessebo</option>
        <option label="Lidingö" value="302">Lidingö</option>
        <option label="Lidköping" value="15">Lidköping</option>
        <option label="Lilla Edet" value="161">Lilla Edet</option>
        <option label="Lindesberg" value="204">Lindesberg</option>
        <option label="Linköping" value="59">Linköping</option>
        <option label="Ljungby" value="85">Ljungby</option>
        <option label="Ljusdal" value="234">Ljusdal</option>
        <option label="Ljusnarsberg" value="199">Ljusnarsberg</option>
        <option label="Lomma" value="112">Lomma</option>
        <option label="Ludvika" value="229">Ludvika</option>
        <option label="Luleå" value="278">Luleå</option>
        <option label="Lund" value="19">Lund</option>
        <option label="Lycksele" value="267">Lycksele</option>
        <option label="Lysekil" value="167">Lysekil</option>
        <option label="Malmö" value="3">Malmö</option>
        <option label="Malung-Sälen" value="216">Malung-Sälen</option>
        <option label="Malå" value="259">Malå</option>
        <option label="Mariestad" value="9">Mariestad</option>
        <option label="Mark" value="26">Mark</option>
        <option label="Markaryd" value="310">Markaryd</option>
        <option label="Mellerud" value="160">Mellerud</option>
        <option label="Mjölby" value="64">Mjölby</option>
        <option label="Mora" value="223">Mora</option>
        <option label="Motala" value="62">Motala</option>
        <option label="Mullsjö" value="67">Mullsjö</option>
        <option label="Munkedal" value="146">Munkedal</option>
        <option label="Munkfors" value="183">Munkfors</option>
        <option label="Mölndal" value="165">Mölndal</option>
        <option label="Mönsterås" value="90">Mönsterås</option>
        <option label="Mörbylånga" value="88">Mörbylånga</option>
        <option label="Nacka" value="299">Nacka</option>
        <option label="Nora" value="203">Nora</option>
        <option label="Norberg" value="209">Norberg</option>
        <option label="Nordanstig" value="233">Nordanstig</option>
        <option label="Nordmaling" value="254">Nordmaling</option>
        <option label="Norrköping" value="60">Norrköping</option>
        <option label="Norrtälje" value="35">Norrtälje</option>
        <option label="Norsjö" value="258">Norsjö</option>
        <option label="Nybro" value="93">Nybro</option>
        <option label="Nykvarn" value="295">Nykvarn</option>
        <option label="Nyköping" value="46">Nyköping</option>
        <option label="Nynäshamn" value="305">Nynäshamn</option>
        <option label="Nässjö" value="72">Nässjö</option>
        <option label="Ockelbo" value="230">Ockelbo</option>
        <option label="Olofström" value="99">Olofström</option>
        <option label="Orsa" value="220">Orsa</option>
        <option label="Orust" value="144">Orust</option>
        <option label="Osby" value="120">Osby</option>
        <option label="Oskarshamn" value="94">Oskarshamn</option>
        <option label="Ovanåker" value="232">Ovanåker</option>
        <option label="Oxelösund" value="47">Oxelösund</option>
        <option label="Pajala" value="275">Pajala</option>
        <option label="Partille" value="140">Partille</option>
        <option label="Perstorp" value="121">Perstorp</option>
        <option label="Piteå" value="279">Piteå</option>
        <option label="Ragunda" value="246">Ragunda</option>
        <option label="Robertsfors" value="257">Robertsfors</option>
        <option label="Ronneby" value="101">Ronneby</option>
        <option label="Rättvik" value="219">Rättvik</option>
        <option label="Sala" value="211">Sala</option>
        <option label="Salem" value="291">Salem</option>
        <option label="Sandviken" value="236">Sandviken</option>
        <option label="Sigtuna" value="304">Sigtuna</option>
        <option label="Simrishamn" value="130">Simrishamn</option>
        <option label="Sjöbo" value="115">Sjöbo</option>
        <option label="Skara" value="8">Skara</option>
        <option label="Skellefteå" value="268">Skellefteå</option>
        <option label="Skinnskatteberg" value="205">Skinnskatteberg</option>
        <option label="Skurup" value="114">Skurup</option>
        <option label="Skövde" value="174">Skövde</option>
        <option label="Smedjebacken" value="222">Smedjebacken</option>
        <option label="Sollefteå" value="32">Sollefteå</option>
        <option label="Sollentuna" value="298">Sollentuna</option>
        <option label="Solna" value="301">Solna</option>
        <option label="Sorsele" value="261">Sorsele</option>
        <option label="Sotenäs" value="145">Sotenäs</option>
        <option label="Staffanstorp" value="105">Staffanstorp</option>
        <option label="Stenungsund" value="142">Stenungsund</option>
        <option label="Stockholm" value="5">Stockholm</option>
        <option label="Storfors" value="181">Storfors</option>
        <option label="Storuman" value="260">Storuman</option>
        <option label="Strängnäs" value="50">Strängnäs</option>
        <option label="Strömstad" value="169">Strömstad</option>
        <option label="Strömsund" value="249">Strömsund</option>
        <option label="Sundbyberg" value="300">Sundbyberg</option>
        <option label="Sundsvall" value="243">Sundsvall</option>
        <option label="Sunne" value="187">Sunne</option>
        <option label="Surahammar" value="206">Surahammar</option>
        <option label="Svalöv" value="104">Svalöv</option>
        <option label="Svedala" value="113">Svedala</option>
        <option label="Svenljunga" value="162">Svenljunga</option>
        <option label="Säffle" value="193">Säffle</option>
        <option label="Säter" value="226">Säter</option>
        <option label="Sävsjö" value="74">Sävsjö</option>
        <option label="Söderhamn" value="237">Söderhamn</option>
        <option label="Söderköping" value="61">Söderköping</option>
        <option label="Södertälje" value="34">Södertälje</option>
        <option label="Sölvesborg" value="103">Sölvesborg</option>
        <option label="Tanum" value="147">Tanum</option>
        <option label="Tibro" value="164">Tibro</option>
        <option label="Tidaholm" value="176">Tidaholm</option>
        <option label="Tierp" value="40">Tierp</option>
        <option label="Timrå" value="241">Timrå</option>
        <option label="Tingsryd" value="80">Tingsryd</option>
        <option label="Tjörn" value="143">Tjörn</option>
        <option label="Tomelilla" value="118">Tomelilla</option>
        <option label="Torsby" value="180">Torsby</option>
        <option label="Torsås" value="87">Torsås</option>
        <option label="Tranemo" value="158">Tranemo</option>
        <option label="Tranås" value="77">Tranås</option>
        <option label="Trelleborg" value="128">Trelleborg</option>
        <option label="Trollhättan" value="16">Trollhättan</option>
        <option label="Trosa" value="51">Trosa</option>
        <option label="Tyresö" value="293">Tyresö</option>
        <option label="Täby" value="296">Täby</option>
        <option label="Töreboda" value="28">Töreboda</option>
        <option label="Uddevalla" value="168">Uddevalla</option>
        <option label="Ulricehamn" value="27">Ulricehamn</option>
        <option label="Umeå" value="266">Umeå</option>
        <option label="Upplands Väsby" value="283">Upplands Väsby</option>
        <option label="Upplands-Bro" value="294">Upplands-Bro</option>
        <option label="Uppsala" value="41">Uppsala</option>
        <option label="Uppvidinge" value="78">Uppvidinge</option>
        <option label="Vadstena" value="63">Vadstena</option>
        <option label="Vaggeryd" value="70">Vaggeryd</option>
        <option label="Valdemarsvik" value="58">Valdemarsvik</option>
        <option label="Vallentuna" value="284">Vallentuna</option>
        <option label="Vansbro" value="215">Vansbro</option>
        <option label="Vara" value="17">Vara</option>
        <option label="Varberg" value="137">Varberg</option>
        <option label="Vaxholm" value="303">Vaxholm</option>
        <option label="Vellinge" value="107">Vellinge</option>
        <option label="Vetlanda" value="75">Vetlanda</option>
        <option label="Vilhelmina" value="264">Vilhelmina</option>
        <option label="Vimmerby" value="96">Vimmerby</option>
        <option label="Vindeln" value="256">Vindeln</option>
        <option label="Vingåker" value="44">Vingåker</option>
        <option label="Vänersborg" value="170">Vänersborg</option>
        <option label="Vännäs" value="263">Vännäs</option>
        <option label="Värmdö" value="286">Värmdö</option>
        <option label="Värnamo" value="73">Värnamo</option>
        <option label="Västervik" value="95">Västervik</option>
        <option label="Västerås" value="210">Västerås</option>
        <option label="Växjö" value="84">Växjö</option>
        <option label="Vårgårda" value="152">Vårgårda</option>
        <option label="Ydre" value="53">Ydre</option>
        <option label="Ystad" value="127">Ystad</option>
        <option label="Älmhult" value="82">Älmhult</option>
        <option label="Älvdalen" value="221">Älvdalen</option>
        <option label="Älvkarleby" value="37">Älvkarleby</option>
        <option label="Älvsbyn" value="277">Älvsbyn</option>
        <option label="Ängelholm" value="131">Ängelholm</option>
        <option label="Åmål" value="173">Åmål</option>
        <option label="Ånge" value="240">Ånge</option>
        <option label="Åre" value="250">Åre</option>
        <option label="Årjäng" value="186">Årjäng</option>
        <option label="Åsele" value="265">Åsele</option>
        <option label="Åstorp" value="123">Åstorp</option>
        <option label="Åtvidaberg" value="56">Åtvidaberg</option>
        <option label="Öckerö" value="312">Öckerö</option>
        <option label="Ödeshög" value="52">Ödeshög</option>
        <option label="Örebro" value="4">Örebro</option>
        <option label="Örkelljunga" value="109">Örkelljunga</option>
        <option label="Örnsköldsvik" value="245">Örnsköldsvik</option>
        <option label="Östersund" value="253">Östersund</option>
        <option label="Österåker" value="285">Österåker</option>
        <option label="Östhammar" value="43">Östhammar</option>
        <option label="Östra Göinge" value="108">Östra Göinge</option>
        <option label="Överkalix" value="272">Överkalix</option>
        <option label="Övertorneå" value="274">Övertorneå</option>
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



