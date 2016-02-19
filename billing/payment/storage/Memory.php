<?php
/**
 * Billing Payment
 *
 * Copyright (c) 2016 Atelier Disko - All rights reserved.
 *
 * Licensed under the AD General Software License v1.
 *
 * This software is proprietary and confidential. Redistribution
 * not permitted. Unless required by applicable law or agreed to
 * in writing, software distributed on an "AS IS" BASIS, WITHOUT-
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *
 * You should have received a copy of the AD General Software
 * License. If not, see http://atelierdisko.de/licenses.
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