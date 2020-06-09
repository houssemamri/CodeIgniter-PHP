<!DOCTYPE html>
<html>
    <head>
      <title>Test</title>
      <meta name="google-signin-client_id" content="477160079094-8c63vdhok6cok7asoh9d2fsr020pvvs4.apps.googleusercontent.com">
    </head>
    <body>
      <script>
      var GoogleAuth;
      var SCOPE = 'https://www.googleapis.com/auth/plus.business.manage';
      function handleClientLoad() {
        // Load the API's client and auth2 modules.
        // Call the initClient function after the modules load.
        gapi.load('client:auth2', initClient);
      }
      function initClient() {
        // Retrieve the discovery document for version 3 of Google Drive API.
        // In practice, your app can retrieve one or more discovery documents.

        // Initialize the gapi.client object, which app uses to make API requests.
        // Get API key and client ID from API Console.
        // 'scope' field specifies space-delimited list of access scopes.
        gapi.client.init({
            'clientId': '477160079094-8c63vdhok6cok7asoh9d2fsr020pvvs4.apps.googleusercontent.com',
            'scope': SCOPE
        }).then(function () {
          GoogleAuth = gapi.auth2.getAuthInstance();

          // Listen for sign-in state changes.
          GoogleAuth.isSignedIn.listen(updateSigninStatus);

          // Handle initial sign-in state. (Determine if user is already signed in.)
          var user = GoogleAuth.currentUser.get();
          setSigninStatus();

          // Call handleAuthClick function when user clicks on
          //      "Sign In/Authorize" button.
          $('#sign-in-or-out-button').click(function() {
            handleAuthClick();
          });
          $('#revoke-access-button').click(function() {
            revokeAccess();
          });
        });
        var request = gapi.client.request({
          'method': 'GET',
          'path': '/v3/accounts'
        });
        // Execute the API request.
        request.execute(function(response) {
          console.log(response);
        });
      }

      function handleAuthClick() {
        if (GoogleAuth.isSignedIn.get()) {
          // User is authorized and has clicked 'Sign out' button.
          GoogleAuth.signOut();
        } else {
          // User is not signed in. Start Google auth flow.
          GoogleAuth.signIn();
        }
      }

      function revokeAccess() {
        GoogleAuth.disconnect();
      }

      function setSigninStatus(isSignedIn) {
        var user = GoogleAuth.currentUser.get();
        var isAuthorized = user.hasGrantedScopes(SCOPE);
        if (isAuthorized) {
          $('#sign-in-or-out-button').html('Sign out');
          $('#revoke-access-button').css('display', 'inline-block');
          $('#auth-status').html('You are currently signed in and have granted ' +
              'access to this app.');
        } else {
          $('#sign-in-or-out-button').html('Sign In/Authorize');
          $('#revoke-access-button').css('display', 'none');
          $('#auth-status').html('You have not authorized this app or you are ' +
              'signed out.');
        }
      }

      function updateSigninStatus(isSignedIn) {
        setSigninStatus();
      }
    </script>

    <button id="sign-in-or-out-button"
            style="margin-left: 25px">Sign In/Authorize</button>
    <button id="revoke-access-button"
            style="display: none; margin-left: 25px">Revoke access</button>

    <div id="auth-status" style="display: inline; padding-left: 25px"></div><hr>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script async defer src="https://apis.google.com/js/api.js"
            onload="this.onload=function(){};handleClientLoad()"
            onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>
    <script>
    jQuery.ajax({
    type: "GET",
    url: "https://mybusiness.googleapis.com/v3/accounts/?key=AIzaSyAA2vV4HtLdBkhXpolcD54NRV-FTGzrxqk",
    success: function(data){
      console.log(data);
    }
   });
    </script>

    </body>
</html>
