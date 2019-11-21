<?php
/**
 * Billing Payment
 *
 * Copyright (c) 2016 Atelier Disko - All rights reserved.
 *
 * Use of this source code is governed by a BSD-style
 * license that can be found in the LICENSE file.
 */

namespace billing_payment\billing\payment\storage;

class Memory extends \billing_payment\billing\payment\Storage {

	protected $_data = [];

	public function write($key, $data) {
		$this->_data[$key] = $data;
		return true;
	}

	public function read($key) {
		if (!isset($this->_data[$key])) {
			return null;
		}
		return $this->_data[$key];
	}

	public function delete($key) {
		if (!isset($this->_data[$key])) {
			return false;
		}
		unset($this->_data[$key]);
		return true;
	}
}

?>