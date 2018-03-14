<div class="register_group">
	<input class="register_input" type="text" required name="name" id="name" value="<?php if ($errorHandler->hasErrors()) {$validator->old_value('name');}?>">
	<span class="highlight"></span>
	<span class="bar"></span>
	<label class="register_label" for="name">Imię <span class="required_symbol">*</span></label>
	<div id="suggesstion-box-firstname"></div>
	<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('name'))): ?>
		<div class="errormessage"><?php echo $errorHandler->first('name') ?></div>
	<?php endif ?>
</div>
<div class="register_group">
	<input class="register_input" id="lastName" type="text" required name="lastName" value="<?php if ($errorHandler->hasErrors()) {$validator->old_value('lastName');}?>">
	<span class="highlight"></span>
	<span class="bar"></span>
	<label class="register_label" for="lastName">Nazwisko <span class="required_symbol">*</span></label>
	<div id="suggesstion-box-lastname"></div>
	<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('lastName'))): ?>
		<div class="errormessage"><?php echo $errorHandler->first('lastName') ?></div>
	<?php endif ?>
</div>
<div class="register_group">
	<input class="register_input" id="email" type="email" required name="email" value="<?php if ($errorHandler->hasErrors()) {$validator->old_value('email');}?>">
	<span class="highlight"></span>
	<span class="bar"></span>
	<label class="register_label" for="email">E-mail <span class="required_symbol">*</span></label>
	<span class="desc">Na podany adres e-mail zostanie wysłana wiadomość z potwierdzeniem rejestracji. Zwróć uwagę na jego poprawność.</span>
	<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('email'))): ?>
		<div class="errormessage"><?php echo $errorHandler->first('email') ?></div>
	<?php endif ?>
</div>
<div class="register_group">
	<input class="register_input" type="text" required name="address" id="address" value="<?php if ($errorHandler->hasErrors()) {$validator->old_value('address');}?>">
	<span class="highlight"></span>
	<span class="bar"></span>
	<label class="register_label" for="address">Adres<span class="required_symbol">*</span></label>
	<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('address'))): ?>
		<div class="errormessage"><?php echo $errorHandler->first('address') ?></div>
	<?php endif ?>
</div>
<div class="register_group">
	<input class="register_input" type="date" name="birthdate" id="birthdate" value="<?php if ($errorHandler->hasErrors()) {$validator->old_value('birthdate');}?>">
	<span class="highlight"></span>
	<span class="bar"></span>
	<label class="register_label" for="birthdate">Data urodzenia<span class="required_symbol">*</span></label>
	<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('birthdate'))): ?>
		<div class="errormessage"><?php echo $errorHandler->first('birthdate') ?></div>
	<?php endif ?>
</div>
<div class="register_group">
	<input class="register_input" type="text" required id="city" name="city" value="<?php if ($errorHandler->hasErrors()) {$validator->old_value('city');}?>">
	<span class="highlight"></span>
	<span class="bar"></span>
	<label class="register_label" for="city">Miasto <span class="required_symbol">*</span></label>
	<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('city'))): ?>
		<div class="errormessage"><?php echo $errorHandler->first('city') ?></div>
	<?php endif ?>
</div>
<div class="register_group">
<!-- 	<span class="highlight"></span>
<span class="bar"></span> -->
	<select class="register_input" id="prov" name="prov">
		<option stateCode="" <?php check_option_from_htttp_method('prov','','post') ?> value="">wybierz</option>
		<option stateCode="02" <?php check_option_from_htttp_method('prov','Dolnośląskie','post') ?> value="Dolnośląskie">Dolnośląskie</option>
		<option stateCode="04" <?php check_option_from_htttp_method('prov','Kujawsko-pomorskie','post') ?> value="Kujawsko-pomorskie">Kujawsko-pomorskie</option>
		<option stateCode="06" <?php check_option_from_htttp_method('prov','Lubelskie','post') ?> value="Lubelskie">Lubelskie</option>
		<option stateCode="08" <?php check_option_from_htttp_method('prov','Lubuskie','post') ?> value="Lubuskie">Lubuskie</option>
		<option stateCode="12" <?php check_option_from_htttp_method('prov','Małopolskie','post') ?> value="Małopolskie">Małopolskie</option>
		<option stateCode="10" <?php check_option_from_htttp_method('prov','Łódzkie','post') ?> value="Łódzkie">Łódzkie</option>
		<option stateCode="14" <?php check_option_from_htttp_method('prov','Mazowieckie','post') ?> value="Mazowieckie">Mazowieckie</option>
		<option stateCode="16" <?php check_option_from_htttp_method('prov','Opolskie','post') ?> value="Opolskie">Opolskie</option>
		<option stateCode="18" <?php check_option_from_htttp_method('prov','Podkarpackie','post') ?> value="Podkarpackie">Podkarpackie</option>
		<option stateCode="20" <?php check_option_from_htttp_method('prov','Podlaskie','post') ?> value="Podlaskie">Podlaskie</option>
		<option stateCode="22" <?php check_option_from_htttp_method('prov','Pomorskie','post') ?> value="Pomorskie">Pomorskie</option>
		<option stateCode="24" <?php check_option_from_htttp_method('prov','Śląskie','post') ?> value="Śląskie">Śląskie</option>
		<option stateCode="26" <?php check_option_from_htttp_method('prov','Świętokrzyskie','post') ?> value="Świętokrzyskie">Świętokrzyskie</option>
		<option stateCode="28" <?php check_option_from_htttp_method('prov','Warmińsko-mazurskie','post') ?> value="Warmińsko-mazurskie">Warmińsko-mazurskie</option>
		<option stateCode="30" <?php check_option_from_htttp_method('prov','Wielkopolskie','post') ?> value="Wielkopolskie">Wielkopolskie</option>
		<option stateCode="32" <?php check_option_from_htttp_method('prov','Zachodniopomorskie','post') ?> value="Zachodniopomorskie">Zachodniopomorskie</option>
	</select>
	<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('prov'))): ?>
		<div class="errormessage"><?php echo $errorHandler->first('prov') ?></div>
	<?php endif ?>
	<label class="register_label">Województwo<span class="required_symbol">*</span></label>
</div>
<div class="register_group">
<!-- 	<span class="highlight"></span>
	<span class="bar"></span> -->
	<select class="register_input" id="country" name="country">
		<option value="">wybierz</option>
		<?php foreach ($countries as $key => $single_country): ?>
		<option <?php 
		if ($_POST) {		
				check_option_from_htttp_method('country',$single_country['kraj'],'post'); 
			}else{
			if ($single_country['kraj']=='Polska') {
				echo 'selected';
			}
		}?>
			value="<?php echo $single_country['kraj']; ?>"><?php echo $single_country['kraj']; ?></option>
		<?php endforeach ?>
	</select>
	<label class="register_label" for="country">Kraj <span class="required_symbol">*</span></label>
	<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('country'))): ?>
		<div class="errormessage"><?php echo $errorHandler->first('country') ?></div>
	<?php endif ?>
</div>
<div class="register_group">
	<input class="register_input" type="text" required name="zip" id="zip" value="<?php if ($errorHandler->hasErrors()) {$validator->old_value('zip');}?>">
	<span class="highlight"></span>
	<span class="bar"></span>
	<label class="register_label" for="zip">Kod pocztowy <span class="required_symbol">*</span></label>
	<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('zip'))): ?>
		<div class="errormessage"><?php echo $errorHandler->first('zip') ?></div>
	<?php endif ?>
</div>
<div class="register_group">
	<input class="register_input" type="tel" required name="phone" id="phone" value="<?php if ($errorHandler->hasErrors()) {$validator->old_value('phone');}?>">
	<span class="highlight"></span>
	<span class="bar"></span>
	<label class="register_label" for="phone">Numer telefonu <span class="required_symbol">*</span></label>
	<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('phone'))): ?>
		<div class="errormessage"><?php echo $errorHandler->first('phone') ?></div>
	<?php endif ?>
</div>
<div class="register_group">
	<input class="register_input" type="text" required id="nick" name="nick" value="<?php if ($errorHandler->hasErrors()) {$validator->old_value('nick');}?>">
	<span class="highlight"></span>
	<span class="bar"></span>
	<label class="register_label" for="nick">Login <span class="required_symbol">*</span></label>
	<span class="desc">Login (nazwa użytkownika) jest to nazwa, pod którą będziesz widoczny dla innych użytkowników. Login musi się składać z minimum 6 znaków.</span>
	<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('nick'))): ?>
		<div class="errormessage"><?php echo $errorHandler->first('nick') ?></div>
	<?php endif ?>
</div>
<div class="register_group">
	<input class="register_input" type="password" required id="password" name="password">
	<span class="highlight"></span>
	<span class="bar"></span>
	<label class="register_label" for="password">Hasło <span class="required_symbol">*</span></label>
	<span class="desc">Jako hasła nie używaj swojego imienia, nazwiska itp. Hasło musi się składać z minimum 6 znaków.</span>
	<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('password'))): ?>
		<div class="errormessage"><?php echo $errorHandler->first('password') ?></div>
	<?php endif ?>
</div>
<div class="register_group">
	<input class="register_input" type="password" required id="repeat_password" name="repeat_password">
	<span class="highlight"></span>
	<span class="bar"></span>
	<label class="register_label" for="repeat_password">Powtórz hasło <span class="required_symbol">*</span></label>
</div>
<label class="control control--checkbox">Oświadczam, że znam i akceptuję postanowienia <a href="#">
Regulaminu</a> portalu Handlujemy.pl
<input type="checkbox"  name="regulamin" <?php check_checkbox_from_htttp_method('regulamin',0,'post') ?> >
<div class="control__indicator"></div>
<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('regulamin'))): ?>
	<div class="errormessage"><?php echo $errorHandler->first('regulamin') ?></div>
<?php endif ?>
</label>
<label class="control control--checkbox">Wyrażam zgodę na przetwarzanie danych osobowych przez portal Handlujemy.pl
	<input type="checkbox" name="dane_osobowe" <?php check_checkbox_from_htttp_method('dane_osobowe',0,'post') ?>>
	<div class="control__indicator"></div>
	<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('dane_osobowe'))): ?>
		<div class="errormessage"><?php echo $errorHandler->first('dane_osobowe') ?></div>
	<?php endif ?>
</label>
<label class="control control--checkbox">Oświadczam że mam ukończone 18 lat
	<input type="checkbox" name="18_lat" <?php check_checkbox_from_htttp_method('18_lat',0,'post') ?>>
	<div class="control__indicator"></div>
	<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('18_lat'))): ?>
		<div class="errormessage"><?php echo $errorHandler->first('18_lat') ?></div>
	<?php endif ?>
</label>
<div class="form-group-register">
<?php
if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
	echo '<div class="g-recaptcha" data-sitekey="6Lci3BoTAAAAAFno3fi1G2GOe3irnxhpeqj1A9oi"></div>'; //localhost
} else {
	echo '<div class="g-recaptcha" data-sitekey="'.captcha_data('data-sitekey').'"></div>'; //notloacl host
}
?>
<input type="hidden" class="hiddenRecaptcha required" name="captcha" id="hiddenRecaptcha" data-error="#percaptcha">
<?php if ($errorHandler->hasErrors()&&!empty($errorHandler->first('g-recaptcha-response'))): ?>
	<div class="errormessage"><?php echo $errorHandler->first('g-recaptcha-response') ?></div>
<?php endif ?>
</div>