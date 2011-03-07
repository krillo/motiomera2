function m_step_showActivities(){
  document.getElementById('step-ActivityLink').style.display = 'none';
  //document.getElementById('motiomera_steg_enhet').style.display = 'none';
  document.getElementById('activity-list').style.display = 'block';
}


function m_debug(){
  document.getElementById('debug-link').style.display = 'none';
  document.getElementById('debug-msg').style.display = 'block';
}

function m_close_debug(){
  document.getElementById('debug-msg').style.display = 'none';
  document.getElementById('debug-link').style.display = 'block';
}



function m_step_validate(){
  var date = new Date();
  var futureDate;

  //if(date.getTime() < stegKalender.getSelectedDate().getTime())
  //var futureDate = true;

  if(document.getElementById("m-steps-count").value == "" || !isInt(document.getElementById("m-steps-count").value)){
    alert("Värdet måste vara ett heltal");
    return false;
  }else{
    return true;
  }
  /*
  }else if(futureDate){
  alert("Du kan inte ange ett datum i framtiden");
  return false;
  }else if(document.getElementById("motiomera_steg_antal").value >= 100000){
  alert("Du kan inte rapportera så många steg.");
  return false;
  }else if(document.getElementById("motiomera_steg_antal").value >= 30000){
  return confirm("Vill du rapportera " + document.getElementById("motiomera_steg_antal").value + "steg?");
  }else if(document.getElementById("motiomera_steg_antal").value >= 1440 && motiomera_steg_getAktivitetsVarde(document.getElementById("steg_aid").value)!=1) {
  alert("Du kan inte rapportera en aktivitet på så många minuter.");
  return false;
  }else if (motiomera_steg_getAktivitetsVarde(document.getElementById("steg_aid").value)*document.getElementById("motiomera_steg_antal").value > 100000){
  alert("Du kan inte rapportera en aktivitet som motsvarar så många steg.");
  return false;
  }else if (motiomera_steg_getAktivitetsVarde(document.getElementById("steg_aid").value)*document.getElementById("motiomera_steg_antal").value > 30000){
  return confirm("Vill du rapportera " + document.getElementById("motiomera_steg_antal").value + "minuter?");
  }else{
  return true;
  */

}