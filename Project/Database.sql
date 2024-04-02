/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.7.31 : Database - inventorymanagement
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`inventorymanagement` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `inventorymanagement`;

/*Table structure for table `tbldepartment` */

DROP TABLE IF EXISTS `tbldepartment`;

CREATE TABLE `tbldepartment` (
  `department_pk` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`department_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbldepartment` */

insert  into `tbldepartment`(`department_pk`,`department_name`) values 
(1,'Stock'),
(2,'Cat'),
(3,'Dog'),
(4,'Implement');

/*Table structure for table `tblproduct_sales_months` */

DROP TABLE IF EXISTS `tblproduct_sales_months`;

CREATE TABLE `tblproduct_sales_months` (
  `product_fk` int(11) DEFAULT NULL,
  `January` int(11) DEFAULT '0',
  `February` int(11) DEFAULT '0',
  `March` int(11) DEFAULT '0',
  `April` int(11) DEFAULT '0',
  `May` int(11) DEFAULT '0',
  `June` int(11) DEFAULT '0',
  `July` int(11) DEFAULT '0',
  `August` int(11) DEFAULT '0',
  `September` int(11) DEFAULT '0',
  `October` int(11) DEFAULT '0',
  `November` int(11) DEFAULT '0',
  `December` int(11) DEFAULT '0',
  KEY `product_fk` (`product_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblproduct_sales_months` */

insert  into `tblproduct_sales_months`(`product_fk`,`January`,`February`,`March`,`April`,`May`,`June`,`July`,`August`,`September`,`October`,`November`,`December`) values 
(1,0,0,0,0,0,0,0,0,0,0,0,0),
(2,0,0,0,0,0,0,0,0,0,0,0,0),
(3,0,0,0,0,0,0,0,0,0,0,0,0),
(4,0,0,0,0,0,0,0,0,0,0,0,0),
(5,0,0,0,0,0,0,0,0,0,0,0,0),
(6,0,0,0,0,0,0,0,0,0,0,0,0),
(7,0,0,0,0,0,0,0,0,0,0,0,0),
(8,0,0,0,0,0,0,0,0,0,0,0,0),
(9,0,0,0,0,0,0,0,0,0,0,0,0),
(10,0,0,0,0,0,0,0,0,0,0,0,0),
(11,0,0,0,0,0,0,0,0,0,0,0,0),
(12,0,0,0,0,0,0,0,0,0,0,0,0),
(13,0,0,0,0,0,0,0,0,0,0,0,0),
(14,0,0,0,0,0,0,0,0,0,0,0,0),
(15,0,0,0,0,0,0,0,0,0,0,0,0),
(16,0,0,0,0,0,0,0,0,0,0,0,0),
(17,0,0,0,0,0,0,0,0,0,0,0,0),
(18,0,0,0,0,0,0,0,0,0,0,0,0),
(19,0,0,0,0,0,0,0,0,0,0,0,0),
(20,0,0,0,0,0,0,0,0,0,0,0,0),
(21,0,0,0,0,0,0,0,0,0,0,0,0),
(22,0,0,0,0,0,0,0,0,0,0,0,0),
(23,0,0,0,0,0,0,0,0,0,0,0,0),
(24,0,0,0,0,0,0,0,0,0,0,0,0),
(25,0,0,0,0,0,0,0,0,0,0,0,0),
(26,0,0,0,0,0,0,0,0,0,0,0,0),
(27,0,0,0,0,0,0,0,0,0,0,0,0),
(28,0,0,0,0,0,0,0,0,0,0,0,0),
(29,0,0,0,0,0,0,0,0,0,0,0,0),
(30,0,0,0,0,0,0,0,0,0,0,0,0),
(31,0,0,0,0,0,0,0,0,0,0,0,0),
(32,0,0,0,0,0,0,0,0,0,0,0,0),
(33,0,0,0,0,0,0,0,0,0,0,0,0),
(34,0,0,0,0,0,0,0,0,0,0,0,0),
(35,0,0,0,0,0,0,0,0,0,0,0,0),
(36,0,0,0,0,0,0,0,0,0,0,0,0),
(37,0,0,0,0,0,0,0,0,0,0,0,0),
(38,0,0,0,0,0,0,0,0,0,0,0,0),
(39,0,0,0,0,0,0,0,0,0,0,0,0),
(40,0,0,0,0,0,0,0,0,0,0,0,0),
(41,0,0,0,0,0,0,0,0,0,0,0,0),
(42,0,0,0,0,0,0,0,0,0,0,0,0),
(43,0,0,0,0,0,0,0,0,0,0,0,0);

/*Table structure for table `tblproduct_sales_months_history` */

DROP TABLE IF EXISTS `tblproduct_sales_months_history`;

CREATE TABLE `tblproduct_sales_months_history` (
  `datetime` timestamp NULL DEFAULT NULL,
  `product_fk` int(11) DEFAULT NULL,
  `January` int(11) DEFAULT '0',
  `Fabruary` int(11) DEFAULT '0',
  `March` int(11) DEFAULT '0',
  `April` int(11) DEFAULT '0',
  `May` int(11) DEFAULT '0',
  `June` int(11) DEFAULT '0',
  `July` int(11) DEFAULT '0',
  `August` int(11) DEFAULT '0',
  `September` int(11) DEFAULT '0',
  `October` int(11) DEFAULT '0',
  `Nevember` int(11) DEFAULT '0',
  `December` int(11) DEFAULT '0',
  KEY `product_fk` (`product_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblproduct_sales_months_history` */

/*Table structure for table `tblproduct_transaction` */

DROP TABLE IF EXISTS `tblproduct_transaction`;

CREATE TABLE `tblproduct_transaction` (
  `product_pk` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `product_status` int(11) DEFAULT '1' COMMENT '1=Active, 0=InActive',
  `ETA` int(11) DEFAULT '0',
  `RMA` int(11) DEFAULT '0',
  `Consignment_Stock` int(11) DEFAULT '0',
  `Pre_Order` int(11) DEFAULT '0',
  `AMD` int(11) DEFAULT '0',
  `Intel` int(11) DEFAULT '0',
  PRIMARY KEY (`product_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblproduct_transaction` */

insert  into `tblproduct_transaction`(`product_pk`,`product_name`,`product_status`,`ETA`,`RMA`,`Consignment_Stock`,`Pre_Order`,`AMD`,`Intel`) values 
(1,'Hello Word',0,200,100,300,100,100,100),
(2,'SpaceShip',0,100,100,100,100,100,100),
(3,'StarShip',0,0,0,0,0,0,0),
(4,'Cinderella',0,0,0,0,0,0,0),
(5,'Pinochhio',0,0,0,0,0,0,0),
(6,'The Conterville Ghost',0,0,0,0,0,0,0),
(7,'Bopha',0,0,0,0,0,0,0),
(8,'Fanta',0,0,0,0,0,0,0),
(9,'Coca',0,0,0,0,0,0,0),
(10,'Mirrinda',0,0,0,0,0,0,0),
(11,'Madison',0,0,0,0,0,0,0),
(12,'Steve Jobs',0,0,0,0,0,0,0),
(13,'Mark Zuckerburg',0,0,0,0,0,0,0),
(14,'Bong Khon',0,0,0,0,0,0,0),
(15,'Bong Vatana',0,0,0,0,0,0,0),
(16,'Bong Neth',0,0,0,0,0,0,0),
(17,'Bong Vichara',0,0,0,0,0,0,0),
(18,'Bong Dara',0,0,0,0,0,0,0),
(19,'Nika',0,0,0,0,0,0,0),
(20,'Goku',0,0,0,0,0,0,0),
(21,'Benny',0,0,0,0,0,0,0),
(22,'Benly',0,0,0,0,0,0,0),
(23,'Toyota',0,0,0,0,0,0,0),
(24,'Lexus',0,0,0,0,0,0,0),
(25,'Cambodia',0,0,0,0,0,0,0),
(26,'Thailand',0,0,0,0,0,0,0),
(27,'US',0,0,0,0,0,0,0),
(28,'England',0,0,0,0,0,0,0),
(29,'Spain',0,0,0,0,0,0,0),
(30,'Portugual',0,0,0,0,0,0,0),
(31,'Argentina',0,0,0,0,0,0,0),
(32,'Germany',0,0,0,0,0,0,0),
(33,'Colombia',0,0,0,0,0,0,0),
(34,'Real Mardrid',0,0,0,0,0,0,0),
(35,'Barcelona',0,0,0,0,0,0,0),
(36,'Bayern',0,0,0,0,0,0,0),
(37,'Dortmund',0,0,0,0,0,0,0),
(38,'AC Milan',0,0,0,0,0,0,0),
(39,'PSG',0,0,0,0,0,0,0),
(40,'Man UTD',0,0,0,0,0,0,0),
(41,'Arsernal',0,0,0,0,0,0,0),
(42,'Liverpool',0,0,0,0,0,0,0),
(43,'Chelsea',0,0,0,0,0,0,0);

/*Table structure for table `tblproduct_transaction_history` */

DROP TABLE IF EXISTS `tblproduct_transaction_history`;

CREATE TABLE `tblproduct_transaction_history` (
  `user_fk` int(11) DEFAULT NULL,
  `product_fk` int(11) DEFAULT NULL,
  `dateTime` timestamp NULL DEFAULT NULL,
  `ETA` int(11) DEFAULT '0',
  `RMA` int(11) DEFAULT '0',
  `Consignment_Stock` int(11) DEFAULT '0',
  `Show_Room` int(11) DEFAULT '0',
  `Pre_Order` int(11) DEFAULT '0',
  `AMD` int(11) DEFAULT '0',
  `Intel` int(11) DEFAULT '0',
  KEY `user_fk` (`user_fk`),
  KEY `product_fk` (`product_fk`),
  CONSTRAINT `tblproduct_transaction_history_ibfk_1` FOREIGN KEY (`user_fk`) REFERENCES `tbluser` (`user_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblproduct_transaction_history` */

/*Table structure for table `tblproductadjustpermission` */

DROP TABLE IF EXISTS `tblproductadjustpermission`;

CREATE TABLE `tblproductadjustpermission` (
  `department_fk` int(11) DEFAULT NULL,
  `product_tran_name_str` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  KEY `product_tran_name_fk` (`product_tran_name_str`),
  KEY `user_fk` (`department_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblproductadjustpermission` */

insert  into `tblproductadjustpermission`(`department_fk`,`product_tran_name_str`) values 
(2,'ETA'),
(2,'RMA'),
(2,'Consignment_Stock');

/*Table structure for table `tbluser` */

DROP TABLE IF EXISTS `tbluser`;

CREATE TABLE `tbluser` (
  `user_pk` int(11) NOT NULL AUTO_INCREMENT,
  `user_department_fk` int(11) DEFAULT NULL,
  `user_level_fk` int(11) DEFAULT NULL,
  `user_full_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `user_log_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `user_log_password` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`user_pk`),
  KEY `tbluser_ibfk_2` (`user_level_fk`),
  KEY `tbluser_ibfk_3` (`user_department_fk`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbluser` */

insert  into `tbluser`(`user_pk`,`user_department_fk`,`user_level_fk`,`user_full_name`,`user_log_name`,`user_log_password`) values 
(23,1,1,'heng','heng','123'),
(24,1,1,'dolla','dolla','123'),
(25,3,1,'Hello','hello','123'),
(27,1,2,'dara','dara','123'),
(28,1,1,'Benny','Benny','123'),
(29,1,1,'Kaka','Kaka','012513403a'),
(30,3,1,'MengSUE','SUE','0155555'),
(31,1,2,'Mengsue','bro meng','123');

/*Table structure for table `tbluserlevel` */

DROP TABLE IF EXISTS `tbluserlevel`;

CREATE TABLE `tbluserlevel` (
  `userlever_pk` int(11) NOT NULL AUTO_INCREMENT,
  `userlevel_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`userlever_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbluserlevel` */

insert  into `tbluserlevel`(`userlever_pk`,`userlevel_name`) values 
(1,'Admin'),
(2,'Staff');

/* Function  structure for function  `fn_exist_user` */

/*!50003 DROP FUNCTION IF EXISTS `fn_exist_user` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` FUNCTION `fn_exist_user`(u_full_name varchar(100)) RETURNS int(11)
BEGIN
	-- if return 0 not exist user
	return(select count(*) from `tbluser` where `user_full_name` = u_full_name);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `Delete_Column` */

/*!50003 DROP PROCEDURE IF EXISTS  `Delete_Column` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Delete_Column`(IN table_name VARCHAR(100), IN column_name VARCHAR(100))
BEGIN
    DECLARE column_exists INT;
    -- Check if the column exists in the table
    SELECT COUNT(*) INTO column_exists
    FROM information_schema.columns
    WHERE table_name = table_name
      AND column_name = column_name;
    IF column_exists > 0 THEN
        -- Drop the column for tblproduct_transaction
        SET @query1 = CONCAT('ALTER TABLE `inventorymanagement`.`tblproduct_transaction` DROP COLUMN ', column_name , ';');
        PREPARE stmt1 FROM @query1;
        EXECUTE stmt1;
        DEALLOCATE PREPARE stmt1;
        -- Drop the column for tblproduct_transaction_history
        SET @query2 = CONCAT('ALTER TABLE `inventorymanagement`.`tblproduct_transaction_history` DROP COLUMN ', column_name , ';');
        PREPARE stmt2 FROM @query2;
        EXECUTE stmt2;
        DEALLOCATE PREPARE stmt2;
        
        -- Delete from tblproductadjustpermission where product_tran_name_str matches
        SET @delete_query = CONCAT('DELETE FROM tblproductadjustpermission WHERE product_tran_name_str = ''', column_name, ''';');
        PREPARE delete_stmt FROM @delete_query;
        EXECUTE delete_stmt;
        DEALLOCATE PREPARE delete_stmt;
        SELECT 'Column dropped successfully' AS Result;
    ELSE
        SELECT 'Column does not exist' AS Result;
    END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Delete_Department_Grant` */

/*!50003 DROP PROCEDURE IF EXISTS  `Delete_Department_Grant` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Delete_Department_Grant`(depart_fk int)
BEGIN
		-- delete if exists department used to grant
		DELETE FROM `tblproductadjustpermission` WHERE `department_fk` = depart_pk;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `Grand_Department_Permission` */

/*!50003 DROP PROCEDURE IF EXISTS  `Grand_Department_Permission` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Grand_Department_Permission`(depart_fk int , tran_name varchar(200))
BEGIN
		-- grant
		insert into `tbldepartment` (`department_pk`,`department_name`)
		values (depart_fk,tran_name);
	END */$$
DELIMITER ;

/* Procedure structure for procedure `Grant_Department_Permission` */

/*!50003 DROP PROCEDURE IF EXISTS  `Grant_Department_Permission` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Grant_Department_Permission`(depart_fk int , tran_name varchar(200))
BEGIN
		-- grant new access permission by department
		insert into `tbldepartment` (`department_pk`,`department_name`)
		values (depart_fk,tran_name);
	END */$$
DELIMITER ;

/* Procedure structure for procedure `Insert_Column` */

/*!50003 DROP PROCEDURE IF EXISTS  `Insert_Column` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Insert_Column`(IN column_name  VARCHAR(100))
BEGIN
    SET @query1 = CONCAT('ALTER TABLE `inventorymanagement`.`tblproduct_transaction` ADD COLUMN ', column_name , ' INT (11) DEFAULT 0 NULL ;');
    SET @query2 = CONCAT('ALTER TABLE `inventorymanagement`.`tblproduct_transaction_history` ADD COLUMN ', column_name , ' INT (11) DEFAULT 0 ;');
    
    PREPARE stmt1 FROM @query1;
    EXECUTE stmt1;
    DEALLOCATE PREPARE stmt1;
    PREPARE stmt2 FROM @query2;
    EXECUTE stmt2;
    DEALLOCATE PREPARE stmt2;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Insert_department` */

/*!50003 DROP PROCEDURE IF EXISTS  `Insert_department` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_department`(d_name VARCHAR(100))
BEGIN
		INSERT INTO `tbldepartment` (`department_name`)
		VALUES(d_name);
	END */$$
DELIMITER ;

/* Procedure structure for procedure `Insert_Multiple_Checkbox` */

/*!50003 DROP PROCEDURE IF EXISTS  `Insert_Multiple_Checkbox` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Insert_Multiple_Checkbox`(department_pk INT,brands VARCHAR(100))
BEGIN
    -- insert into tblproductadjustpermission
    INSERT INTO `tblproductadjustpermission` (`department_fk`,`product_tran_name_str`)
    VALUES(department_pk,brands);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Insert_User` */

/*!50003 DROP PROCEDURE IF EXISTS  `Insert_User` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Insert_User`(u_full_name varchar(100),u_log_name varchar(100), u_log_password varchar(100),u_level int ,u_department int)
BEGIN
		-- insert into user
		insert into `tbluser` (`user_full_name`,`user_log_name`,`user_log_password`,`user_level_fk`,`user_department_fk`)
		values(u_full_name,u_log_name,u_log_password,u_level,u_department);
	END */$$
DELIMITER ;

/* Procedure structure for procedure `Load_All_department` */

/*!50003 DROP PROCEDURE IF EXISTS  `Load_All_department` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Load_All_department`()
BEGIN
	select * from `tbldepartment` Order by department_pk desc;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `Load_All_Transaction` */

/*!50003 DROP PROCEDURE IF EXISTS  `Load_All_Transaction` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Load_All_Transaction`()
BEGIN
		-- Drop 
		DROP TABLE IF EXISTS tbltmptransaction;
		-- Create the temporary table
		CREATE TEMPORARY TABLE tbltmptransaction AS
		SELECT
		  COLUMN_NAME AS department_name
		FROM INFORMATION_SCHEMA.COLUMNS
		WHERE TABLE_NAME = 'tblproduct_transaction'
		  AND ORDINAL_POSITION >= 4; -- Start from the third column (dateTime is 1, ETA is 2, RMA is 3)
		-- Display the temporary table
		SELECT * FROM tbltmptransaction;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `Load_All_User` */

/*!50003 DROP PROCEDURE IF EXISTS  `Load_All_User` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Load_All_User`()
BEGIN
		select * from `tbluser`;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `Load_Product_Data` */

/*!50003 DROP PROCEDURE IF EXISTS  `Load_Product_Data` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Load_Product_Data`(lm int )
BEGIN
		select * from `tblproduct_transaction` where `product_status` = 1 limit lm; 
	END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_AddMonthsToTempTable` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_AddMonthsToTempTable` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `sp_AddMonthsToTempTable`()
BEGIN
    DECLARE dynamic_year INT;
    DECLARE column_name VARCHAR(255);
    DECLARE col_counter INT DEFAULT 1;
    
    -- Set dynamic_year to the current year
    SET dynamic_year = YEAR(NOW());
    
    -- Drop the temporary table if it exists
    DROP TEMPORARY TABLE IF EXISTS temp_table;
    
    -- Create a temporary table
    CREATE TEMPORARY TABLE IF NOT EXISTS temp_table AS
    SELECT * FROM tblproduct_transaction;
    
    -- Construct the ALTER TABLE statement to add the new columns in reverse order (from December to January)
    SET col_counter = 12; -- Start from December
    WHILE col_counter >= 1 DO
        SET column_name = CONCAT(
            CASE col_counter
                WHEN 1 THEN 'January'
                WHEN 2 THEN 'February'
                WHEN 3 THEN 'March'
                WHEN 4 THEN 'April'
                WHEN 5 THEN 'May'
                WHEN 6 THEN 'June'
                WHEN 7 THEN 'July'
                WHEN 8 THEN 'August'
                WHEN 9 THEN 'September'
                WHEN 10 THEN 'October'
                WHEN 11 THEN 'November'
                WHEN 12 THEN 'December'
            END, '_', dynamic_year
        );
        -- Check if the column already exists before adding it
        SET @column_exists_query = CONCAT('SELECT COUNT(*) INTO @column_exists FROM information_schema.columns WHERE table_name = ''temp_table'' AND column_name = ''', column_name, ''';');
        PREPARE column_exists_stmt FROM @column_exists_query;
        EXECUTE column_exists_stmt;
        DEALLOCATE PREPARE column_exists_stmt;
        IF @column_exists = 0 THEN
            SET @alter_table_sql = CONCAT('ALTER TABLE temp_table ADD COLUMN ', column_name, ' INT DEFAULT 0;');
            PREPARE alter_table_stmt FROM @alter_table_sql;
            EXECUTE alter_table_stmt;
            DEALLOCATE PREPARE alter_table_stmt;
        END IF;
        -- Decrement the counter
        SET col_counter = col_counter - 1;
    END WHILE;
    
    -- Select and display data from the temporary table
    SELECT * FROM temp_table;
    
END */$$
DELIMITER ;

/* Procedure structure for procedure `User_login` */

/*!50003 DROP PROCEDURE IF EXISTS  `User_login` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `User_login`( userName varchar(100) , pass_word VARCHAR(100))
BEGIN		
		select * from `tbluser` where `user_log_name` = userName and `user_log_password` = pass_word ;	 
	END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
