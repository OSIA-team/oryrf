CREATE TABLE project_info
(
  id                  INT AUTO_INCREMENT
    PRIMARY KEY,
  name                VARCHAR(255) NULL,
  implementation_name VARCHAR(255) NULL,
  value               VARCHAR(255) NULL
)
  ENGINE = InnoDB
  CHARSET = utf8;


CREATE TABLE stranka
(
  id           INT AUTO_INCREMENT
    PRIMARY KEY,
  `key`        VARCHAR(255)           NULL,
  role         VARCHAR(255)           NULL,
  datum        DATE                   NULL,
  pouzito      TINYINT                NULL,
  content      TEXT                   NULL,
  active       TINYINT(3) DEFAULT '0' NOT NULL,
  nazev        VARCHAR(32)            NULL,
  parrent_menu VARCHAR(32)            NULL,
  image        VARCHAR(255)           NULL,
  url          VARCHAR(32)            NULL
)
  ENGINE = InnoDB;

