<div class="grid_9" style="padding-top: 10px;">
  <?php if($contest != -1):?>
    <span style="font-size:13px;padding-bottom:10px;float:left;">Du tävlar just nu för lag <?php echo  $team_name = $contest[0]->team_name; ?> från <?php echo  $team_name = $contest[0]->company_name; ?> </span>
  <?php endif;?>

  <img src="/img/googlemaps.png" alt="googlemaps" style="float:left;">
</div>
