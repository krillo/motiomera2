<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Reset your password</title>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/daje_temp_newpassword.css" />
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js'></script>
    <script src="<?php echo base_url(); ?>js/jquery.validate.js" type="text/javascript"></script>
  </head>
    <body class="show_password_reset identity_validation">
      <script type="text/javascript">
        $(document).ready(function() {
          $.validator.addMethod("password",function(value,element){
            return this.optional(element) || /^[A-Za-z0-9!@#$%^/+-=?&*()_]{6,40}$/i.test(value);
          }, "<img src='/img/icon_fail.png'/>");
          $("#password").keyup(function() {
            $("#password-error").remove();
            var password = $(this).val();
            /*var characterReg = /^\s*[a-zA-Z0-9,\s]+\s*$/;*/
            var characterReg = /^\s*[a-zA-Z0-9,!@#$%^/+-=?&*()_\s]+\s*$/;
            /*var characterReg = /^([a-zA-Z0-9,!@#$%^/+-=?&*()_]{6,40})$/*/
            if(!characterReg.test(password)) {
              $(this).after('<span id="password-error" <img src="/img/icon_fail.png"></span>');
            }else {
              $(this).after('<span id="password-error" <img src="/img/icon_success.png"></span>')
            }
          });
          $("#signupForm").validate({
            rules: {
              password: {
                required: true,
                password: true,
                minlength: 6,
                maxlength: 40
              },
              password_confirmation: {
                required: true,
                minlength: 6,
                maxlength: 40,
                equalTo: "#password"
              }
            },
            messages: {
              password: {
                required: "<img src='/img/icon_fail.png'/>",
                minlength: "<img src='/img/icon_fail.png'/>",
                maxlength: ""
              },
              password_confirmation: {
                required: "<img src='/img/icon_fail.png'/>",
                minlength: "<img src='/img/icon_fail.png'/>",
                maxlength: "",
                equalTo: "<img src='/img/icon_fail.png'/>"
              }
            }
          });
        });
      </script>

      <div id="wrapper">
        <div class="container">

          <div class="Full">
            <div class="col">

              <!--div class="innercol"-->

                <div id="header">
                  <h2>
                    Reset your MotioMera password
                  </h2>
                </div>

                <div id="panel">
                  <div style="margin-bottom: 24px;">
                    <p style="font-size: 16px;">Hello, <span style="font-weight: bold;"><?php echo $this->session->userdata('user_full_name'); ?></span></p>

                    <p style="font-size: 16px;">Please use the form below to set a new password.</p>
                  </div>

                  <img alt="Lock" class="lock" src='/img/lock.jpg'/>

                  <span style="color:red;"><?php echo validation_errors(); ?></span>

                  <!--div class="form"-->
                  <form accept-charset="UTF-8" action="/validate/newpass"  id="signupForm"  method="post">
                    <input id="return_to" name="return_to" type="hidden" />

                    <div class="field validated_field">
                      <label>Your Email</label> 
                      <p class="field"><input id="email" name="email" type="text" style="opacity:0.4;filter:alpha(opacity=40)" readonly value="<?php echo $this->session->userdata('user_mail'); ?>" /></p>
                    </div>

                    <div class="field validated_field">
                      <label for="password">Choose a new password</label>
                      <p><input id="password" name="password"  type="text"/></p>
                      <span id="password-error"></span>
                      <p class="hint">Type min 6 and max 40 characters, no å,ä,ö.</p>
                    </div>

                    <div class="field validated_field">
                      <label for="password_confirmation">Confirm your new password</label>
                      <p><input id="password_confirmation" name="password_confirmation"  type="text" /></p>
                      <p class="hint">This must match the password above. </p>
                    </div>

                    <div class="action submit">
                      <p><input title="Reset my password." class="submit" name="commit" type="submit" value="Reset my password" /></p>
                    </div>
 
                    <div class="cancel">
                      <a href="/start"><input type="button" name="cancel" title="Go back to Start page." value="Cancel" /></a>
                    </div>
                  </form>  <!--/div-->

                </div>
         
            </div>
            
          </div>
        </div>

      </div>

    </body>
</html>




