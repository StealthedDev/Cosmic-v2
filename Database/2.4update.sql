DROP TABLE IF EXISTS `website_shop_offers`;
DROP TABLE IF EXISTS `website_shop_purchases`;

-- ----------------------------
-- Table structure for website_paypal_offers
-- ----------------------------
DROP TABLE IF EXISTS `website_paypal_offers`;
CREATE TABLE `website_paypal_offers`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of website_paypal_offers
-- ----------------------------
INSERT INTO `website_paypal_offers` VALUES (1, '10.00', 'VIP', 'ES551.png', '{\"givecredits\":{\"credits\":10000},\"givepoints\":{\"type\":5,\"points\":5000},\"givebadge\":[{\"badge\":\"ES551;ES51G\"}],\"setrank\":{\"rank\":2}}', '<ul>\r\n<li>Je ontvangt 10000 credits</li>\r\n<li>Je ontvangt 5000 diamonds</li>\r\n<li>Je ontvangt 2 unieke badges</li>\r\n<li>Je ontvangt VIP Rank</li>\r\n</ul>');
INSERT INTO `website_paypal_offers` VALUES (2, '5.00', '50 credits', 'belcredits-lg.png', '{\"givecredits\":{\"credits\":50}}', '<ul><li>Je ontvangt 50 credits</ul></li>');

-- ----------------------------
-- Table structure for website_paypal_payments
-- ----------------------------
DROP TABLE IF EXISTS `website_paypal_payments`;
CREATE TABLE `website_paypal_payments`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `offer_id` int(11) NULL DEFAULT NULL,
  `order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `payer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'pending',
  `delivered` enum('NO','YES') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'NO',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
