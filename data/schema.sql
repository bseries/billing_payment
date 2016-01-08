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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Augment
ALTER TABLE `users` ADD `payment_method` VARCHAR(100)  NULL  DEFAULT NULL  AFTER `tax_type`;
