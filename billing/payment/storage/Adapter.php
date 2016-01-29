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

namespace billing_payment\payment;

use UnexpectedValueException;

// This class represents a payment gateway's storage. Wherin we can
// store potentially sensitive data (remotely). So that we don't have
// to be PCI compliant. It works pretty much like a very simple
// key/value store.
abstract class Storage {

	abstract public function write($key, $data);

	abstract public function read($key);

	abstract public function delete($key);
}

?>