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

use billing_payment\billing\payment\Method;

class Methods {

	use \base_core\core\Registerable;
	use \base_core\core\RegisterableEnumeration;

	public static function register($name, Method $object) {
		static::$_registry[$name] = $object;
	}
}

?>