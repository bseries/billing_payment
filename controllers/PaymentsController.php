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

namespace billing_payment\controllers;

use billing_invoice\models\Invoices;
use billing_payment\models\Payments;
use billing_core\models\Currencies;
use lithium\g11n\Message;
use li3_flash_message\extensions\storage\FlashMessage;

class PaymentsController extends \base_core\controllers\BaseController {

	use \base_core\controllers\AdminIndexTrait;
	use \base_core\controllers\AdminAddTrait;
	use \base_core\controllers\AdminEditTrait;
	use \base_core\controllers\AdminDeleteTrait;
	use \base_core\controllers\UsersTrait;

	protected function _selects($item = null) {
		$currencies = Currencies::find('list');

		if ($item) {
			$users = $this->_users($item, ['field' => 'user_id', 'empty' => true]);
			$invoices = [null => '-'] + Invoices::find('list', [
				'conditions' => [
					'OR' => [
						'user_id' => $item->user_id,
						'id' => $item->billing_invoice_id
					]
				],
				'order' => ['number' => 'DESC']
			]);
			return compact('currencies', 'invoices', 'users');
		}
		return compact('currencies');
	}
}

?>