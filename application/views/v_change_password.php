<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Reset your password</title>
    <!--link href="https://launchpad-asset2.37signals.com/stylesheets/signal_id/identifications.css?1303394513" media="screen" rel="stylesheet" type="text/css" />
    <link href="https://launchpad-asset3.37signals.com/stylesheets/signal_id/modal.css?1303394513" media="screen" rel="stylesheet" type="text/css" /-->
    <!--link href="https://launchpad-asset2.37signals.com/stylesheets/signal_id/layout.css?1303394513" media="screen" rel="stylesheet" type="text/css" /-->
    <!--link href="https://launchpad-asset2.37signals.com/stylesheets/signal_id/identities.css?1303394513" media="screen" rel="stylesheet" type="text/css" /-->
    <!--link href="https://launchpad-asset1.37signals.com/stylesheets/signal_id/welcome.css?1303394513" media="screen" rel="stylesheet" type="text/css" /-->
    <!--link href="https://launchpad-asset1.37signals.com/stylesheets/signal_id/launchbar.css?1303394522" media="screen" rel="stylesheet" type="text/css" /-->
    <!--link href="https://launchpad-asset0.37signals.com/stylesheets/signal_id/id_card.css?1303394513" media="screen" rel="stylesheet" type="text/css" /-->
    <!--link href="https://launchpad-asset0.37signals.com/stylesheets/signal_id/invitations.css?1303394513" media="screen" rel="stylesheet" type="text/css" /-->
    <!--link href="https://launchpad-asset1.37signals.com/stylesheets/signal_id/buttons.css?1303394513" media="screen" rel="stylesheet" type="text/css" /-->

    <!--link href="https://launchpad-asset2.37signals.com/stylesheets/signal_id/layout.css?1303394513" media="screen" rel="stylesheet" type="text/css" /-->
    <!--link href="https://launchpad-asset2.37signals.com/stylesheets/signal_id/password_resets.css?1303394513" media="screen" rel="stylesheet" type="text/css" /-->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/layout.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/identities.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/password_resets.css" />
    <!--link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/cmxform.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/cmxformTemplate.css" /-->
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js'></script>
    <!-- script src="https://launchpad-asset1.37signals.com/sprockets.js?1303394513" type="text/javascript"></script-->
    <script src="<?php echo base_url(); ?>js/jquery.validate.js" type="text/javascript"></script>
    <!-- script src="<?php echo base_url(); ?>js/sprockets.js" type="text/javascript"></script-->
  </head>

  
    <body class="show_password_reset identity_validation">

      <script type="text/javascript">
        $(document).ready(function() {

          $.validator.addMethod("password",function(value,element){
            return this.optional(element) || /^[A-Za-z0-9!@#$%^/+-=?&*()_]{6,40}$/i.test(value);
          }, "<img src='/img/icon_fail.png'/>You must type min 6 letters no å,ä,ö.");

          $("#password").keyup(function() {
          $("#password-error").remove();
          var password = $(this).val();
          var characterReg = /^\s*[a-zA-Z0-9,\s]+\s*$/;
          if(!characterReg.test(password)) {
            $(this).after('<span id="password-error" style="color:red;" <img src="/img/icon_fail.png">No special characters allowed.</span>');
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
                required: "<img src='/img/icon_fail.png'/>Please provide a password",
                minlength: "<img src='/img/icon_fail.png'/>Your password must be at least 6 characters long",
                maxlength: ""
              },
              password_confirmation: {
                required: "<img src='/img/icon_fail.png'/>Please provide a password",
                minlength: "<img src='/img/icon_fail.png'/>Your password must be at least 6 characters long",
                maxlength: "",
                equalTo: "<img src='/img/icon_fail.png'/>Please enter the same password as above"
              }
            }
          });
        });
      </script>


    <div id="wrapper">
        <div class="container">

        <div class="Full">
          <div class="col">


            <div class="innercol">


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
                
                <!--img alt="Lock" class="lock" src="https://launchpad-asset2.37signals.com/images/signal_id/lock.jpg?1303394513" /-->
                <img alt="Lock" class="lock" src='/img/lock.jpg'/>

                <span style="color:red;"><?php echo validation_errors(); ?></span>

                <!--div class="form"-->
                  <form accept-charset="UTF-8" action="/validate/newpass"  id="signupForm"  method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="_method" type="hidden" value="put" /><input name="authenticity_token" type="hidden" value="20ABhprwLSijRsBI1AMVKMbl0Sqse5ybM8w99koCAJk=" /></div>
                    <input id="return_to" name="return_to" type="hidden" />

                    <div class="field validated_field">
                      <label>Your Email</label>
                      <p class="field"><input id="email" name="email" type="text" style="opacity:0.4;filter:alpha(opacity=40)" readonly value="<?php echo $this->session->userdata('user_mail'); ?>" /></p>
                    </div>

                    <div class="field validated_field">
                      <label for="password">Choose a new password</label>
                      <p><input id="password" name="password"  type="text" /></p>
                      <span id="password-error"></span>
                      <!--p class="field"><input data-password-mismatch="These passwords don't match. Please try again. Remember that passwords are case sensitive." data-password-not-password="Must not be 'password'" data-password-same-as-username="Your password can not be the same as your username" data-password-too-short="For security your password must be at least 6 characters" id="password" name="password" type="text" /></p-->
                      <p class="hint">Min 6 characters and max 40 characters.</p>
                      <!--p class="error"></p-->
                    </div>

                    <div class="field validated_field">
                      <label for="password_confirmation">Confirm your new password</label>
                      <p><input id="password_confirmation" name="password_confirmation"  type="text" /></p>
                      <!--p class="field"><input id="password_confirmation" name="password_confirmation" type="text" /></p-->
                      <p class="hint">This must match the password above. </p>
                      <!--p class="error"></p-->
                    </div>

                    <div class="action submit">
                      <p><input title="Reset my password." class="submit" name="commit" type="submit" value="Reset my password" /></p>
                    </div>
                    <!--a href="/start">Cancel</a-->
                    <div class="cancel">
                    <input class="cancel" title="Go back to Start page." type="button" value="Cancel" onclick="document.location.href='/start';return false;" />
                    </div>
                  </form>  <!--/div-->

              </div>

              <br style="clear: both;" />

            </div>
          </div>
          <div class="bottom">
            <div class="footer">

            </div>
            &nbsp;
          </div>
        </div>
      </div>

    </div>

  </body>
</html>




<!--script src="<?php echo base_url(); ?>js/jquery.validate.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/cmxform.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/cmxformTemplate.css" />

<script type="text/javascript">
  $(document).ready(function() {
    $.validator.addMethod("newpass",function(value,element){
      return this.optional(element) || /^[A-Za-z0-9!@#$%^&*()_]{6,40}$/i.test(value);
    },"You must type min 6 letters no å,ä,ö.");
    
    $("#change-pass").validate({
      rules: {
      newpass: {
          required: true,
          newpass: true,
          minlength: 6,
          maxlength: 40
        },
        newpass2: {
          required: true,
          minlength: 6,
          maxlength: 40,
          equalTo: "#newpass"
    }
    },
      messages: {
        newpass: {
          required: "Please provide a password",
          minlength: "Your password must be at least 6 characters long",
          maxlength: "40"
        },
        newpass2: {
          required: "Please provide a password",
          minlength: "Your password must be at least 6 characters long",
          maxlength: "40",
          equalTo: "Please enter the same password as above"
        }     
      }
  });
  });
</script>

<h1>New Password</h1>
<div style="color:red;"><?php echo validation_errors(); ?></div>
<form id="change-pass" name="change-pass" method="post" action="/validate/newpass">
  <p>
    Hej, <?php echo $this->session->userdata('user_full_name'); ?>.
  </p>
  <p>
    <label for="newpass">New Password</label>
    <input id="newpass" name="newpass" type="text" value="<?php echo set_value('newpass'); ?>"/>
  </p>
  <p>
    <label for="newpass2">Your Password again</label>
    <input id="newpass2" name="newpass2" type="text" value="<?php echo set_value('newpass2'); ?>"/>
  </p>
  <p>
    <input class="submit" type="submit" value="Reset my password"/>
  </p>
</form-->