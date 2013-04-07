-- prepare environment script shall be executed during installation

CREATE DATABASE `bearded_calendar`;
CREATE USER 'bearded_calendar'@'localhost' IDENTIFIED BY 'Vm0wijYgSY4mtCn7';
GRANT ALL PRIVILEGES ON bearded_calendar.* TO 'bearded_calendar'@'localhost' WITH GRANT OPTION;
