/**
 * Returns object that will process AJAX requests.
 */
function getXMLHttpRequest()
{
  try {
    // Opera 8.0+, Firefox, Safari
    return new XMLHttpRequest();
  } catch (e) {
    // Internet Explorer Browsers
    try {
      return new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try{
        return new ActiveXObject("Microsoft.XMLHTTP");
      } catch (e){
        // Something went wrong
        alert("Your browser doesn't support AJAX");
        return false;
      }
    }
  }
}
