<?php
/**
 * Billing Payment
 *
 * Copyright (c) 2016 Atelier Disko - All rights reserved.
 *
 * Use of this source code is governed by a BSD-style
 * license that can be found in the LICENSE file.
 */

namespace billing_payment\billing\payment;

// This class is loosely modeled upon the Omnipay AbstractGateway. It represents
// a specific payment gateway.
//
// @link https://github.com/thephpleague/omnipay-common/blob/master/src/Omnipay/Common/AbstractGateway.php
abstract class Gateway {

	protected $_config = [];

	public function __construct(array $config) {
		return $this->_config = $config;
	}

	public function __call($name, array $arguments) {
		if (!array_key_exists($name, $this->_config)) {
			throw new BadMethodCallException("Method or configuration `{$name}` does not exist.");
		}
		return $this->_config[$name];
	}

	// Must return the Storage object for this Gateway.
	abstract public function storage();
}

?>