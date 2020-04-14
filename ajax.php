<?php 
include_once('config.php');
$data = array();

if($_POST['action'] == 'register'){
    $var = array(
        "username" => trim($_POST['username']),
        "password" => trim($_POST['password']),
    );
$flg = getVal("select username from manage_user where username='".$_POST['username']."'");
if($flg ==''){
    if($_POST['password'] == $_POST['cpassword']){
        if(insert("manage_user",$var)){
            $_SESSION['id'] = getVal("select id from manage_user where username='".$_POST['username']."'");
            $_SESSION['name'] = $_POST['username'];
            $data['url']=URL_ROOT."home.php";
            $data['status'] = 1;
            $data['success'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span></button>Registered Successfully !</span>";
        }
        else{
            $data['status'] =2;
            $data['error'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span></button>Something went wrong !</span>";
        }
    }    
    else{
        $data['status'] =2;
        $data['error'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span></button>Password do not match !</span>";
    }
}
else{
    $data['status'] =2;
    $data['error'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button>Username already exit !</span>";
 }
 echo json_encode($data);
}
if($_POST['action'] == 'logout'){ 
session_unset();
$data['status'] = 1;
echo json_encode($data);
}
if($_POST['action'] == 'get_reminders'){
    $sql = "SELECT * FROM manage_reminder";
        $result = $conn->query($sql);
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()) {
                if(date("m/d/Y",strtotime($_POST['date_from']))<date("m/d/Y",strtotime($row['date'])) && date("m/d/Y",strtotime($_POST['date_to']))>date("m/d/Y",strtotime($row['date']))){
                  ?>
                <tr>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['subject'];?></td>
                    <td><?php echo $row['description'];?></td>
                    <td><?php echo $row['email_id'];?></td>
                    <td><?php echo $row['contact_no'];?></td>
                    <td><?php echo $row['sms_no'];?></td>
                    <td><?php echo $row['recur_time'];?></td>
                    <td><?php if($row['status']==1) echo "Enabled"; else echo "disabled";?></td>
                    <td><input type="radio" name="radio_id" value="<?php echo $row['id'];?>"> </td>
                </tr>
                <?php }

            }
        }
}
if($_POST['action'] == 'delete_reminder'){    
    $cond = "WHERE id='".$_POST['id']."'";
if(delete("manage_reminder",$cond)){
    $data['status'] = 1;
    $data['success'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button>Reminder deleted Successfully !</span>";
    
}
else{
    $data['status'] =2;
    $data['error'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button>Something went wrong !</span>";
 }
 echo json_encode($data);
}
if($_POST['action'] == 'enable_reminder'){
    $var = array(        
        "status" => 1,
    );
    $cond = "WHERE id='".$_POST['id']."'";
if(update("manage_reminder",$var,$cond)){
    $data['status'] = 1;
    $data['success'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button>Reminder disabled Successfully !</span>";
    
}
else{
    $data['status'] =2;
    $data['error'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button>Something went wrong !</span>";
 }
 echo json_encode($data);
}
if($_POST['action'] == 'disable_reminder'){
    $var = array(        
        "status" => 2,
    );
    $cond = "WHERE id='".$_POST['id']."'";
if(update("manage_reminder",$var,$cond)){
    $data['status'] = 1;
    $data['success'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button>Reminder disabled Successfully !</span>";
    
}
else{
    $data['status'] =2;
    $data['error'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button>Something went wrong !</span>";
 }
 echo json_encode($data);
}
if($_POST['action'] == 'modify_reminder'){
    $var = array(
        "date" => trim($_POST['date']),
        "name" => trim($_POST['name']),
        "subject" => trim($_POST['subject']),
        "description" => trim($_POST['description']),
        "email_id" => trim($_POST['email_id']),
        "contact_no" => trim($_POST['contact_no']),
        "sms_no" => trim($_POST['sms_no']),
        "recur_time" => trim($_POST['recur_time']),
        "status" => 1,
    );
    $cond = "WHERE id='".$_POST['id']."'";
if(update("manage_reminder",$var,$cond)){
    $data['status'] = 1;
    $data['success'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button>Reminder updated Successfully !</span>";
    
}
else{
    $data['status'] =2;
    $data['error'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button>Something went wrong !</span>";
 }
 echo json_encode($data);
}
if($_POST['action'] == 'set_reminder'){
    $var = array(
        "date" => trim($_POST['date']),
        "user_id" => trim($_SESSION['id']),
        "name" => trim($_POST['name']),
        "subject" => trim($_POST['subject']),
        "description" => trim($_POST['description']),
        "email_id" => trim($_POST['email_id']),
        "contact_no" => trim($_POST['contact_no']),
        "sms_no" => trim($_POST['sms_no']),
        "recur_time" => trim($_POST['recur_time']),
        "status" => 1,
    );
if(insert("manage_reminder",$var)){
    $data['status'] = 1;
    $data['success'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button>Reminder added Successfully !</span>";
    
}
else{
    $data['status'] =2;
    $data['error'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button>Something went wrong !</span>";
 }
 echo json_encode($data);
}
if($_POST['action']=='login'){
    if($_POST['password'] == getVal("select password from manage_user where username='".$_POST['username']."'")){
        $_SESSION['id'] = getVal("select id from manage_user where username='".$_POST['username']."'");
        $_SESSION['name'] = $_POST['username'];
        $data['status'] = 1;
        $data['success'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span></button>Login Successfully !</span>";
        $data['url']=URL_ROOT."home.php";
    }
    else{
        $data['status'] =2;
        $data['error'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span></button>Incorrect Email or Password !</span>";
     }

echo json_encode($data);
}
?>