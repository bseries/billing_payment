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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;