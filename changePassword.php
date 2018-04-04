<?php
    include_once "sessionAuth.php";
?>

<html>
<head>
<style type="text/css">
body {font-family: Arial, Helvetica, sans-serif;}

	input[type=text], input[type=password] {
	    width: 100%;
	    padding: 12px 20px;
	    margin: 8px 0;
	    display: inline-block;
	    border: 1px solid #ccc;
	    box-sizing: border-box;
	}

	button {
	    background-color: #CC4040;
	    color: white;
	    padding: 14px 20px;
	    margin: 8px 0;
	    border: none;
	    cursor: pointer;
	    width: 100%;
	}

	button:hover {
	    opacity: 0.8;
	}

	.cancelbtn {
	    width: auto;
	    padding: 10px 18px;
	    background-color: #f44336;
	}

	.imgcontainer {
	    text-align: center;
	    margin: 24px 0 12px 0;
	    position: relative;
	}

	.container {
	    padding: 16px;
	}


	.modal {
	    display: none; 
	    position: fixed; 
	    z-index: 1; 
	    top: 0;
	    width: 100%; 
	    height: 100%; 
	    overflow: auto; 
	    background-color: rgb(0,0,0); 
	    background-color: rgba(0,0,0,0.4);
	    padding-top: 60px;
	}

	.modal-content {
	    background-color: #fefefe;
	    margin: 5% auto 15% auto; 
	    border: 1px solid #888;
	    width: 20%; 
	}

	.close {
	    position: absolute;
	    right: 25px;
	    top: 0;
	    color: #000;
	    font-size: 35px;
	    font-weight: bold;
	}

	.close:hover, .close:focus {
	    color: red;
	    cursor: pointer;
	}

	.animate {
	    -webkit-animation: animatezoom 0.6s;
	    animation: animatezoom 0.6s
	}

	@-webkit-keyframes animatezoom {
	    from {-webkit-transform: scale(0)} 
	    to {-webkit-transform: scale(1)}
	}
	    
	@keyframes animatezoom {
	    from {transform: scale(0)} 
	    to {transform: scale(1)}
	}

	@media screen and (max-width: 300px) {
	    span.psw {
	       display: block;
	       float: none;
	    }
	    .cancelbtn {
	       width: 100%;
	    }
	}
</style>
</head>
<body>
<div class = "border">

<h2>Update Password</h2>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Update</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="updatePassword.php" method="post">

    <div class="container">
      <label for="old"><b>Old Password</b></label>
      <input type="password" placeholder="Enter Username" name="old" required>

      <label for="new"><b>New Password</b></label>
      <input type="password" placeholder="Enter Password" name="new" required>
        
      <label for="reEnter"><b>Confirm New Password</b></label>
      <input type="password" placeholder="Enter Password" name="reEnter" required>
        
      <button type="submit">Change Password</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<script>

var modal = document.getElementById('id01');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</div>
</body>
</html>