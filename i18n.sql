# Export von Tabelle i18n
# ------------------------------------------------------------

CREATE TABLE `i18n` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Export von Tabelle i18n_languages
# ------------------------------------------------------------

CREATE TABLE `i18n_languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iso` varchar(10) NOT NULL,
  `name` int(10) unsigned NOT NULL,
  `default` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `iso_UNIQUE` (`iso`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_i18n_languages_i18n1_idx` (`name`),
  CONSTRAINT `fk_i18n_languages_i18n1` FOREIGN KEY (`name`) REFERENCES `i18n` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Export von Tabelle i18n_translations
# ------------------------------------------------------------

CREATE TABLE `i18n_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `i18n_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `value` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_i18n_translations_i18n1_idx` (`i18n_id`),
  KEY `fk_i18n_translations_i18n_languages1_idx` (`language_id`),
  CONSTRAINT `fk_i18n_translations_i18n1` FOREIGN KEY (`i18n_id`) REFERENCES `i18n` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_i18n_translations_i18n_languages1` FOREIGN KEY (`language_id`) REFERENCES `i18n_languages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
