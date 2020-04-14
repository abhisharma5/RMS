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
<title>View Reminders</title>
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
     <script>
        $(function() {
           $( "#datepicker-7" ).datepicker({
              showOn:"button",
              buttonImage: "images/calender.png",
              buttonImageOnly: true
           });
        });
     </script>

</head>

<body><div class="view-reminder">
        <h2>View your Reminders</h2><br>

            From date:
            <input type="text" name="date_from" id="datepicker-6" format="mm-dd-yyyy" class="form-control"><br>
            To date:
            <input type="text" name="date_to" id="datepicker-7" format="mm-dd-yyyy" class="form-control"><br>
            
            <button type="button" id="get_bt" class="btn btn-info">Get Reminders</button style="float:right">
            <br>
              <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Reminder Name</th>
                              <th scope="col">Reminder Subject</th>
                              <th scope="col">Reminder Description</th>
                              <th scope="col">Email Address</th>
                              <th scope="col">Contact No.</th>
                              <th scope="col">SMS No.</th>
                              <th scope="col">Recurrence Frequency</th>
                              <th scope="col">Status</th>
                              <th scope="col">Check box</th>
                            </tr>
                          </thead>
                          <tbody id="tbody">                           
                          </tbody>
                        </table>
              
                        <br><br><br>
              <a href="<?php echo URL_ROOT;?>" type="button" type="button" class="btn btn-info">Back</a style="float:left">
              <button type="button" id="delete_bt" class="btn btn-info">Delete Reminder</button style="float:right">
              <button type="button" id="enable_bt" class="btn btn-info">Enable Reminder</button style="float:right">
                <button type="button" id="disable_bt" class="btn btn-info">Disable Reminder</button style="float:right">
                  <button type="button" id="modify_bt" class="btn btn-info">Modify Reminder</button style="float:right"><br><br>
                <button type="button" id="logout" class="btn btn-warning">Logout</button>
                <input type="text" hidden id="url" value="<?php echo URL_ROOT.'modify_reminder.php?id=';?>">
        </div>
  
    
</body>
<script>  
 $("#get_bt").on("click",function(){
  $.ajax({
		url : 'ajax.php',
		type: 'POST',
		data :"&date_to="+$('#datepicker-7').val()+"&date_from="+$('#datepicker-6').val()+"&action=get_reminders",
  	encode: false
    }).done(function(data){ 
      $("#tbody").html(data);
    });
 });
 
$("#disable_bt").on("click", function(){
	$.ajax({
		url : 'ajax.php',
		type: 'POST',
		data :"&id="+$('input[name=radio_id]:checked').val()+"&action=disable_reminder",
    dataType: 'json',
    encode : true,
	}).done(function(data){ 
    if(data.status == 1){
      alert("Reminder Diasbled");
        location.reload();

    } 
    else{
      alert("Something went wrong !");
    } 
	});
  });
  
$("#enable_bt").on("click", function(){
	$.ajax({
		url : 'ajax.php',
		type: 'POST',
		data :"&id="+$('input[name=radio_id]:checked').val()+"&action=enable_reminder",
    dataType: 'json',
    encode : true,
	}).done(function(data){ 
    if(data.status == 1){
      alert("Reminder Enabled");
        location.reload();

    } 
    else{
      alert("Something went wrong !");
    } 
	});
  });
  
$("#delete_bt").on("click", function(){
	$.ajax({
		url : 'ajax.php',
		type: 'POST',
		data :"&id="+$('input[name=radio_id]:checked').val()+"&action=delete_reminder",
    dataType: 'json',
    encode : true,
	}).done(function(data){ 
    if(data.status == 1){
      alert("Reminder Deleted");
        location.reload();

    } 
    else{
      alert("Something went wrong !");
    } 
	});
  });
  $("#modify_bt").on("click", function(){
    window.location.replace($("#url").val()+$('input[name=radio_id]:checked').val());
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