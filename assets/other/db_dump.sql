/*
Navicat MySQL Data Transfer

Source Server         : localhost_mysql_new
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : flip_tech_test

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-01-18 21:58:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Create Database for `flip_tech_test`
-- ----------------------------
CREATE DATABASE IF NOT EXISTS `flip_tech_test` ;
USE `flip_tech_test`;

-- ----------------------------
-- Table structure for `disburse_log`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `disburse_log` (
`autoId`  int(11) NOT NULL AUTO_INCREMENT ,
`req_id`  varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`req_status`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`req_receipt`  text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
`time_served`  datetime NULL DEFAULT NULL ,
`api_request`  text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
`api_response`  text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
`insert_date`  datetime NULL DEFAULT NULL ,
`update_date`  datetime NULL DEFAULT NULL ,
PRIMARY KEY (`autoId`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci
AUTO_INCREMENT=92160002
ROW_FORMAT=Compact
;

-- ----------------------------
-- Records of disburse_log
-- ----------------------------
BEGIN;
INSERT INTO `disburse_log` (`autoId`, `req_id`, `req_status`, `req_receipt`, `time_served`, `api_request`, `api_response`, `insert_date`, `update_date`) VALUES ('92160001', '2312917483', 'PENDING', null, '0000-00-00 00:00:00', '{\"account_number\":112261024,\"bank_code\":\"bca\",\"amount\":424191,\"remark\":\"This is sample remark\"}', '{\"id\":2312917483,\"amount\":424191,\"status\":\"PENDING\",\"timestamp\":\"2020-01-18 21:51:22\",\"bank_code\":\"bca\",\"account_number\":\"112261024\",\"beneficiary_name\":\"PT FLIP\",\"remark\":\"This is sample remark\",\"receipt\":null,\"time_served\":\"0000-00-00 00:00:00\",\"fee\":4000}', '2020-01-18 21:51:17', '2020-01-18 21:51:17');
COMMIT;

-- ----------------------------
-- Auto increment value for `disburse_log`
-- ----------------------------
ALTER TABLE `disburse_log` AUTO_INCREMENT=92160002;
