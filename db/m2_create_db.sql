SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `m2` ;
CREATE SCHEMA IF NOT EXISTS `m2` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `m2` ;

-- -----------------------------------------------------
-- Table `m2`.`white_label`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `m2`.`white_label` ;

CREATE  TABLE IF NOT EXISTS `m2`.`white_label` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `descr` VARCHAR(180) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `created_at` TIMESTAMP NULL DEFAULT NULL ,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `ix_white_label_id` (`id` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `m2`.`activities`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `m2`.`activities` ;

CREATE  TABLE IF NOT EXISTS `m2`.`activities` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `wl_id` INT NOT NULL ,
  `name` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `multiplicity` INT NULL DEFAULT NULL ,
  `severity` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `unit` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `desc` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `created_at` DATETIME NULL DEFAULT NULL ,
  `updated_at` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_activities_white_label1` (`wl_id` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  CONSTRAINT `fk_activities_white_label1`
    FOREIGN KEY (`wl_id` )
    REFERENCES `m2`.`white_label` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 51
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `m2`.`municipals`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `m2`.`municipals` ;

CREATE  TABLE IF NOT EXISTS `m2`.`municipals` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `country_id` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `code` VARCHAR(45) NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `ix_municipals_id` (`id` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'All the roles in used motiomera ';


-- -----------------------------------------------------
-- Table `m2`.`sources`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `m2`.`sources` ;

CREATE  TABLE IF NOT EXISTS `m2`.`sources` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `wl_id` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `descr` VARCHAR(45) NULL ,
  `type` VARCHAR(45) NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sources_white_label1` (`wl_id` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  CONSTRAINT `fk_sources_white_label1`
    FOREIGN KEY (`wl_id` )
    REFERENCES `m2`.`white_label` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `m2`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `m2`.`roles` ;

CREATE  TABLE IF NOT EXISTS `m2`.`roles` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `level` INT NOT NULL ,
  `descr` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `name` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `level_UNIQUE` (`level` ASC) ,
  INDEX `ix_roles_level` (`level` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 14
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `m2`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `m2`.`users` ;

CREATE  TABLE IF NOT EXISTS `m2`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `municipal_id` INT NULL ,
  `wl_id` INT NOT NULL ,
  `level` INT NOT NULL ,
  `email` VARCHAR(45) NULL ,
  `email_confirmed` INT NULL ,
  `password` VARCHAR(45) NULL ,
  `f_name` VARCHAR(45) NULL ,
  `l_name` VARCHAR(45) NULL ,
  `nick` VARCHAR(45) NULL ,
  `sex` ENUM('FEMALE', 'MALE') NULL ,
  `born` DATETIME NULL ,
  `descr` VARCHAR(45) NULL ,
  `last_login` DATETIME NULL ,
  `img_filename` VARCHAR(128) NULL ,
  `avatar_filename` VARCHAR(128) NULL ,
  `customer_id` VARCHAR(45) NULL ,
  `paid_until` DATETIME NULL ,
  `trophy_start` DATETIME NULL ,
  `status` VARCHAR(140) NULL ,
  `company_key_temp` VARCHAR(45) NULL ,
  `sources_id` INT NULL ,
  `total_steps` INT NULL ,
  `total_steps_current` INT NULL ,
  `total_logins` INT NULL ,
  `total_regs` INT NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_users_municipals1` (`municipal_id` ASC) ,
  INDEX `fk_users_white_label1` (`wl_id` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_users_sources1` (`sources_id` ASC) ,
  INDEX `fk_users_roles1` (`level` ASC) ,
  CONSTRAINT `fk_users_municipals1`
    FOREIGN KEY (`municipal_id` )
    REFERENCES `m2`.`municipals` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_white_label1`
    FOREIGN KEY (`wl_id` )
    REFERENCES `m2`.`white_label` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_sources1`
    FOREIGN KEY (`sources_id` )
    REFERENCES `m2`.`sources` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_roles1`
    FOREIGN KEY (`level` )
    REFERENCES `m2`.`roles` (`level` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `m2`.`companys`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `m2`.`companys` ;

CREATE  TABLE IF NOT EXISTS `m2`.`companys` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `wl_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  `source_id` INT NULL ,
  `name` VARCHAR(45) NULL ,
  `customer_id` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `is_valid` TINYINT(1) NULL DEFAULT NULL ,
  `source` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `tmp_password` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `created_at` DATETIME NULL DEFAULT NULL ,
  `updated_at` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_companys_white_label1` (`wl_id` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_companys_users1` (`user_id` ASC) ,
  INDEX `fk_companys_sources1` (`source_id` ASC) ,
  CONSTRAINT `fk_companys_white_label1`
    FOREIGN KEY (`wl_id` )
    REFERENCES `m2`.`white_label` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_companys_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `m2`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_companys_sources1`
    FOREIGN KEY (`source_id` )
    REFERENCES `m2`.`sources` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `m2`.`trades`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `m2`.`trades` ;

CREATE  TABLE IF NOT EXISTS `m2`.`trades` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `wl_id` INT NOT NULL ,
  `name` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `created_at` DATETIME NULL DEFAULT NULL ,
  `updated_at` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_trades_white_label1` (`wl_id` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  CONSTRAINT `fk_trades_white_label1`
    FOREIGN KEY (`wl_id` )
    REFERENCES `m2`.`white_label` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `m2`.`drives`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `m2`.`drives` ;

CREATE  TABLE IF NOT EXISTS `m2`.`drives` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `wl_id` INT NOT NULL ,
  `name` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `nof_weeks` INT NULL DEFAULT NULL ,
  `start` DATETIME NULL DEFAULT NULL ,
  `stop` DATETIME NULL DEFAULT NULL ,
  `created_at` DATETIME NULL DEFAULT NULL ,
  `updated_at` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_drives_white_label1` (`wl_id` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  CONSTRAINT `fk_drives_white_label1`
    FOREIGN KEY (`wl_id` )
    REFERENCES `m2`.`white_label` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `m2`.`contests`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `m2`.`contests` ;

CREATE  TABLE IF NOT EXISTS `m2`.`contests` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `company_id` INT NOT NULL ,
  `drive_id` INT NULL DEFAULT NULL ,
  `trade_id` INT NULL DEFAULT NULL ,
  `start` DATETIME NULL DEFAULT NULL ,
  `stop` DATETIME NULL DEFAULT NULL ,
  `nof_weeks` INT NULL DEFAULT NULL ,
  `route_xxx` INT NULL DEFAULT NULL ,
  `created_at` DATETIME NULL DEFAULT NULL ,
  `updated_at` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_contest_trades` (`trade_id` ASC) ,
  INDEX `fk_contest_drives1` (`drive_id` ASC) ,
  INDEX `fk_contest_companys1` (`company_id` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  CONSTRAINT `fk_contest_trades`
    FOREIGN KEY (`trade_id` )
    REFERENCES `m2`.`trades` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contest_drives1`
    FOREIGN KEY (`drive_id` )
    REFERENCES `m2`.`drives` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contest_companys1`
    FOREIGN KEY (`company_id` )
    REFERENCES `m2`.`companys` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `m2`.`teams`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `m2`.`teams` ;

CREATE  TABLE IF NOT EXISTS `m2`.`teams` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `contest_id` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `total_steps` INT NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_teams_contests1` (`contest_id` ASC) ,
  CONSTRAINT `fk_teams_contests1`
    FOREIGN KEY (`contest_id` )
    REFERENCES `m2`.`contests` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `m2`.`keys`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `m2`.`keys` ;

CREATE  TABLE IF NOT EXISTS `m2`.`keys` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `contest_id` INT NOT NULL ,
  `user_id` INT NULL ,
  `team_id` INT NULL ,
  `key` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `created_at` DATETIME NULL DEFAULT NULL ,
  `updated_at` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_keys_contest1` (`contest_id` ASC) ,
  INDEX `fk_keys_users1` (`user_id` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_keys_teams1` (`team_id` ASC) ,
  CONSTRAINT `fk_keys_contest1`
    FOREIGN KEY (`contest_id` )
    REFERENCES `m2`.`contests` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_keys_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `m2`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_keys_teams1`
    FOREIGN KEY (`team_id` )
    REFERENCES `m2`.`teams` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `m2`.`steps`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `m2`.`steps` ;

CREATE  TABLE IF NOT EXISTS `m2`.`steps` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `activity_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  `count` INT NULL DEFAULT NULL ,
  `steps` INT NULL DEFAULT NULL ,
  `date` DATE NULL DEFAULT NULL ,
  `status` ENUM('TEMP','VALID','DEL') CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `created_at` DATETIME NULL DEFAULT NULL ,
  `updated_at` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_steps_activities1` (`activity_id` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_steps_users1` (`user_id` ASC) ,
  CONSTRAINT `fk_steps_activities1`
    FOREIGN KEY (`activity_id` )
    REFERENCES `m2`.`activities` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_steps_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `m2`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 286
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `m2`.`temp`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `m2`.`temp` ;

CREATE  TABLE IF NOT EXISTS `m2`.`temp` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `descr` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `m2`.`addresses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `m2`.`addresses` ;

CREATE  TABLE IF NOT EXISTS `m2`.`addresses` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `company_id` INT NULL ,
  `user_id` INT NULL ,
  `type` ENUM('PAYER','RECEIVER','PRIVATE') NOT NULL ,
  `company_name` VARCHAR(45) NULL ,
  `ref_name` VARCHAR(45) NULL ,
  `address1` VARCHAR(45) NULL ,
  `address2` VARCHAR(45) NULL ,
  `co` VARCHAR(45) NULL ,
  `zip` VARCHAR(45) NULL ,
  `city` VARCHAR(45) NULL ,
  `email` VARCHAR(45) NULL ,
  `phone` VARCHAR(45) NULL ,
  `mobile` VARCHAR(45) NULL ,
  `country` VARCHAR(45) NULL ,
  `organisation_no` VARCHAR(45) NULL ,
  `tax_code` VARCHAR(45) NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_addresses_companys1` (`company_id` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_addresses_users1` (`user_id` ASC) ,
  CONSTRAINT `fk_addresses_companys1`
    FOREIGN KEY (`company_id` )
    REFERENCES `m2`.`companys` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_addresses_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `m2`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `m2`.`contest_dates`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `m2`.`contest_dates` ;

CREATE  TABLE IF NOT EXISTS `m2`.`contest_dates` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `contest_id` INT NOT NULL ,
  `date` DATETIME NOT NULL ,
  `type` VARCHAR(45) NOT NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_contest_dates_contests1` (`contest_id` ASC) ,
  CONSTRAINT `fk_contest_dates_contests1`
    FOREIGN KEY (`contest_id` )
    REFERENCES `m2`.`contests` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- procedure insert_steps
-- -----------------------------------------------------

USE `m2`;
DROP procedure IF EXISTS `m2`.`insert_steps`;

DELIMITER $$
USE `m2`$$
CREATE DEFINER=`root`@`tdm013143ib` PROCEDURE `insert_steps`( IN in_user_id INT, IN in_activity_id INT, IN in_count INT, IN in_step_date DATE)
BEGIN
/*
calculates actual steps from activity_id
inserts a new row to 'steps'
calculates total steps and total nbr of inserts per user
updates 'users' with that data
it selectes the last insert id (from 'steps') (and returns it)

kristian erendi 2011
*/

DECLARE v_calc_steps INT;
DECLARE v_total_steps INT;
DECLARE v_total_regs INT;



SELECT (multiplicity * in_count) FROM activities WHERE id = in_activity_id INTO v_calc_steps;
INSERT INTO steps (user_id, activity_id, count, steps, created_at, updated_at, date, status) 
  VALUES (in_user_id, in_activity_id, in_count, v_calc_steps, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, in_step_date, 'VALID');
SELECT LAST_INSERT_ID() step_id;

-- SELECT @steps:=sum(steps), @regs:=COUNT(id) FROM steps WHERE user_id = in_user_id;
SELECT sum(steps) FROM steps WHERE user_id = in_user_id INTO v_total_steps;
SELECT COUNT(id) FROM steps WHERE user_id = in_user_id INTO v_total_regs;
UPDATE users SET total_steps = v_total_steps, total_regs = v_total_regs, updated_at = CURRENT_TIMESTAMP WHERE id = in_user_id;
-- UPDATE users SET total_steps = @steps, total_regs = @regs WHERE id = in_user_id;



END$$

DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `m2`.`white_label`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `m2`;
INSERT INTO `m2`.`white_label` (`id`, `name`, `descr`, `created_at`, `updated_at`) VALUES ('1', 'Aller media', 'Aller media i sverige', '2011-03-29 12:00:00', '2011-03-29 12:00:00');
INSERT INTO `m2`.`white_label` (`id`, `name`, `descr`, `created_at`, `updated_at`) VALUES ('2', 'Boyhappy', 'Cool slick and smooth', '2011-03-29 12:00:00', '2011-03-29 12:00:00');
INSERT INTO `m2`.`white_label` (`id`, `name`, `descr`, `created_at`, `updated_at`) VALUES ('3', 'Aller CAE', 'Aller i danmark', '2011-03-29 12:00:00', '2011-03-29 12:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `m2`.`activities`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `m2`;
INSERT INTO `m2`.`activities` (`id`, `wl_id`, `name`, `multiplicity`, `severity`, `unit`, `desc`, `created_at`, `updated_at`) VALUES ('1', '1', 'steg', '1', '', '', NULL, '2011-03-03 12:00:00', '2011-03-03 12:00:00');
INSERT INTO `m2`.`activities` (`id`, `wl_id`, `name`, `multiplicity`, `severity`, `unit`, `desc`, `created_at`, `updated_at`) VALUES ('2', '1', 'cykling', '50', 'medel', 'min', NULL, '2011-03-03 12:00:00', '2011-03-03 12:00:00');
INSERT INTO `m2`.`activities` (`id`, `wl_id`, `name`, `multiplicity`, `severity`, `unit`, `desc`, `created_at`, `updated_at`) VALUES ('3', '1', 'cykling', '100', 'svår', 'min', NULL, '2011-03-03 12:00:00', '2011-03-03 12:00:00');
INSERT INTO `m2`.`activities` (`id`, `wl_id`, `name`, `multiplicity`, `severity`, `unit`, `desc`, `created_at`, `updated_at`) VALUES ('4', '1', 'cykling', '30', 'lätt', 'min', NULL, '2011-03-03 12:00:00', '2011-03-03 12:00:00');
INSERT INTO `m2`.`activities` (`id`, `wl_id`, `name`, `multiplicity`, `severity`, `unit`, `desc`, `created_at`, `updated_at`) VALUES ('5', '2', 'skateboard', '30', 'smooth', 'km', NULL, '2011-03-03 12:00:00', '2011-03-03 12:00:00');
INSERT INTO `m2`.`activities` (`id`, `wl_id`, `name`, `multiplicity`, `severity`, `unit`, `desc`, `created_at`, `updated_at`) VALUES ('6', '2', 'skateboard', '40', 'cool', 'km', NULL, '2011-03-03 12:00:00', '2011-03-03 12:00:00');
INSERT INTO `m2`.`activities` (`id`, `wl_id`, `name`, `multiplicity`, `severity`, `unit`, `desc`, `created_at`, `updated_at`) VALUES ('7', '1', 'innebandy', '80', 'tuff', 'min', NULL, '2011-03-03 12:00:00', '2011-03-03 12:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `m2`.`municipals`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `m2`;
INSERT INTO `m2`.`municipals` (`id`, `country_id`, `name`, `code`, `created_at`, `updated_at`) VALUES ('1', '46', 'Helsingborg', '1283', '2011-03-03 12:00:00', '2011-03-03 12:00:00');
INSERT INTO `m2`.`municipals` (`id`, `country_id`, `name`, `code`, `created_at`, `updated_at`) VALUES ('2', '46', 'Varberg', '1383', '2011-03-03 12:00:00', '2011-03-03 12:00:00');
INSERT INTO `m2`.`municipals` (`id`, `country_id`, `name`, `code`, `created_at`, `updated_at`) VALUES ('3', '46', 'Båstad', '1278', '2011-03-03 12:00:00', '2011-03-03 12:00:00');
INSERT INTO `m2`.`municipals` (`id`, `country_id`, `name`, `code`, `created_at`, `updated_at`) VALUES ('4', '45', 'Köpenhavn', '1', '2011-03-03 12:00:00', '2011-03-03 12:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `m2`.`roles`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `m2`;
INSERT INTO `m2`.`roles` (`id`, `level`, `descr`, `name`, `created_at`, `updated_at`) VALUES ('1', '11', 'trial user', 'user_trial', '2011-03-30 10:00:00', '2011-03-30 10:00:00');
INSERT INTO `m2`.`roles` (`id`, `level`, `descr`, `name`, `created_at`, `updated_at`) VALUES ('2', '12', 'campaign user', 'user_campaign', '2011-03-30 10:00:00', '2011-03-30 10:00:00');
INSERT INTO `m2`.`roles` (`id`, `level`, `descr`, `name`, `created_at`, `updated_at`) VALUES ('3', '19', 'normal user', 'user', '2011-03-30 10:00:00', '2011-03-30 10:00:00');
INSERT INTO `m2`.`roles` (`id`, `level`, `descr`, `name`, `created_at`, `updated_at`) VALUES ('4', '41', 'company admin ', 'admin_company', '2011-03-30 10:00:00', '2011-03-30 10:00:00');
INSERT INTO `m2`.`roles` (`id`, `level`, `descr`, `name`, `created_at`, `updated_at`) VALUES ('5', '51', 'support admin', 'admin_support', '2011-03-30 10:00:00', '2011-03-30 10:00:00');
INSERT INTO `m2`.`roles` (`id`, `level`, `descr`, `name`, `created_at`, `updated_at`) VALUES ('6', '71', 'white label admin', 'admin_white_label', '2011-03-30 10:00:00', '2011-03-30 10:00:00');
INSERT INTO `m2`.`roles` (`id`, `level`, `descr`, `name`, `created_at`, `updated_at`) VALUES ('7', '99', 'superadmin', 'superadmin', '2011-03-30 10:00:00', '2011-03-30 10:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `m2`.`users`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `m2`;
INSERT INTO `m2`.`users` (`id`, `municipal_id`, `wl_id`, `level`, `email`, `email_confirmed`, `password`, `f_name`, `l_name`, `nick`, `sex`, `born`, `descr`, `last_login`, `img_filename`, `avatar_filename`, `customer_id`, `paid_until`, `trophy_start`, `status`, `company_key_temp`, `sources_id`, `total_steps`, `total_steps_current`, `total_logins`, `total_regs`, `created_at`, `updated_at`) VALUES ('1', '1', '1', '99', 'krillo@gmail.com', '1', 'kapten', 'krillo', 'superadmin', '99', 'MALE', '1977-03-03 12:00:00', NULL, NULL, NULL, 'avatar1.gif', NULL, '2012-03-03 12:00:00', '2011-03-03 12:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-03-03 12:00:00', '2011-03-03 12:00:00');
INSERT INTO `m2`.`users` (`id`, `municipal_id`, `wl_id`, `level`, `email`, `email_confirmed`, `password`, `f_name`, `l_name`, `nick`, `sex`, `born`, `descr`, `last_login`, `img_filename`, `avatar_filename`, `customer_id`, `paid_until`, `trophy_start`, `status`, `company_key_temp`, `sources_id`, `total_steps`, `total_steps_current`, `total_logins`, `total_regs`, `created_at`, `updated_at`) VALUES ('2', '3', '1', '51', 'emma@boyhappy.se', '1', 'kapten', 'emma', 'p', '41', 'FEMALE', '1977-03-03 12:00:00', NULL, NULL, NULL, 'avatar7.gif', NULL, '2012-03-03 12:00:00', '2011-03-03 12:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-03-03 12:00:00', '2011-03-03 12:00:00');
INSERT INTO `m2`.`users` (`id`, `municipal_id`, `wl_id`, `level`, `email`, `email_confirmed`, `password`, `f_name`, `l_name`, `nick`, `sex`, `born`, `descr`, `last_login`, `img_filename`, `avatar_filename`, `customer_id`, `paid_until`, `trophy_start`, `status`, `company_key_temp`, `sources_id`, `total_steps`, `total_steps_current`, `total_logins`, `total_regs`, `created_at`, `updated_at`) VALUES ('3', '2', '1', '19', 'user@boyhappy.se', '1', 'kapten', 'normal', 'user', '19', 'FEMALE', '1977-03-03 12:00:00', NULL, NULL, NULL, 'avatar2.gif', NULL, '2012-03-03 12:00:00', '2011-03-03 12:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-03-03 12:00:00', '2011-03-03 12:00:00');
INSERT INTO `m2`.`users` (`id`, `municipal_id`, `wl_id`, `level`, `email`, `email_confirmed`, `password`, `f_name`, `l_name`, `nick`, `sex`, `born`, `descr`, `last_login`, `img_filename`, `avatar_filename`, `customer_id`, `paid_until`, `trophy_start`, `status`, `company_key_temp`, `sources_id`, `total_steps`, `total_steps_current`, `total_logins`, `total_regs`, `created_at`, `updated_at`) VALUES ('4', '2', '2', '19', 'user2@boyhappy.se', '1', 'kapten', 'wl2', 'user', 'wl19', 'MALE', '1977-03-03 12:00:00', NULL, NULL, NULL, 'avatar3.gif', NULL, '2012-03-03 12:00:00', '2011-03-03 12:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-03-03 12:00:00', '2011-03-03 12:00:00');
INSERT INTO `m2`.`users` (`id`, `municipal_id`, `wl_id`, `level`, `email`, `email_confirmed`, `password`, `f_name`, `l_name`, `nick`, `sex`, `born`, `descr`, `last_login`, `img_filename`, `avatar_filename`, `customer_id`, `paid_until`, `trophy_start`, `status`, `company_key_temp`, `sources_id`, `total_steps`, `total_steps_current`, `total_logins`, `total_regs`, `created_at`, `updated_at`) VALUES ('5', '3', '2', '71', 'admin2@boyhappy.se', '1', 'kapten', 'wl2-admin', 'admin', 'wl71', 'MALE', '1977-03-03 12:00:00', NULL, NULL, NULL, 'avatar3.gif', NULL, '2012-03-03 12:00:00', '2011-03-03 12:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-03-03 12:00:00', '2011-03-03 12:00:00');
INSERT INTO `m2`.`users` (`id`, `municipal_id`, `wl_id`, `level`, `email`, `email_confirmed`, `password`, `f_name`, `l_name`, `nick`, `sex`, `born`, `descr`, `last_login`, `img_filename`, `avatar_filename`, `customer_id`, `paid_until`, `trophy_start`, `status`, `company_key_temp`, `sources_id`, `total_steps`, `total_steps_current`, `total_logins`, `total_regs`, `created_at`, `updated_at`) VALUES ('6', '1', '1', '41', 'novo@boyhappy.se', '1', 'kapten', 'novoboy', 'admin', 'novo', 'FEMALE', '1977-03-03 12:00:00', NULL, NULL, NULL, 'avatar5.gif', NULL, '2012-03-03 12:00:00', '2011-03-03 12:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-03-03 12:00:00', '2011-03-03 12:00:00');
INSERT INTO `m2`.`users` (`id`, `municipal_id`, `wl_id`, `level`, `email`, `email_confirmed`, `password`, `f_name`, `l_name`, `nick`, `sex`, `born`, `descr`, `last_login`, `img_filename`, `avatar_filename`, `customer_id`, `paid_until`, `trophy_start`, `status`, `company_key_temp`, `sources_id`, `total_steps`, `total_steps_current`, `total_logins`, `total_regs`, `created_at`, `updated_at`) VALUES ('7', '3', '1', '19', 'jams@boyhappy.se', '1', 'kapten', 'James', 'Withouse', 'Bullbull', 'MALE', '1977-03-03 12:00:00', NULL, NULL, NULL, 'avatar6.gif', NULL, '2012-03-03 12:00:00', '2012-03-03 12:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-03-03 12:00:00', '2012-03-03 12:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `m2`.`companys`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `m2`;
INSERT INTO `m2`.`companys` (`id`, `wl_id`, `user_id`, `source_id`, `name`, `customer_id`, `is_valid`, `source`, `tmp_password`, `created_at`, `updated_at`) VALUES ('1', '1', '1', NULL, 'Boy Interactive Ltd', '1111', '1', NULL, NULL, '2011-03-03 12:00:00', '2011-03-03 12:00:00');
INSERT INTO `m2`.`companys` (`id`, `wl_id`, `user_id`, `source_id`, `name`, `customer_id`, `is_valid`, `source`, `tmp_password`, `created_at`, `updated_at`) VALUES ('2', '1', '6', NULL, 'Triserpiaan global', '2222', '1', NULL, NULL, '2011-03-03 12:00:00', '2011-03-03 12:00:00');
INSERT INTO `m2`.`companys` (`id`, `wl_id`, `user_id`, `source_id`, `name`, `customer_id`, `is_valid`, `source`, `tmp_password`, `created_at`, `updated_at`) VALUES ('3', '2', '5', NULL, 'Vourff Ag', '3333', '1', NULL, NULL, '2011-03-03 12:00:00', '2011-03-03 12:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `m2`.`drives`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `m2`;
INSERT INTO `m2`.`drives` (`id`, `wl_id`, `name`, `nof_weeks`, `start`, `stop`, `created_at`, `updated_at`) VALUES ('1', '1', 'Vårkampanjen 2011', '5', '2011-03-29 00:00:00', '2011-05-02 00:00:00', '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`drives` (`id`, `wl_id`, `name`, `nof_weeks`, `start`, `stop`, `created_at`, `updated_at`) VALUES ('2', '1', 'Kullakampanjen 2011', '2', '2011-04-11 00:00:00', '2011-04-24 00:00:00', '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`drives` (`id`, `wl_id`, `name`, `nof_weeks`, `start`, `stop`, `created_at`, `updated_at`) VALUES ('3', '2', 'Transporters campaign', '6', '2011-03-14 00:00:00', '2011-04-24 00:00:00', '2011-03-03 00:00:00', '2011-03-03 00:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `m2`.`contests`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `m2`;
INSERT INTO `m2`.`contests` (`id`, `company_id`, `drive_id`, `trade_id`, `start`, `stop`, `nof_weeks`, `route_xxx`, `created_at`, `updated_at`) VALUES ('1', '1', NULL, NULL, '2010-02-28 00:00:00', '2010-05-01 00:00:00', '6', NULL, '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`contests` (`id`, `company_id`, `drive_id`, `trade_id`, `start`, `stop`, `nof_weeks`, `route_xxx`, `created_at`, `updated_at`) VALUES ('2', '1', '1', NULL, '2011-03-29 00:00:00', '2011-05-01 00:00:00', '5', NULL, '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`contests` (`id`, `company_id`, `drive_id`, `trade_id`, `start`, `stop`, `nof_weeks`, `route_xxx`, `created_at`, `updated_at`) VALUES ('3', '3', '1', NULL, '2011-03-29 00:00:00', '2011-05-01 00:00:00', '5', NULL, '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`contests` (`id`, `company_id`, `drive_id`, `trade_id`, `start`, `stop`, `nof_weeks`, `route_xxx`, `created_at`, `updated_at`) VALUES ('4', '2', '2', NULL, '2011-04-04 00:00:00', '2011-04-17 00:00:00', '2', NULL, '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`contests` (`id`, `company_id`, `drive_id`, `trade_id`, `start`, `stop`, `nof_weeks`, `route_xxx`, `created_at`, `updated_at`) VALUES ('5', '1', '2', NULL, '2011-04-11 00:00:00', '2011-04-24 00:00:00', '2', NULL, '2011-03-03 00:00:00', '2011-03-03 00:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `m2`.`teams`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `m2`;
INSERT INTO `m2`.`teams` (`id`, `contest_id`, `name`, `total_steps`, `created_at`, `updated_at`) VALUES ('1', '2', 'Bull bull', NULL, '2011-03-03', '2011-03-03');
INSERT INTO `m2`.`teams` (`id`, `contest_id`, `name`, `total_steps`, `created_at`, `updated_at`) VALUES ('2', '2', 'Aller no daller', NULL, '2011-03-03', '2011-03-03');
INSERT INTO `m2`.`teams` (`id`, `contest_id`, `name`, `total_steps`, `created_at`, `updated_at`) VALUES ('3', '2', 'Beachers', NULL, '2011-03-03', '2011-03-03');
INSERT INTO `m2`.`teams` (`id`, `contest_id`, `name`, `total_steps`, `created_at`, `updated_at`) VALUES ('4', '2', 'Knallers', NULL, '2011-03-03', '2011-03-03');
INSERT INTO `m2`.`teams` (`id`, `contest_id`, `name`, `total_steps`, `created_at`, `updated_at`) VALUES ('5', '4', 'Autobahn', NULL, '2011-03-03', '2011-03-03');
INSERT INTO `m2`.`teams` (`id`, `contest_id`, `name`, `total_steps`, `created_at`, `updated_at`) VALUES ('6', '4', 'Tour de France', NULL, '2011-03-03', '2011-03-03');

COMMIT;

-- -----------------------------------------------------
-- Data for table `m2`.`keys`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `m2`;
INSERT INTO `m2`.`keys` (`id`, `contest_id`, `user_id`, `team_id`, `key`, `created_at`, `updated_at`) VALUES ('1', '2', '1', '1', '112', '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`keys` (`id`, `contest_id`, `user_id`, `team_id`, `key`, `created_at`, `updated_at`) VALUES ('2', '2', '2', NULL, '113', '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`keys` (`id`, `contest_id`, `user_id`, `team_id`, `key`, `created_at`, `updated_at`) VALUES ('3', '2', '3', '2', '114', '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`keys` (`id`, `contest_id`, `user_id`, `team_id`, `key`, `created_at`, `updated_at`) VALUES ('4', '2', '6', '2', '115', '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`keys` (`id`, `contest_id`, `user_id`, `team_id`, `key`, `created_at`, `updated_at`) VALUES ('5', '2', '7', '2', '116', '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`keys` (`id`, `contest_id`, `user_id`, `team_id`, `key`, `created_at`, `updated_at`) VALUES ('6', '2', NULL, NULL, '117', '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`keys` (`id`, `contest_id`, `user_id`, `team_id`, `key`, `created_at`, `updated_at`) VALUES ('7', '2', NULL, NULL, '118', '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`keys` (`id`, `contest_id`, `user_id`, `team_id`, `key`, `created_at`, `updated_at`) VALUES ('8', '4', '4', NULL, '119', '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`keys` (`id`, `contest_id`, `user_id`, `team_id`, `key`, `created_at`, `updated_at`) VALUES ('9', '4', '5', NULL, '120', '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`keys` (`id`, `contest_id`, `user_id`, `team_id`, `key`, `created_at`, `updated_at`) VALUES ('10', '4', NULL, NULL, '121', '2011-03-03 00:00:00', '2011-03-03 00:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `m2`.`contest_dates`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `m2`;
INSERT INTO `m2`.`contest_dates` (`id`, `contest_id`, `date`, `type`, `created_at`, `updated_at`) VALUES ('1', '2', '2011-05-02 00:00:00', 'LAST_REG', '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`contest_dates` (`id`, `contest_id`, `date`, `type`, `created_at`, `updated_at`) VALUES ('2', '2', '2011-05-03 00:00:00', 'SEND_RESULT_EMAIL', '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`contest_dates` (`id`, `contest_id`, `date`, `type`, `created_at`, `updated_at`) VALUES ('3', '2', '2011-05-08 00:00:00', 'LAST_ADMIN_DAY', '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`contest_dates` (`id`, `contest_id`, `date`, `type`, `created_at`, `updated_at`) VALUES ('4', '4', '2011-05-02 00:00:00', 'LAST_REG', '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`contest_dates` (`id`, `contest_id`, `date`, `type`, `created_at`, `updated_at`) VALUES ('5', '4', '2011-05-03 00:00:00', 'SEND_RESULT_EMAIL', '2011-03-03 00:00:00', '2011-03-03 00:00:00');
INSERT INTO `m2`.`contest_dates` (`id`, `contest_id`, `date`, `type`, `created_at`, `updated_at`) VALUES ('6', '4', '2011-05-08 00:00:00', 'LAST_ADMIN_DAY', '2011-03-03 00:00:00', '2011-03-03 00:00:00');

COMMIT;
