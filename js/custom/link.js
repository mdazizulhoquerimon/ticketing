	function links()
		{
	
	
				 var li="http://localhost/ticketing/";
				//var li="http://192.168.0.109/ticketing/";
				// var li="https://www.cursorbd.com/ticketing/";
	
	
	
			return li;
	
		}
		
		function hostReachable() {

 // Handle IE and more capable browsers
  var xhr = new ( window.ActiveXObject || XMLHttpRequest )( "Microsoft.XMLHTTP" );
  var status;
  var server = window.location.hostname;
  if (window.location.port != '') {
    server += ':'+window.location.port;
  }

  // Open new request as a HEAD to the root hostname with a random param to bust the cache
  xhr.open( "HEAD", "//" + server + "/?rand=" + Math.floor((1 + Math.random()) * 0x10000), false );

  // Issue request and handle response
  try {
    xhr.send();
    return ( xhr.status >= 200 && xhr.status < 300 || xhr.status === 304 );
  } catch (error) {
    return false;
}

}