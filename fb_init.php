	<div id="fb-root"></div>
	<script>
        window.fbAsyncInit = function() {
          FB.init({
            appId      : '309935889102713', // App ID
            channelUrl : '//fblogin.local/channel.html', // Channel File
            status     : true, // check login status
            cookie     : true, // enable cookies to allow the server to access the session
            xfbml      : true,  // parse XFBML
          });
          //handling goes btw here and the end of the function
          // listen for and handle auth.statusChange events
	        FB.Event.subscribe('auth.statusChange', function(response) {
	          if (response.authResponse) {
	            // user has auth'd your app and is logged into Facebook
	            FB.api('/me', function(me){
	              if (me.name) {
	                document.getElementById('auth-displayname').innerHTML = (me.name +' / '+ me.email);
	              }
	            })
	            document.getElementById('auth-loggedout').style.display = 'none';
	            document.getElementById('auth-loggedin').style.display = 'inline';
	            document.getElementById('phpAuthenticate').style.display = 'none';
	            document.getElementById('or').style.display = 'none';
	            $('iframe').hide();
	          } else {
	            // user has not auth'd your app, or is not logged into Facebook
	            document.getElementById('auth-loggedout').style.display = 'inline';
	            document.getElementById('auth-loggedin').style.display = 'none';
	            document.getElementById('phpAuthenticate').style.display = 'inline';
	            document.getElementById('or').style.display = 'inline';
	          }
	        });
	        document.getElementById('auth-logoutlink').addEventListener('click', function(){
	          FB.logout();
	        }); 
        };
        // Load the SDK Asynchronously
        (function(d){
           var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           ref.parentNode.insertBefore(js, ref);
         }(document));
	</script>