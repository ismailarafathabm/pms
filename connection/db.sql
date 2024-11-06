--for bom
CREATE TABLE `nafco_pms`.`pms_bom` (`bom_id` INT NOT NULL AUTO_INCREMENT , `bom_projectid` INT NOT NULL , `bom_projectno` VARCHAR(255) NOT NULL , `bom_projectname` VARCHAR(255) NOT NULL , `bom_boqid` INT NOT NULL , `bom_profileno` VARCHAR(255) NOT NULL , `bom_description` VARCHAR(355) NOT NULL , `bom_dieweight` DOUBLE NOT NULL , `bom_qrlenght` DOUBLE NOT NULL , `bom_qrbar` DOUBLE NOT NULL , `bom_qrtotweight` DOUBLE NOT NULL , `bom_avilength` DOUBLE NOT NULL , `bom_avaibar` DOUBLE NOT NULL , `bom_orderlength` DOUBLE NOT NULL , `bom_orderbar` DOUBLE NOT NULL , `bom_orderweight` DOUBLE NOT NULL , `bom_itemfinish` VARCHAR(255) NOT NULL , `bom_remarks` VARCHAR(255) NOT NULL , `bom_prefixno` VARCHAR(255) NOT NULL , `bom_no` VARCHAR(255) NOT NULL , `bom_cby` VARCHAR(255) NOT NULL , `bom_eby` VARCHAR(255) NOT NULL , `bom_cdate` DATETIME NOT NULL , `bom_edate` DATETIME NOT NULL , `bom_postflag` INT NOT NULL , `bom_mflag` INT NOT NULL , `bom_date` DATE NOT NULL , `bom_mdate` DATE NOT NULL , `bom_projectencno` VARCHAR(350) NOT NULL , PRIMARY KEY (`bom_id`)) ENGINE = InnoDB;
ALTER TABLE `pms_bom` ADD `bom_registerno` VARCHAR(255) NOT NULL AFTER `bom_projectencno`, ADD `bom_checkedby` VARCHAR(255) NOT NULL AFTER `bom_registerno`;
ALTER TABLE `pms_bom` ADD `bom_makeby` VARCHAR(255) NOT NULL AFTER `bom_checkedby`;
ALTER TABLE `pms_bom` ADD `alsowithlenght` BOOLEAN NOT NULL AFTER `bom_makeby`;


CREATE TABLE `nafco_pms`.`pms_boqeng` (`boqeng_id` INT NOT NULL AUTO_INCREMENT , `boqeng_project_id` INT NOT NULL , `boqeng_projectno` VARCHAR(255) NOT NULL , `boqeng_projectnoenc` VARCHAR(255) NOT NULL , `boqeng_projectname` VARCHAR(255) NOT NULL , `boqeng_projectlocation` VARCHAR(255) NOT NULL , `boqeng_boqid` INT NOT NULL , `boqeng_qty` DOUBLE NOT NULL , `boqeng_area` DOUBLE NOT NULL , `boqeng_rdate` DATE NOT NULL , `boqeng_enggname` VARCHAR(255) NOT NULL , `boqeng_cby` VARCHAR(255) NOT NULL , `boqeng_eby` VARCHAR(255) NOT NULL , `boqeng_cdate` DATETIME NOT NULL , `boqeng_edate` DATETIME NOT NULL , `boqeng_postflag` VARCHAR(1) NOT NULL , PRIMARY KEY (`boqeng_id`)) ENGINE = InnoDB;

UPDATE `pms_boqeng` set boqeng_area = (boqeng_area)/1000000 WHERE `boqeng_enggname` = 'suji' and boqeng_area <> 0

--for boq

ALTER TABLE `pms_poq` ADD `issupersede` INT NOT NULL AFTER `boq_calby`, ADD `oldboqid` INT NOT NULL AFTER `issupersede`;