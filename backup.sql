-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: localhost    Database: idm
-- ------------------------------------------------------
-- Server version	5.7.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `SequelizeMeta`
--

DROP TABLE IF EXISTS `SequelizeMeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SequelizeMeta` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`name`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SequelizeMeta`
--

LOCK TABLES `SequelizeMeta` WRITE;
/*!40000 ALTER TABLE `SequelizeMeta` DISABLE KEYS */;
INSERT INTO `SequelizeMeta` VALUES ('201802190000-CreateUserTable.js'),('201802190003-CreateUserRegistrationProfileTable.js'),('201802190005-CreateOrganizationTable.js'),('201802190008-CreateOAuthClientTable.js'),('201802190009-CreateUserAuthorizedApplicationTable.js'),('201802190010-CreateRoleTable.js'),('201802190015-CreatePermissionTable.js'),('201802190020-CreateRoleAssignmentTable.js'),('201802190025-CreateRolePermissionTable.js'),('201802190030-CreateUserOrganizationTable.js'),('201802190035-CreateIotTable.js'),('201802190040-CreatePepProxyTable.js'),('201802190045-CreateAuthZForceTable.js'),('201802190050-CreateAuthTokenTable.js'),('201802190060-CreateOAuthAuthorizationCodeTable.js'),('201802190065-CreateOAuthAccessTokenTable.js'),('201802190070-CreateOAuthRefreshTokenTable.js'),('201802190075-CreateOAuthScopeTable.js'),('20180405125424-CreateUserTourAttribute.js'),('20180612134640-CreateEidasTable.js'),('20180727101745-CreateUserEidasIdAttribute.js'),('20180730094347-CreateTrustedApplicationsTable.js'),('20180828133454-CreatePasswordSalt.js'),('20180921104653-CreateEidasNifColumn.js'),('20180922140934-CreateOauthTokenType.js'),('20181022103002-CreateEidasTypeAndAttributes.js'),('20181108144720-RevokeToken.js'),('20181113121450-FixExtraAndScopeAttribute.js'),('20181203120316-FixTokenTypesLength.js'),('20190116101526-CreateSignOutUrl.js'),('20190316203230-CreatePermissionIsRegex.js'),('20190429164755-CreateUsagePolicyTable.js'),('20190507112246-CreateRoleUsagePolicyTable.js'),('20190507112259-CreatePtpTable.js'),('20191019153205-UpdateUserAuthorizedApplicationTable.js'),('20200928134556-AddDisable2faKey.js');
/*!40000 ALTER TABLE `SequelizeMeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_token`
--

DROP TABLE IF EXISTS `auth_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_token` (
  `access_token` varchar(255) NOT NULL,
  `expires` datetime DEFAULT NULL,
  `valid` tinyint(1) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `pep_proxy_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`access_token`),
  UNIQUE KEY `access_token` (`access_token`),
  KEY `user_id` (`user_id`),
  KEY `pep_proxy_id` (`pep_proxy_id`),
  CONSTRAINT `auth_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_token_ibfk_2` FOREIGN KEY (`pep_proxy_id`) REFERENCES `pep_proxy` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_token`
--

LOCK TABLES `auth_token` WRITE;
/*!40000 ALTER TABLE `auth_token` DISABLE KEYS */;
INSERT INTO `auth_token` VALUES ('0e221237-d781-48af-8cea-63e4559d4f52','2020-12-23 01:15:19',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('15f9cbc3-3aff-4a9c-857b-2146c92c1216','2020-12-23 12:51:46',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('22d02b38-800c-4d83-928f-1694b08d36ae','2020-12-23 13:01:02',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('31adddd0-adba-4b1f-aa51-a42bda13166f','2020-12-23 03:01:31',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('497456a2-3e10-4ba8-87e0-1ee4e5f6d6fa','2020-12-23 13:33:45',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('499e6e82-d56f-436a-af7d-0a7cc6c9025a','2020-12-22 17:15:06',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('49e319e6-5c71-483e-a6ab-f00c6c5ada11','2020-12-23 12:34:14',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('4e207936-4dd4-4000-91fa-a2b2c8e38162','2020-12-07 19:57:42',1,'admin',NULL),('4fd43f1a-f3cd-45f0-93f1-9d38d4029efa','2020-12-22 14:09:52',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('50a3d8e8-599b-4d78-82d6-a56027081bff','2020-12-23 13:25:10',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('50c797f7-d087-4181-b02a-94235c8a2d80','2020-12-23 20:22:59',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('555c9fa1-661a-437c-9ade-50d65d8409e0','2020-12-23 16:42:41',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('5d84d17a-a5df-405d-ae93-731602bf1a32','2020-12-22 13:48:27',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('5e888d6b-174d-49d3-aa0b-83c5e2bdc563','2020-12-23 14:24:46',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('62d149d4-4654-44d7-bc36-450ce3adb230','2020-12-22 18:00:44',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('68af8519-b8bc-431b-afef-46782a2b37fd','2020-12-23 03:20:42',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('6e709415-4af0-484e-a727-f1cd98ecae7a','2020-12-23 12:15:09',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('74f710df-bb35-4723-83b5-8eb09c8b1db8','2020-12-23 02:56:06',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('7e834a8d-fcfc-411d-9e0b-17c91e04b8f9','2020-12-07 19:48:38',1,'admin',NULL),('7fffa0ec-398f-4592-a165-ca29b80c9282','2020-12-22 17:48:50',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('80fe6fff-e57e-4674-abab-ac4810738e4e','2020-12-23 03:02:50',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('8160e47a-a284-49df-ad7c-fbed1f371d55','2020-12-23 16:21:19',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('8e668426-f1d9-42c0-9b12-2c0bd2fefc9c','2020-12-07 19:52:27',1,'admin',NULL),('922dc8b0-8ec0-4012-869c-2fe63a9a3858','2020-12-07 19:58:52',1,'admin',NULL),('92cc7675-4e72-441c-aa7d-3a3b82d88c54','2020-12-23 15:03:55',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('93fd5a0a-4fa7-4482-8ae1-9b730f1f4143','2020-12-22 14:24:34',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('96b91f86-b98a-43e0-a249-91ef7e62cd7c','2020-12-23 02:55:26',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('98fb333e-6081-4739-b417-94c2d4c158db','2020-12-07 19:30:46',1,'admin',NULL),('9b333216-7f5f-476a-a6dc-587c532fb76f','2020-12-22 18:49:14',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('a483d00b-0045-4d57-b0da-d0ed580c74ed','2020-12-22 13:51:22',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('a4e87325-2300-4c8b-9c6b-fc84d72f5245','2020-12-23 03:12:18',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('a71fd0ef-3239-41e8-afc4-fd3b22d50f6a','2020-12-07 20:01:30',1,'admin',NULL),('bb5dd7f7-59da-4da9-be0b-16f00e392dee','2020-12-23 13:35:16',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('bc9d6072-31e7-49e0-93a4-a5ea4d344b1c','2020-12-23 15:16:04',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('c1da0f16-0c54-4f88-b792-4f89ae42f670','2020-12-07 19:34:47',1,'admin',NULL),('c3a58654-2f2d-44f2-97a3-fe815b4fc8c0','2020-12-22 22:30:02',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('ce8ce112-9509-42ac-835e-b571e934c899','2020-12-23 11:14:56',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('d6252b21-e2ef-4b6b-93cf-78f30b2c4719','2020-12-23 03:05:20',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('e6f34652-0b2d-48cf-a166-a72e1142897a','2020-12-07 19:53:29',1,'admin',NULL),('e979471d-2077-44b7-9cca-9f6dcb267c02','2020-12-07 19:49:27',1,'admin',NULL),('ef87642a-9d44-43c1-a18c-633b7ce52f98','2020-12-23 13:15:48',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('f2f44f9f-f11f-45f9-bd63-1141ce27a25d','2020-12-23 15:08:05',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('f5042d19-db86-47e2-8399-36b4d0daa5fb','2020-12-23 03:26:30',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408'),('fd85519e-2838-4268-826d-614a3fdb99be','2020-12-07 20:09:07',1,'admin',NULL),('fee0242b-e33a-494b-b571-59a03e0e9355','2020-12-23 14:01:04',1,NULL,'pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408');
/*!40000 ALTER TABLE `auth_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authzforce`
--

DROP TABLE IF EXISTS `authzforce`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authzforce` (
  `az_domain` varchar(255) NOT NULL,
  `policy` char(36) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `version` int(11) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`az_domain`),
  KEY `oauth_client_id` (`oauth_client_id`),
  CONSTRAINT `authzforce_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authzforce`
--

LOCK TABLES `authzforce` WRITE;
/*!40000 ALTER TABLE `authzforce` DISABLE KEYS */;
/*!40000 ALTER TABLE `authzforce` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eidas_credentials`
--

DROP TABLE IF EXISTS `eidas_credentials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eidas_credentials` (
  `id` varchar(36) NOT NULL,
  `support_contact_person_name` varchar(255) DEFAULT NULL,
  `support_contact_person_surname` varchar(255) DEFAULT NULL,
  `support_contact_person_email` varchar(255) DEFAULT NULL,
  `support_contact_person_telephone_number` varchar(255) DEFAULT NULL,
  `support_contact_person_company` varchar(255) DEFAULT NULL,
  `technical_contact_person_name` varchar(255) DEFAULT NULL,
  `technical_contact_person_surname` varchar(255) DEFAULT NULL,
  `technical_contact_person_email` varchar(255) DEFAULT NULL,
  `technical_contact_person_telephone_number` varchar(255) DEFAULT NULL,
  `technical_contact_person_company` varchar(255) DEFAULT NULL,
  `organization_name` varchar(255) DEFAULT NULL,
  `organization_url` varchar(255) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `organization_nif` varchar(255) DEFAULT NULL,
  `sp_type` varchar(255) DEFAULT 'private',
  `attributes_list` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `oauth_client_id` (`oauth_client_id`),
  CONSTRAINT `eidas_credentials_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eidas_credentials`
--

LOCK TABLES `eidas_credentials` WRITE;
/*!40000 ALTER TABLE `eidas_credentials` DISABLE KEYS */;
/*!40000 ALTER TABLE `eidas_credentials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `iot`
--

DROP TABLE IF EXISTS `iot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `iot` (
  `id` varchar(255) NOT NULL,
  `password` varchar(40) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_client_id` (`oauth_client_id`),
  CONSTRAINT `iot_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iot`
--

LOCK TABLES `iot` WRITE;
/*!40000 ALTER TABLE `iot` DISABLE KEYS */;
/*!40000 ALTER TABLE `iot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_token`
--

DROP TABLE IF EXISTS `oauth_access_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_token` (
  `access_token` varchar(255) NOT NULL,
  `expires` datetime DEFAULT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `refresh_token` varchar(255) DEFAULT NULL,
  `valid` tinyint(1) DEFAULT NULL,
  `extra` json DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `iot_id` varchar(255) DEFAULT NULL,
  `authorization_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`access_token`),
  UNIQUE KEY `access_token` (`access_token`),
  KEY `oauth_client_id` (`oauth_client_id`),
  KEY `user_id` (`user_id`),
  KEY `iot_id` (`iot_id`),
  KEY `refresh_token` (`refresh_token`),
  KEY `authorization_code_at` (`authorization_code`),
  CONSTRAINT `authorization_code_at` FOREIGN KEY (`authorization_code`) REFERENCES `oauth_authorization_code` (`authorization_code`) ON DELETE CASCADE,
  CONSTRAINT `oauth_access_token_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE,
  CONSTRAINT `oauth_access_token_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `oauth_access_token_ibfk_3` FOREIGN KEY (`iot_id`) REFERENCES `iot` (`id`) ON DELETE CASCADE,
  CONSTRAINT `refresh_token` FOREIGN KEY (`refresh_token`) REFERENCES `oauth_refresh_token` (`refresh_token`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_token`
--

LOCK TABLES `oauth_access_token` WRITE;
/*!40000 ALTER TABLE `oauth_access_token` DISABLE KEYS */;
INSERT INTO `oauth_access_token` VALUES ('017c9bc43546e859a348fcfa1ad4a957d752cb1e','2020-12-22 12:19:23','bearer','be9374116eb5e34232db84378fbac0f3383f54a7',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL),('01df11cd6aa9f5a7551fe3144cceb02f008e3cfe','2020-12-22 20:03:43','bearer','1c4072f081141281dd6013cdc07109478f6ac432',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'f9928b829fcda4904582a045c138d1f50bbb11d2'),('02f3356f5a860972d03f4375874955d7805fc5dd','2020-12-23 16:58:14','bearer','5863e15cf799515020fd9106cea0a52d6294cbf3',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'913ab3e59328d80a2ed25532adbdf2ec940ecfeb'),('067dc485e4aa31353908fe9bc0a4fb80c16cbf90','2020-12-23 02:22:50','bearer','0623c3865bd0745ab90c7051248309830b19eff4',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,'1651bb5ef099c0ef1beaaae1edf9f4ccd1841dcb'),('08b7507290d36c13aa130909863393278ae0b76a','2020-12-22 12:29:11','bearer','50d4af13dec593658c148dfae9df44105873ad3d',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL),('09caa4fec6ab71b55c10578c33c567b716f958a8','2020-12-23 15:17:52','bearer','e3f93d200255fa9628b147463349c16a8f9416f4',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,NULL),('10e82917b514e3be1382531cb01f033085170f96','2020-12-08 14:10:22','bearer',NULL,1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL),('1321fbb47b9ae5193aa5624c317c04d9318c41c7','2020-12-23 11:05:34','bearer','f55088f03c1567f6fff8f18bec17234c0c671af7',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,NULL),('13410991623a89f86175a34c1ea735217eed5a3b','2020-12-22 11:59:30','bearer','e46b0e5177b444c996eb6e1d334f2575dd22e3f5',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL),('1369bc0e142edcce05704764ffc3d7ff04b1f9e0','2020-12-23 16:02:50','bearer','fabe04a9b104e0b35b3cf801b769c4ce8a84f849',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'b2da62518657de9f6718efdb8798e36abdb0b2b4'),('1647e631b1a65803437763f77322968a7f865c4d','2020-12-08 14:13:59','bearer',NULL,1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL),('19da8418e697db66f73bb4efc509d2cf8d4bbbf3','2020-12-23 17:25:05','bearer','fe3c5138d358f73a071b541d6f5c0866fdf1965f',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,NULL),('21c859af9ce684d5fc05abe6c1bb3eb3ef63bdbd','2020-12-22 09:32:33','bearer',NULL,1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL),('23ec3953a6de8f2984189fcebef348e0a3707ad3','2020-12-23 03:28:57','bearer','08168cf92fe26587f45d4dd53e08e8464142b75a',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,'1fa6d9c9701970ae9398606225d57aa1c665c832'),('24747f0d130a81ec3df88af32e812d8aade9e007','2020-12-22 15:54:40','bearer','a74556c7cb3c3e4f2c45493eab9e27ba865d103c',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'69b384d60507d7798a40fc65231a1a7f38f428bd'),('264a3862e85919d791a84d5e2814ddc230cec5e3','2020-12-22 19:21:10','bearer','5838a7d1e4739895e0a780ff74e3e75fb5762658',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'c062375161a30697ef98dcc8fd15723f159a6964'),('3959473eb4f25e5ab511d9b3b8cd147467066312','2020-12-22 15:52:32','bearer','332ce4eb05c3b3152cce53d9085c4d4e1fffa0c1',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL),('3e5c798693865d56519e530a9595aa9492eb0d78','2020-12-23 03:12:31','bearer','34a59a3cf8e073c598a104e957d1713d391b735c',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,'85425115981a2f1ae27fe8093a82c96e65bfd9bf'),('42effa79e019f2676d218708006c9f62fb8984c4','2020-12-23 12:34:41','bearer','c0623968323dbf9d55671b56cd7af31b783d5798',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'0bf74d72cb6be11635c9f18124702f43f13cc97d'),('43cc628084302745d1b5fec5aeae8bb5e691682f','2020-12-23 15:09:07','bearer','6d4550d297de1445d88d0d3a2e8768ddb8eb27a1',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'abc01a6fc93f06344f303e9143402ff8729d1780'),('4761d9858651c5cf78db0a519bdb69136b53617d','2020-12-22 15:51:48','bearer','4eb14d40ece3bfdd4af3cb1162a46c6f8de8c0f9',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL),('477c53a5b06a46b173e7892f2aaf6d6655795546','2020-12-22 15:55:55','bearer','4bb7931cfe70b15325e0a7af731b545a3354ec81',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'98dc44c2235abb3205e59f63bcc24b01863e660f'),('48807e5408d2b8f0d19285b19ac52d5705b3ac29','2020-12-22 20:04:12','bearer','30edf4757dca2690fc213ce5ed39f44884a1f12f',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'9cd4573e017fd3d0b6b26df224288892157adce8'),('4adf8775c693f39334c15056579b736e99d90a07','2020-12-22 22:30:16','bearer','7ae704fbd55623756b25ed750483eaa30d7a586d',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,'a87a930e80741dd53d03955bc16f40b8df603018'),('4e78d6377634e4bcf0a91374f9209ecef06e6421','2020-12-22 15:52:48','bearer',NULL,1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL),('56afcb8bc5e586aa36383774e2e41ea24382009c','2020-12-23 13:16:53','bearer','6f29ee7e0dfa292ea16a54e17d8a02c62221ec5c',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'573b85f9e9035543276b03fa191d6549968ba511'),('58655734561f4ba0e1208ca358f9e570474fe836','2020-12-08 14:14:02','bearer',NULL,1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL),('58cf73ba90ed022d5205576645750990cdecab61','2020-12-22 16:07:16','bearer','6da198ab86277f2d92bd44b81bb38e58f4eb011c',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'f464545a9680662310379ea3f16ec1f11f7b6634'),('5a359d514d3850f37d7e19791f4aca9c5ee7403d','2020-12-22 20:04:05','bearer','748680207e09fc105366dd96d149cecdca661a4c',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'f1ca00a832706cca71e8e8bffb7502d8fd73bbfc'),('5afabee616ce9f98bb1e117add7cd40368dbb5cc','2020-12-22 20:07:44','bearer','c824a9e6d4a7c56849fd8d5ef67d3ca976771952',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,NULL),('5c4a2ad4200b276663c71134b6c0016a9d5b31cf','2020-12-23 03:21:06','bearer','3cdeb243b8166ec565a7b6a3f6dfaa9994a333d2',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,'caf3f97772b0171d76f2af81b5d7a17b079254e5'),('5e77f82638bfc69709888a4a92ec7dbbca052440','2020-12-23 14:01:38','bearer','b6dc79709c9634e50fcd1f2b094d8b3112f68919',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'ec0f04b1ed77a40e6cd261a90f459b4b67fabf8e'),('657dfcc6a624f8a3799ff72f02cce60424cd5d15','2020-12-23 13:02:04','bearer','bc567c87c8371cbe89c312f999ee8c21c8eeaa27',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,NULL),('6d95dedffb1ce296751cb52c6c2d6f718c778554','2020-12-22 16:06:22','bearer','2e63f5582c8bfa071ff7978ac9c2577f3b65b2a2',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'3000a7a44588409cd5325f0db6d5fa729f8eee69'),('6f0629f6398b798a993daa4faee4ffb82c810d58','2020-12-22 19:21:05','bearer','a70be8f57a401e59e846305f3b97cf337e430484',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'fba0941cf57fa8e6889acb05992b24dfbb5af7e9'),('75f058309e75b432c3f7ab2c36eae03a01406c81','2020-12-23 16:01:55','bearer','bc55cf1ca3a5dd9a6b12360a7824862affd82f96',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'29f9931e40c49d49df3e4bd37268653c30f473e2'),('76737ed924c99d9ede2bb557fa5d431549ba5154','2020-12-22 20:04:50','bearer','99a4d9d398f4090a7879de82bcfab83b1d62f50b',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,NULL),('7789753f7f5ca89fc46125a11af74eb12139916e','2020-12-23 11:17:52','bearer','215e847991a900df27e55e4a3572d15875d9a76e',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,NULL),('7bdd48902e6d5918cce44bf27a085a4bc27c1869','2020-12-22 13:55:39','bearer','5d8c9c9173f97f3dd913058902f43316947463b8',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL),('809829a6932d5c2879771a46c9bf355abd0778e7','2020-12-23 15:16:19','bearer','450296ae35e4968ad578eed8e6c91ae608159fb3',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'5691a539b6ce05b09402a502053454cc3451506d'),('863092bab07b357b45f620b75a7105ba040c3c96','2020-12-23 12:52:11','bearer','7a6e29d6080ae43f6e95320e96d37166a869ab4e',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,NULL),('86670bef995e34eeb67f8100be69c4ca725b66af','2020-12-22 11:31:38','bearer','177e7d7d75ce780c600c174e61e94059ca8442e4',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL),('8882c23d522c1d24cfb50eed0daf9e9fbfe5feb3','2020-12-22 20:06:22','bearer','59b71089f5f49f76750b69d637081e729c439094',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,NULL),('8b33fff41465b7597cbfd006bbabb4e551f8f486','2020-12-23 13:36:01','bearer','9976becaa67af1e259d5271ee3caef22ce33fa98',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'bb4293f38243e88c98b3023ab78f91ba8ca3bc33'),('8e1be3a95adf5bfe6f5e661fb7d9f3809bfbdb5c','2020-12-22 16:05:18','bearer','0263fda309aa07b8e6fd93552e36070754f928ce',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'4e4da8a8fa66eba48c830d651ef4dcd76dba66d7'),('92fdbc84226ab15fea413c0cf37eee6e41741d29','2020-12-08 14:10:13','bearer',NULL,1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL),('957052a75bdc17a779cf343479390a4255c01dc4','2020-12-08 14:09:45','bearer',NULL,1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL),('9be8c570af227de410820808a4bbce936e8e8d60','2020-12-22 15:59:52','bearer','ffd9be3cf9dd8181a40b8bea046e7f149681e1c2',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'d56912f2230ead686a04e6a630c7c720668039aa'),('ae30cbdd878668f6afaee4bd83fc1c6ff30b661c','2020-12-23 13:25:46','bearer','0f2b7e64aa672b22c02d8eb02dace60d491e6ba6',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,NULL),('b6642aac55cccc0a454c03097e16a5182fa57785','2020-12-23 14:30:44','bearer','5c6c22589a9982989c11d3688d5f649ee14cdcdf',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'1c7a160baccd33b1b4439f5aa30e4ce4966c1c58'),('b8c19c48b7e1a663ae426187aa48b1bb4641562e','2020-12-22 20:00:51','bearer','d6d4fb35f6efc1247e628fe720405b57ce2f7124',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'0faf3c451dd04644d6330124a0a1a5e2c5680f4a'),('bd1fdd2c85a75d0aa5e0eb8936fe035047704a4f','2020-12-23 15:04:15','bearer','30e29a5ae3f04e656606ad33020b5346a6d21308',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'7f4291a6f5141046a65c56a9bbec4afb05a1ebee'),('bdb1eaf8a7cef5c3c6c427e26899dfc61888eec2','2020-12-23 02:56:22','bearer','0a3821a739b8685aa583a31297a3317b04e86215',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,'894ec4496d5444fbf88fc26702717f5109ab7541'),('be2450552c54b139a4b0e7fffe22719b9c30c8d8','2020-12-22 09:32:23','bearer',NULL,1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL),('bf856b29307ef279c2fe1b2d853bb8b1a3492900','2020-12-22 16:01:12','bearer','a2efd8376e767a338531ecba1d238efab0a9d6fc',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'6940a1972ca46e23f42f8ddeaf32e8efcf09b6fb'),('cc20a9b5756618140274e850e70bd9fa34387dda','2020-12-23 15:30:00','bearer','e1a5b6838dfd451e0f8c4de1286aa764b3650f5f',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'5a3c4d29a55dfcb61f434ea5ac0f59ae62edd0b4'),('d70dd2033b445fd30fa6b96646c1d182b7aa2a0e','2020-12-22 19:59:25','bearer','f75dee521ba01adb04abbac86f09086ebe60d509',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,NULL),('e4bc31bc992a35782674e21890fbe6a961a92328','2020-12-23 12:19:05','bearer','ef9dfe01fddb8e54153a439e2038798d9b5af665',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,NULL),('ed6f3df2c1c00b20aeffcb2796e3b4e0617ccf76','2020-12-23 16:02:14','bearer','5ce242432d92c4bed41f55c1137ccd935ced882b',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,NULL),('f06515add15b8a894dcaef4762e532db2a6c4e20','2020-12-23 03:05:47','bearer','aec8b41cec678e5e8923a0c92574b2a97a82459e',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,'eeba11885a1cb4615fcf8a2a81f89200df312aac'),('f553107d8a6d7ee898298825ac44f571a78466b2','2020-12-08 19:31:41','bearer',NULL,1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,NULL),('f954ea36ea9dafaf5b86faaffbb59f39ffac9c25','2020-12-20 12:33:23','bearer',NULL,1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL),('f95e1dec63d259b37967b7f8566a92dc5fd98209','2020-12-22 16:07:35','bearer','fe8c32d2ecde562e7825bb1730ed762580381149',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'bdd37e338b32bcaafcd37c1c917fe6208b2c98df'),('f9e4cd9bbb299950277001706b765afa2263d22f','2020-12-23 11:25:16','bearer','746218b80e0bdcee46823313ac47e8b3e6c5f36d',1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,NULL),('fc9bb86766f631d1d441a8c4f1ae78bf690f4af7','2020-12-22 13:52:51','bearer',NULL,1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL),('fd294ed3fb95e947289225fac60547d11c992bf8','2020-12-22 15:54:37','bearer',NULL,1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL);
/*!40000 ALTER TABLE `oauth_access_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_authorization_code`
--

DROP TABLE IF EXISTS `oauth_authorization_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_authorization_code` (
  `authorization_code` varchar(256) NOT NULL,
  `expires` datetime DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `valid` tinyint(1) DEFAULT NULL,
  `extra` json DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`authorization_code`),
  UNIQUE KEY `authorization_code` (`authorization_code`),
  KEY `oauth_client_id` (`oauth_client_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `oauth_authorization_code_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE,
  CONSTRAINT `oauth_authorization_code_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_authorization_code`
--

LOCK TABLES `oauth_authorization_code` WRITE;
/*!40000 ALTER TABLE `oauth_authorization_code` DISABLE KEYS */;
INSERT INTO `oauth_authorization_code` VALUES ('0bf74d72cb6be11635c9f18124702f43f13cc97d','2020-12-23 11:39:40','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9'),('0faf3c451dd04644d6330124a0a1a5e2c5680f4a','2020-12-22 19:05:51','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin'),('1651bb5ef099c0ef1beaaae1edf9f4ccd1841dcb','2020-12-23 01:27:49','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8'),('1c7a160baccd33b1b4439f5aa30e4ce4966c1c58','2020-12-23 13:35:43','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9'),('1fa6d9c9701970ae9398606225d57aa1c665c832','2020-12-23 02:33:57','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8'),('29f9931e40c49d49df3e4bd37268653c30f473e2','2020-12-23 15:06:55','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9'),('3000a7a44588409cd5325f0db6d5fa729f8eee69','2020-12-22 15:11:22','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin'),('4e4da8a8fa66eba48c830d651ef4dcd76dba66d7','2020-12-22 15:10:18','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin'),('5691a539b6ce05b09402a502053454cc3451506d','2020-12-23 14:21:19','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9'),('573b85f9e9035543276b03fa191d6549968ba511','2020-12-23 12:21:52','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9'),('5a3c4d29a55dfcb61f434ea5ac0f59ae62edd0b4','2020-12-23 14:35:00','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9'),('6940a1972ca46e23f42f8ddeaf32e8efcf09b6fb','2020-12-22 15:06:12','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin'),('69b384d60507d7798a40fc65231a1a7f38f428bd','2020-12-22 14:59:40','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin'),('7f4291a6f5141046a65c56a9bbec4afb05a1ebee','2020-12-23 14:09:15','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9'),('85425115981a2f1ae27fe8093a82c96e65bfd9bf','2020-12-23 02:17:31','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8'),('894ec4496d5444fbf88fc26702717f5109ab7541','2020-12-23 02:01:22','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8'),('913ab3e59328d80a2ed25532adbdf2ec940ecfeb','2020-12-23 16:03:14','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9'),('98dc44c2235abb3205e59f63bcc24b01863e660f','2020-12-22 15:00:54','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin'),('9cd4573e017fd3d0b6b26df224288892157adce8','2020-12-22 19:09:12','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin'),('a87a930e80741dd53d03955bc16f40b8df603018','2020-12-22 21:35:16','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8'),('abc01a6fc93f06344f303e9143402ff8729d1780','2020-12-23 14:14:06','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9'),('b2da62518657de9f6718efdb8798e36abdb0b2b4','2020-12-23 15:07:50','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9'),('bb4293f38243e88c98b3023ab78f91ba8ca3bc33','2020-12-23 12:41:01','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9'),('bdd37e338b32bcaafcd37c1c917fe6208b2c98df','2020-12-22 15:12:35','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin'),('c062375161a30697ef98dcc8fd15723f159a6964','2020-12-22 18:26:09','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin'),('caf3f97772b0171d76f2af81b5d7a17b079254e5','2020-12-23 02:26:05','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8'),('d56912f2230ead686a04e6a630c7c720668039aa','2020-12-22 15:04:52','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin'),('e03831cf4645b03371ef959c390430dcf1d02254','2020-12-22 18:25:10','http://localhost:8080/php/loginAction.php',NULL,1,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin'),('ec0f04b1ed77a40e6cd261a90f459b4b67fabf8e','2020-12-23 13:06:38','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9'),('eeba11885a1cb4615fcf8a2a81f89200df312aac','2020-12-23 02:10:47','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8'),('f1ca00a832706cca71e8e8bffb7502d8fd73bbfc','2020-12-22 19:09:05','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin'),('f464545a9680662310379ea3f16ec1f11f7b6634','2020-12-22 15:12:16','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin'),('f9928b829fcda4904582a045c138d1f50bbb11d2','2020-12-22 19:08:43','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin'),('fba0941cf57fa8e6889acb05992b24dfbb5af7e9','2020-12-22 18:26:04','http://localhost:8080/php/loginAction.php',NULL,0,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','admin');
/*!40000 ALTER TABLE `oauth_authorization_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_client`
--

DROP TABLE IF EXISTS `oauth_client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_client` (
  `id` varchar(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `secret` char(36) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `url` varchar(2000) DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default',
  `grant_type` varchar(255) DEFAULT NULL,
  `response_type` varchar(255) DEFAULT NULL,
  `client_type` varchar(15) DEFAULT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `extra` json DEFAULT NULL,
  `token_types` varchar(2000) DEFAULT NULL,
  `jwt_secret` varchar(255) DEFAULT NULL,
  `redirect_sign_out_uri` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_client`
--

LOCK TABLES `oauth_client` WRITE;
/*!40000 ALTER TABLE `oauth_client` DISABLE KEYS */;
INSERT INTO `oauth_client` VALUES ('d9ec7243-8131-4228-8143-b8fd5448a850','MovieApp','Web App to manage Movies','36cbabde-d738-45f7-b874-f14c004a65a8','http://localhost:8080/','http://localhost:8080/php/loginAction.php','default','authorization_code,implicit,password,client_credentials,refresh_token,hybrid','code,token',NULL,NULL,NULL,NULL,NULL,'http://localhost:8080/index.php'),('idm_admin_app','idm','idm',NULL,'','','default','','',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `oauth_client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_token`
--

DROP TABLE IF EXISTS `oauth_refresh_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_token` (
  `refresh_token` varchar(256) NOT NULL,
  `expires` datetime DEFAULT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `iot_id` varchar(255) DEFAULT NULL,
  `authorization_code` varchar(255) DEFAULT NULL,
  `valid` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`refresh_token`),
  UNIQUE KEY `refresh_token` (`refresh_token`),
  KEY `oauth_client_id` (`oauth_client_id`),
  KEY `user_id` (`user_id`),
  KEY `iot_id` (`iot_id`),
  KEY `authorization_code_rt` (`authorization_code`),
  CONSTRAINT `authorization_code_rt` FOREIGN KEY (`authorization_code`) REFERENCES `oauth_authorization_code` (`authorization_code`) ON DELETE CASCADE,
  CONSTRAINT `oauth_refresh_token_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE,
  CONSTRAINT `oauth_refresh_token_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `oauth_refresh_token_ibfk_3` FOREIGN KEY (`iot_id`) REFERENCES `iot` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_token`
--

LOCK TABLES `oauth_refresh_token` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_token` DISABLE KEYS */;
INSERT INTO `oauth_refresh_token` VALUES ('0263fda309aa07b8e6fd93552e36070754f928ce','2021-01-05 15:05:18','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'4e4da8a8fa66eba48c830d651ef4dcd76dba66d7',1),('0623c3865bd0745ab90c7051248309830b19eff4','2021-01-06 01:22:50','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,'1651bb5ef099c0ef1beaaae1edf9f4ccd1841dcb',1),('08168cf92fe26587f45d4dd53e08e8464142b75a','2021-01-06 02:28:57','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,'1fa6d9c9701970ae9398606225d57aa1c665c832',1),('0a3821a739b8685aa583a31297a3317b04e86215','2021-01-06 01:56:22','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,'894ec4496d5444fbf88fc26702717f5109ab7541',1),('0f2b7e64aa672b22c02d8eb02dace60d491e6ba6','2021-01-06 12:25:46','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,NULL,1),('177e7d7d75ce780c600c174e61e94059ca8442e4','2021-01-05 10:31:38','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL,1),('1c4072f081141281dd6013cdc07109478f6ac432','2021-01-05 19:03:43','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'f9928b829fcda4904582a045c138d1f50bbb11d2',1),('215e847991a900df27e55e4a3572d15875d9a76e','2021-01-06 10:17:52','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,NULL,1),('2e63f5582c8bfa071ff7978ac9c2577f3b65b2a2','2021-01-05 15:06:22','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'3000a7a44588409cd5325f0db6d5fa729f8eee69',1),('30e29a5ae3f04e656606ad33020b5346a6d21308','2021-01-06 14:04:15','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'7f4291a6f5141046a65c56a9bbec4afb05a1ebee',1),('30edf4757dca2690fc213ce5ed39f44884a1f12f','2021-01-05 19:04:12','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'9cd4573e017fd3d0b6b26df224288892157adce8',1),('332ce4eb05c3b3152cce53d9085c4d4e1fffa0c1','2021-01-05 14:52:32','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL,1),('34a59a3cf8e073c598a104e957d1713d391b735c','2021-01-06 02:12:31','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,'85425115981a2f1ae27fe8093a82c96e65bfd9bf',1),('3cdeb243b8166ec565a7b6a3f6dfaa9994a333d2','2021-01-06 02:21:06','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,'caf3f97772b0171d76f2af81b5d7a17b079254e5',1),('450296ae35e4968ad578eed8e6c91ae608159fb3','2021-01-06 14:16:19','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'5691a539b6ce05b09402a502053454cc3451506d',1),('4bb7931cfe70b15325e0a7af731b545a3354ec81','2021-01-05 14:55:55','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'98dc44c2235abb3205e59f63bcc24b01863e660f',1),('4eb14d40ece3bfdd4af3cb1162a46c6f8de8c0f9','2021-01-05 14:51:48','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL,1),('50d4af13dec593658c148dfae9df44105873ad3d','2021-01-05 11:29:11','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL,1),('5838a7d1e4739895e0a780ff74e3e75fb5762658','2021-01-05 18:21:10','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'c062375161a30697ef98dcc8fd15723f159a6964',1),('5863e15cf799515020fd9106cea0a52d6294cbf3','2021-01-06 15:58:14','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'913ab3e59328d80a2ed25532adbdf2ec940ecfeb',1),('59b71089f5f49f76750b69d637081e729c439094','2021-01-05 19:06:22','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,NULL,1),('5c6c22589a9982989c11d3688d5f649ee14cdcdf','2021-01-06 13:30:44','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'1c7a160baccd33b1b4439f5aa30e4ce4966c1c58',1),('5ce242432d92c4bed41f55c1137ccd935ced882b','2021-01-06 15:02:14','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,NULL,1),('5d8c9c9173f97f3dd913058902f43316947463b8','2021-01-05 12:55:39','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL,1),('6d4550d297de1445d88d0d3a2e8768ddb8eb27a1','2021-01-06 14:09:07','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'abc01a6fc93f06344f303e9143402ff8729d1780',1),('6da198ab86277f2d92bd44b81bb38e58f4eb011c','2021-01-05 15:07:16','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'f464545a9680662310379ea3f16ec1f11f7b6634',1),('6f29ee7e0dfa292ea16a54e17d8a02c62221ec5c','2021-01-06 12:16:53','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'573b85f9e9035543276b03fa191d6549968ba511',1),('746218b80e0bdcee46823313ac47e8b3e6c5f36d','2021-01-06 10:25:16','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,NULL,1),('748680207e09fc105366dd96d149cecdca661a4c','2021-01-05 19:04:05','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'f1ca00a832706cca71e8e8bffb7502d8fd73bbfc',1),('7a6e29d6080ae43f6e95320e96d37166a869ab4e','2021-01-06 11:52:11','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,NULL,1),('7ae704fbd55623756b25ed750483eaa30d7a586d','2021-01-05 21:30:16','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,'a87a930e80741dd53d03955bc16f40b8df603018',1),('9976becaa67af1e259d5271ee3caef22ce33fa98','2021-01-06 12:36:01','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'bb4293f38243e88c98b3023ab78f91ba8ca3bc33',1),('99a4d9d398f4090a7879de82bcfab83b1d62f50b','2021-01-05 19:04:50','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,NULL,1),('a2efd8376e767a338531ecba1d238efab0a9d6fc','2021-01-05 15:01:12','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'6940a1972ca46e23f42f8ddeaf32e8efcf09b6fb',1),('a70be8f57a401e59e846305f3b97cf337e430484','2021-01-05 18:21:05','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'fba0941cf57fa8e6889acb05992b24dfbb5af7e9',1),('a74556c7cb3c3e4f2c45493eab9e27ba865d103c','2021-01-05 14:54:40','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'69b384d60507d7798a40fc65231a1a7f38f428bd',1),('aec8b41cec678e5e8923a0c92574b2a97a82459e','2021-01-06 02:05:47','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,'eeba11885a1cb4615fcf8a2a81f89200df312aac',1),('b6dc79709c9634e50fcd1f2b094d8b3112f68919','2021-01-06 13:01:38','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'ec0f04b1ed77a40e6cd261a90f459b4b67fabf8e',1),('bc55cf1ca3a5dd9a6b12360a7824862affd82f96','2021-01-06 15:01:55','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'29f9931e40c49d49df3e4bd37268653c30f473e2',1),('bc567c87c8371cbe89c312f999ee8c21c8eeaa27','2021-01-06 12:02:04','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,NULL,1),('be9374116eb5e34232db84378fbac0f3383f54a7','2021-01-05 11:19:23','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL,1),('c0623968323dbf9d55671b56cd7af31b783d5798','2021-01-06 11:34:41','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'0bf74d72cb6be11635c9f18124702f43f13cc97d',1),('c824a9e6d4a7c56849fd8d5ef67d3ca976771952','2021-01-05 19:07:44','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,NULL,1),('d6d4fb35f6efc1247e628fe720405b57ce2f7124','2021-01-05 19:00:51','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'0faf3c451dd04644d6330124a0a1a5e2c5680f4a',1),('e1a5b6838dfd451e0f8c4de1286aa764b3650f5f','2021-01-06 14:30:00','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'5a3c4d29a55dfcb61f434ea5ac0f59ae62edd0b4',1),('e3f93d200255fa9628b147463349c16a8f9416f4','2021-01-06 14:17:52','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,NULL,1),('e46b0e5177b444c996eb6e1d334f2575dd22e3f5','2021-01-05 10:59:30','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,NULL,1),('ef9dfe01fddb8e54153a439e2038798d9b5af665','2021-01-06 11:19:05','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,NULL,1),('f55088f03c1567f6fff8f18bec17234c0c671af7','2021-01-06 10:05:34','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,NULL,1),('f75dee521ba01adb04abbac86f09086ebe60d509','2021-01-05 18:59:25','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,NULL,1),('fabe04a9b104e0b35b3cf801b769c4ce8a84f849','2021-01-06 15:02:50','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','495046c9-a982-41c4-9e02-3d22ae3ef8d9',NULL,'b2da62518657de9f6718efdb8798e36abdb0b2b4',1),('fe3c5138d358f73a071b541d6f5c0866fdf1965f','2021-01-06 16:25:05','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','4c399cd8-2031-4cf2-9983-bc12003378f8',NULL,NULL,1),('fe8c32d2ecde562e7825bb1730ed762580381149','2021-01-05 15:07:35','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'bdd37e338b32bcaafcd37c1c917fe6208b2c98df',1),('ffd9be3cf9dd8181a40b8bea046e7f149681e1c2','2021-01-05 14:59:52','bearer','d9ec7243-8131-4228-8143-b8fd5448a850','admin',NULL,'d56912f2230ead686a04e6a630c7c720668039aa',1);
/*!40000 ALTER TABLE `oauth_refresh_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_scope`
--

DROP TABLE IF EXISTS `oauth_scope`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_scope` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scope` varchar(255) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_scope`
--

LOCK TABLES `oauth_scope` WRITE;
/*!40000 ALTER TABLE `oauth_scope` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_scope` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization`
--

DROP TABLE IF EXISTS `organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organization` (
  `id` varchar(36) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `description` text,
  `website` varchar(2000) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization`
--

LOCK TABLES `organization` WRITE;
/*!40000 ALTER TABLE `organization` DISABLE KEYS */;
/*!40000 ALTER TABLE `organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pep_proxy`
--

DROP TABLE IF EXISTS `pep_proxy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pep_proxy` (
  `id` varchar(255) NOT NULL,
  `password` varchar(40) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_client_id` (`oauth_client_id`),
  CONSTRAINT `pep_proxy_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pep_proxy`
--

LOCK TABLES `pep_proxy` WRITE;
/*!40000 ALTER TABLE `pep_proxy` DISABLE KEYS */;
INSERT INTO `pep_proxy` VALUES ('pep_proxy_50639bc0-5dc0-472f-aaed-63e5b2154408','abc2f8a8b1daf7bc301b63f3cdd3f658d27185b6','d9ec7243-8131-4228-8143-b8fd5448a850','5330581a2a61f42a');
/*!40000 ALTER TABLE `pep_proxy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `id` varchar(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `is_internal` tinyint(1) DEFAULT '0',
  `action` varchar(255) DEFAULT NULL,
  `resource` varchar(255) DEFAULT NULL,
  `xml` text,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `is_regex` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `oauth_client_id` (`oauth_client_id`),
  CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES ('1','Get and assign all internal application roles',NULL,1,NULL,NULL,NULL,'idm_admin_app',0),('2','Manage the application',NULL,1,NULL,NULL,NULL,'idm_admin_app',0),('3','Manage roles',NULL,1,NULL,NULL,NULL,'idm_admin_app',0),('4','Manage authorizations',NULL,1,NULL,NULL,NULL,'idm_admin_app',0),('5','Get and assign all public application roles',NULL,1,NULL,NULL,NULL,'idm_admin_app',0),('6','Get and assign only public owned roles',NULL,1,NULL,NULL,NULL,'idm_admin_app',0);
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ptp`
--

DROP TABLE IF EXISTS `ptp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ptp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `previous_job_id` varchar(255) NOT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`,`previous_job_id`),
  KEY `oauth_client_id` (`oauth_client_id`),
  CONSTRAINT `ptp_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ptp`
--

LOCK TABLES `ptp` WRITE;
/*!40000 ALTER TABLE `ptp` DISABLE KEYS */;
/*!40000 ALTER TABLE `ptp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` varchar(36) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `is_internal` tinyint(1) DEFAULT '0',
  `oauth_client_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `oauth_client_id` (`oauth_client_id`),
  CONSTRAINT `role_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES ('d8a99e6c-290f-4e07-9c5a-664e1c62390a','USER',0,'d9ec7243-8131-4228-8143-b8fd5448a850'),('e174ba0a-b8d6-4199-9c25-1032f7757cbd','CINEMAOWNER',0,'d9ec7243-8131-4228-8143-b8fd5448a850'),('ebdebb50-d5b8-4a41-b0e0-1f05a097c357','ADMIN',0,'d9ec7243-8131-4228-8143-b8fd5448a850'),('provider','Provider',1,'idm_admin_app'),('purchaser','Purchaser',1,'idm_admin_app');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_assignment`
--

DROP TABLE IF EXISTS `role_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_assignment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_organization` varchar(255) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `role_id` varchar(36) DEFAULT NULL,
  `organization_id` varchar(36) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_client_id` (`oauth_client_id`),
  KEY `role_id` (`role_id`),
  KEY `organization_id` (`organization_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `role_assignment_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_assignment_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_assignment_ibfk_3` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_assignment_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_assignment`
--

LOCK TABLES `role_assignment` WRITE;
/*!40000 ALTER TABLE `role_assignment` DISABLE KEYS */;
INSERT INTO `role_assignment` VALUES (12,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','e174ba0a-b8d6-4199-9c25-1032f7757cbd',NULL,'4c399cd8-2031-4cf2-9983-bc12003378f8'),(13,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','ebdebb50-d5b8-4a41-b0e0-1f05a097c357',NULL,'admin'),(14,NULL,'d9ec7243-8131-4228-8143-b8fd5448a850','d8a99e6c-290f-4e07-9c5a-664e1c62390a',NULL,'495046c9-a982-41c4-9e02-3d22ae3ef8d9');
/*!40000 ALTER TABLE `role_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permission`
--

DROP TABLE IF EXISTS `role_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` varchar(36) DEFAULT NULL,
  `permission_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `permission_id` (`permission_id`),
  CONSTRAINT `role_permission_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_permission_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permission`
--

LOCK TABLES `role_permission` WRITE;
/*!40000 ALTER TABLE `role_permission` DISABLE KEYS */;
INSERT INTO `role_permission` VALUES (1,'provider','1'),(2,'provider','2'),(3,'provider','3'),(4,'provider','4'),(5,'provider','5'),(6,'provider','6'),(7,'purchaser','5'),(16,'ebdebb50-d5b8-4a41-b0e0-1f05a097c357','6'),(17,'ebdebb50-d5b8-4a41-b0e0-1f05a097c357','5'),(18,'ebdebb50-d5b8-4a41-b0e0-1f05a097c357','4'),(19,'ebdebb50-d5b8-4a41-b0e0-1f05a097c357','3'),(20,'ebdebb50-d5b8-4a41-b0e0-1f05a097c357','2'),(21,'ebdebb50-d5b8-4a41-b0e0-1f05a097c357','1'),(22,'e174ba0a-b8d6-4199-9c25-1032f7757cbd','5'),(23,'d8a99e6c-290f-4e07-9c5a-664e1c62390a','5');
/*!40000 ALTER TABLE `role_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_usage_policy`
--

DROP TABLE IF EXISTS `role_usage_policy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_usage_policy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` varchar(36) DEFAULT NULL,
  `usage_policy_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `usage_policy_id` (`usage_policy_id`),
  CONSTRAINT `role_usage_policy_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_usage_policy_ibfk_2` FOREIGN KEY (`usage_policy_id`) REFERENCES `usage_policy` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_usage_policy`
--

LOCK TABLES `role_usage_policy` WRITE;
/*!40000 ALTER TABLE `role_usage_policy` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_usage_policy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trusted_application`
--

DROP TABLE IF EXISTS `trusted_application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trusted_application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `trusted_oauth_client_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_client_id` (`oauth_client_id`),
  KEY `trusted_oauth_client_id` (`trusted_oauth_client_id`),
  CONSTRAINT `trusted_application_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE,
  CONSTRAINT `trusted_application_ibfk_2` FOREIGN KEY (`trusted_oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trusted_application`
--

LOCK TABLES `trusted_application` WRITE;
/*!40000 ALTER TABLE `trusted_application` DISABLE KEYS */;
/*!40000 ALTER TABLE `trusted_application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usage_policy`
--

DROP TABLE IF EXISTS `usage_policy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usage_policy` (
  `id` varchar(36) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` enum('COUNT_POLICY','AGGREGATION_POLICY','CUSTOM_POLICY') DEFAULT NULL,
  `parameters` json DEFAULT NULL,
  `punishment` enum('KILL_JOB','UNSUBSCRIBE','MONETIZE') DEFAULT NULL,
  `from` time DEFAULT NULL,
  `to` time DEFAULT NULL,
  `odrl` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_client_id` (`oauth_client_id`),
  CONSTRAINT `usage_policy_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usage_policy`
--

LOCK TABLES `usage_policy` WRITE;
/*!40000 ALTER TABLE `usage_policy` DISABLE KEYS */;
/*!40000 ALTER TABLE `usage_policy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` varchar(36) NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `description` text,
  `website` varchar(2000) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default',
  `gravatar` tinyint(1) DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `date_password` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '0',
  `admin` tinyint(1) DEFAULT '0',
  `extra` json DEFAULT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `starters_tour_ended` tinyint(1) DEFAULT '0',
  `eidas_id` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('495046c9-a982-41c4-9e02-3d22ae3ef8d9','SotirisKavvouras','','','default',0,'sotos.kavvouras@gmail.com','53bbbb8ec6e4b268696d32c494fac2cfa263f270','2020-12-23 10:04:21',1,0,'{\"visible_attributes\": [\"username\", \"description\", \"website\", \"identity_attributes\", \"image\", \"gravatar\"]}',NULL,0,NULL,'f47a690564e66083'),('4c399cd8-2031-4cf2-9983-bc12003378f8','admin1','','','default',0,'admin1@test.com','9fd743caf5ed571fc94ac215b177a5d43cba3e7e','2020-12-08 18:30:57',1,0,'{\"visible_attributes\": [\"username\", \"description\", \"website\", \"identity_attributes\", \"image\", \"gravatar\"]}',NULL,0,NULL,'fcbd1ccb6dbb109e'),('admin','admin','','','default',0,'admin@test.com','4996ac21decfdeea21436fbef3b685d31e678070','2020-12-06 23:58:05',1,1,'{\"visible_attributes\": [\"username\", \"description\"]}',NULL,0,NULL,'5e5f60f4017fa741');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_authorized_application`
--

DROP TABLE IF EXISTS `user_authorized_application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_authorized_application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(36) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `shared_attributes` varchar(255) DEFAULT NULL,
  `login_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `oauth_client_id` (`oauth_client_id`),
  CONSTRAINT `user_authorized_application_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_authorized_application_ibfk_2` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_authorized_application`
--

LOCK TABLES `user_authorized_application` WRITE;
/*!40000 ALTER TABLE `user_authorized_application` DISABLE KEYS */;
INSERT INTO `user_authorized_application` VALUES (3,'admin','d9ec7243-8131-4228-8143-b8fd5448a850','username,email,identity_attributes,image,gravatar,eidas_profile','2020-12-08 13:09:45'),(4,'4c399cd8-2031-4cf2-9983-bc12003378f8','d9ec7243-8131-4228-8143-b8fd5448a850','username,email,identity_attributes,image,gravatar,eidas_profile','2020-12-08 18:31:41'),(5,'495046c9-a982-41c4-9e02-3d22ae3ef8d9','d9ec7243-8131-4228-8143-b8fd5448a850','username,email','2020-12-23 10:05:34');
/*!40000 ALTER TABLE `user_authorized_application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_organization`
--

DROP TABLE IF EXISTS `user_organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_organization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(10) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `organization_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `organization_id` (`organization_id`),
  CONSTRAINT `user_organization_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_organization_ibfk_2` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_organization`
--

LOCK TABLES `user_organization` WRITE;
/*!40000 ALTER TABLE `user_organization` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_registration_profile`
--

DROP TABLE IF EXISTS `user_registration_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_registration_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activation_key` varchar(255) DEFAULT NULL,
  `activation_expires` datetime DEFAULT NULL,
  `reset_key` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `verification_key` varchar(255) DEFAULT NULL,
  `verification_expires` datetime DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `disable_2fa_key` varchar(255) DEFAULT NULL,
  `disable_2fa_expires` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_email` (`user_email`),
  CONSTRAINT `user_registration_profile_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_registration_profile`
--

LOCK TABLES `user_registration_profile` WRITE;
/*!40000 ALTER TABLE `user_registration_profile` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_registration_profile` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-23 19:25:41
