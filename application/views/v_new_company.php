
<script src="<?php echo base_url(); ?>js/jquery.validate.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/cmxform.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/cmxformTemplate.css" />

<script type="text/javascript">
  $(document).ready(function(){
    //check if amount is submitted and are numbers
    $('#register-submit').click(function(){
      var count1 = $('#count1').attr('value');
      var count2 = $('#count2').attr('value');
      if(count1 == '' && count2 == ''){
        alert('both empty');
        //snyggt felmeddelande
        return false;
      }
      if(count1 != ''){
        alert(count1);
        var c1 = parseInt(count1);
        if(isNaN(c1)){
          alert('c1 is not a number');
          //snyggt felmeddelande
          return false;
        }
      }
      if(count2 != ''){
        alert(count2);
        var c2 = parseInt(count2);
        if(isNaN(c2)){
          alert('c2 is not a number');
          //snyggt felmeddelande
          return false;
        }
      }
      return true;
    });
    $.validator.addMethod('numericOnly', function (value) {
      return /[0-9 ]/.test(value);
    }, 'Please only enter numeric values (0-9)');

    $('#signupForm').submit(function(e){ //  This selector needs to point to your form.
      if ($('#trade').val() == "0") {
        $("#trade-error").show();
        $("#trade-error").html('Choose a trade.');
        e.preventDefault();
        return false;
      }});

    $('#signupForm').submit(function(e){ //  This selector needs to point to your form.
      if ($('#source').val() == "0") {
        $("#source-error").show();
        $("#source-error").html('Choose a source.');
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
        count1: {
          numericOnly:true
        },
        count2: {
          numericOnly: true
        },
        agree: {
          required: true
        }
      },
      messages: {
        company: {
          required: "Please type a company name"
        },
        agree: "Please accept our policy"
      }
    });
  });

</script>
<div class="grid_4" style="margin-left: 20px;">
<h1>Beställning för företag</h1>

<!--div style="border: 2px solid red; padding-left: 10px;">   <?php echo validation_errors(); ?> </div-->

<form class="cmxform" id="signupForm" method="post" action="/validate/companyreg">
  <fieldset>
    <legend>Fyll i formuläret</legend>
    <p>
      <label for="company">Företagets namn</label>
      <input id="company" name="company" type="text" value="<?php echo set_value('company'); ?>"/>
    </p>
    <p>
      <label for="count1">Antal deltagare</label>
      <input id="count1" name="count1" type="text" size="4" value="<?php echo set_value('count1'); ?>"/><span> 5 veckors tävling <b>med</b> stegräknare <span style="color: red;">289kr</span> ex. moms.</span>
    </p>
    <p>
      <label for="count2"></label>
      <input type="text" size="4" id="count2" name="count2" value="<?php echo set_value('count2'); ?>"/><span> 5 veckors tävling <b>utan</b> stegräknare <span style="color: red;">159kr</span> ex. moms.</span>
    </p>
    <p>
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
      <label for="start">Start datum</label>
      <input name="start" id="start" type="radio" checked="checked"/><span> Den stora vårtävlingen 9 maj</span>
    </p>
    <p>
      <label></label>
      <input type="radio"  name="start"/>
      <select name="start_">
        <option value="2011-04-11">Måndagen den 11 April</option>
        <option value="2011-04-18">Måndagen den 18 April</option>
        <option value="2011-04-25">Måndagen den 25 April</option>
        <option value="2011-05-02">Måndagen den 2 Maj</option>
        <option value="2011-05-09">Måndagen den 9 Maj</option>
        <option value="2011-05-16">Måndagen den 16 Maj</option>
        <option value="2011-05-23">Måndagen den 23 Maj</option>
        <option value="2011-05-30">Måndagen den 30 Maj</option>
        <option value="2011-06-06">Måndagen den 6 Juni</option>
        <option value="2011-06-13">Måndagen den 13 Juni</option>
      </select>
    </p>
    <p>
      <label for="trade">Vilken bransch tillhör företaget?</label>
      <?php
      $this->load->helper('form');
      echo form_dropdown('trade', $trade, 'Choose...', 'id="trade"');
      ?>
      <span id="trade-error" style="color:red;"></span>
    </p>
    <p>
      <label for="membership">Medlemskap</label>      
      <input name="code" id="code" type="radio"/><span>Jag har kampanjkod</span>
      <a href="">Läs mer</a>
    </p>
    <p>
      <label for="source">Hur hörde du talas om Motiomera?</label>
      <?php
      $this->load->helper('form');
      echo form_dropdown('source', $source, 'Choose...', 'id="source"');
      ?>
      <span id="source-error" style="color:red;"></span>
    </p>
    <div style="border-style:solid; border-width:2px;  float:right;">
      <h2 style="text-align:center; margin:1px;">Tilläggsbeställning</h2>
      <p style="margin:auto;">Är du redan kund och vill göra en<br /> tilläggsbeställning? Logga in på din<br />administrationssida där du enkelt kan<br />lägga till fler deltagare. <a href="http://motiomera.se/pages/foretaglogin.php">Klicka här.</a></p>
    </div>
    <p>
      <label for="agree">Ja, jag godkänner <a href="http://www.integritetspolicy.se/" target="_blank">Allers integritetspolicy</a> och är över 16 år. </label>
      <input type="checkbox" class="checkbox" id="agree" name="agree" />
    </p>
    <p>
      <input id="register-submit" class="submit" type="submit" value="Gå vidare"/>
    </p>
  </fieldset>
</form>
</div>


