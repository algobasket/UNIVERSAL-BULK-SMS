<?php
 session_start(); 
  if($_SESSION['id']){
   
     require 'function.php';
     $provider = $_GET['provider'];
     if(isset($_POST['send'])) 
     {
        if($provider == "onehop.co"){
          echo  sendSmsOneHop_TEST($_POST['source'],$_POST['txt'],$_POST['sId'],$_POST['label'],$_POST['mno']);
        }elseif($provider=="textgoto.com"){
          echo  sendSmsTextGoTo($_POST['username'],$_POST['password'],$_POST['to'],$_POST['text']);
        }elseif($provider=="intellisms.co.uk"){
          echo  sendSmsIntellisms($_POST['username'],$_POST['password'],$_POST['to'],$_POST['text'],$_POST['senderId']);
        }elseif($provider=="nexmo.com"){ 
          echo  sendSmsNextMo($_POST['apiKey'],$_POST['apiSecret'],$_POST['to'],$_POST['from'],$_POST['text']);
        }
     }
  }else{
         if($_POST['login'] && ($_POST['usernameA'] == "algobasket") && ($_POST['usernameA'] == "algobasket"))
         {
              $_SESSION['id'] = 1;
              header('location:index.php');exit();
         }
      
   $html = '<center><fieldset><legend>Login To Universal Bulk SMS</legend><form method="POST"><table class="table">
             <tr> 
               <td>Username : <input type="text" name="usernameA" class="form-control"/></td>
               <td>Password : <input type="text" name="password" class="form-control"/></td>
               <td><input type="submit" name="login" value="Login" class="form-control"/></td>
             </tr>
           </table></form></fieldset>Build by Algobasket.com</center>';
   die($html); 
   } 
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Universal Bulk SMS Sender</title>
  </head>
  <body>
  <center>
  <br>
<h4>Universal Bulk SMS Sender</h4>
<form method="POST">
<table class="table">
  <tr>
     <td>SMS SERVICE PROVIDER</td>
     <td>
       <select name="smsProvider" class="form-control" onchange='smsProviderChange(this.value)' >
          <option disabled selected value>SELECT PROVIDER</option>
          <option value="intellisms.co.uk" <?php echo ($_GET['provider'] =="intellisms.co.uk") ? "selected" : "" ;?>>INTELLISMS.CO.UK</option>
          <option value="textgoto.com" <?php echo ($_GET['provider'] =="textgoto.com") ? "selected" : "" ;?>>TEXTGOTO.COM</option>
          <option value="onehop.co" <?php echo ($_GET['provider'] =="onehop.co") ? "selected" : "" ;?>>ONEHOP.CO</option>
          <option value="nexmo.com" <?php echo ($_GET['provider'] =="nexmo.com") ? "selected" : "" ;?>>NEXTMO.COM</option> 
       </select>  
     </td> 
  </tr>
  <?php if($provider == "onehop.co"){ ?>
   <tr>
      <td>SOURCE</td>
      <td><input type="text" name="source" class="form-control" value="1001" required/></td>
   </tr>
   <tr>
      <td>MESSAGE*</td>
      <td><textarea name="txt" class="form-control" placeholder="Your Text Message" required></textarea></td>
   </tr>
   <tr>
      <td>SENDER-ID*</td>
      <td><input type="text" name="sId" class="form-control" placeholder="Enter Sender-ID" required /></td>
   </tr>
   <tr>
      <td>LABEL*</td>
      <td><input type="text" name="label" class="form-control" placeholder="Enter Label" required/></td>
   </tr>
   <tr>
      <td>RECEIVER NUMBERS*</td>
      <td><textarea name="mno" class="form-control" placeholder="Receiver Numbers separated with commas" required></textarea></td>
   </tr>
   <tr>
      <td></td>
      <td><input type="submit" name="send" value="SEND" class="btn btn-primary"/></td>
   </tr>
 <?php } ?>


 <?php if($provider == "intellisms.co.uk"){ ?>
  <tr>
     <td>USERNAME</td>
     <td><input type="text" name="username" class="form-control" placeholder="Enter Username" required/></td>
  </tr>
  <tr>
     <td>PASSWORD</td>
     <td><input type="text" name="password" class="form-control" placeholder="Enter Password" required/></td>
  </tr>
  <tr>
     <td>MESSAGE*</td>
     <td><textarea name="text" class="form-control" value="helloWorld" placeholder="Your Text Message" required></textarea></td>
  </tr>
  <tr>
     <td>SENDER-ID*</td>
     <td><input type="senderId" name="sId" class="form-control" value="market" required /></td>
  </tr>
  <tr>
     <td>RECEIVER NUMBERS*</td>
     <td><textarea name="to" class="form-control" placeholder="Receiver Numbers separated with commas" required></textarea></td>
  </tr>
  <tr>
     <td></td>
     <td><input type="submit" name="send" value="SEND" class="btn btn-primary"/></td>
  </tr>
<?php } ?>


<?php if($provider == "textgoto.com"){ ?>
  <tr>
     <td>USER-ID</td>
     <td><input type="text" name="username" class="form-control" placeholder="Enter UserId" required/></td>
  </tr>
  <tr>
     <td>PASSWORD</td>
     <td><input type="text" name="password" class="form-control" placeholder="Enter Password" required/></td>
  </tr>
  <tr>
     <td>MESSAGE*</td>
     <td><textarea name="text" class="form-control" placeholder="Your Text Message" required></textarea></td>
  </tr>
  <tr>
     <td>SENDER-ID*</td>
     <td><input type="senderId" name="sId" class="form-control" value="market" required /></td>
  </tr>
  <tr>
     <td>RECEIVER NUMBERS*</td>
     <td><textarea name="to" class="form-control" placeholder="Receiver Numbers separated with commas" required></textarea></td>
  </tr>
  <tr>
     <td></td>
     <td><input type="submit" name="send" value="SEND" class="btn btn-primary"/></td>
  </tr>
<?php } ?>


<?php if($provider == "nexmo.com"){ ?>   
  <tr>
     <td>API-KEY</td>
     <td><input type="text" name="apiKey" class="form-control" value="6b828295" placeholder="Enter API-KEY" required/></td>
  </tr>
  <tr>
     <td>API-SECRET</td>
     <td><input type="text" name="apiSecret" class="form-control" value="Ge74nhts5mwclhvJ" placeholder="Enter API-SECRET" required/></td>
  </tr>
  <tr> 
     <td>MESSAGE*</td>
     <td><textarea name="text" class="form-control" placeholder="Your Text Message" required></textarea></td>
  </tr>
  <tr>
     <td>SENDER-ID*</td>
     <td><input type="text" name="from" class="form-control" value="market" required /></td>
  </tr>
  <tr>
     <td>RECEIVER NUMBERS*</td>
     <td><textarea name="to" class="form-control" placeholder="Receiver Numbers separated with commas" required></textarea></td>
  </tr>
  <tr>
     <td></td>
     <td><input type="submit" name="send" value="SEND" class="btn btn-primary"/></td>
  </tr> 
<?php } ?> 

</table>
</form>
</center>
<pre>
<h5>Instruction</h5>
  label	✓	String	Label or route based on routing configuration<br>
  sms_text	✓	String	SMS Text you want to send<br>
  sms_list	✓	String	SMS Data you want to send<br>
  sender_id	✓	String	Incoming number configured or Alphanumeric senderID<br>
  mobile_number	✓	String	Mobile number in format of country_code+Number i.e. for US if number is +1-9887877877 this will be 19887877877<br>
  source	x	Number	Default 1001<br>
  encoding	x	String	Encoding default: plaintext, choices: plaintext, unicode<br>
</pre>
<hr>
<footer>
    <center><h5>Developed by Algobasket</h5></center>
</footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>
      function smsProviderChange(y){
        if(y){
            window.location.href= "?provider=" + y;
        }
      }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>


