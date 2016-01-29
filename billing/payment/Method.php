<?php
/**
 * Billing Payment
 *
 * Copyright (c) 2014 Atelier Disko - All rights reserved.
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

namespace billing_payment\billing\payment;

use AD\Finance\Price\NullPrice;
use BadMethodCallException;
use billing_payment\billing\payment\Gateways;
use li3_access\security\Access;

class Method {

	protected $_config = [];

	public function __construct(array $config) {
		if (isset($config['access'])) {
			$config['access'] = (array) $config['access'];
		}
		return $this->_config = $config + [
			// The (display) title of the method, can also be an anonymous function.
			'title' => null,

			// Name of the gateway configuration to use.
			'gateway' => null,

			// Set of conditions of which any must be fulfilled, so
			// that the method is made available to a user.
			'access' => ['user.role:admin'],

			// The fee applied when using the payment method. Can also be a callable.
			'price' => new NullPrice(),

			// Dependent on $format return either HTML or plaintext. Can be an anonymous function.
			'info' => null
		];
	}

	public function __call($name, array $arguments) {
		if (!array_key_exists($name, $this->_config)) {
			throw new BadMethodCallException("Method or configuration `{$name}` does not exist.");
		}
		return $this->_config[$name];
	}

	public function hasAccess($user) {
		return Access::check(
			'entity',
			$user,
			$this,
			$this->_config['access']
		);
	}

	// Retrieves the Gateway adapter object for the payment method. Each payment method
	// specifies which gateway it intends to use, using the following notation.
	//
	// Gateway provided by the B-Series : `'banquePayPal'`
	// --------- " ------- Omnipay      : `'omnipayPayPal'`
	//
	// @link http://omnipay.thephpleague.com/
	public function gateway() {
		return Gateways::registry($this->_config['gateway']);
	}

	public function title() {
		return is_callable($value = $this->_config[__FUNCTION__]) ? $value() : $value;
	}

	public function price($user, $cart) {
		return is_callable($value = $this->_config[__FUNCTION__]) ? $value($user, $cart) : $value;
	}

	public function info($entity, $context, $format, $renderer, $order) {
		return is_callable($value = $this->_config[__FUNCTION__]) ? $value($context, $format, $renderer, $order) : $value;
	}
}

?>