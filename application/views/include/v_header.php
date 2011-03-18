<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js'></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-ui-1.8.9.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/step.js?ver=0.2"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/ui-lightness/jquery-ui-1.8.9.custom.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/style.css" />


<?php if ($this->session->userdata('role_level') > 40): ?>
    <script type="text/javascript" src="<?php echo base_url(); ?>dataTables/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>dataTables/css/demo_table.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>dataTables/css/demo_page.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>dataTables/css/demo_table_jui.css" />
<?php endif; ?>

    <title><?php echo $title; ?></title>
  </head>
  <body>

<?php include 'v_adminbar.php'; ?>

    <div id="header">
      <img src="<?php echo base_url(); ?>img/motiomera_header.png" />
      <?php if ($this->m_user->isLoggedIn()): ?>
        <div id="greeting">
          Welcome <span id="greeting-nick"><?php echo $this->session->userdata('user_nick'); ?></span><br/>
          <a href="/start/logout">Log out</a>
        </div>

      <?php else: ?>
          <div id="log-in" class="mmFontWhite">
            <form action="/start/login" method="post">
              <table width="290" cellspacing="1" cellpadding="0" border="0">
                <tr>
                  <td class="log-in-input">E-postadress: </td>
                  <td><input name="user" id="user" value="" class="text-field" size="17" type="text" maxlength="96" tabindex="1" /></td>
                  <td class="log-in-input"><input type="checkbox" id="autologin" name="autologin" value="on" tabindex="3" /> <label for="autologin">Kom ihåg mig</label></td>
                </tr>
                <tr>
                  <td class="log-in-input">Lösenord: </td>
                  <td><input name="pwd" id="pwd" value="" size="17" class="text-field" type="password" maxlength="96" tabindex="2"/></td>
                  <td><input type="hidden" name="login" value="Login"/><input type="image" src="/img/icons/LoggaInIcon.gif" alt="Logga in" tabindex="4" /></td>
                </tr>
              </table>
            </form>
          </div>
      <?php endif; ?>

    </div>

    <div id="mmMenuTop">
          <a href="/user/newcompany">FÖR FÖRETAG</a> |
					<a href="/user/newuser">BLI MEDLEM</a> |
					<a href="/user/forgotpass">GLÖMT LÖSENORDET?</a>
		</div>


    <div class="clear"></div>

    
    