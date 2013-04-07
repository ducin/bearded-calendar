-- model script holds relational database tables definitions

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'klucz obcy',
  `username` varchar(32) NOT NULL COMMENT 'login',
  `password` varchar(255) NOT NULL COMMENT 'hasło',
  `first_name` varchar(32) NOT NULL COMMENT 'imię',
  `last_name` varchar(32) NOT NULL COMMENT 'nazwisko',
  `email` varchar(127) DEFAULT NULL COMMENT 'adres e-mail',
  `last_login` datetime DEFAULT NULL COMMENT 'ostatnio zalogowany',
  `created_at` datetime DEFAULT NULL COMMENT 'data utworzenia',
  `updated_at` datetime DEFAULT NULL COMMENT 'data ostatniej aktualizacji',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='użytkownicy' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'klucz główny',
  `user_id` int(10) unsigned NOT NULL COMMENT 'klucz obcy: użytkownik, autor notatki',
  `note_date` date NOT NULL COMMENT 'data',
  `description` varchar(255) NOT NULL COMMENT 'opis',
  `created_at` datetime DEFAULT NULL COMMENT 'data utworzenia',
  `updated_at` datetime DEFAULT NULL COMMENT 'data ostatniej aktualizacji',
  INDEX user_id_note_date_idx (user_id, note_date),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='notatki użytkowników' AUTO_INCREMENT=1;

ALTER TABLE notes ADD CONSTRAINT note_user_id_users_id FOREIGN KEY (user_id) REFERENCES users(id);
