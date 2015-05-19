<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>TCMC - Sign up</title>
<link href="sitestyles.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
include("header.php");
?>
<div class="site_outside">
<div class="site">
<h1>Join us!</h1>
<p>To become a member of Townsville Community Music Centre, please fill out the form below. Free members can add notices to 
our bulletin board for free, paying members can add artists for free as well. To become a paying member, follow the 
link to PayPal and subscribe to a yearly fee of $25. An admin will upgrade your account as soon as possible. 

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="YZR8VZ66B4EJQ">
<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

<form id="register" name="register" method="post" action="signupprocess.php">
<fieldset class="subtleSet">
	<h2>Sign up</h2>
	<p>
	<label class="label" for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname" required>
    </p>
    <p>
    <label class="label" for="surname">Surname</label>
    <input type="text" name="surname" id="surname" required>
    </p>
    <p>
    <label class="label" for="street">Address</label>
    <input type="text" name="street" id="street" required>
    </p>
    <p>
    <label class="label" for="postcode">Post code</label>
    <input type="text" name="postcode" id="postcode" pattern=".{4,4}" required title="4 characters needed" size="4"><br>
    </p>
    <p>
    <label class="label" for="suburb">Suburb</label>
    <input type="text" name="suburb" id="suburb" required>
    </p>
    <p>
    <label class="label" for="state">State</label>
    <select name="state" id="state"><option>ACT</option><option>NSW</option><option>NT</option><option selected>Qld</option><option>SA</option><option>Tas
    </option><option>Vic</option><option>WA</option></select>
	</p>
    <p>
    <label class="label" for="phoneday">Phone Day</label>
    <input type="text" pattern=".{10,10}" required title="please check the phone number. No country code needed"
    name="phoneday" id="phoneday" >
    </p>
    <p>
    <label class="label" for="phoneeve">Phone Evening</label>
    <input type="text" name="phoneeve" id="phoneeve" >
    </p>
    <p>
    <label class="label" for="email">Email (username)</label>
    <input type="email" name="email" id="email" required>
    </p>
    <p>
    <label class="label" for="password">Password</label>
    <input type="password" name="password" id="password" pattern=".{6,}" required title="Please make sure your password has more than 6 characters">
    </p>
    <p>
    <label class="label" for="repassword">Retype password</label>
    <input type="password" name="repassword" id="repassword" >
    </p>    
    <p>
    <input type="submit" name="submit" id="submit" value="Become a member">
    </p>
    </fieldset>
</form>
</div>
</div>    
<?php
include("footer.html");
?>    
</body>
</html>