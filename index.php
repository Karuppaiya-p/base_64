<?php
	$output="";
	$out="";
	if(isset($_POST["submit"]))
	{
		if(isset($_FILES["primary_img"]))
		{
			$extension=array("jpeg","jpg","png");
			$img=$_FILES["primary_img"]["name"];
			$file_tmp=$_FILES["primary_img"]["tmp_name"];
			$ext=pathinfo($img,PATHINFO_EXTENSION);
			if(in_array($ext,$extension)) 
			{
				//$image_path = 'Untitled.png'; //this will be the physical path of your image   
				$img_binary = fread(fopen($file_tmp, "r"), filesize($file_tmp));
				$file = md5(uniqid()).'.txt';
				$data = base64_encode($img_binary);
				file_put_contents($file, $data);
				$output='<div><form name="addform1" action="'.$_SERVER["REQUEST_URI"].'" method="post" enctype="multipart/form-data" >
				<h1 style="text-align:center">Send an email</h1>
				<p><a href="'.$file.'" target="_blank" download>View File</a></p>
				<input type="hidden" name="file" value="'.$file.'">
				<label for="from">From Mail</label>
				<input type="email" id="from" name="from" required> 
				<label for="to">To mail</label>
				<input type="email" id="to" name="to" required>     
				<input type="submit" value="Send Email" name="send_mail">
			  </form></div>'; 				
			}
			 else 
			{
				array_push($error1,"$img");
			}
		}
		else
		{
			echo "Choose Image";
		}
	}
	if(isset($_POST["send_mail"]))
	{
		$from=$_POST["from"];
		$to=$_POST["to"];
		$file=$_POST["file"];
		$subject = "";
		$content = "<h1>Hi! You received Encoded Image</h1>
				<p>If you want download encoded image <a href='https://tifs.info/encode/base_64_decode.php?download=".$file."' class='button'>Click Here</a></p>";
		$subject = "Received Encoded Image";

		$message = "
		<html>
		<head>
		<title>Received Encoded Image using md5, base64</title>
		</head>
		<style>
		.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
		</style>
		<body>
		".$content."
		</body>
		</html>
		";

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.$from.'>' . "\r\n";
		if(@mail($to,$subject,$message,$headers))
		{
		  $out= "Mail Sent Successfully";
		}else{
		  $out= "Mail Not Sent";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Base 64</title>
</head>
<style>
input[type=text], select,input[type=email] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
	margin:auto;
	width:50%;
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}
.bg {
  background-image: url("bg.jpg"); /* The image used */
  background-color: #cccccc; /* Used if the image is unavailable */
  background-position: fixed; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: 100% 100%; /* Resize the background image to cover the entire container */
}
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
</style>
<body class="bg" style="min-height:600px">

<ul>
  <li><a href="index.php" class="button" >Encode</a></li>
  <li><a href="base_64_decode.php">Decode</a></li>
</ul>

<div style="margin-top:2%;">
	<?=$out;?>
  <form name="addform" action="<?php echo $_SERVER["REQUEST_URI"]?>" method="post" enctype="multipart/form-data" novalidate>
	<h1 style="text-align:center">producing user privacy for cryptography</h1>
    <label for="primary_img">Browse Image</label>
    <input type="file" id="primary_img" name="primary_img">     
    <input type="submit" value="Submit" name="submit">
	<p style="text-align:right">Developed by - menaka</p>
  </form>
</div>
<br>
  <?=$output?>
  <script>
function copyText(element) 
{
  var range, selection, worked;

  if (document.body.createTextRange) {
    range = document.body.createTextRange();
    range.moveToElementText(element);
    range.select();
  } else if (window.getSelection) {
    selection = window.getSelection();        
    range = document.createRange();
    range.selectNodeContents(element);
    selection.removeAllRanges();
    selection.addRange(range);
  }
  
  try {
    document.execCommand('copy');
    alert('text copied');
  }
  catch (err) {
    alert('unable to copy text');
  }
}
</script>
</body>
</html>