-- model script holds relational database tables definitions

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `username` varchar(32) NOT NULL COMMENT 'user login',
  `password` varchar(255) NOT NULL COMMENT 'user password',
  `first_name` varchar(32) NOT NULL COMMENT 'user first name',
  `last_name` varchar(32) NOT NULL COMMENT 'user last name',
  `email` varchar(127) DEFAULT NULL COMMENT 'user email',
  `last_login` datetime DEFAULT NULL COMMENT 'user last login time',
  `created_at` datetime DEFAULT NULL COMMENT 'user account creation time',
  `updated_at` datetime DEFAULT NULL COMMENT 'user account last update time',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='application users' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `user_id` int(10) unsigned NOT NULL COMMENT 'foreign key: the user, note author',
  `note_date` date NOT NULL COMMENT 'note date (it will be visible then)',
  `description` varchar(255) NOT NULL COMMENT 'user note description',
  `created_at` datetime DEFAULT NULL COMMENT 'user note creation time',
  `updated_at` datetime DEFAULT NULL COMMENT 'user note last update time',
  INDEX user_id_note_date_idx (user_id, note_date),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='user notes' AUTO_INCREMENT=1;

ALTER TABLE notes ADD CONSTRAINT note_user_id_users_id FOREIGN KEY (user_id) REFERENCES users(id);
