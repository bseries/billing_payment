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