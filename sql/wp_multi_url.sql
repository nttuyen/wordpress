CREATE  TABLE `wp_multiurl` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `url` VARCHAR(250) NOT NULL ,
  `theme` VARCHAR(250) NOT NULL ,
  `description` VARCHAR(500) NULL ,
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  `wp_url_cat` (
  `url_id` INT NOT NULL ,
  `cat_id` INT NOT NULL ,
  PRIMARY KEY (`url_id`, `cat_id`) 
)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
ALTER TABLE `wp_url_cat` CHANGE COLUMN `cat_id` `cat_id` BIGINT NOT NULL  ;

