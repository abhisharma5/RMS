<?php 
include("config.php");
if(!isset($_SESSION['id']) || $_SESSION['id']==''){
    header("Location: ".URL_ROOT);
}
?>
<!DOCTYPE html>
<html>
<head>
    
    
<meta charset="UTF-8">
<title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="mystyle2.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
<img src="images\image003.png" class="logo">
<div><div class="title">
    <h1>Welcome <?php echo $_SESSION['name'];?> To The Reminder Application</h1></div><br>
    <div class="options">
    <a href="<?php echo URL_ROOT."set_reminder.php";?>" class="btn btn-primary">Set Reminder</a><br><br>
    <a href="<?php echo URL_ROOT."modify_reminder.php";?>" class="btn btn-primary">Modify Reminder</a><br><br>
    <a href="<?php echo URL_ROOT."disable_reminder.php";?>" class="btn btn-primary">Disable Reminder</a><br><br>
    <a href="<?php echo URL_ROOT."delete_reminder.php";?>" class="btn btn-primary">Delete Reminder</a><br><br>
    <a href="<?php echo URL_ROOT."enable_reminder.php";?>" class="btn btn-primary">Enable Reminder</a><br><br>
    <a href="<?php echo URL_ROOT."view_reminder.php";?>" class="btn btn-primary">View your Reminders</a><br><br>
    <a href="<?php echo URL_ROOT;?>" id="logout" class="btn btn-warning">Logout</a><br><br>

</div>

    </div>
</body>
<script>
$("#logout").on("click", function(){
    $.ajax({
		url : 'ajax.php',
		type: 'POST',
		data : "&action=logout",
    dataType: 'json',
    encode : true,
	}).done(function(data){ 
    if(data.status == 1){      
      location.reload();

    } 
	});
});
</script>
</html>