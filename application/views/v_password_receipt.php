<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <style type="text/css">
    p {font-size: 12px;}
  </style>
    <title>Nytt Lösenord</title>
  </head>
  <body>
    <!--form action="" method="post"-->
    <h2>Nytt lösenord</h2>
    <p>
      <?php $ord = sha1('danne');?>
      Klicka på länken för att ändra Ert lösenord <?php echo anchor ("http://m2.dev/index.php/user/changepass/$ord")?>
    </p>
    
      <!--?php $ord = 'hej';
            $message = "Ni har precis bett om ett nytt lösenord. En aktiveringskod har skickats till den E-postadress som uppgavs. Vänligen klicka på länken i mailet för att få den nya koden." . $ord ."";
            echo $message;
            ?-->
    
    
      <!--label for="new_pass">New password</label>
      <input id="new_pass" name="new_pass" type="text"/>
    </p>
    <p>
      <label for="new_pass_again">New password again</label>
      <input id="new_pass_again" name="new_pass_again" type="text"/>
    </p-->
    <!--p>
      <input type="submit" value="Send"/>
    </p-->
    
  </body>
</html>
