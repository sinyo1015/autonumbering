<?php

namespace Sinyo1015\AutoNumbering;

use Sinyo1015\AutoNumbering\Exception\MissingArgumentException;
use Sinyo1015\AutoNumbering\Exception\StringLengthException;

class AutoNumber{
	protected $prefix;
	protected $lastIndex;
	protected $indexNext;

	public function __construct($prefix, $indexNext, $lastIndex){
		if($prefix == null || $lastIndex == null || $indexNext == null){
			throw new MissingArgumentException("\$prefix \/ \$lastIndex \/ \$indexNext Must Not Null");
		}
		else{
			$this->prefix = $prefix;
			$this->lastIndex = $lastIndex;
			$this->indexNext = $indexNext;
		}

		if($lastIndex < strlen($prefix)){
			throw new StringLengthException("\$lastIndex must not be a negative numbers");
		}
	}

	public function make($existing){

		if($existing === null){
			throw new MissingArgumentException("\$existing parameter needed for adding last number");
		}

		$number = (int) substr($existing, $this->indexNext, $this->lastIndex);

		$newNumber = $number + 1;

		$realLength = ($this->lastIndex - $this->indexNext);

		$formatter = "%0" . $realLength . "s";

		return $this->prefix . sprintf($formatter, $newNumber);
	}
}