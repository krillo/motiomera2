<script type="text/javascript">
  $(function() {
    //do the ajax email check
    $("#new-pass").click(function() {
      var email = $("#email").val();
      email = encodeURIComponent(email);
      $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>user/checkemail/" + email,
        data: "",
        cache: false,
        success: function(html){
          $("#new-pass-mess").html(html);
        }
      });
      return false;
    });
  });
</script>

<h1>Glömt lösenord</h1>
<form>
<p>
  <label for="email" style="font-weight: bold;"> E-postadress</label>
  <input id="email" name="email" type="text" style="margin-left: 10px;" value="" />Har du glömt din E-postadress eller användarnamn? Kontakta oss <a href="http://motiomera.se/pages/vanligafragor.php#Fraga_EjHittaSvar"> här.</a>
</p>
<button id="new-pass">Send</button>
<span id="new-pass-mess" style="color:red;"></span>
</form>

