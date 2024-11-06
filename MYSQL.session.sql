CREATE TABLE `nafco_pms`.`pms_glass_order` (
    `goid` INT NOT NULL AUTO_INCREMENT,
    `gono` VARCHAR(255) NOT NULL,
    `godoneby` VARCHAR(255) NOT NULL,
    `goreldate` DATE NOT NULL,
    `gorcdate` DATE NOT NULL,
    `gosupplier` INT NOT NULL,
    `goglasstype` VARCHAR(255) NOT NULL,
    `goglassspc` LONGTEXT NOT NULL,
    `goglassthickness` VARCHAR(255) NOT NULL,
    `gomarkinglocation` LONGTEXT NOT NULL,
    `goglassqty` INT NOT NULL,
    `goremark` LONGTEXT NOT NULL,
    `goby` VARCHAR(255) NOT NULL,
    `goedit` VARCHAR(255) NOT NULL,
    `gocdate` DATETIME NOT NULL,
    `goeditdate` DATETIME NOT NULL,
    `godate` DATE NOT NULL,
    `gotype` VARCHAR(255) NOT NULL,
    `goproject` INT NOT NULL,
    PRIMARY KEY (`goid`)
) ENGINE = InnoDB;
ALTER TABLE `pms_glass_order`
ADD `gostatus` VARCHAR(255) NOT NULL
AFTER `goproject`;
CREATE TABLE `nafco_pms`.`pms_glass_purchase` (
    `gopid` INT NOT NULL AUTO_INCREMENT,
    `gopdate` DATE NOT NULL,
    `gopcoating` VARCHAR(255) NOT NULL,
    `gopinner` VARCHAR(255) NOT NULL,
    `gopout` VARCHAR(255) NOT NULL,
    `gopremark` VARCHAR(255) NOT NULL,
    `goprecdate` DATE NOT NULL,
    `gopapproveddate` DATE NOT NULL,
    `gopuiinsert` VARCHAR(255) NOT NULL,
    `gopcby` VARCHAR(255) NOT NULL,
    `gopeby` VARCHAR(255) NOT NULL,
    `gopcdate` DATE NOT NULL,
    `gopedate` DATE NOT NULL,
    `gototsqm` DOUBLE NOT NULL,
    `goppricepersqm` DOUBLE NOT NULL,
    PRIMARY KEY (`gopid`)
) ENGINE = InnoDB;
ALTER TABLE `pms_glass_order` CHANGE `gosupplier` `gosupplier` VARCHAR(255) NOT NULL;
ALTER TABLE `pms_glass_purchase`
ADD `goid` INT NOT NULL;
CREATE TABLE `nafco_pms`.`pms_glass_order_purchase` (
    `gopid` INT NOT NULL AUTO_INCREMENT,
    `gopno` VARCHAR(255) NOT NULL,
    `gopdate` DATE NOT NULL,
    `gopproject` INT NOT NULL,
    `gopsalesrep` VARCHAR(255) NOT NULL,
    `gopglassdesc` LONGTEXT NOT NULL,
    `gopglasstype` VARCHAR(255) NOT NULL,
    `gopglasstotalarea` DOUBLE NOT NULL,
    `gopglassqty` INT NOT NULL,
    `gopglasspricepersqm` DOUBLE NOT NULL,
    `gopglasstotalamount` DOUBLE NOT NULL,
    `gopcby` VARCHAR(255) NOT NULL,
    `gopeby` VARCHAR(255) NOT NULL,
    `gopcdate` DATETIME NOT NULL,
    `gopedate` DATETIME NOT NULL,
    `gopbudgetid` INT NOT NULL,
    PRIMARY KEY (`gopid`)
) ENGINE = InnoDB;
RENAME TABLE `nafco_pms`.`pms_glass_order_puchaseing` TO `nafco_pms`.`pms_glass_order_purchase`;
ALTER TABLE `pms_budget_glass`
ADD `gbudgetglassno` VARCHAR(255) NOT NULL;


select mb.bmmaterialtype,
    mb.budgetval,
    po.poval
From (
        select bmmaterialtype,
            bmproject,
            sum(bmdiscountval) as budgetval
        from pms_budget_materials
        group by bmmaterialtype,
            bmproject
    ) as mb
    inner join (
        select ponewtype,
            ponewproject,
            sum(ponewtotval) as poval
        from pms_ponew
        group by ponewtype,
            ponewproject
    ) as po on po.ponewtype = mb.bmmaterialtype
    and mb.bmproject = po.ponewproject



    SELECT `bmproject`,`bmmaterialtype`,sum(`bmdiscountval`) FROM `pms_budget_materials` group by `bmproject`,`bmmaterialtype`;
    
    select *,mat.material as materialtotal,glass.gt as glasstotal,glass.gst as glassshapedtotal from pms_project_summary as pj right join (
        select bmproject,sum(bmdiscountval) as material from pms_budget_materials group by bmproject
    ) as mat on pj.project_id = mat.bmproject left join (
        select bgprojectid,sum(bgtotalcost) as gt,sum(bgshapedtotalcost) as gst from pms_budget_glass group by bgprojectid
    ) as glass on pj.project_id = glass.bgprojectid
    

--new update

ALTER TABLE `pms_gon` ADD `gondoneby` VARCHAR(255) NOT NULL AFTER `gonewid`, ADD `gonrelesetopurcahse` DATE NOT NULL AFTER `gondoneby`, ADD `gonrecivedfrompurchase` DATE NOT NULL AFTER `gonrelesetopurcahse`, ADD `gonstatus` VARCHAR(255) NOT NULL AFTER `gonrecivedfrompurchase`, ADD `gonsupplier` INT NOT NULL AFTER `gonstatus`, ADD `gonglasstype` VARCHAR(255) NOT NULL AFTER `gonsupplier`, ADD `gonglassspc` VARCHAR(255) NOT NULL AFTER `gonglasstype`, ADD `gonmakringlocation` LONGTEXT NOT NULL AFTER `gonglassspc`, ADD `gonlocation` LONGTEXT NOT NULL AFTER `gonmakringlocation`, ADD `gonqty` DOUBLE NOT NULL AFTER `gonlocation`, ADD `gonremark` VARCHAR(255) NOT NULL AFTER `gonqty`, ADD `gonorderno` VARCHAR(255) NOT NULL AFTER `gonremark`, ADD `gonby` VARCHAR(255) NOT NULL AFTER `gonorderno`;
ALTER TABLE `pms_gon` ADD `goeby` VARCHAR(255) NOT NULL AFTER `gonby`, ADD `gocdate` DATETIME NOT NULL AFTER `goeby`, ADD `goedate` DATETIME NOT NULL AFTER `gocdate`;
ALTER TABLE `pms_gon` ADD `gontype` VARCHAR(255) NOT NULL AFTER `goedate`, ADD `gonproject` INT NOT NULL AFTER `gontype`;

ALTER TABLE `pms_gon` CHANGE `gonewid` `gonewid` INT(11) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`gonewid`);