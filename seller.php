<?php
//seller.php

$error = '';
$name = '';
$email = '';
$phone = '';
$title = '';
$author = '';
$isbn = '';
$paypal = '';
$desc = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["email"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   $error .= '<p><label class="text-danger">Invalid email format</label></p>';
  }
 }
 if(empty($_POST["phone"]))
 {
  $error .= '<p><label class="text-danger">Phone Number is required</label></p>';
 }
 else
 {
  $phone = clean_text($_POST["phone"]);
 }
 if(empty($_POST["title"]))
 {
  $error .= '<p><label class="text-danger">Title is required</label></p>';
 }
 else
 {
  $title = clean_text($_POST["title"]);
 }
 if(empty($_POST["author"]))
 {
  $error .= '<p><label class="text-danger">Author is required</label></p>';
 }
 else
 {
  $author = clean_text($_POST["author"]);
 }
 if(empty($_POST["isbn"]))
 {
  $error .= '<p><label class="text-danger">ISBN Number is required</label></p>';
 }
 else
 {
  $isbn = clean_text($_POST["isbn"]);
 }
 if(empty($_POST["paypal"]))
 {
  $error .= '<p><label class="text-danger">Paypal Link is required</label></p>';
 }
 else
 {
  $paypal = clean_text($_POST["paypal"]);
 }
 if(empty($_POST["desc"]))
 {
  $error .= '<p><label class="text-danger">Description is required</label></p>';
 }
 else
 {
  $desc = clean_text($_POST["desc"]);
 }

 if($error == '')
 {
  $file_open = fopen("data.csv", "a");
  $no_rows = count(file("data.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'sr_no'  => $no_rows,
   'name'  => $name,
   'email'  => $email,
   'phone' => $phone, 
   'title' => $title,
   'author' => $author,
   'isbn' => $isbn,
   'paypal' => $paypal,
   'desc' => $desc
  );
  fputcsv($file_open, $form_data);
  $error = '<label class="text-success">Thank you for selling with us</label>';
  $name = '';
  $email = '';
  $phone = '';
  $title = '';
  $author = '';
  $isbn = '';
  $paypal = '';
  $desc = '';
 }
}

?>
<!DOCTYPE html>
<html>
 <head>
  <title>How to Store Form data in CSV File using PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h2 align="center">Name of site (?)</h2>
   <br />
   <div class="col-md-6" style="margin:0 auto; float:none;">
    <form method="post">
     <h3 align="center">Seller Form</h3>
     <br />
     <?php echo $error; ?>
     <div class="form-group">
      <label>Enter Name</label>
      <input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo $name; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Email</label>
      <input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $email; ?>" />
     </div>
    <div class="form-group">
      <label>Enter Phone Number</label>
      <input type="text" name="subject" class="form-control" placeholder="Enter Phone Number" value="<?php echo $phone; ?>" />
     </div>
    <div class="form-group">
      <label>Enter Book Title</label>
      <input type="text" name="subject" class="form-control" placeholder="Enter Book Title" value="<?php echo $title; ?>" />
     </div>
    <div class="form-group">
      <label>Enter Author Name</label>
      <input type="text" name="subject" class="form-control" placeholder="Enter Author Name" value="<?php echo $author; ?>" />
     </div>
    <div class="form-group">
      <label>Enter ISBN Number</label>
      <input type="text" name="subject" class="form-control" placeholder="Enter ISBN Number" value="<?php echo $isbn; ?>" />
     </div>
    <div class="form-group">
      <label>Enter Paypal Money Request Link</label>
      <input type="text" name="subject" class="form-control" placeholder="Enter Paypal Money Request Link" value="<?php echo $paypal; ?>" />
     </div>        
     <div class="form-group">
      <label>Enter Description of Use</label>
      <textarea name="message" class="form-control" placeholder="Enter Description of Use"><?php echo $desc; ?></textarea>
     </div>
     <div class="form-group" align="center">
      <input type="submit" name="submit" class="btn btn-info" value="Submit" />
     </div>
    </form>
   </div>
  </div>
 </body>
</html>
