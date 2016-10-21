<?php
include 'init.php';
include 'header.php';


if(isset($_GET['email']) and isset($_GET['email_code']))
{
	$email		=	trim($_GET['email']);
	$email_code	=	trim($_GET['email_code']);
	if(email_exists($email) === false)
	{
		$errors[] = 'Oops, Something went wrong, and we could\'nt find that email address!';
	}
	else if(activate($email,$email_code) === false)
	{
		$errors[] = 'We had problems activating your account.';
	}
}
else
{
	header('Location: index.php');
	exit();
}
include 'body4.php';
include 'sidebar.php';
include 'footer.php';
?>
