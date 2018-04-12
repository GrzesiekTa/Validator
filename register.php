<?php 
require_once 'database/Database.php';
require_once 'validator/Validator.php';
require_once 'validator/ErrorHandler.php';
$errorHandler = new ErrorHandler;
$database=new Database;

$pdo = $database->pdo;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {	
		$validator = new Validator($database,$errorHandler);

        $validation = $validator->check($_FILES,[
            'image_upload_box'=>[
                'required' => true,
                'is_img' => true,
                'max_file_size'=>4000000,
            ]
        ]);

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
				'maxlenght' => 30,
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
            'select_test' => [
                'required' => true,
                'is_integer'=>true
            ],
			'regulamin' => [
				'required' => true,
			],
		]);

	if ($validation->fails()) {
		// echo '<pre>';
		// var_dump($errorHandler->allErrors());
		// echo '</pre>';

	} else {
		$password=password_hash($_POST['password'],PASSWORD_DEFAULT);
		$query = $pdo->prepare("INSERT INTO users (id, nick, email, city, postal_code, password) VALUES (NULL,:nick,:email,:city,:postal_code,:password)");
		$query->bindParam(':nick', $_POST['nick'],PDO::PARAM_STR);
		$query->bindParam(':email', $_POST['email'],PDO::PARAM_STR);
		$query->bindParam(':city', $_POST['city'],PDO::PARAM_STR);
		$query->bindParam(':postal_code', $_POST['postal_code'],PDO::PARAM_STR);
		$query->bindParam(':password', $password,PDO::PARAM_STR);
		$query->execute();
		$success=true;
	}


}?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Simple validator</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<main>
	<?php if (isset($success)): ?>
		<div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true" style="font-size:20px">×</span>
			</button><strong>Success!</strong> Zarejestrowales sie poprawnie
		</div>
	<?php endif ?>
    <section class="container">
        <div class="card">
            <div class="card-header text-white bg-primary mb-3">Rejestracja</div>
            <div class="card-body">
                <p>Rejestracja jest darmowa.</p>
                <p>Po rejestracji wykonaj dwupoziomową aktywację konta.</p>
                <p>Pola oznaczone <span>*</span> są wymagane do poprawnego ukończenia procesu rejestracji.</p>
            </div>
        </div>
        <div class="card text-center">
            <div class="card-header bg-primary text-white">
                <h3>Formularz rejestracji</h3>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input class="form-control" type="text" name="nick" id="nick" value="<?php if ($errorHandler->hasErrors()) {$validator->old_value('nick');}?>">
                        <label for="nick">nick <span class="required_symbol">*</span></label>
                        <?php if ($errorHandler->hasErrors()&&!empty($errorHandler->firstError('nick'))): ?>
                        <div class="bg-danger text-white">
                            <?php echo $errorHandler->firstError('nick') ?>
                        </div>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="email" type="email" name="email" value="<?php if ($errorHandler->hasErrors()) {$validator->old_value('email');}?>">
                        <label for="email">email <span class="required_symbol">*</span></label>
                        <?php if ($errorHandler->hasErrors()&&!empty($errorHandler->firstError('email'))): ?>
                        <div class="bg-danger text-white">
                            <?php echo $errorHandler->firstError('email') ?>
                        </div>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" id="city" name="city" value="<?php if ($errorHandler->hasErrors()) {$validator->old_value('city');}?>">
                        <label for="city">Miasto <span class="required_symbol">*</span></label>
                        <?php if ($errorHandler->hasErrors()&&!empty($errorHandler->firstError('city'))): ?>
                        <div class="bg-danger text-white">
                            <?php echo $errorHandler->firstError('city') ?>
                        </div>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" id="postal_code" name="postal_code" value="<?php if ($errorHandler->hasErrors()) {$validator->old_value('postal_code');}?>">
                        <label for="postal_code">Kod pocztowy<span class="required_symbol">*</span></label>
                        <?php if ($errorHandler->hasErrors()&&!empty($errorHandler->firstError('postal_code'))): ?>
                        <div class="bg-danger text-white">
                            <?php echo $errorHandler->firstError('postal_code') ?>
                        </div>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" id="password" name="password">
                        <label for="password">Hasło <span class="required_symbol">*</span></label>
                        <span class="desc">Jako hasła nie używaj swojego imienia, nazwiska itp. Hasło musi się składać z minimum 6 znaków.</span>
                        <?php if ($errorHandler->hasErrors()&&!empty($errorHandler->firstError('password'))): ?>
                        <div class="bg-danger text-white">
                            <?php echo $errorHandler->firstError('password') ?>
                        </div>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" id="repeat_password" name="repeat_password">
                        <label for="repeat_password">Powtórz hasło <span class="required_symbol">*</span></label>
                        <?php if ($errorHandler->hasErrors()&&!empty($errorHandler->firstError('repeat_password'))): ?>
                        <div class="bg-danger text-white">
                            <?php echo $errorHandler->firstError('repeat_password') ?>
                        </div>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label class="btn btn-default btn-file">
                            <input name="image_upload_box" type="file" id="image_upload_box" size="40" />
                        </label>
                        <?php if ($errorHandler->hasErrors()&&!empty($errorHandler->firstError('image_upload_box'))): ?>
                        <div class="bg-danger text-white">
                            <?php echo $errorHandler->firstError('image_upload_box') ?>
                        </div>
                        <?php endif ?>
                        <div clas="showPhoto">
                            <img class="img-responsive" src="" alt="" id="showPhoto">
                        </div>
                    </div>
                    <div class="form-group">
                     
                        <select class="form-control" id="select_test" name="select_test">
                            <option value="">---------------</option>
                            <option <?php if ($errorHandler->hasErrors()) {$validator->select_old_value(1,'select_test');}?> value="1">1</option>
                            <option <?php if ($errorHandler->hasErrors()) {$validator->select_old_value(2,'select_test');}?> value="2">2</option>
                        </select>
                        <label for="select_test">select_test:</label>
                        <?php if ($errorHandler->hasErrors()&&!empty($errorHandler->firstError('select_test'))): ?>
                        <div class="bg-danger text-white">
                            <?php echo $errorHandler->firstError('select_test') ?>
                        </div>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label>Oświadczam, że znam i akceptuję postanowienia regulaminu
								<input class="form-control" type="checkbox"  name="regulamin" >
							</label>
                        <?php if ($errorHandler->hasErrors()&&!empty($errorHandler->firstError('regulamin'))): ?>
                        <div class="bg-danger text-white">
                            <?php echo $errorHandler->firstError('regulamin') ?>
                        </div>
                        <?php endif ?>
                    </div>
                    <div class="captcha">
                        <div class="g-recaptcha" data-sitekey="6Lci3BoTAAAAAFno3fi1G2GOe3irnxhpeqj1A9oi"></div>
                        <input type="hidden" class="hiddenRecaptcha required" name="captcha" id="hiddenRecaptcha" data-error="#percaptcha">
                        <?php if ($errorHandler->hasErrors()&&!empty($errorHandler->firstError('g-recaptcha-response'))): ?>
                        <div class="bg-danger text-white">
                            <?php echo $errorHandler->firstError('g-recaptcha-response') ?>
                        </div>
                        <?php endif ?>
                    </div>
                    <br>
                    <br>
                    <input class="btn btn-primary btn-block btn-lg" type="submit" required name="register" value="Zarejestruj się">
                </form>
            </div>
        </div>
    </section>
</main>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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