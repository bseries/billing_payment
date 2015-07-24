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

use base_core\extensions\cms\Panes;
use lithium\g11n\Message;

extract(Message::aliases());

Panes::register('billing.payments', [
	'title' => $t('Payments', ['scope' => 'billing_payment']),
	'url' => [
		'library' => 'billing_payment',
		'controller' => 'Payments', 'action' => 'index',
		'admin' => true
	],
	'weight' => 45
]);

?>