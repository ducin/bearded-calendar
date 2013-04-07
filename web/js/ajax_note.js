function processNewNote(form)
{
  var ajaxRequest = getXMLHttpRequest();
  ajaxRequest.onreadystatechange = function()
  {
    if(ajaxRequest.readyState == 4)
    {
      document.getElementById('note').innerHTML = ajaxRequest.responseText;
    }
  }
  ajaxRequest.open("GET", "/note_new"
    + "/" + form.user_id.value
    + "/" + form.note_date.value
    + "/" + form.description.value, true);
  ajaxRequest.send(null); 
}
