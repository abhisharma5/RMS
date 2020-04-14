<?php include("config.php");
if(!isset($_SESSION['id']) || $_SESSION['id']==''){
  header("Location: ".URL_ROOT);
}?>
<!DOCTYPE html>
<html>
<head>
    
    
<meta charset="UTF-8">
<title>Disable Reminder</title>
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

<body><div class="disable-reminder">
        <h2>Enable  Reminder</h2><br>          
       
        <form>
          <div id="message"></div>
          Select a date:
            <input type="text" name="date" id="datepicker-6" format="mm-dd-yyyy" class="form-control" value="<?php if(isset($_REQUEST['date'])) echo $_REQUEST['date'];?>">
            <input type="name" id="url" class="form-control" name="url" value="<?php echo URL_ROOT."enable_reminder.php?date=";?>" hidden>

            <?php if(isset($_REQUEST['date'])){?>
              <?php 
                $sql = "SELECT * FROM manage_reminder where status=2 AND user_id=".$_SESSION['id'];
                $result = $conn->query($sql);
                ?> 
            Reminders :
            <select name="reminder" id="reminder" class="form-control">
                <option selected hidden value="">Select Reminder</option>
                <?php if ($result->num_rows > 0) {            
                    while($row = $result->fetch_assoc()) {
                        if(isset($_REQUEST['date'])){
                          if($_REQUEST['date'] == $row['date'])
                          echo "<option value='".$row["id"]."' selected>".$row["name"]." - " .substr($row["description"],0,30)."</option>";

                        }
                    }
                } else {
                    echo "<option value=''>No reminders</option>";
                }?>
              </select>
                                     <br>
              <button type="submit" class="btn btn-info">Confirm</button>
              </form>
              <?php }?>
              <br>
              <a href="<?php echo URL_ROOT."home.php";?>" class="btn btn-info">Back</a style="float:left">
                <button type="button" id="logout" class="btn btn-warning">Logout</button>
        </div>
  
    
</body>
<script>
  $("#datepicker-6").change(function(){
  window.location.replace($('#url').val()+$(this).val()); 
});

$("form").submit(function(event){
	$.ajax({
		url : 'ajax.php',
		type: 'POST',
		data : $(this).serialize()+"&id="+$('#reminder').val()+"&action=enable_reminder",
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