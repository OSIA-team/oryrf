ALTER TABLE `bel3s`.`kategorie`
  ADD COLUMN `hidden` TINYINT(1) DEFAULT 0 NOT NULL AFTER `topmenu`;

CREATE TABLE priloha
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    menuItem_id INT,
    kategorie_id INT,
    CONSTRAINT priloha_menuitem_id_fk FOREIGN KEY (menuItem_id) REFERENCES menuitem (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT priloha_kategorie_id_fk FOREIGN KEY (kategorie_id) REFERENCES kategorie (id) ON DELETE CASCADE ON UPDATE CASCADE
);
ALTER TABLE priloha COMMENT = 'propojeni priloh s jidlem a kategoriemi';


ALTER TABLE priloha ADD active TINYINT DEFAULT 1 NOT NULL;

ALTER TABLE kategorie ADD visible INT DEFAULT 1 NOT NULL;

INSERT INTO kategorie (nazev, topmenu, url, visible) VALUES ("Neviditelné", 0, "invisible", 0);