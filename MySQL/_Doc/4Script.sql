-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Personas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Personas` (
  `Cedula` INT NOT NULL,
  `Nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`Cedula`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Vehiculos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Vehiculos` (
  `Placa` VARCHAR(45) NOT NULL,
  `CedulaDuenho` INT NOT NULL,
  PRIMARY KEY (`Placa`, `CedulaDuenho`),
  INDEX `CedulaDuenho_idx` (`CedulaDuenho` ASC),
  CONSTRAINT `CedulaDuenho`
    FOREIGN KEY (`CedulaDuenho`)
    REFERENCES `mydb`.`Personas` (`Cedula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Lugares`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Lugares` (
  `IdLugar` INT NOT NULL,
  `Ubicacion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`IdLugar`, `Ubicacion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Infracciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Infracciones` (
  `Placa` VARCHAR(45) NOT NULL,
  `IdLugar` INT NOT NULL,
  `Fecha` INT NOT NULL,
  `Velocidad` INT NOT NULL,
  PRIMARY KEY (`Placa`, `IdLugar`, `Fecha`),
  INDEX `IdLugar_idx` (`IdLugar` ASC),
  CONSTRAINT `Placa`
    FOREIGN KEY (`Placa`)
    REFERENCES `mydb`.`Vehiculos` (`Placa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `IdLugar`
    FOREIGN KEY (`IdLugar`)
    REFERENCES `mydb`.`Lugares` (`IdLugar`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Telefonos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Telefonos` (
  `CedulaD` INT NOT NULL,
  `Fijo` INT NULL,
  `Movil` INT NOT NULL,
  `Movil2` INT NULL,
  PRIMARY KEY (`CedulaD`, `Movil`),
  CONSTRAINT `CedulaD`
    FOREIGN KEY (`CedulaD`)
    REFERENCES `mydb`.`Personas` (`Cedula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;