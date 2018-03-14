<?php 

require_once 'validator/ErrorHandler.php';
require_once 'validator/Validator.php';
require_once 'Database.php';



$errorHandler = new ErrorHandler;

$database=new Database;


$pdo = $database->pdo;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {	
		$validator = new Validator($database,$errorHandler);
		$validation = $validator->check($_POST, [
			'nick' => [
				'required' => true,
				'maxlenght' => 12,
				'minlenght' => 4,
				'unique' => 'users',
			],
			
			'email' => [
				'required' => true,
				'maxlenght' => 100,
				'email' => true,
				'unique' => 'users',
			],
			'city' => [
				'required' => true,
				'maxlenght' => 100,
				'minlenght' => 3,
			],

			'postal_code' => [
				'required' => true,
				'post_code' => true,
			],
			'password' => [
				'required' => true,
				'minlenght' => 6,
				'maxlenght' => 20,
			],
			'repeat_password' => [
				'required' => true,
				'match' => 'password',
			],
			'g-recaptcha-response' => [
				'captcha' => true,
				'required' => true,
			],
			'regulamin' => [
				'required' => true,
			],
		]);

	if ($validation->fails()) {
		echo('Wystąpiły błędy popraw formularz');
	} else {
		echo('Zarejestrowano poprawnie sprawdz emaila');
	}


}

?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Simple validator</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>




	<main>
		<section class="container">
			<div class="card text-white bg-primary mb-3">
				<div class="card-header">Rejestracja</div>
				<div class="card-body">
					<p>Rejestracja jest darmowa.</p>
					<p>Po rejestracji wykonaj dwupoziomową aktywację konta.</p>
					<p>Pola oznaczone <span>*</span> są wymagane do poprawnego ukończenia procesu rejestracji.</p>
				</div>
			</div>
			<div class="card text-center">
				<div class="card-header bg-primary text-white">
					Formularz rejestracji
				</div>
				<div class="card-body">
					<form method="post">
						<div class="form-group">
							<input class="form-control" type="text" name="nick" id="nick" value="<?php if ($errorHandler->hasErrors()) {$validator->old_value('nick');}?>">
							<label for="nick">nick <span class="required_symbol">*</span></label>
							<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('nick'))): ?>
								<div class="errormessage"><?php echo $errorHandler->first('nick') ?></div>
							<?php endif ?>
						</div>
						<div class="form-group">
							<input class="form-control" id="email" type="email" name="email" value="<?php if ($errorHandler->hasErrors()) {$validator->old_value('email');}?>">
							<label for="email">email <span class="required_symbol">*</span></label>
							<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('email'))): ?>
								<div class="errormessage"><?php echo $errorHandler->first('email') ?></div>
							<?php endif ?>
						</div>
						<div class="form-group">
							<input class="form-control" type="text" id="city" name="city" value="<?php if ($errorHandler->hasErrors()) {$validator->old_value('city');}?>">
							<label for="city">Miasto <span class="required_symbol">*</span></label>
							<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('city'))): ?>
								<div class="errormessage"><?php echo $errorHandler->first('city') ?></div>
							<?php endif ?>
						</div>

						<div class="form-group">
							<input class="form-control" type="text" id="postal_code" name="postal_code" value="<?php if ($errorHandler->hasErrors()) {$validator->old_value('postal_code');}?>">
							<label for="postal_code">Kod pocztowy<span class="required_symbol">*</span></label>
							<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('postal_code'))): ?>
								<div class="errormessage"><?php echo $errorHandler->first('postal_code') ?></div>
							<?php endif ?>
						</div>









						<div class="form-group">
							<input class="form-control" type="password" id="password" name="password">
							<label for="password">Hasło <span class="required_symbol">*</span></label>
							<span class="desc">Jako hasła nie używaj swojego imienia, nazwiska itp. Hasło musi się składać z minimum 6 znaków.</span>
							<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('password'))): ?>
								<div class="errormessage"><?php echo $errorHandler->first('password') ?></div>
							<?php endif ?>
						</div>
						<div class="form-group">
							<input class="form-control" type="password" id="repeat_password" name="repeat_password">
							<label for="repeat_password">Powtórz hasło <span class="required_symbol">*</span></label>
						</div>
						<div class="form-group">
							<label>Oświadczam, że znam i akceptuję postanowienia regulaminu
								<input class="form-control" type="checkbox"  name="regulamin" >
							</label>
								<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('regulamin'))): ?>
									<div class="errormessage"><?php echo $errorHandler->first('regulamin') ?></div>
								<?php endif ?>
						</div>
						
						<div class="captcha">
							<div class="g-recaptcha" data-sitekey="6Lci3BoTAAAAAFno3fi1G2GOe3irnxhpeqj1A9oi"></div>
							<input type="hidden" class="hiddenRecaptcha required" name="captcha" id="hiddenRecaptcha" data-error="#percaptcha">
							<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('g-recaptcha-response'))): ?>
								<div class="errormessage"><?php echo $errorHandler->first('g-recaptcha-response') ?></div>
							<?php endif ?>
						</div>
						<br>
						<br>
						<input class="btn btn-primary btn-block btn-lg" type="submit" required name="register" value="Zarejestruj się">
					</form>
				</div>
			</section>
		</main>






<style>
.errormessage  {
    color: #fff;
    background:9px 9px no-repeat #cc3b3b;
    background-size: 10px 10px;
    padding: 5px 15px 3px 25px;
    font-size: 13px;
    border-radius: 2px;
    margin: 12px 0 0;
    line-height: 23px;
    display: inline-block;
    width: 100%;
    text-align: center;
}
.register_nav a{
    color: #333333;
    
    font-size: 20px;
    font-weight: 400;
    text-transform: uppercase;
    display: inline-block;
    max-width: 100%;
    margin-bottom: 0;
    margin-top: 0;
    padding: 10px 20px;
}

.register_nav a.active{
    border-bottom: 3px solid #f01917;
}
.country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute;z-index: 2000;color: white}
.country-list li{padding: 10px; background: #f01917; border-bottom: #bbb9b9 1px solid;}
.country-list li:hover{background:#ece3d2;cursor: pointer;}
#search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA01CSJu8MXF7Ce7GyNvPtCo2aJzy2eT10&libraries=places&sensor=false&libraries=places&region=PL"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
function autocompleteLoad() {
    var input = document.getElementById('city');
    var options = {
    types: ['(cities)'],
};
var autocomplete = new google.maps.places.Autocomplete(input, options);
}
google.maps.event.addDomListener(window, 'load', autocompleteLoad);

</script>

</body>
</html>