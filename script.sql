-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema truckpad
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema truckpad
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `truckpad` DEFAULT CHARACTER SET utf8 ;
USE `truckpad` ;

-- -----------------------------------------------------
-- Table `truckpad`.`tipo_veiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `truckpad`.`tipo_veiculo` (
  `codigo` INT NOT NULL,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `truckpad`.`motorista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `truckpad`.`motorista` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `idade` INT NOT NULL,
  `sexo` VARCHAR(1) NOT NULL,
  `veiculo_proprio` TINYINT(1) NOT NULL,
  `tipo_veiculo` INT NOT NULL,
  `tipo_cnh` VARCHAR(2) NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_motorista_1_idx` (`tipo_veiculo` ASC),
  CONSTRAINT `fk_motorista_1`
    FOREIGN KEY (`tipo_veiculo`)
    REFERENCES `truckpad`.`tipo_veiculo` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `truckpad`.`local`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `truckpad`.`local` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  `latitude` DECIMAL(11,8) NOT NULL,
  `longitude` DECIMAL(11,8) NOT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `truckpad`.`checkin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `truckpad`.`checkin` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `data` TIMESTAMP NULL,
  `codigo_origem` INT NULL,
  `codigo_destino` INT NULL,
  `carregado` TINYINT(1) NULL,
  `codigo_motorista` INT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_checkin_1_idx` (`codigo_motorista` ASC),
  INDEX `fk_checkin_2_idx` (`codigo_origem` ASC),
  INDEX `fk_checkin_3_idx` (`codigo_destino` ASC),
  CONSTRAINT `fk_checkin_1`
    FOREIGN KEY (`codigo_motorista`)
    REFERENCES `truckpad`.`motorista` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_checkin_2`
    FOREIGN KEY (`codigo_origem`)
    REFERENCES `truckpad`.`local` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_checkin_3`
    FOREIGN KEY (`codigo_destino`)
    REFERENCES `truckpad`.`local` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
