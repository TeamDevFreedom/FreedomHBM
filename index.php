<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Accueil</title>
  <!--<link rel="stylesheet" href="style.css">-->
  <script src="./scripts/jquery.js"></script>
  <script>
	var userClickHandler = function(id){
		window.location.href = './login.php?id='+id;
	};
	var documentReadyHandler = function(){
		$('#user1').click(function(){userClickHandler('user1');});
		$('#user2').click(function(){userClickHandler('user2');});
		$('#user3').click(function(){userClickHandler('user3');});
		$('#user4').click(function(){userClickHandler('user4');});
	};
	$( document ).ready(documentReadyHandler);
  </script>
  
</head>
<body>
  <ul>
	<li id="user1">User 1</li>
	<li id="user2">User 2</li>
	<li id="user3">User 3</li>
	<li id="user4">User 4</li>
  </ul>
</body>
</html>