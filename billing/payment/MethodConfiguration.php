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

class MethodConfiguration extends \base_core\core\Configuration {

	public function __construct(array $config = []) {
		$config += [
			// The (display) title of the method, can also be an anonymous function.
			'title' => $data['name'],

			'gateway' => null,

			// Set of conditions of which any must be fulfilled, so
			// that the method is made available to a user.
			'access' => ['user.role:admin'],

			// The fee applied when using the payment method.
			'price' => new NullPrice(),

			// Dependent on $format return either HTML or plaintext. Can be an anonymous function.
			'info' => null
		];
		parent::__construct($config);
	}

	// Retrieves the Gateway adapter object for the payment method. Each payment method
	// specifies which gateway it intends to use, using the following notation.
	//
	// Gateway provided by the B-Series : `'banquePayPal'`
	// --------- " ------- Omnipay      : `'omnipayPayPal'`
	//
	// @link http://omnipay.thephpleague.com/
	public function gateway() {
		return Gateway::config($this->_data['gateway'])->adapter;
	}

	public function title() {
		return is_callable($value = $this->_data[__FUNCTION__]) ? $value() : $value;
	}

	public function price($user, $cart) {
		return is_callable($value = $this->_data[__FUNCTION__]) ? $value($user, $cart) : $value;
	}

	public function info($entity, $context, $format, $renderer, $order) {
		return is_callable($value = $this->_data[__FUNCTION__]) ? $value($context, $format, $renderer, $order) : $value;
	}
}

?>