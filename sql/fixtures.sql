-- fixtures script holds test data you can insert into MySQL database to use the calendar immediately

INSERT INTO  `bearded_calendar`.`users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'jl', 'jl', 'John', 'Lennon', 'john.lennon@beatles.com', '1980-12-08 00:00:00', '1940-10-09 00:00:00', '1980-12-08 00:00:00'),
(2, 'pmc', 'pmc', 'Paul', 'McCartney', 'paul.mccartney@beatles.com', '2013-08-24 12:40:00', '1942-06-18 00:00:00', '2013-08-24 12:30:00'),
(3, 'gh', 'gh', 'George', 'Harrison', 'george.harrison@beatles.com', '2001-11-29 00:00:00', '1943-02-25 00:00:00', '2001-11-29 00:00:00'),
(4, 'rs', 'rs', 'Ringo', 'Starr', 'ringo.starr@beatles.com', '2013-08-24 12:40:00', '1940-07-07 00:00:00', '2013-08-24 12:30:00');
