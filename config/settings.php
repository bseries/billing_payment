<?php
/**
 * Billing Payment
 *
 * Copyright (c) 2014 Atelier Disko - All rights reserved.
 *
 * This software is proprietary and confidential. Redistribution
 * not permitted. Unless required by applicable law or agreed to
 * in writing, software distributed on an "AS IS" BASIS, WITHOUT-
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 */

namespace billing_payment\config;

use base_core\extensions\cms\Settings;

Settings::register('service.paypal.default', [
	'email' => null
]);
Settings::register('service.bank.default', [
	'holder' => null,
	'bank' => null,
	'bic' => null,
	'iban' => null,
	'code' => null,
	'account' => null
]);

?>