<?php 
include("config.php");
if(!isset($_SESSION['id']) || $_SESSION['id']==''){
  redirect(URL_ROOT);
}
?>
<!DOCTYPE html>
<html>
<head>
    
    
<meta charset="UTF-8">
<title>Set Reminder</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="mystyle2.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      <script>
        $(function() {
           $( "#datepicker-6" ).datepicker({
              showOn:"button",
              buttonImage: "images/calender.png",
              buttonImageOnly: true
           });
        });
     </script>



</head>

<body><div class="set-reminder">
        <h2>Set a new Reminder</h2><br>
          <form>
          <div id="message"></div>
            Select a date:
            <input type = "text" name="date" id = "datepicker-6"><br>
            Subject:              
              <select name="subject" class="form-control">
                <option selected hidden value="">Select Subject</option>
                <option>College work</option>
                <option>Personal</option>
                <option>Study</option>
                <option>Play</option>
                <option>Movie</option>
                <option>Coding</option>
              </select>
              Name :<input name="name"class="form-control" type="text" placeholder="Name">
              Description:<input name="description"class="form-control" type="text" placeholder="Subject Description">
              Email:<input name="email_id" type="text" class="form-control" id="exampleInputEmail1" placeholder="Email">
              Contact No.:<input name="contact_no" type="text" class="form-control" id="contactno" placeholder="Contact no." >
              SMS No.:<input name="sms_no" type="text" class="form-control" id="smsno" placeholder="SMS NO."><br>
              Recur for next:
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary active">
                  <input type="radio" name="recur_time" id="option1" value="7 Days" checked>7 Days
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="recur_time" value="5 Days" id="option2"> 5 Days
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="recur_time" value="3 Days" id="option3"> 3 Days
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="recur_time" value="2 Days" id="option4"> 2 Days
                  </label>
              </div>
                        <br><br>
                        <button type="submit" class="btn btn-info">Confirm</button>
              </form><br>
              <a href="<?php echo URL_ROOT."home.php";?>" class="btn btn-info">Back</a style="float:left">
                <button type="button" class="btn btn-warning">Logout</button>
        </div>
  
    
</body>
<script>
$("form").submit(function(event){
	$.ajax({
		url : 'ajax.php',
		type: 'POST',
		data : $(this).serialize()+"&action=set_reminder",
    dataType: 'json',
    encode : true,
	}).done(function(data){ 
    if(data.status == 1){
      $('#message').html(data.success);
      $("form").trigger("reset");
    } 
    else{
    $('#message').html(data.error);
    $("form").trigger("reset");    
    } 
	});
  event.preventDefault(); 
  });
</script>
</html>