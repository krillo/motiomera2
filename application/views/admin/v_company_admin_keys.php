<?php $count = count($free_keys); ?>
<p>
Varje deltagare har i stegräknarpaketet fått en företagsnyckel som de ska använda för att registrera sig på MotioMera.
Nedan kan du se de företagsnycklar som ännu inte registrerats på sajten.
Om någon av deltagarna har fått förhinder kan alltså nycklarna användas av någon annan om så önskas.
</p>

<h2>Nycklar som inte har använts ännu (<?php echo $count; ?> st):</h2>
<p id="key-list">
  <?php
  if($count > 0){
    foreach ($free_keys as $key => $row){
      echo $row . '<br>';
    }
  } else {
    echo 'Inga lediga nycklar.';
  }  
  ?>
</p>


