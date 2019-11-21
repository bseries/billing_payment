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

use billing_payment\billing\payment\Method;

class Methods {

	use \base_core\core\Registerable;
	use \base_core\core\RegisterableEnumeration;

	public static function register($name, array $object) {
		static::$_registry[$name] = new Method($object);
	}
}

?>