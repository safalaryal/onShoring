<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<?php include("header.php"); ?>

<div class="container">
  <h1>
    Visitor's Signup form
  </h1>
  <form action="insert.php" method="POST">

    <div class="col-md-4 form-group" style="display:inline-block">
      <input type="text" class="form-control" name="visitorName" id="Visitor_name" placeholder="Name" required>
    </div>
    <div class=" col-md-4 form-group" style="display:inline-block ">
      <input type="text" class="form-control" name="visitorSurname" id="Visitor_Surname" placeholder="Surname" required>
    </div>
    <div class=" col-md-4 form-group " style="display:inline-block">
      <input type="email" class="form-control" name="visitorEmail" id="Visitor_Email" placeholder="Email" required>
    </div>
    <div class=" col-md-4 form-group" style="display:inline-block">
      <input type="text" class="form-control" name="visitorPhone" id="Visitor_Phone" placeholder="Phone" required>
    </div>

    <div class=" col-md-4 form-group" style="display:inline-block">
      <input type="phone" class="form-control" name="visitorCompany" id="Visitor_Company" placeholder="Company's Name(optional)">
    </div>
    <div class=" col-md-4 form-group " style="display:inline-block">
      <select class="dropdown btn-lg btn-secondary dropdown-toggle" name="visitorGender" required>
        <option selected hidden value="">Gender</option>
        <option value="m">Male</option>
        <option value="f">Female</option>

      </select>
    </div>
    <div class=" col-md-4 form-group " style="display:inline-block">
      <select name="visitorVisiting" style="text-align:center text-align-last:center  " class="dropdown btn-lg btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
        <option selected hidden value="">Visiting?</option>
        <option value="John">John Benjamin</option>
        <option value="Alberta">Alberta wick</option>
        <option value="Harry">Harry Styles</option>
        <option value="Lewis">Lewis Miller</option>
        <option value="Cong">Cong lee</option>

      </select>
    </div>
    <div class=" col-md-4 form-group" style="display:inline-block">
      <input type="text" class="form-control" name="visitorType" id="Visitor_Type" placeholder="Visitor Type">
    </div>
    <div class=" col-md-4 form-group" style="display:inline-block">
      <input type="file" class="form-control" name="visitorImage" id="visitor_Image" placeholder="Choose image">
    </div>

    <button class="btn btn-primary" type="submit" value="Submit">Submit</button>
  </form>
</div>









<?php // function to escape data and strip tags
function safestrip($string)
{
  $string = strip_tags($string);
  $string = mysql_real_escape_string($string);
  return $string;
}

//function to show any messages
function messages()
{
  $message = '';
  if ($_SESSION['success'] != '') {
    $message = '<span class="success" id="message">' . $_SESSION['success'] . '</span>';
    $_SESSION['success'] = '';
  }
  if ($_SESSION['error'] != '') {
    $message = '<span class="error" id="message">' . $_SESSION['error'] . '</span>';
    $_SESSION['error'] = '';
  }
  return $message;
}

// log user in function
function login($username, $password)
{

  //call safestrip function
  $user = safestrip($username);
  $pass = safestrip($password);

  //convert password to md5
  $pass = md5($pass);

  // check if the user id and password combination exist in database
  $sql = mysql_query("SELECT * FROM table WHERE username = '$user' AND password = '$pass'") or die(mysql_error());

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