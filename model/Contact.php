<?php

Class Contact 
{

	function mail($name, $mail, $subject, $category, $message) 
	{
		session_start();

		$errors = [];
		$input = [];

		if (empty($name) || !preg_match('/^[a-zA-Z]{3,25}+$/', $name)) {
			$errors['name'] = 'Votre nom doit compter entre 3 et 25 caractères !';
		}else {
			$input['name'] = $name;
		}
		
		if (empty($mail)|| !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			$errors['mail'] = 'Veuillez renseigner un email valide !';
		}else {
			$input['mail'] = $mail;
		}
		
		if (empty($category)) {
			$errors['category'] = 'Veuillez sélectionner une catégorie';
		}
		
		if (empty($subject) || strlen($subject) <= 3 || strlen($subject) >= 100) {
			$errors['subject'] = 'L\'object doit compter entre 3 et 100 caractères !';
		}else {
			$input['subject'] = $subject;
		}
		
		if (empty($message) || strlen($message) <= 3 || strlen($message) >= 500) {
			$errors['message'] = 'Votre message doit compter entre 3 et 500 caractères !';
		}else {
			$input['message'] = $message;
		}

		if (!empty($errors)) {
			$_SESSION['errors'] = $errors;
			$_SESSION['input'] = $input;
			header('Location: index.php?action=contact&through=mail&#div_contact_form');
		}else {
			$to      = 'stiwy@caritey-developpement.fr';
			$subject = $category . " " . $subject;
			$message = 'De :' . $name  . "\r\n" . $message;
			$message = wordwrap($message, 70, "\r\n");
			$headers = 'From: ' . $mail . "\r\n" .
			'Reply-To: ' . $mail . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

			mail($to, $subject, $message, $headers);

			$_SESSION['flash']['success'] = 'Votre email à bien été envoyé !';
			header('Location: index.php?action=contact&through=mail&#div_contact_form');
		}
	}  
}