<?php

class Hash extends phpseclib\Crypt\Hash {

	public function __construct($hash = 'sha512')
	{
		parent::__construct($hash);
	}

	/**
	 * Compute the HMAC.
	 *
	 * @access public
	 * @param string $text
	 * @return string
	 */
	function hash($text, $return_binary = FALSE)
	{
		if (!is_bool($return_binary))
		{
			throw new Exception('$return_binary must be boolean');
		}

		$output = !empty($this->key) || is_string($this->key) ?
				hash_hmac($this->hash, $text, $this->key, $return_binary) :
				hash($this->hash, $text, $return_binary);

		return strlen($output) > $this->length ? substr($output, 0, $this->length) : $output;
	}

}
