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

namespace billing_payment\models;

use UnexpectedValueException;

// @see base_core\models\BaseRegister
// @see billing_payment\models\PaymentGateways::_register()
class PaymentGateways extends \base_core\models\BaseRegister {

	protected static function _register(array $data) {
		return $data + [
			// The (display) title of the method, can also be an anonymous function.
			// @see billing_core\models\PaymentGateways::title()
			'title' => $data['name']
		];
	}
}

?>