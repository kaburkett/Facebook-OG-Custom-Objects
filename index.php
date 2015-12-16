<html>
	<head>
		<title>Facebook JSDK Setup</title>
	</head>
	<body>
		<script>
		  window.fbAsyncInit = function() {
		    FB.init({
		      appId      : 'YOUR_APP_ID_HERE',
		      xfbml      : false,
		      version    : 'v2.5'
		    });
		  };
		
		  (function(d, s, id){
		     var js, fjs = d.getElementsByTagName(s)[0];
		     if (d.getElementById(id)) {return;}
		     js = d.createElement(s); js.id = id;
		     js.src = "//connect.facebook.net/en_US/sdk.js";
		     fjs.parentNode.insertBefore(js, fjs);
		   }(document, 'script', 'facebook-jssdk'));
		   
		   //more sdk functions permitted after the init call
		    function postbyoid(oid){
		    	FB.ui({
		    		method:'share_open_graph',
		    		action_type: 'myonlineinventory:add',
		    		action_properties: JSON.stringify({oid,}) },function(response){console.dir(response);});
		    	//console.dir(oid);
		    }
		    //call login and ask for publish permission
		    function myFacebookLogin() {
			  FB.login(function(){
			  	//create object
			  	FB.api(
				  'me/objects/myonlineinventory:vehicle',
				  'post',
				  {'object': {
				    'og:url': 'http://myonlineinventory.com',
				    'og:title': 'Vehicle Demo',
				    'og:type': 'myonlineinventory:vehicle',
				    'og:image': 'http://v3.myonlineinventory.com/assets/frontend/layout/img/logos/logo-corp-red.png',
				    'og:description': 'Just posted a demo vehicle to myonlineinventory!',
				    'fb:app_id': 'YOUR_APP_ID_HERE'
				  }}, function(vehid){console.dir(vehid);
				  
			  	//create story with action
				  FB.api(
				  'me/myonlineinventory:add',
				  'post',
				  {
				    'vehicle': vehid.id,
				  },function(response){console.dir(response); });
				  
				  FB.ui({
		    		method:'share_open_graph',
		    		action_type: 'myonlineinventory:add',
		    		action_properties: JSON.stringify({vehicle:vehid.id,}) },function(response){console.dir(response);});
		    	//console.dir(oid);
		    	
				  });
			  }, {scope: 'publish_actions'});
			}
		</script>
		<button onclick="myFacebookLogin()">Post on Facebook</button>
	</body>
</html>
