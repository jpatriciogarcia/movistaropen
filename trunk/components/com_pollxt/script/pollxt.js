
        function switchonoff(name) {
                name = "poll"+name;

                if (document.getElementById(name).style.display=="none")
                 {
                  document.getElementById(name).style.display="block";


                 }
                else
                 {
                 document.getElementById(name).style.display="none";
                 }
                }
         function checkSelected(id) {
                 vid = "v"+id;
                 pid = "p"+id;
                 if  (document.getElementById(vid).value != '' )
                  {  document.getElementById(pid).checked = true;
                     return true;
                  }
         }
         
	// remote scripting library
	// Script based on the SAJAX javascript XMLHTTPRequest library
	// which is (c) copyright 2005 modernmethod, inc
	//Script has been modified for use with PollXT

	/**
	* Sajax function for setting up a browser compatible XMLHTTPRequest object
	*
	* @return object
	*/
	function ajax_get_channel() {
		var xml_channel;
		var msxmlhttp = new Array(
				'Msxml2.XMLHTTP.5.0',
				'Msxml2.XMLHTTP.4.0',
				'Msxml2.XMLHTTP.3.0',
				'Msxml2.XMLHTTP',
				'Microsoft.XMLHTTP');
			for (var i = 0; i < msxmlhttp.length; i++) {
				try {
					xml_channel = new ActiveXObject(msxmlhttp[i]);
				} catch (e) {
					xml_channel = null;  //Unable to create a Microsoft XMLHTTPRequest object
				}
			}

		if(!xml_channel && typeof XMLHttpRequest != "undefined")
			xml_channel = new XMLHttpRequest();
		if (!xml_channel)
			window.alert("Could not create connection object.");
		return xml_channel;
	}

	/*
	* Function to call a url on the server
	*/
	function call_server(url, call_back, data)	{

		var serviceCaller;
		var postData;

		serviceCaller = ajax_get_channel();

		serviceCaller.open("POST", url, true);

		postData = data;

		serviceCaller.setRequestHeader("POST", url + " HTTP/1.1");
		serviceCaller.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");


		serviceCaller.onreadystatechange = function()	{

			if(serviceCaller.readyState != 4)	{
				return;
			}

			var data;

			data = serviceCaller.responseText.substring(0);
				call_back(data);
				return true;
		}

		serviceCaller.send(postData);
		delete serviceCaller;
	}

