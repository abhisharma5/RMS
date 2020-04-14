<?php include("config.php");
if(!isset($_SESSION['id']) || $_SESSION['id']==''){
  header(URL_ROOT);
}?>
<!DOCTYPE html>
<html>
<head>
    
    
<meta charset="UTF-8">
<title>Modify Reminder</title>
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

<body><div class="modify-reminder">
        <h2>Modify Reminder</h2><br>
        <?php 
        $sql = "SELECT * FROM manage_reminder where user_id=".$_SESSION['id'];
        $result = $conn->query($sql);
        ?>      
       
        <form>
          <div id="message"></div>
            Reminders :
            <select name="reminder" id="reminder" class="form-control">
                <option selected hidden value="">Select Reminder</option>
                <?php if ($result->num_rows > 0) {            
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='".$row["id"]."'>".$row["name"]." - " .substr($row["description"],0,30)."</option>";
                        if(isset($_REQUEST['id'])){
                          if($_REQUEST['id'] == $row['id'])
                          echo "<option value='".$row["id"]."' selected>".$row["name"]." - " .substr($row["description"],0,30)."</option>";

                        }
                    }
                } else {
                    echo "<option value=''>No reminders</option>";
                }?>
              </select>
              <input type="name" id="id" class="form-control" name="id" value="<?php echo $_REQUEST['id'];?>" hidden>

              <input type="name" id="url" class="form-control" name="url" value="<?php echo URL_ROOT."modify_reminder.php?id=";?>" hidden>
              <?php if(isset($_REQUEST['id'])){ 
              $sql = "SELECT * FROM manage_reminder where id='".$_REQUEST['id']."'";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {            
                while($row = $result->fetch_assoc()) {
              ?>
               
            Select a date:
            <input type="text" name="date" format="mm-dd-yyyy" id = "datepicker-6" class="form-control" value="<?php if(isset($_REQUEST['id'])) echo $row['date'];?>"><br>
            Subject:
            <select name="subject" class="form-control">
                <option selected hidden value="">Select Subject</option>
                <option <?php if($row['subject']=='College work') echo 'selected'; ?>>College work</option>
                <option <?php if($row['subject']=='Personal') echo 'selected'; ?>>Personal</option>
                <option <?php if($row['subject']=='Study') echo 'selected'; ?>>Study</option>
                <option <?php if($row['subject']=='Play') echo 'selected'; ?>>Play</option>
                <option <?php if($row['subject']=='Movie') echo 'selected'; ?>>Movie</option>
                <option <?php if($row['subject']=='Coding') echo 'selected'; ?>>Coding</option>
              </select>
              Name :<input name="name"class="form-control" type="text" value="<?php if(isset($_REQUEST['id'])) echo $row['name'];?>" placeholder="Subject Description">

              Description:<input name="description"class="form-control" type="text" value="<?php if(isset($_REQUEST['id'])) echo $row['description'];?>" placeholder="Subject Description">
              Email:<input name="email_id" type="text" class="form-control" id="exampleInputEmail1" value="<?php if(isset($_REQUEST['id'])) echo $row['email_id'];?>" placeholder="Email">
              Contact No.:<input name="contact_no" type="text" class="form-control" id="contactno" value="<?php if(isset($_REQUEST['id'])) echo $row['contact_no'];?>" placeholder="Contact no." >
              SMS No.:<input name="sms_no" type="text" class="form-control" id="smsno" value="<?php if(isset($_REQUEST['id'])) echo $row['sms_no'];?>" placeholder="SMS NO."><br>
              Recur for next:
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary active">
                  <input type="radio" name="recur_time" id="option1" value="7 Days" <?php if($row['recur_time']=='7 Days') echo 'checked'; ?>>7 Days
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="recur_time" value="5 Days" id="option2" <?php if($row['recur_time']=='5 Days') echo 'checked'; ?>> 5 Days
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="recur_time" value="3 Days" id="option3" <?php if($row['recur_time']=='3 Days') echo 'checked'; ?>> 3 Days
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="recur_time" value="2 Days" id="option4" <?php if($row['recur_time']=='2 Days') echo 'checked'; ?>> 2 Days
                  </label>
              </div>
                        <br><br>
                        <button type="submit" class="btn btn-info">Confirm</button>
              </form>
              <?php }}}?>
              <br>
              <a href="<?php echo URL_ROOT."home.php";?>" class="btn btn-info">Back</a style="float:left">
                <button type="button" id="logout" class="btn btn-warning">Logout</button>
        </div>
  
    
</body>
<script>
$("#reminder").change(function(){
  window.location.replace($('#url').val()+$(this).val()); 
});
$("form").submit(function(event){
	$.ajax({
		url : 'ajax.php',
		type: 'POST',
		data : $(this).serialize()+"&action=modify_reminder",
    dataType: 'json',
    encode : true,
	}).done(function(data){ 
    if(data.status == 1){
      $('#message').html(data.success);
      $("form").trigger("reset");
      location.reload();
    } 
    else{
    $('#message').html(data.error);
    $("form").trigger("reset");    
    } 
	});
  event.preventDefault(); 
  });
  
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