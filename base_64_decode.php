<?php
	$output="";
	if(isset($_POST["submit"]))
	{
		$key=$_POST["img"];
		$decoded_str = base64_decode($key); //pass the encoded string here

		$im = imagecreatefromstring($decoded_str);
		//below code will display the image on browser
		$img=md5(uniqid()).".jpg";
		if(imagejpeg($im,$img))
		{
			$output="<div><p style='text-align:center'>Click that image to Download</p>
				<p style='text-align:center'><a href='".$img."' target='_blank' download><img src='".$img."' width='250px'></a></p>
				</div>";
		}
		
	}
	if(isset($_GET["download"]))
	{
		$file=$_GET["download"];
		$myfile = fopen($file, "r") or die("Unable to open file!");
		$decoded_str=base64_decode(fread($myfile,filesize($file)));
		fclose($myfile);
		$im = imagecreatefromstring($decoded_str);
		//below code will display the image on browser
		$img=md5(uniqid()).".jpg";
		if(imagejpeg($im,$img))
		{
			$output="<div><p style='text-align:center'>Click that image to Download</p>
				<p style='text-align:center'><a href='".$img."' target='_blank' download><img src='".$img."' width='250px'></a></p>
				</div>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Base 64</title>
</head>
<style>
input[type=text], select {
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
  background-position: cover; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: 100% 100%; /* Resize the background image to cover the entire container */
}
</style>
<body class="bg" style="min-height:600px">

<ul>
  <li><a href="index.php" >Encode</a></li>
  <li><a href="base_64_decode.php" class="button">Decode</a></li>
</ul>

<div style="margin-top:2%;">

  <form name="addform" action="<?php echo $_SERVER["REQUEST_URI"]?>" method="post" enctype="multipart/form-data" novalidate>
	<h1 style="text-align:center">Base 64 bit Decryption</h1>
    

    <label for="img">Enter Encode Text</label>
    <input type="text" id="img" name="img" placeholder="encoded text">

     
    <input type="submit" value="Submit" name="submit">
  </form>
</div>
<br>
<?=$output;?>
</body>
</html>