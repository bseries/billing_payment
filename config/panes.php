<?php
/**
 * Billing Payment
 *
 * Copyright (c) 2015 David Persson - All rights reserved.
 * Copyright (c) 2016 Atelier Disko - All rights reserved.
 *
 * Use of this source code is governed by a BSD-style
 * license that can be found in the LICENSE file.
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
	'weight' => 42
]);

?>
