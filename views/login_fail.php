<?php
session_start();
if($_SESSION['login-status'] == "fail"){ ?>
	<div class="container">
		<div class="alert alert-danger" role="alert">
		    <h4 class="alert-heading">Error!</h4>
		    <p>Incorrect login or password</p>
		</div>
	</div>
<? } ?>