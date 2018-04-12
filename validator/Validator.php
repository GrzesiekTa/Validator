<?php

class Validator {
	protected $errorHandler;
	protected $validateItems;

	protected $rules = ['required', 'minlenght', 'maxlenght', 'email', 'alnum', 'match', 'unique', 'post_code', 'url', 'captcha', 'year18', 'nip', 'regon','phone','is_integer','date','max_file_size','is_img'];

	public $messages = [
		'required' => 'Pole :field jest wymagane',
		'minlenght' => 'Pole :field musi mieć min :satisifer znaków',
		'maxlenght' => 'Pole :field musi mieć max :satisifer znaków',
		'email' => 'Email nie jest poprawny',
		'alnum' => 'to :field musi zawierac liczbe',
		'match' => 'Hasła nie są takie same',
		'unique' => 'Podane pole :field już istnieje w bazie musisz urzyć innego',
		'post_code' => 'adres pocztowy nie jest poprawny',
		'url' => 'Adres url nie jest poprawny',
		'captcha' => 'Potwierdz że nie jesteś botem',
		'year18' => 'Aby założyć konto w tym serwisie musisz mieć ukończone 18 lat',
		'nip' => 'Nip nie jest poprawny',
		'regon' => 'Regon nie jest poprawny',
		'phone' => "Numer tel nie jest poprawny: przykład 500-500-500, 34-315-43-34,500500500, 343154334",
		'is_integer' =>"To pole musi być liczbą",
		'date'=>'Nie poprawny format daty',
		'max_file_size'=>"za duzy plik max :satisifer kb",
		'is_img'=>'Tylko jpeg, pjpeg, gif, png',
	];
	function __construct(Database $database,ErrorHandler $errorHandler)
	{
		$this->errorHandler=$errorHandler;
		$this->database=$database;
	}

	public function check($validateItems, $rules) {

		$this->validateItems = $validateItems;

		foreach ($rules as $itemName => $requireRule) {
			@$this->validate([
				'field' => $itemName,
				'value' => $validateItems[$itemName],
				'rules' => $requireRule,
			]);
		}
		return $this;
	}

	public function old_value($value) {
		echo $this->validateItems[$value];
	}
	public function select_old_value($value,$itemName) {
		if (isset($this->validateItems[$itemName])&&$this->validateItems[$itemName]==$value) {
			echo 'selected';
		}
	}

	public function fails() {
		return $this->errorHandler->hasErrors();
	}

	public function errors() {
		return $this->errorHandler;
	}

	protected function validate($item) {
		$field = $item['field'];

		//wymuszanie wprowadznie require
		if (!isset($item['rules']['required'])) {
			echo "walidujac pole  <b>{$field}</b> pole musisz przypisać require true or false";
			die;
		}
		//walidator odpolony jest tylko w przypadku gdy pole ma require true lub require false ale nie jest puste
		if ($item['rules']['required'] == 1 || ($item['rules']['required'] ==0 && $this->required(null,$item['value'],null) == 1)) {
			foreach ($item['rules'] as $rule => $satisifer) {
				if (in_array($rule, $this->rules)) {
					if (!call_user_func_array([$this, $rule], [$field, $item['value'], $satisifer])) {
						$messages = $this->messages;
						$this->errorHandler->addError(
							str_replace([':field', ':satisifer'], [$field, $satisifer], $messages[$rule]), $field
						);
					}
				}
			}
		} 
	}
	//=========================================================================================================================
	protected function required($field, $value, $satisifer) {
		if (!is_array($value)) {
			if (!is_null($value) && (trim($value) != '')) {
				return true;
			} else {
				return false;
			}
		}else{
			//type file
			if (isset($value['size'])) {
				if ($value['size']>0) {
					return true;
				}else{
					return false;
				}
			}
			//array
			return true;
		}
	}
	//=========================================================================================================================
	protected function minlenght($field, $value, $satisifer) {
		return mb_strlen($value) >= $satisifer;
	}
	//=========================================================================================================================
	protected function maxlenght($field, $value, $satisifer) {
		return mb_strlen($value) <= $satisifer;
	}
	//=========================================================================================================================
	protected function email($field, $value, $satisifer) {
		return filter_var($value, FILTER_VALIDATE_EMAIL);
	}
	//=========================================================================================================================
	protected function alnum($field, $value, $satisifer) {
		return ctype_alnum($value);
	}
	protected function match($field, $value, $satisifer) {
		return $value === $this->validateItems[$satisifer];
	}
	//=========================================================================================================================
	protected function unique($field, $value, $satisifer) {
		return !$this->database->table($satisifer)->exists([
			$field=>$value
		]);
	}
	//=========================================================================================================================
	protected function post_code($field, $value, $satisifer) {
		$value = preg_replace("([-]+)", "", $value);
		return preg_match('/^[0-9]{2}-?[0-9]{3}$/Du', $value);
	}
	//=========================================================================================================================
	protected function url($field, $value, $satisifer) {
		return filter_var($value, FILTER_VALIDATE_URL);
	}
	//=========================================================================================================================
	protected function captcha($field, $value, $satisifer) {
		if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
			$sekret = "6Lci3BoTAAAAAKBdjxF-5gyYkCX9UtSvZYW_Gx71"; //localhost
		} else {
			$sekret = "6Lf7hCgUAAAAADXJumgdQk4-M8Bo26gpL04yP_o2"; //notloacl host
		}

		$check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $sekret . '&response=' . $value);
		$answer = json_decode($check);

		return $answer->success;
	}
	//=========================================================================================================================
	protected function year18($field, $value, $satisifer) {

		if ($this->alnum($value, null, null) === false) {
			return false;
		} else {

			$check_18_years_old = date("Y") - $value;

			if ($check_18_years_old >= 18) {
				return true;
			} else {
				return false;
			}
		}
	}
	//=========================================================================================================================
	protected function nip($field, $value, $satisifer) {
		$value = preg_replace("/[^0-9]+/", "", $value);
		if (strlen($value) != 10) {
			return false;
		}

		$arrSteps = array(6, 5, 7, 2, 3, 4, 5, 6, 7);
		$intSum = 0;
		for ($i = 0; $i < 9; $i++) {
			$intSum += $arrSteps[$i] * $value[$i];
		}
		$int = $intSum % 11;

		$intControlNr = ($int == 10) ? 0 : $int;
		if ($intControlNr == $value[9]) {
			return true;
		}
		return false;
	}
	//=========================================================================================================================
	protected function regon($field, $value, $satisifer) {
		if (strlen($value) != 9) {
			return false;
		}

		$arrSteps = array(8, 9, 2, 3, 4, 5, 6, 7);
		$intSum = 0;
		for ($i = 0; $i < 8; $i++) {
			$intSum += $arrSteps[$i] * $value[$i];
		}
		$int = $intSum % 11;
		$intControlNr = ($int == 10) ? 0 : $int;
		if ($intControlNr == $value[8]) {
			return true;
		}
		return false;
	}
	//=========================================================================================================================
	protected function phone($field, $value, $satisifer) {

		$value = preg_replace("([- ]+)", "", $value);
		$reg = '/^[0-9]{8,13}$/';

		return preg_match($reg, $value);
	}
	//=========================================================================================================================
	protected function is_integer($field, $value, $satisifer) {
		return is_numeric($value);
	}
	//=========================================================================================================================
	protected function date($field, $value, $satisifer) {
		return strtotime($value);
	}
	//=========================================================================================================================
	public function max_file_size($field, $value, $satisifer) {
		if ($_FILES[$field]["size"] > $satisifer) {
			return false;
		}
		return true;
	}

	//=========================================================================================================================
	public function is_img($field, $value, $satisifer) {
		if ((($_FILES[$field]["type"] !== "image/jpeg" && $_FILES[$field]["type"] !== "image/pjpeg" && $_FILES[$field]["type"] !== "image/gif" && $_FILES[$field]["type"] !== "image/x-png"))) {
			return false;
		}
		return true;
	}



}
?>