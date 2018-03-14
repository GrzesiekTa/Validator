<?php 

class ErrorHandler 
{
	protected $errors=[];

	public function addError($errors,$key=null)
	{
		if ($key) {
			$this->errors[$key][]=$errors;
		}else{
			$this->errors[]=$errors;
		}
	}

	public function allErrors($key=null)
	{
		return isset($this->errors[$key]) ? $this->errors[$key]: $this->errors;
	}

	public function hasErrors()
	{
		return count ($this->allErrors())? true:false;
	}

	public function firstError($key)
	{
		return isset($this->allErrors()[$key][0]) ? $this->allErrors()[$key][0] : '';
	}
}
 ?>