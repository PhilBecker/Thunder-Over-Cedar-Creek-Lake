-- phpMyAdmin SQL Dump
-- version 2.11.9.4
-- http://www.phpmyadmin.net
--
-- Host: 10.8.11.213
-- Generation Time: Apr 29, 2010 at 02:19 PM
-- Server version: 5.0.67
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `airshowdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_businessinfo`
--

CREATE TABLE `tbl_businessinfo` (
  `ID` int(11) NOT NULL,
  `BusinessName` varchar(255) collate latin1_general_ci default NULL,
  `OwnerName` varchar(255) collate latin1_general_ci default NULL,
  `Address` varchar(255) collate latin1_general_ci default NULL,
  `City` varchar(255) collate latin1_general_ci default NULL,
  `State` varchar(255) collate latin1_general_ci default NULL,
  `Zip` int(11) default NULL,
  `Phone1` varchar(255) collate latin1_general_ci default NULL,
  `Phone2` varchar(255) collate latin1_general_ci default NULL,
  `Email` varchar(255) collate latin1_general_ci default NULL,
  `Website` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_businessinfo`
--

INSERT INTO `tbl_businessinfo` VALUES(0, 'Z Bar Ranch', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'www.ZBarRanch.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallerycategories`
--

CREATE TABLE `tbl_gallerycategories` (
  `ID` int(11) NOT NULL auto_increment,
  `CategoryName` varchar(255) collate latin1_general_ci default NULL,
  `Photo` varchar(255) collate latin1_general_ci default NULL,
  `PhotoAlt` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_gallerycategories`
--

INSERT INTO `tbl_gallerycategories` VALUES(10, '2009 Air Show', 'CIMG0142.jpg', 'Thunder Over Cedar Creek Lake - 2009 Air Show');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_galleryphotos`
--

CREATE TABLE `tbl_galleryphotos` (
  `PhotoID` int(11) NOT NULL auto_increment,
  `Date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `Category` int(11) default NULL,
  `Description` text collate latin1_general_ci,
  `Photo` varchar(255) collate latin1_general_ci default NULL,
  `PhotoAlt` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`PhotoID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=185 ;

--
-- Dumping data for table `tbl_galleryphotos`
--

INSERT INTO `tbl_galleryphotos` VALUES(156, '2009-09-06 09:44:45', 10, '<p>&#160;</p>', 'PCCrowd4.jpg.JPG', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(157, '2009-09-06 09:45:05', 10, '<p>&#160;</p>', 'CIMG0115.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(158, '2009-09-06 09:45:19', 10, '<p>&#160;</p>', 'CIMG0120.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(159, '2009-09-06 09:45:34', 10, '<p>&#160;</p>', 'CIMG0084.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(160, '2009-09-06 09:45:46', 10, '<p>&#160;</p>', 'CIMG0139.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(161, '2009-09-06 09:49:11', 10, '<p>&#160;</p>', 'CIMG0142_1.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(162, '2009-09-06 09:49:21', 10, '<p>&#160;</p>', 'CIMG0566.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(163, '2009-09-06 09:49:42', 10, '<p>&#160;</p>', 'CIMG0567.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(164, '2009-09-06 09:50:02', 10, '<p>&#160;</p>', 'CIMG0570.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(165, '2009-09-06 09:54:48', 10, '<p>&#160;</p>', 'CIMG0575.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(169, '2009-09-06 09:55:40', 10, '<p>&#160;</p>', 'Parachute.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(170, '2009-09-06 09:55:58', 10, '<p>&#160;</p>', 'Parachute in water.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(166, '2009-09-06 09:55:04', 10, '<p>&#160;</p>', 'CIMG0581.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(167, '2009-09-06 09:55:19', 10, '<p>&#160;</p>', 'July 4th Clubhouse.JPG', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(168, '2009-09-06 09:55:28', 10, '<p>&#160;</p>', 'July 4th Crowd Pool.JPG', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(171, '2009-09-06 09:56:15', 10, '<p>&#160;</p>', 'Air Show 055.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(172, '2009-09-06 09:56:30', 10, '<p>&#160;</p>', 'Air Show 058.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(173, '2009-09-06 09:56:46', 10, '<p>&#160;</p>', 'Air Show 061.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(174, '2009-09-06 09:57:02', 10, '<p>&#160;</p>', 'Air Show 062.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(175, '2009-09-06 09:57:15', 10, '<p>&#160;</p>', 'Air Show 060.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(176, '2009-09-06 09:57:34', 10, '<p>&#160;</p>', 'Air Show 066.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(177, '2009-09-06 09:57:47', 10, '<p>&#160;</p>', 'Air Show 067.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(178, '2009-09-06 09:58:09', 10, '<p>&#160;</p>', 'Air Show 065.jpg', 'Thunder Over Cedar Creek Lake 2009 Air Show');
INSERT INTO `tbl_galleryphotos` VALUES(179, '2010-03-05 11:32:48', 10, '<p>&#160;</p>', 'IMG_5698.jpg', NULL);
INSERT INTO `tbl_galleryphotos` VALUES(180, '2010-03-05 11:33:12', 10, '<p>&#160;</p>', 'IMG_5715.jpg', NULL);
INSERT INTO `tbl_galleryphotos` VALUES(181, '2010-03-05 11:33:25', 10, '<p>&#160;</p>', 'IMG_5719.jpg', NULL);
INSERT INTO `tbl_galleryphotos` VALUES(182, '2010-03-05 11:33:35', 10, '<p>&#160;</p>', 'IMG_5736.jpg', NULL);
INSERT INTO `tbl_galleryphotos` VALUES(183, '2010-03-05 11:33:44', 10, '<p>&#160;</p>', 'IMG_5737.jpg', NULL);
INSERT INTO `tbl_galleryphotos` VALUES(184, '2010-03-05 11:33:53', 10, '<p>&#160;</p>', 'IMG_5738.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `ID` int(11) NOT NULL auto_increment,
  `UserName` varchar(255) collate latin1_general_ci NOT NULL,
  `User` varchar(255) collate latin1_general_ci NOT NULL,
  `Password` varchar(255) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` VALUES(1, 'Dave Heltzel', 'dmheltzel', 'Whitetail55');
INSERT INTO `tbl_login` VALUES(2, 'CCVF', 'cedarcreek', 'veterans');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
  `NewsID` int(11) NOT NULL auto_increment,
  `Date` date default NULL,
  `Author` varchar(255) collate latin1_general_ci default NULL,
  `Title` varchar(255) collate latin1_general_ci default NULL,
  `Short` text character set latin1 collate latin1_danish_ci,
  `Copy` text collate latin1_general_ci,
  `Photo` varchar(255) collate latin1_general_ci default NULL,
  `PhotoAlt` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`NewsID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_news`
--

INSERT INTO `tbl_news` VALUES(11, '0000-00-00', 'Bob O''Neil', 'CCVF Donation Ceremony', '<p>&#160;</p>\r\n<div style="border-right: medium none; padding-right: 0in; border-top: medium none; padding-left: 0in; padding-bottom: 4pt; border-left: medium none; padding-top: 0in; border-bottom: #4f81bd 1pt solid">\r\n<div style="margin: 0in 0in 0pt">&#160;</div>\r\n<div style="margin: 0in 0in 15pt"><span style="font-size: 20pt"><font color="#17365d">CEDAR CREEK VETERANS FOUNDATION DONATES $10,000 TO THE FISHER HOUSE IN DALLAS FOR EAST TEXAS MILITARY AND THEIR FAMILIES. </font></span></div>\r\n</div>\r\n<div style="margin: 0in 0in 10pt">&#160;</div>', '<p>&#160;</p>\r\n<div style="margin: 0in 0in 10pt"><span style="font-size: 14pt; line-height: 115%">&#160;</span></div>\r\n<div style="margin: 0in 0in 10pt">&#160;\r\n<div style="border-right: medium none; padding-right: 0in; border-top: medium none; padding-left: 0in; padding-bottom: 4pt; border-left: medium none; padding-top: 0in; border-bottom: #4f81bd 1pt solid">\r\n<div style="margin: 0in 0in 0pt">&#160;</div>\r\n<div style="margin: 0in 0in 15pt"><span style="font-size: 20pt"><font color="#17365d">CEDAR CREEK VETERANS FOUNDATION DONATES $10,000 TO THE FISHER HOUSE IN DALLAS FOR EAST TEXAS MILITARY AND THEIR FAMILIES. </font></span></div>\r\n</div>\r\n<div style="margin: 0in 0in 10pt">&#160;</div>\r\n<div style="margin: 0in 0in 10pt"><span style="font-size: 14pt; line-height: 115%">THE CEDAR CREEK VETERANS FOUNDATION IS A NON-PROFIT 501(C)(3) CHARITABLE ORGANIZATION ESTABLISHED TO RAISE MONIES TO ASSIST WITH THE PHYSICAL AND EMOTIONAL RECOVERY AND REHABILITATION OF WOUNDED, INJURED AND DISABLED MILITARY PERSONNEL AND VETERANS WITH A FOCUS ON THOSE INDIVIDUALS RESIDING IN AND ORGANIZATIONS&#160;SERVING THE NORTHEAST TEXAS REGION. THE FOUNDATIONâ€™S PRINCIPAL &#160;FUNDRAISING ACTIVITY IS THE â€œTHUNDER OVER CEDAR CREEK LAKEâ€ AIR SHOW PRESENTED DURING THE JULY 4<sup>TH</sup> HOLIDAY TIMEFRAME. &#160;DONATIONS TO CCVF ARE TAX-DEDUCTIBLE AS ALLOWED BY LAW. </span></div>\r\n<div style="margin: 0in 0in 10pt"><span style="font-size: 14pt; line-height: 115%">PLEASE VISIT CCVF AT </span><a href="http://www.ccveteransfoundation.org/"><span style="font-size: 14pt; line-height: 115%"><font color="#0000ff">WWW.CCVETERANSFOUNDATION.ORG</font></span></a><span style="font-size: 14pt; line-height: 115%"> AND </span><a href="http://www.tocclairshow.com/"><span style="font-size: 14pt; line-height: 115%"><font color="#0000ff">WWW.TOCCLAIRSHOW.COM</font></span></a><span style="font-size: 14pt; line-height: 115%">.&#160;</span></div>\r\n<div style="margin: 0in 0in 10pt">&#160;</div>\r\n<div style="margin: 0in 0in 10pt"><span style="font-size: 14pt; line-height: 115%">THE FISHER HOUSE IS A&#160;HOME AWAY FROM HOME FOR SERVICEMEN, VETERANS AND THEIR FAMILIES. THE FISHER HOUSE ENABLES&#160;MILITARY FAMILIES TO BE TOGETHER DURING EXTENDED TREATMENTS FOR SERIOUS ILLNESS OR LENGTHY PHYSICAL THERAPY SESSIONS AT NO CHARGE. &#160;IT IS LOCATED AT 4500 S LANCASTER RD., DALLAS, TX.</span></div>\r\n<div style="margin: 0in 0in 10pt">&#160;</div>\r\n<div style="margin: 0in 0in 10pt"><span style="font-size: 14pt; line-height: 115%">CCVF BOARD PRESIDENT BOB Oâ€™NEIL &#160;PRESENTING DONATION TO FISHER HOUSE MANAGER, LYDIA HENDERSON.&#160;&#160; DONATION IS SCHEDULED FOR 11:30 A.M. ON 11/10/09 AT THE FISHER HOUSE www.fisherhouse.org</span></div>\r\n<div style="margin: 0in 0in 10pt">&#160;</div>\r\n<div style="margin: 0in 0in 10pt"><span style="font-size: 14pt; line-height: 115%">FOR MORE&#160;INFORMATION AND PHOTOGRAPHS CONTACT &#160;BOB Oâ€™NEIL, AT </span><a href="mailto:RAONEILMMM@AOL.COM"><span style="font-size: 14pt; line-height: 115%"><font color="#0000ff">RAONEILMMM@AOL.COM</font></span></a><span style="font-size: 14pt; line-height: 115%"> OR CALL CELL 903-681-4546.</span></div>\r\n<div style="margin: 0in 0in 10pt">&#160;</div>\r\n<div style="margin: 0in 0in 10pt">&#160;</div>\r\n<div style="margin: 0in 0in 10pt">&#160;</div>\r\n<div style="margin: 0in 0in 10pt">&#160;</div>\r\n<div style="margin: 0in 0in 10pt">&#160;</div>\r\n<div style="margin: 0in 0in 10pt">&#160;</div>\r\n</div>\r\n<div style="margin: 0in 0in 10pt">&#160;</div>\r\n<div style="margin: 0in 0in 10pt">&#160;</div>\r\n<div style="margin: 0in 0in 10pt">&#160;</div>\r\n<p>&#160;</p>\r\n<div style="border-right: medium none; padding-right: 0in; border-top: medium none; padding-left: 0in; padding-bottom: 4pt; border-left: medium none; padding-top: 0in; border-bottom: #4f81bd 1pt solid">\r\n<div style="margin: 0in 0in 0pt">&#160;</div>\r\n<div style="margin: 0in 0in 10pt"><span style="font-size: 14pt; line-height: 115%">&#160;</span></div>\r\n<div style="margin: 0in 0in 10pt">&#160;</div>\r\n<div style="margin: 0in 0in 10pt">&#160;</div>\r\n<div style="margin: 0in 0in 10pt">&#160;</div>\r\n<div style="margin: 0in 0in 10pt">&#160;</div>\r\n</div>', 'CCVF Press Release Photo 111509.JPG', NULL);
INSERT INTO `tbl_news` VALUES(13, '0000-00-00', 'Bob O''Neil', '6th Annual Thunder Over Cedar Creek Lake July 3, 2010', '<p><b>6th Annual Thunder Over Cedar Creek Lake - July 3, 2010</b></p>', '<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-family: &quot;Times New Roman&quot;,&quot;serif&quot;"><v:shapetype id="_x0000_t75" stroked="f" filled="f" path="m@4@5l@4@11@9@11@9@5xe" o:preferrelative="t" o:spt="75" coordsize="21600,21600"><v:stroke joinstyle="miter"></v:stroke><v:formulas><v:f eqn="if lineDrawn pixelLineWidth 0"></v:f><v:f eqn="sum @0 1 0"></v:f><v:f eqn="sum 0 0 @1"></v:f><v:f eqn="prod @2 1 2"></v:f><v:f eqn="prod @3 21600 pixelWidth"></v:f><v:f eqn="prod @3 21600 pixelHeight"></v:f><v:f eqn="sum @0 0 1"></v:f><v:f eqn="prod @6 1 2"></v:f><v:f eqn="prod @7 21600 pixelWidth"></v:f><v:f eqn="sum @8 21600 0"></v:f><v:f eqn="prod @7 21600 pixelHeight"></v:f><v:f eqn="sum @10 21600 0"></v:f></v:formulas><v:path o:connecttype="rect" gradientshapeok="t" o:extrusionok="f"></v:path><o:lock aspectratio="t" v:ext="edit"></o:lock></v:shapetype><v:shape id="_x0000_i1025" style="width: 3in; height: 87pt" type="#_x0000_t75"><v:imagedata o:title="TOCCL air show logo" src="file:///C:\\Users\\Karen\\AppData\\Local\\Temp\\msohtmlclip1\\01\\clip_image001.jpg"></v:imagedata></v:shape></span><b style="mso-bidi-font-weight: normal"><span style="font-size: 14pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;">Thunder over Cedar Creek Lake Air Show</span></b><b style="mso-bidi-font-weight: normal"><span style="font-size: 11pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;"><o:p></o:p></span></b></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-size: 11pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;"><o:p>&#160;</o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-size: 11pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;">MABANK, TX --- The 6<sup>th</sup> Annual Thunder over Cedar Creek Lake Air Show will be held July 3<sup>rd</sup>, 2010 over the shining waters of Cedar Creek Lake just 55 minutes southeast of Dallas.<span style="mso-spacerun: yes">&#160; </span>Thunder over Cedar Creek Lake is a unique family event, the only one of its kind in Texas!<span style="mso-spacerun: yes">&#160; </span>Spectators come for miles around to enjoy the Air Show performances that take place, not at an airport, but entirely <i style="mso-bidi-font-style: normal">over</i> <i style="mso-bidi-font-style: normal">the water</i>!<span style="mso-spacerun: yes">&#160; </span>They can either watch the action packed evening from their own boats on the lake or join the nearly 40,000 people lining the shoreline.<span style="mso-spacerun: yes">&#160; </span>There are no admission fees for this spectacular Air Show unless one prefers to sit in the elegant VIP seating area located on the shore line at the prestigious Pinnacle Club.<span style="mso-spacerun: yes">&#160; </span><o:p></o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-size: 11pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;"><o:p>&#160;</o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-size: 11pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;">Thunder over Cedar Creek Lake takes place July 3<sup>rd</sup> just before sunset beginning at 6:30pm culminating in a giant fireworks display at 9:15pm.<o:p></o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-size: 11pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;"><o:p>&#160;</o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-size: 11pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;">The Air Show honors military aviation with performances by the US Air Force B1 Bomber, a C-17 Cargo Plane, the incredible Commemorative Air Force group Tora, Tora, Tora with their Japanese fighters and bombers simulating the Pearl Harbor attack in breathtaking dog fights filled with breathtaking smoke, fire, and explosions that will leave you in awe. Be astounded by the dramatic formation aerobatics of the Trojan Phlyers T-28 team.<span style="mso-spacerun: yes">&#160; </span>Enjoy a P-39 fighter, B-25 bombers, an L-29 fighter jet and more announced daily.<span style="mso-spacerun: yes">&#160; </span>The evening Air Show culminates with a powerful, dramatic show by Randy Ball in his MiG 17 as he demonstrates 600 mile per hour dives into the dusk.<span style="mso-spacerun: yes">&#160; </span>Feel the heat of the afterburner!<o:p></o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-family: &quot;Times New Roman&quot;,&quot;serif&quot;"><o:p>&#160;</o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-size: 11pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;">Pre event activities include a free static display of participating aircraft at the Athens, TX airport July 2 from Noon to 5pm, a Meet the Pilots luau party Friday, July 2<sup>nd</sup> at 6:30pm at the Pinnacle Club (tickets required), and another free aircraft static display in Tyler on July 3<sup>rd</sup> at 10am at the historic Aviation Memorial Museum at Pounds Air Field.<span style="mso-spacerun: yes">&#160; </span><o:p></o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-size: 11pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;"><o:p>&#160;</o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-size: 11pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;">The Thunder over Cedar Creek Lake Air Show is organized by the Cedar Creek Veterans Foundation, a 501(c)(3) organization.<span style="mso-spacerun: yes">&#160; </span>This foundation was established to raise funds to assist the physical and emotional recovery of the injured and disabled <span style="mso-spacerun: yes">&#160;</span>military personnel with a focus on individuals residing in, and organizations serving, the northeast Texas area.<span style="mso-spacerun: yes">&#160; </span>This annual Air Show is the primary fundraising activity for the foundation.<span style="mso-spacerun: yes">&#160; </span>Donations are needed and are tax deductible.<span style="mso-spacerun: yes">&#160; </span>A charity golf tournament will be held Monday, June 7 to raise funds for the Air Show.<o:p></o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-size: 11pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;"><o:p>&#160;</o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-size: 11pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;">Due to the success of the 2009 event, the Cedar Creek Veterans Foundation was able to donate $10,000 to one if its major recipient organizations, the Fisher House in Dallas for East Texas military and their families.<o:p></o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-size: 11pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;"><o:p>&#160;</o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-size: 11pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;">For more information on the Thunder over Cedar Creek Lake Air Show, visit <a href="http://www.tocclairshow.com/">www.tocclairshow.com</a>.<span style="mso-spacerun: yes">&#160; </span>For information on the Cedar Creek Veterans Foundation, visit <a href="http://www.ccveteransfoundation.org/">www.ccveteransfoundation.org</a>. <o:p></o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-family: &quot;Times New Roman&quot;,&quot;serif&quot;"><o:p>&#160;</o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt; text-align: center" align="center"><span style="font-family: &quot;Times New Roman&quot;,&quot;serif&quot;">###<o:p></o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-size: 11pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;">Contact:<o:p></o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-size: 11pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;">Bob Oâ€™Neil<o:p></o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-size: 11pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;">903 681 4546<o:p></o:p></span></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><span style="font-size: 11pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;">raoneilmmm@aol.com</span><b style="mso-bidi-font-weight: normal"><span style="font-size: 14pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;"><o:p></o:p></span></b></p>\r\n<p class="MsoNormal" style="margin: 0in 0in 0pt"><b style="mso-bidi-font-weight: normal"><span style="font-size: 14pt; font-family: &quot;Times New Roman&quot;,&quot;serif&quot;"><o:p>&#160;</o:p></span></b></p>\r\n<p>&#160;</p>', '', NULL);
