<!DOCTYPE html>
<html>
<head>
<?php
include("config.php");
if(isset($_SESSION['id'])){
  header("Location: ".URL_ROOT."home.php");
}
?>
    
<meta charset="UTF-8">
<title>Registration Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="mystyle2.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-fluid bg">
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12"></div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="col-md-4 col-sm-4 col-xs-12"></div>
                <form class="form-container">
                  <h2> Reminder Registration Form</h2>
                  <div id="message"></div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" name="username"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
                      <small id="emailHelp" class="form-text text-muted">We'll never share your Username with anyone else.</small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" name="cpassword" class="form-control" id="exampleInputPassword1" placeholder="Password">
                      </div>
                    <div class="form-group form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-info btn-warning">Submit</button>
                    <a href="<?php echo URL_ROOT;?>" type="button" class="btn btn-info btn-primary">Log in</a>

                  </form>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12"></div>
        </div>
    </div>
        
   
   
    
</body>
<script>

$("form").submit(function(event){
	$.ajax({
		url : 'ajax.php',
		type: 'POST',
		data : $(this).serialize()+"&action=register",
    dataType: 'json',
    encode : true,
	}).done(function(data){ 
    if(data.status == 1){
      $('#message').html(data.success);
      window.location.replace(data.url);  
    } 
    else{
    $('#message').html(data.error);
    } 
	});
  event.preventDefault(); 
  });
</script>
</html>