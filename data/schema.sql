CREATE TABLE `billing_payments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `billing_invoice_id` int(11) unsigned DEFAULT NULL COMMENT 'may be used when pymnt can be connected to inv',
  `method` varchar(100) NOT NULL DEFAULT '',
  `amount_currency` char(3) NOT NULL DEFAULT 'EUR',
  `amount` int(10) NOT NULL COMMENT 'always gross',
  `date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `billing_invoice_id` (`billing_invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `billing_payment_means` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `payment_method` varchar(100) NOT NULL DEFAULT '',
  `storage_id` varchar(200) DEFAULT NULL COMMENT 'remote',
  `information` text NOT NULL COMMENT 'masked only',
  `user_has_accepted_direct_debit` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'valid if method is debit card',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Augment
ALTER TABLE `users` ADD `payment_method` VARCHAR(100)  NULL  DEFAULT NULL  AFTER `tax_type`;
