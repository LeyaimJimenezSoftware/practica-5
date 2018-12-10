<html>
<head>

  <title>Notificaciones Push</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://www.gstatic.com/firebasejs/5.7.0/firebase.js"></script>

  <script>

    // Initialize Firebase
    var config = {
    apiKey: "AIzaSyBe3DVjghoG5f5ZpYmGRimu27HnO-X6aH0",
    authDomain: "clase-mantenimiento-203ee.firebaseapp.com",
    databaseURL: "https://clase-mantenimiento-203ee.firebaseio.com",
    projectId: "clase-mantenimiento-203ee",
    storageBucket: "clase-mantenimiento-203ee.appspot.com",
    messagingSenderId: "200681878545"
    };
    firebase.initializeApp(config);

    // Retrieve Firebase Messaging object.
    const messaging = firebase.messaging();

    messaging.requestPermission().then(function() {
      console.log('Notification permission granted.');
      // TODO(developer): Retrieve an Instance ID token for use with FCM.
      // ...

      if (isTokenSentToServer()) {
        console.log('token ya fue enviado');
      }else{
        getRegToken();
      }

    }).catch(function(err) {
      console.log('Unable to get permission to notify.', err);
    });

    function getRegToken() {
      messaging.getToken().then(function(currentToken) {
        if (currentToken) {
          saveToken(currentToken);
          console.log(currentToken);
          setTokenSentToServer(true);
        } else {
          console.log('No Instance ID token available. Request permission to generate one.');
          setTokenSentToServer(false);
        }
      }).catch(function(err) {
        console.log('An error occurred while retrieving token. ', err);
        showToken('Error retrieving Instance ID token. ', err);
        setTokenSentToServer(false);
      });
    }

    function saveToken(currentToken) {
      $.ajax({
      url:'action.php',
      method:'post',
      data: 'token=' + currentToken
      }).done(function(result){
      console.log();
      })
    }

    function isTokenSentToServer() {
      return window.localStorage.getItem('sentToServer') == 1;
    }

    function setTokenSentToServer(sent) {
      window.localStorage.setItem('sentToServer', sent ? 1 : 0);
    }

    messaging.onMessage(function(payload){
      var title = payload.data.title;
      var options = {
      body: payload.data.body,
      icon: payload.data.icon
      }
      var myNotification = new Notification(title, options);
      console.log('Mensaje recibidio', payload)
    })

  </script>

  <link rel="manifest" href="manifest.json">
</head>
<body>
  <h1>App con notificaciones push</h1>
  
</body>
</html>