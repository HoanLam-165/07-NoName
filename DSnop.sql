use deliveryservice;

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `CategoryID` INT NOT NULL AUTO_INCREMENT,
  `CategoryName` VARCHAR(100) NOT NULL,
  `Description` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `category` (`CategoryID`, `CategoryName`, `Description`, `created_at`, `updated_at`) VALUES
(1, 'Food', 'Fast food delivery', '2025-11-06 02:45:12', NULL),
(2, 'Fragile', 'Breakable items like glassware', '2025-11-06 02:45:12', NULL),
(3, 'Documents', 'Paperwork & letters', '2025-11-06 02:45:12', NULL);

DROP TABLE IF EXISTS `charge`;

CREATE TABLE `charge` (
  `ChargeID` INT NOT NULL AUTO_INCREMENT,
  `CategoryID` INT NOT NULL,
  `Unit` VARCHAR(50) DEFAULT NULL,
  `UnitCharge` DECIMAL(10,2) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ChargeID`),
  KEY `CategoryID` (`CategoryID`),
  CONSTRAINT `charge_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `charge` (`ChargeID`, `CategoryID`, `Unit`, `UnitCharge`, `created_at`, `updated_at`) VALUES
(1, 1, 'kg', 15.00, '2025-11-06 02:45:12', NULL),
(2, 2, 'package', 25.00, '2025-11-06 02:45:12', NULL),
(3, 3, 'item', 35.00, '2025-11-06 02:45:12', NULL);

DROP TABLE IF EXISTS `delivery`;

CREATE TABLE `delivery` (
  `DeliveryID` INT NOT NULL AUTO_INCREMENT,
  `OrderID` INT NOT NULL,
  `StaffID` INT NOT NULL,
  `ManagerID` INT DEFAULT NULL,
  `Status` VARCHAR(50) DEFAULT 'Assigned',
  `CurrentLocation` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`DeliveryID`),
  KEY `OrderID` (`OrderID`),
  KEY `StaffID` (`StaffID`),
  KEY `ManagerID` (`ManagerID`),
  CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`),
  CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`StaffID`) REFERENCES `user` (`UserID`),
  CONSTRAINT `delivery_ibfk_3` FOREIGN KEY (`ManagerID`) REFERENCES `user` (`UserID`),
  CONSTRAINT `delivery_chk_1` CHECK ((`Status` IN ('Assigned','On-going','Delivered')))
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `delivery` (`DeliveryID`, `OrderID`, `StaffID`, `ManagerID`, `Status`, `CurrentLocation`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, 'Delivered', 'Warehouse HCM', '2025-11-06 02:45:12', NULL),
(2, 2, 3, 1, 'On-going', 'District 1', '2025-11-06 02:45:12', NULL),
(3, 3, 3, 1, 'Delivered', 'Customer Address', '2025-11-06 02:45:12', NULL);

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `OrderID` INT NOT NULL AUTO_INCREMENT,
  `CustomerID` INT NOT NULL,
  `CategoryID` INT NOT NULL,
  `FromLocation` VARCHAR(255) DEFAULT NULL,
  `ToLocation` VARCHAR(255) DEFAULT NULL,
  `Total` DECIMAL(10,2) DEFAULT NULL,
  `Charge` DECIMAL(10,2) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`OrderID`),
  KEY `CustomerID` (`CustomerID`),
  KEY `CategoryID` (`CategoryID`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `user` (`UserID`),
  CONSTRAINT `order_ibfk_2` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `order` (`OrderID`, `CustomerID`, `CategoryID`, `FromLocation`, `ToLocation`, `Total`, `Charge`, `created_at`, `updated_at`) VALUES
(1,1,1,'123 Le Loi, HCM','56 Nguyen Trai, HCM',150.00,15.00,'2025-11-06 02:45:12',NULL),
(2,2,3,'45 Tran Hung Dao, HN','78 Pham Van Dong, HN',200.00,25.00,'2025-11-06 02:45:12',NULL),
(3,3,2,'99 Nguyen Hue, HCM','33 Cach Mang, HCM',300.00,35.00,'2025-11-06 02:45:12',NULL),
(4,1,1,'12 Pasteur, HCM','88 Hai Ba Trung, HCM',180.00,15.00,'2025-11-06 02:45:12',NULL),
(5,2,2,'21 Le Duan, HCM','90 Tran Quoc Thao, HCM',320.00,35.00,'2025-11-06 02:45:12',NULL),
(6,3,3,'01 Ly Thuong Kiet, HN','09 Doi Can, HN',190.00,25.00,'2025-11-06 02:45:12',NULL),
(7,2,1,'34 Nguyen Van Cu, HCM','70 Le Lai, HCM',160.00,15.00,'2025-11-06 02:45:12',NULL);

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `RoleID` INT NOT NULL AUTO_INCREMENT,
  `RoleName` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `role` (`RoleID`, `RoleName`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2025-11-06 02:45:12', NULL),
(2, 'Customer', '2025-11-06 02:45:12', NULL);

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `UserID` INT NOT NULL AUTO_INCREMENT,
  `UserName` VARCHAR(100) NOT NULL,
  `Mobile` VARCHAR(20) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `user` (`UserID`, `UserName`, `Mobile`, `created_at`, `updated_at`) VALUES
(1, 'Nguyen Van A', '0901234567', '2025-11-06 02:45:12', NULL),
(2, 'Tran Thi B', '0987654321', '2025-11-06 02:45:12', NULL),
(3, 'Le Van C', '0911222333', '2025-11-06 02:45:12', NULL);

DROP TABLE IF EXISTS `userrole`;

CREATE TABLE `userrole` (
  `UserRoleID` INT NOT NULL AUTO_INCREMENT,
  `UserID` INT NOT NULL,
  `RoleID` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`UserRoleID`),
  KEY `UserID` (`UserID`),
  KEY `RoleID` (`RoleID`),
  CONSTRAINT `userrole_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  CONSTRAINT `userrole_ibfk_2` FOREIGN KEY (`RoleID`) REFERENCES `role` (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `userrole` (`UserRoleID`, `UserID`, `RoleID`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-11-06 02:45:12', NULL),
(2, 2, 2, '2025-11-06 02:45:12', NULL),
(3, 3, 3, '2025-11-06 02:45:12', NULL);

