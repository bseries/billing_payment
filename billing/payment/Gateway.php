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

namespace billing_payment\billing\payment;

use RuntimeException;
use base_core\core\Configuration;
use lithium\core\Libraries;

class Gateways {

	use \base_core\core\Configurable;
	use \base_core\core\ConfigurableEnumberation;

	protected static function _initializeConfiguration($config) {
		if (!is_object($config['adapter'])) {
			if (!$class = Libraries::locate('adapter.billing.payment.gateway')) {
				throw new RuntimeException("No adapter class for `{$config['adapter']}` found.");
			}
			$config['adapter'] = new $class['adapter']($config);
		}
		return new Configuration($config);
	}
}

?>