-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: pestart_caricatures
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

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
-- Table structure for table `Caricatures`
--

DROP TABLE IF EXISTS `Caricatures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Caricatures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `path` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `tid` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `is_post` int(11) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `upvote` int(11) DEFAULT '0',
  `downvote` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Caricatures`
--

LOCK TABLES `Caricatures` WRITE;
/*!40000 ALTER TABLE `Caricatures` DISABLE KEYS */;
INSERT INTO `Caricatures` VALUES (0,'Ð›Ð¾Ð³Ð¾','Ð›Ð¾Ð³Ð¾Ñ‚Ð¾ Ð½Ð° ÑÐ°Ð¹Ñ‚Ð°','./content/caricatures/logo.png',NULL,NULL,1,0,'2018-06-06',0,0),(2,'Ð‘Ð»Ð°Ñ‚ÐµÑ‡ÐºÐ¸ Ð² ÐŸÐµÑ€Ð½Ð¸Ðº','Ð˜ Ð±Ð»Ð°Ñ‚ÐµÑ‡ÐºÐ¸ Ð³Ð¾ Ð¾Ñ‚Ð½ÐµÑÐµ Ð² ÐŸÐµÑ€Ð½Ð¸Ðº...','./content/bg_supergeroi/blatechki.jpg',NULL,NULL,2,1,'2018-06-06',0,0),(3,'Ð¡ÐµÐ»ÑÐºÐ¸ÑÑ‚ Ð´Ð¸Ð»Ð¸Ð¶Ð°Ð½Ñ','ÐŸÐµÑ€Ð»Ð°Ñ‚Ð° Ð½Ð° Ð¡ÐšÐ“Ð¢...','./content/caricatures/dilijans.jpg',NULL,NULL,1,1,'2018-06-06',0,0),(4,'ÐªTV','','./content/caricatures/btv.jpg',NULL,NULL,1,1,'2018-06-06',0,0),(5,'ÐÑ‚Ð»Ð°Ñ','','./content/caricatures/atlas.jpg',NULL,NULL,1,1,'2018-06-06',0,0),(6,'ÐšÐ°Ñ„ÐµÐ²Ð¸Ñ‚Ðµ','','./content/caricatures/zeleni2.png',NULL,NULL,1,1,'2018-06-06',0,0),(7,'Ð—Ð¸Ð¼Ð°','Ð¢Ñ€Ð°Ð²Ð¼Ð°Ñ‚Ð¾Ð»Ð¾Ð³Ð¸ÑÑ‚Ð° likes this','./content/caricatures/zima.png',NULL,NULL,1,1,'2018-06-06',0,0),(8,'I came in like.....','some wrecked balls...','./content/caricatures/wrecked_balls.png',NULL,NULL,1,1,'2018-06-06',0,0),(9,'US Christmass','','./content/caricatures/us_christmass.png',NULL,NULL,1,1,'2018-06-06',0,0),(10,'Shit Brother','','./content/caricatures/vip_brother.png',NULL,NULL,1,1,'2018-06-06',0,0),(11,'Ð’Ð¸Ñ€ÑƒÑÐ¸','','./content/caricatures/virusi.png',NULL,NULL,1,1,'2018-06-06',0,0),(12,'Ð’Ð¸Ñ‚Ð¾ÑˆÐ°','','./content/caricatures/vitosha.png',NULL,NULL,1,1,'2018-06-06',0,0),(13,'Taliban Santa','','./content/caricatures/taliban_santa.png',NULL,NULL,1,1,'2018-06-06',0,0),(14,'Ð¡Ð»Ð¾Ð½ÑŠÑ‚, Ð¼Ð¾Ñ Ð¿Ñ€Ð¸ÑÑ‚ÐµÐ»...','','./content/caricatures/slon.png',NULL,NULL,1,1,'2018-06-06',0,0),(15,'Ð¡Ð¼Ð°Ñ€Ñ‚Ñ„Ð¾Ð½','','./content/caricatures/smartphone.png',NULL,NULL,1,1,'2018-06-06',0,0),(16,'Shitty Minaj','','./content/caricatures/shitty_minaj.png',NULL,NULL,1,1,'2018-06-06',0,0),(17,'mi6o 6amara','','./content/caricatures/shamar.png',NULL,NULL,1,1,'2018-06-06',0,0),(18,'Scientific Fundamentalism','','./content/caricatures/scientific_fundementalism.png',NULL,NULL,1,1,'2018-06-06',0,0),(19,'Reaper of Freedom','','./content/caricatures/reaper_of_freedom.png',NULL,NULL,1,1,'2018-06-06',0,0),(20,'ÐŸÐ°Ð½ÐµÐ»ÐºÐ°','Ð–Ðš \"Ð¡Ð»ÑƒÑ‡Ð°Ð¹Ð½Ð°\", ÐºÐ¾Ñ Ð´Ð° Ðµ Ð½ÐµÐ´ÐµÐ»Ð½Ð° ÑÑƒÑ‚Ñ€Ð¸Ð½...','./content/caricatures/panelka.png',NULL,NULL,1,1,'2018-06-06',0,0),(21,'ÐÑƒÐ¶ÐµÐ½ ÐŸÐ¾Ñ‚Ð¾Ðº','...ÐºÐ¾Ð¼Ñƒ Ðµ ÑŽÐ¶ÐµÐ½?!','./content/caricatures/nujen_potok.png',NULL,NULL,1,1,'2018-06-06',0,0),(22,'Lord of Error','47 FTW!','./content/caricatures/lord_of_error.png',NULL,NULL,1,1,'2018-06-06',0,0),(23,'Ð”ÐµÐ´Ð¾ ÐœÑ€Ð°Ð·','Ð“Ð¾Ñ€ÐºÐ¸ÑÑ‚ ÑÑ‚Ð°Ñ€ÐµÑ† Ð½Ð°Ñ€ÑƒÑˆÐ¸ Ð²ÑŠÐ·Ð´ÑƒÑˆÐ½Ð¾Ñ‚Ð¾ Ð¿Ñ€Ð¾ÑÑ‚Ñ€Ð°Ð½ÑÑ‚Ð²Ð¾ Ð½Ð° Ð¡Ð¡Ð¡Ð ...','./content/caricatures/mig29.png',NULL,NULL,1,1,'2018-06-06',0,0),(24,'Ð˜Ð½Ð´Ð¸Ð¹ÑÐºÐ°Ñ‚Ð° ÐºÐ¾ÑÐ¼Ð¸Ñ‡ÐµÑÐºÐ° Ð¿Ñ€Ð¾Ð³Ñ€Ð°Ð¼Ð°','Ð˜ Ð²ÑÐµ Ð¿Ð°Ðº Ðµ Ð¿Ð¾-Ð´Ð¾Ð±Ñ€Ð° Ð¾Ñ‚ Ñ€Ð¾Ð´Ð½Ð°Ñ‚Ð°...','./content/caricatures/mangalyan.png',NULL,NULL,1,1,'2018-06-06',0,0),(25,'ÐŸÐ¾Ð»Ð¸Ñ‚Ð¸Ñ‡ÐµÑÐºÐ¸ Ð»ÐµÑˆÐ¾ÑÐ´Ð¸','','./content/caricatures/leshoiadi.png',NULL,NULL,1,1,'2018-06-06',0,0),(26,'ÐšÐ¸Ð»Ð¾-Ð“Ñ€Ð°Ð¼Ð¸','','./content/caricatures/kilogrami.png',NULL,NULL,1,1,'2018-06-06',0,0),(27,'ÐšÐž?ÐÐ•!','','./content/caricatures/ko_ne.png',NULL,NULL,1,1,'2018-06-06',0,0),(28,'Ð˜Ð·Ð½ÐµÐ½Ð°Ð´Ð°Ð°Ð°Ð°Ð°','Ð¡Ð½ÐµÐ³ÑŠÑ‚ Ð¾Ñ‚Ð½Ð¾Ð²Ð¾ Ð¸Ð·Ð½ÐµÐ½Ð°Ð´Ð° *ÑÐ»Ð¾Ð¶Ð¸ ÑÐ»ÑƒÑ‡Ð°ÐµÐ½ Ð³Ñ€Ð°Ð´ Ñ‚ÑƒÐº*','./content/caricatures/iznenada.png',NULL,NULL,1,1,'2018-06-06',0,0),(29,'ÐšÐ°Ñ„ÑÐ²Ð° Ð·Ð¾Ð½Ð°','Ð”ÐµÐ½Ð¾Ð½Ð¾Ñ‰Ð½Ð° :)','./content/caricatures/kafqva_zona.png',NULL,NULL,1,1,'2018-06-07',0,0),(30,'Hello shitty','','./content/caricatures/helo_shitty.png',NULL,NULL,1,1,'2018-06-07',0,0),(31,'Ð˜Ð·Ð±Ð¾Ñ€Ð¸ 2013','Ð¢Ð¾ Ð¸ ÑÐ»ÐµÐ´Ð²Ð°Ñ‰Ð¸Ñ‚Ðµ Ð³Ð¾Ð´Ð¸Ð½Ð¸ Ð¼Ð°Ð¹ Ð²ÑÐµ Ñ‚Ð°ÐºÐ°...','./content/caricatures/izbori.png',NULL,NULL,1,1,'2018-06-07',0,0),(32,'(Ð³Ñ€)ÐÐ´ÑÐºÐ¸ Ñ‚Ñ€Ð°Ð½ÑÐ¿Ð¾Ñ€Ñ‚ ÐŸÐ»Ð¾Ð²Ð´Ð¸Ð²','','./content/caricatures/gradski_transport2.png',NULL,NULL,1,1,'2018-06-07',0,0),(33,'The Ex effect...','','./content/caricatures/exeffect.png',NULL,NULL,1,1,'2018-06-07',0,0),(34,'Ð¡Ð²Ð¾Ð±Ð¾Ð´Ð°...','ÐšÐ¾Ð³Ð°Ñ‚Ð¾ ÑÐµ ÑƒÐ´Ð°Ñ€Ð¸Ñˆ... Ð² Ñ€ÐµÑˆÐµÑ‚ÐºÐ¸Ñ‚Ðµ Ð½Ð° Ñ‚Ð²Ð¾Ð¹Ñ‚Ð° ÑÐ²Ð¾Ð±Ð¾Ð´Ð°...','./content/caricatures/freeeedooooom.png',NULL,NULL,1,1,'2018-06-07',0,0),(35,'Fear','ÐÐ°ÑÐ¸Ð»Ð¸ÐµÑ‚Ð¾ Ðµ Ð¼Ð°ÑÐºÐ° Ð½Ð° ÑÑ‚Ñ€Ð°Ñ…Ð°...','./content/caricatures/fear.png',NULL,NULL,1,1,'2018-06-07',0,0),(36,'Death Moroz','','./content/caricatures/death_moroz.png',NULL,NULL,1,1,'2018-06-07',0,0),(37,'ÐŸÑ€ÐµÐ´Ð¸Ð·Ð±Ð¾Ñ€ÐµÐ½ Ð´ÐµÐ±Ð°(Ñ‚)','','./content/caricatures/debat.png',NULL,NULL,1,1,'2018-06-07',0,0),(38,'Clown Wars','Ð¸Ð»Ð¸ ÐºÐ°ÐºÐ²Ð¾ ÑÐµ ÑÐ»ÑƒÑ‡Ð²Ð° ÑÐ»ÐµÐ´ ÐºÐ°Ñ‚Ð¾ Ð”Ñ€Ð¸ÑÐ½Ð¸ ÐºÑƒÐ¿Ð¸Ñ…Ð° ÐœÐµÐ¶Ð´ÑƒÐ·Ð²ÐµÐ·Ð´Ð½Ð¸ Ð’Ð¾Ð¹Ð½Ð¸...','./content/caricatures/sw_clown_wars.png',NULL,NULL,1,1,'2018-06-07',0,0),(39,'Ð¦ÐµÐ½Ð·ÑƒÑ€Ð°','','./content/caricatures/cenzura.png',NULL,NULL,1,1,'2018-06-07',0,0),(40,'Ðªtv Ð¿ÐµÑ€ÑÐ¿ÐµÐºÑ‚Ð¸Ð²Ð°...','Ð’Ð°Ð¶Ð½Ð¾Ñ‚Ð¾ Ðµ Ð½Ð¾Ð²Ð¸Ð½Ð¸Ñ‚Ðµ Ð´Ð° ÑÐ° Ð»Ð¾ÑˆÐ¸ Ð¸ Ð´Ð° ÑÐµ Ð»ÐµÐµ ÐºÑ€ÑŠÐ²...','./content/caricatures/btv_perspective.png',NULL,NULL,1,1,'2018-06-07',0,0),(41,'Ð¡ÑŠÐ²Ñ€ÐµÐ¼ÐµÐ½ÐµÐ½ Ñ…ÑƒÐ»Ð¸Ð³Ð°Ð½','','./content/caricatures/bully.png',NULL,NULL,1,1,'2018-06-07',0,0),(42,'Ð¡Ð¡Ð¡Ð ','','./content/caricatures/cccp.png',NULL,NULL,1,1,'2018-06-07',0,0),(43,'Cancer','','./content/caricatures/cancer.png',NULL,NULL,1,1,'2018-06-07',0,0),(44,'The AXE Effect','','./content/caricatures/axe_effect.png',NULL,NULL,1,1,'2018-06-07',0,0),(45,'ÐšÑƒÐ»Ñ‚ÑƒÑ€Ð°...','Ð½Ð¾Ñ‰ Ð² Ð½ÐµÐ¹Ð½Ð°Ñ‚Ð° ÑÑ‚Ð¾Ð»Ð¸Ñ†Ð°','./content/caricatures/kultura.png',NULL,NULL,1,1,'2018-06-07',0,0),(46,'DAS AUTO!','','./content/caricatures/vw_mordor.png',NULL,NULL,1,1,'2018-06-07',0,0),(47,'ÐµÐºÐ—ÐžÐ ÑÐ¸ÑÑ‚ÑŠÑ‚','','./content/caricatures/exorcist.png',NULL,NULL,1,1,'2018-06-07',0,0),(48,'Ð—Ð°Ð»Ð¾Ð¶Ð½Ð¸Ðº','...Ð² ÑÐ¾Ð±ÑÑ‚Ð²ÐµÐ½Ð°Ñ‚Ð° Ð½Ð¸ Ð´ÑŠÑ€Ð¶Ð°Ð²Ð°...','./content/caricatures/zalojnik.png',NULL,NULL,1,1,'2018-06-07',0,0),(49,'Ð§ÐµÑ€Ð²ÐµÐ½Ð°Ñ‚Ð° Ð¨Ð°Ð¿Ñ‡Ð¸Ñ†Ð°','...Ð¿Ð¾ Ð Ð¸Ð´Ð»Ð¸ Ð¡ÐºÐ¾Ñ‚','./content/caricatures/red_riding_hood.png',NULL,NULL,1,1,'2018-06-07',0,0),(50,'ÐÐ¾Ð²Ð°','Ð¸Ð»Ð¸ Ð¿Ð¾ ÑÐºÐ¾Ñ€Ð¾ (Ð»Ð°Ð¹)ÐÐ¾Ð²Ð°','./content/caricatures/nova.png',NULL,NULL,1,1,'2018-06-07',0,0),(51,'ÐœÑƒÑ‚Ñ€ÐµÐ½Ð° Ð—Ð¾Ð½Ð°','','./content/caricatures/mutrena_zona.png',NULL,NULL,1,1,'2018-06-07',0,0),(52,'ÐšÐ°Ð¿Ð¸Ñ‚Ð°Ð½ Ð¢Ñ€ÑŠÐ¼Ð¿','...Ð³Ð¾Ñ€ÐºÐ¸Ñ Ð—Ð¾Ñ€Ð¾','./content/caricatures/captain_trump.png',NULL,NULL,1,1,'2018-06-07',0,0),(53,'ÐŸÑ€Ð¾Ð»ÐµÑ‚ 2017','','./content/caricatures/prolet_2017.png',NULL,NULL,1,1,'2018-06-07',0,0),(54,'Ð¢Ñ€ÑŠÐ¼Ð¿ ÑÑ€ÐµÑ‰Ñƒ Ð¡Ð²ÐµÑ‚Ð°','','./content/caricatures/trump_earth.png',NULL,NULL,1,1,'2018-06-07',0,0),(55,'ÐŸÑ€Ð°Ð²Ð°Ñ‚Ð° Ð½Ð° Ð¶ÐµÐ½Ð¸Ñ‚Ðµ','Ð’ Ð¡Ð°ÑƒÐ´Ð¸Ñ‚ÑÐºÐ° ÐÑ€Ð°Ð±Ð¸Ñ','./content/caricatures/saudi_women_rights.png',NULL,NULL,1,1,'2018-06-07',0,0),(56,'Wonder... something','','./content/caricatures/wonder_sth.png',NULL,NULL,1,1,'2018-06-07',0,0),(57,'ÐšÑƒÐ»Ñ‚ÑƒÑ€Ð°...','Ð£Ð½Ð¸Ñ‰Ð¾Ð¶Ð°Ð²Ð°Ð¼Ðµ ÐºÑƒÐ»Ñ‚ÑƒÑ€Ð½Ð¸ Ñ†ÐµÐ½Ð½Ð¾ÑÑ‚Ð¸...','./content/caricatures/kultura2.png',NULL,NULL,1,1,'2018-06-07',0,0),(58,'Ð’Ð°Ð»ÑŒÐ¾ Ð¢Ð¸Ñ…Ð¾Ñ‚Ð¾','Ð¨ÑˆÑˆÑˆÑˆÑˆÑˆÑˆÑ‚!','./content/caricatures/valio_tihoto.png',NULL,NULL,1,1,'2018-06-07',0,0),(59,'Ð‘Ð¾Ð¹ÐºÐ¾ Ð¸ ÐŸÑƒÑ‚Ð¸Ð½','','./content/caricatures/putin_n_boiko.png',NULL,NULL,1,1,'2018-06-07',0,0),(60,'Ð§Ð°Ð¹ÐºÐ°','','./content/caricatures/chaika.png',NULL,NULL,1,1,'2018-06-07',0,0),(61,'Ð¡Ñ€Ð° ÐŸÑ€Ð¾Ñ†ÐµÐ´ÑƒÑ€Ð¸','Ð“Ð°Ñ€Ð°Ð½Ñ‚Ð¸Ñ€Ð°Ð½Ð¾ Ð¾Ð±Ð»ÐµÐºÑ‡ÐµÐ½Ð¸Ðµ','./content/caricatures/sra_proceduri.png',NULL,NULL,1,1,'2018-06-07',0,0),(62,'ÐÐ¾Ð²Ð¸Ñ‚Ðµ ÐœÐµÐ¶Ð´ÑƒÐ·Ð²ÐµÐ·Ð´Ð½Ð¸ Ð’Ð¾Ð¹Ð½Ð¸','','./content/caricatures/sw_mickey2.png',NULL,NULL,1,1,'2018-06-07',0,0),(63,'Allah for Dummies','','./content/caricatures/allah_for_dummies2.png',NULL,NULL,1,1,'2018-06-07',0,0),(64,'Trump vs World2','colorized','./content/caricatures/trump2.png',NULL,NULL,1,1,'2018-06-07',0,0),(65,'ÐšÐ°Ñ€Ð½Ð¾Ð±Ð°Ñ‚Ð¼Ð°Ð½','','./content/bg_supergeroi/cover2.png',NULL,NULL,2,1,'2018-06-07',0,0),(66,'Tech Zombies','','./content/caricatures/tech_zombies.png',NULL,NULL,1,1,'2018-06-07',0,0),(67,'ÐŸÑ€ÐµÐ·Ð¸Ð´ÐµÐ½Ñ‚ÑŠÑ‚ Ð½Ð° Ð Ð‘','','./content/bg_supergeroi/circus_monkey.png',NULL,NULL,2,1,'2018-06-07',0,0),(68,'ÐŸÐ°Ð·Ð¸ Ð¼Ð¾Ñ‚Ð¾Ñ€Ð¸ÑÑ‚Ð°!','...Ñ‡Ðµ Ñ‚Ð¾Ð¹ ÑÐ°Ð¼Ð¸Ñ Ð½Ðµ ÑÐµ Ð¿Ñ€ÐµÑÑ‚Ð°Ñ€Ð°Ð²Ð°...','./content/caricatures/pazi_motorista.png',NULL,NULL,1,1,'2018-06-07',0,0),(69,'Rocket man!','','./content/caricatures/rocket_man.png',NULL,NULL,1,1,'2018-06-07',0,0),(70,'Religions','','./content/caricatures/religions.png',NULL,NULL,1,1,'2018-06-07',0,0),(71,'Ð•Ð²Ñ€Ð¾Ð²Ð³ÑŠÐ·Ð¸Ñ','','./content/caricatures/eurovguzia.png',NULL,NULL,1,1,'2018-06-07',0,0),(72,'Ð‘ÑÐ³ÑÑ‚Ð²Ð¾ Ð¾Ñ‚ Ð·Ð°Ñ‚Ð²Ð¾Ñ€Ð°','...Ð¿Ð¾ Ð±ÑŠÐ»Ð³Ð°Ñ€ÑÐºÐ¸','./content/caricatures/prison_break.png',NULL,NULL,1,1,'2018-06-07',0,0);
/*!40000 ALTER TABLE `Caricatures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Categories`
--

DROP TABLE IF EXISTS `Categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `thumb_id` int(11) NOT NULL DEFAULT '0',
  `path` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categories`
--

LOCK TABLES `Categories` WRITE;
/*!40000 ALTER TABLE `Categories` DISABLE KEYS */;
INSERT INTO `Categories` VALUES (1,'ÐšÐ°Ñ€Ð¸ÐºÐ°Ñ‚ÑƒÑ€Ð¸',64,'./content/caricatures/'),(2,'Ð‘Ð“ Ð¡ÑƒÐ¿ÐµÑ€Ð³ÐµÑ€Ð¾Ð¸',65,'./content/bg_supergeroi/');
/*!40000 ALTER TABLE `Categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Content_type`
--

DROP TABLE IF EXISTS `Content_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Content_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Content_type`
--

LOCK TABLES `Content_type` WRITE;
/*!40000 ALTER TABLE `Content_type` DISABLE KEYS */;
INSERT INTO `Content_type` VALUES (1,'Caricatures'),(2,'Posts');
/*!40000 ALTER TABLE `Content_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Groups`
--

DROP TABLE IF EXISTS `Groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Groups`
--

LOCK TABLES `Groups` WRITE;
/*!40000 ALTER TABLE `Groups` DISABLE KEYS */;
INSERT INTO `Groups` VALUES (1,'Admins',NULL),(2,'Users',NULL);
/*!40000 ALTER TABLE `Groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Posts`
--

DROP TABLE IF EXISTS `Posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `is_post` int(11) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Posts`
--

LOCK TABLES `Posts` WRITE;
/*!40000 ALTER TABLE `Posts` DISABLE KEYS */;
INSERT INTO `Posts` VALUES (1,'Ð¡Ð°Ð¹Ñ‚ÑŠÑ‚ Ðµ Ð´Ð¾ Ð³Ð¾Ð»ÑÐ¼Ð° ÑÑ‚ÐµÐ¿ÐµÐ½ Ð³Ð¾Ñ‚Ð¾Ð²!','ÐšÐ°ÐºÑ‚Ð¾ Ð¼Ð¾Ð¶Ðµ Ð±Ð¸ Ð²Ð¸Ð¶Ð´Ð°Ñ‚Ðµ - Ð¿Ð¾ ÑÐ°Ð¹Ñ‚ÑŠÑ‚ Ð²ÐµÑ‡Ðµ ÑÑ‚Ð°Ð±Ð¸Ð»Ð½Ð¾ ÑÐµ Ñ€Ð°Ð±Ð¾Ñ‚Ð¸! ÐŸÑ€ÐµÐ´Ð¿Ð¾Ð»Ð°Ð³Ð°Ð¼, Ñ‡Ðµ Ñ‰Ðµ Ð¸Ð·ÑÐºÐ°Ñ‡Ð°Ñ‚ Ð±ÑŠÐ³Ð¾Ð²Ðµ, ÐºÐ¾Ð¹Ñ‚Ð¾ Ñ‰Ðµ Ð¾Ð¿Ñ€Ð°Ð²ÑÐ¼ Ð² Ð±ÑŠÐ´ÐµÑ‰Ðµ.\r\nÐ˜Ð¼Ð° Ð¾Ñ‰Ðµ Ñ„ÑƒÐ½ÐºÑ†Ð¸Ð¾Ð½Ð°Ð»Ð½Ð¾ÑÑ‚Ð¸, ÐºÐ¾Ð¸Ñ‚Ð¾ Ð¼Ð¸ÑÐ»Ñ Ð´Ð° Ð´Ð¾Ð±Ð°Ð²Ñ Ð² Ð±ÑŠÐ´ÐµÑ‰Ðµ, ÐºÐ°Ñ‚Ð¾ Ð³Ð»Ð°ÑÑƒÐ²Ð°Ð½Ðµ Ð·Ð° ÐºÐ°Ñ€Ð¸ÐºÐ°Ñ‚ÑƒÑ€Ð¸Ñ‚Ðµ, Ð´Ð¾Ð±Ð°Ð²ÑÐ½Ðµ Ð½Ð° ÐºÐ¾Ð¼ÐµÐ½Ñ‚Ð°Ñ€Ð¸ Ð¸ Ñ‚.Ð½. ÐšÐ°ÐºÑ‚Ð¾ Ð¸ Ð¾Ñ‰Ðµ Ñ€Ð°Ð±Ð¾Ñ‚Ð° Ð¿Ð¾ \"Ð´Ð¸Ð·Ð°Ð¹Ð½Ð°\". ÐÐ¾ Ð·Ð° ÑÐµÐ³Ð° - Ñ‚Ð¾Ð»ÐºÐ¾Ð· :)',1,'2018-06-07');
/*!40000 ALTER TABLE `Posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Timeline`
--

DROP TABLE IF EXISTS `Timeline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Timeline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_type` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `is_pinned` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Timeline`
--

LOCK TABLES `Timeline` WRITE;
/*!40000 ALTER TABLE `Timeline` DISABLE KEYS */;
INSERT INTO `Timeline` VALUES (1,1,1,0,'2018-06-06'),(2,1,2,0,'2018-06-06'),(3,1,3,0,'2018-06-06'),(4,1,4,0,'2018-06-06'),(5,1,5,0,'2018-06-06'),(6,1,6,0,'2018-06-06'),(7,1,7,0,'2018-06-06'),(8,1,8,0,'2018-06-06'),(9,1,9,0,'2018-06-06'),(10,1,10,0,'2018-06-06'),(11,1,11,0,'2018-06-06'),(12,1,12,0,'2018-06-06'),(13,1,13,0,'2018-06-06'),(14,1,14,0,'2018-06-06'),(15,1,15,0,'2018-06-06'),(16,1,16,0,'2018-06-06'),(17,1,17,0,'2018-06-06'),(18,1,18,0,'2018-06-06'),(19,1,19,0,'2018-06-06'),(20,1,20,0,'2018-06-06'),(21,1,21,0,'2018-06-06'),(22,1,22,0,'2018-06-06'),(23,1,23,0,'2018-06-06'),(24,1,24,0,'2018-06-06'),(25,1,25,0,'2018-06-06'),(26,1,26,0,'2018-06-06'),(27,1,27,0,'2018-06-06'),(28,1,28,0,'2018-06-06'),(29,2,1,1,'2018-06-07'),(31,1,29,0,'2018-06-07'),(32,1,30,0,'2018-06-07'),(33,1,31,0,'2018-06-07'),(36,1,32,0,'2018-06-07'),(37,1,33,0,'2018-06-07'),(38,1,34,0,'2018-06-07'),(39,1,35,0,'2018-06-07'),(40,1,36,0,'2018-06-07'),(41,1,37,0,'2018-06-07'),(42,1,38,0,'2018-06-07'),(43,1,39,0,'2018-06-07'),(44,1,40,0,'2018-06-07'),(45,1,41,0,'2018-06-07'),(46,1,42,0,'2018-06-07'),(47,1,43,0,'2018-06-07'),(48,1,44,0,'2018-06-07'),(49,1,0,0,'2018-06-07'),(50,1,45,0,'2018-06-07'),(51,1,46,0,'2018-06-07'),(52,1,47,0,'2018-06-07'),(53,1,48,0,'2018-06-07'),(54,1,49,0,'2018-06-07'),(55,1,50,0,'2018-06-07'),(56,1,51,0,'2018-06-07'),(57,1,52,0,'2018-06-07'),(58,1,53,0,'2018-06-07'),(59,1,54,0,'2018-06-07'),(60,1,55,0,'2018-06-07'),(61,1,56,0,'2018-06-07'),(62,1,57,0,'2018-06-07'),(63,1,58,0,'2018-06-07'),(64,1,59,0,'2018-06-07'),(65,1,60,0,'2018-06-07'),(66,1,61,0,'2018-06-07'),(67,1,62,0,'2018-06-07'),(68,1,63,0,'2018-06-07'),(69,1,64,0,'2018-06-07'),(70,1,65,0,'2018-06-07'),(71,1,66,0,'2018-06-07'),(72,1,67,0,'2018-06-07'),(73,1,68,0,'2018-06-07'),(74,1,69,0,'2018-06-07'),(75,1,70,0,'2018-06-07'),(76,1,71,0,'2018-06-07'),(77,1,72,0,'2018-06-07');
/*!40000 ALTER TABLE `Timeline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `sex` varchar(50) DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'antares','$2y$10$8P0QueUlmTmwlcE6F4PtLObtoWNmQsla3Rju3xOwIMAGWEyFkNZI2','petar.stoyanov@gmail.com','Petar Stoyanov',1,'male','Site administrator.');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-08 10:17:09
