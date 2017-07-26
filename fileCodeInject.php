<?php
/**
 * Created by PhpStorm.
 * User: LoicHa
 * Date: 26/07/2017
 * Time: 09:46
 */

class FileCodeInject
{
	private $filename = false;
	private $filenameContent = null;
	function __construct($file)
	{
		if(file_exists($file))
			$this->filename = $file;
	}
	
	
	public function getContent()
	{
		$this->filenameContent = file_get_contents($this->filename);
		return $this->filenameContent;
	}
	
	public function injectCode($code, $find, $position = 'before', $append = true, $newline = true)
	{
		$newline = $newline ? PHP_EOL  : '';
		if(!$append)
		{
			file_put_contents($this->filename,$code);
			$this->filenameContent = $code;
			return;
		}
		if($position == 'top')
		{
			$this->filenameContent = $code.$newline.$this->filenameContent;
			file_put_contents($this->filename,$this->filenameContent);
			return;
		}
		if($position == 'bottom')
		{
			$this->filenameContent = $this->filenameContent.$newline.$code;
			file_put_contents($this->filename,$this->filenameContent);
			return;
		}
		if($find)
		{
			
			if($position == 'before')
			{
				$this->filenameContent =  str_replace($find, $code . $newline . $find, $this->filenameContent);
				file_put_contents($this->filename,$this->filenameContent);
				return;
			}
			elseif($position == 'after')
			{
				$this->filenameContent =  str_replace($find, $find. $newline  .$code , $this->filenameContent);
				file_put_contents($this->filename,$this->filenameContent);
			}
		}
	}
}