<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<?php include("header.php"); ?>

<div class="container">
<h1>
    Visitor's Signup form
</h1>
<form >
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Sign in</button>
  <div >
	<video autoplay="true" id="videoElement">
	
	</video>
</div>
</form>
</div>

 
<style>
#container {
	margin: 0px auto;
	width: 500px;
	height: 375px;
	border: 10px #333 solid;
}
#videoElement {
	width: 500px;
	height: 375px;
	background-color: #666;
}
</style>

 


<script>
var video = document.querySelector("#videoElement");

if (navigator.mediaDevices.getUserMedia) {
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(function (stream) {
      video.srcObject = stream;
    })
    .catch(function (err0r) {
      console.log("Something went wrong!");
    });
}
if (navigator.mediaDevices.getUserMedia) {
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(function (stream) {
      video.srcObject = stream;
    })
    .catch(function (err0r) {
      console.log("Something went wrong!");
    });
}
</script>

<?php // function to escape data and strip tags
function safestrip($string){
       $string = strip_tags($string);
       $string = mysql_real_escape_string($string);
       return $string;
}

//function to show any messages
function messages() {
   $message = '';
   if($_SESSION['success'] != '') {
       $message = '<span class="success" id="message">'.$_SESSION['success'].'</span>';
       $_SESSION['success'] = '';
   }
   if($_SESSION['error'] != '') {
       $message = '<span class="error" id="message">'.$_SESSION['error'].'</span>';
       $_SESSION['error'] = '';
   }
   return $message;
}

// log user in function
function login($username, $password){

 //call safestrip function
 $user = safestrip($username);
 $pass = safestrip($password);

 //convert password to md5
 $pass = md5($pass);

  // check if the user id and password combination exist in database
  $sql = mysql_query("SELECT * FROM table WHERE username = '$user' AND password = '$pass'")or die(mysql_error());

  //if match is equal to 1 there is a match
  if (mysql_num_rows($sql) == 1) {

                          //set session
                          $_SESSION['authorized'] = true;

                          // reload the page
                         $_SESSION['success'] = 'Login Successful';
                         header('Location: ./index.php');
                         exit;


   } else {
               // login failed save error to a session
               $_SESSION['error'] = 'Sorry, wrong username or password';
  }
}
?>
