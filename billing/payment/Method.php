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

use billing_payment\billing\payment\MethodConfiguration;

class Method {

	use \base_core\core\Configurable;
	use \base_core\core\ConfigurableEnumeration;

	protected static function _config($config) {
		return new MethodConfiguration($config);
	}
}

?>