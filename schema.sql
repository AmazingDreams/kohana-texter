CREATE TABLE IF NOT EXISTS `texter` (
	`key`     VARCHAR(255)   NOT NULL
	, `lang`  VARCHAR(32)    NOT NULL
	, `text`  TEXT           NOT NULL

	, UNIQUE (`key`, `lang`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;
