/*
 Navicat Premium Data Transfer

 Source Server         : local-mysql8
 Source Server Type    : MySQL
 Source Server Version : 80033
 Source Host           : localhost:3306
 Source Schema         : faucet

 Target Server Type    : MySQL
 Target Server Version : 80033
 File Encoding         : 65001

 Date: 21/07/2023 18:32:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for chain
-- ----------------------------
DROP TABLE IF EXISTS `chain`;
CREATE TABLE `chain` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `chain_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `chain_id` int DEFAULT NULL,
  `chain_rpc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `explorer` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of chain
-- ----------------------------
BEGIN;
INSERT INTO `chain` (`id`, `chain_name`, `chain_id`, `chain_rpc`, `explorer`) VALUES (1, 'Polygon Mainnet', 137, 'http://polygon.drpc.org', 'https://explorer.matic.network');
INSERT INTO `chain` (`id`, `chain_name`, `chain_id`, `chain_rpc`, `explorer`) VALUES (2, 'Polygon Testnet', 80001, 'https://rpc-mumbai.maticvigil.com', 'https://mumbai.polygonscan.com');
COMMIT;

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(42) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `token_id` int unsigned DEFAULT NULL,
  `rate` decimal(10,2) unsigned DEFAULT NULL,
  `matic` decimal(14,4) unsigned DEFAULT NULL,
  `token_num` decimal(14,4) unsigned DEFAULT NULL,
  `status` int unsigned DEFAULT NULL COMMENT '1 创建\n2 支付完成',
  `ctime` datetime DEFAULT NULL,
  `tx_hash` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `transfer_time` datetime DEFAULT NULL COMMENT '转账上链时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of orders
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for rate
-- ----------------------------
DROP TABLE IF EXISTS `rate`;
CREATE TABLE `rate` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `rate` decimal(10,2) unsigned DEFAULT '1.00',
  `token_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of rate
-- ----------------------------
BEGIN;
INSERT INTO `rate` (`id`, `rate`, `token_id`) VALUES (1, 1.00, 1);
INSERT INTO `rate` (`id`, `rate`, `token_id`) VALUES (2, 2.00, 2);
INSERT INTO `rate` (`id`, `rate`, `token_id`) VALUES (3, 3.00, 3);
INSERT INTO `rate` (`id`, `rate`, `token_id`) VALUES (4, 4.00, 4);
INSERT INTO `rate` (`id`, `rate`, `token_id`) VALUES (5, 21.00, 5);
COMMIT;

-- ----------------------------
-- Table structure for token
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `token_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `chain_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `chain_id` int unsigned DEFAULT NULL,
  `rpc` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `token_logo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `chain_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `explorer` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of token
-- ----------------------------
BEGIN;
INSERT INTO `token` (`id`, `token_name`, `chain_name`, `chain_id`, `rpc`, `token_logo`, `chain_logo`, `explorer`) VALUES (1, 'MATIC', 'Polygon Testnet', 80001, 'https://rpc-mumbai.maticvigil.com/', 'https://cryptotrading.ninja/logos/coins/polygon.png', 'https://cryptotrading.ninja/logos/coins/polygon.png', 'https://mumbai.polygonscan.com');
INSERT INTO `token` (`id`, `token_name`, `chain_name`, `chain_id`, `rpc`, `token_logo`, `chain_logo`, `explorer`) VALUES (2, 'BNB', 'BSC Testnet', 97, 'https://data-seed-prebsc-1-s1.binance.org:8545', 'https://cryptotrading.ninja/logos/coins/bnb.png', 'https://cryptotrading.ninja/logos/blockchains/bsc-testnet.png', 'https://testnet.bscscan.com');
INSERT INTO `token` (`id`, `token_name`, `chain_name`, `chain_id`, `rpc`, `token_logo`, `chain_logo`, `explorer`) VALUES (3, 'ETH', 'Goerli Testnet', 5, 'https://goerli.infura.io/v3/9aa3d95b3bc440fa88ea12eaa4456161', '/images/eth.png', '/images/eth.png', 'https://goerli.etherscan.io');
INSERT INTO `token` (`id`, `token_name`, `chain_name`, `chain_id`, `rpc`, `token_logo`, `chain_logo`, `explorer`) VALUES (4, 'AGOR', 'Arbitrum Goerli', 421613, 'https://endpoints.omniatech.io/v1/arbitrum/goerli/public', '/images/eth.png', 'https://cryptotrading.ninja/logos/blockchains/arbitrum.png', 'https://goerli-rollup-explorer.arbitrum.io');
INSERT INTO `token` (`id`, `token_name`, `chain_name`, `chain_id`, `rpc`, `token_logo`, `chain_logo`, `explorer`) VALUES (5, 'ETH', 'Sepolia Testnet', 11155111, 'https://eth-sepolia.g.alchemy.com/v2/demo', '/images/eth.png', '/images/eth.png', 'https://sepolia.etherscan.io');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
