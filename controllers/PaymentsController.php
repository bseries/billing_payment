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
 * License. If not, see https://atelierdisko.de/licenses.
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