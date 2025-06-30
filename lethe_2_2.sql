-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 25 Ara 2018, 10:51:31
-- Sunucu sürümü: 10.1.35-MariaDB
-- PHP Sürümü: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `lethe_2_2`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_blacklist`
--

CREATE TABLE `lethe_blacklist` (
  `ID` bigint(15) NOT NULL,
  `OID` int(11) NOT NULL DEFAULT '1',
  `email` varchar(255) DEFAULT NULL,
  `ipAddr` varchar(255) DEFAULT NULL,
  `reasons` int(11) DEFAULT '0',
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_bounce_rules`
--

CREATE TABLE `lethe_bounce_rules` (
  `BRID` int(11) NOT NULL,
  `rule` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `rule_cat` varchar(100) NOT NULL DEFAULT '0',
  `matc` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `lethe_bounce_rules`
--

INSERT INTO `lethe_bounce_rules` (`BRID`, `rule`, `desc`, `rule_cat`, `matc`) VALUES
(1, '/<(\\S+@\\S+\\w)>.*\\n?.*\\n?.*user unknown/i', '<xxxxx@yourdomain.com>:\r\n111.111.111.111 does not like recipient.\r\nRemote host said: 550 User unknown', 'unknown', 1),
(2, '/<(\\S+@\\S+\\w)>.*\\n?.*no mailbox/i', 'rule: mailbox unknown;\r\nsample:\r\nSorry, no mailbox here by that name. vpopmail (#5.1.1)', 'unknown', 1),
(3, '/(\\S+@\\S+\\w)<br>.*\\n?.*\\n?.*can\'t find.*mailbox/i', 'rule: mailbox unknown;\r\nsample:\r\nxxxxx@yourdomain.com\r\n\r\nlocal: Sorry, can\'t find user\'s mailbox. (#5.1.1)', 'unknown', 1),
(4, '/Can\'t create output.*\\n?.*<(\\S+@\\S+\\w)>/i', 'rule: mailbox unknown;\r\nsample:\r\n  ##########################################################\r\n  #  This is an automated response from a mail delivery    #\r\n  #  program.  Your message could not be delivered to      #\r\n  #  the following address:                                #\r\n  #                                                        #\r\n  #      \"|/usr/local/bin/mailfilt -u #dkms\"               #\r\n  #        (reason: Can\'t create output)                   #\r\n  #        (expanded from: <xxxxx@yourdomain.com>)         #\r\n  #                                                        #', 'unknown', 1),
(5, '/(\\S+@\\S+\\w).*=D5=CA=BA=C5=B2=BB=B4=E6=D4=DA/i', 'rule: mailbox unknown;\r\nsample:\r\n????????????????:\r\nxxxxx@yourdomain.com : ????, ?????.', 'unknown', 1),
(6, '/(\\S+@\\S+\\w).*\\n?.*Unrouteable address/i', 'rule: mailbox unknown;\r\nsample:\r\nxxxxx@yourdomain.com\r\nUnrouteable address', 'unknown', 1),
(7, '/delivery[^\\n\\r]+failed\\S*\\s+(\\S+@\\S+\\w)\\s/is', 'rule: mailbox unknow;\r\nsample:\r\nDelivery to the following recipients failed.\r\nxxxxx@yourdomain.com', 'unknown', 1),
(8, '/(\\S+@\\S+\\w).*\\n?.*unknown local-part/i', 'rule: mailbox unknown;\r\nsample:\r\nA message that you sent could not be delivered to one or more of its\r\nrecipients. This is a permanent error. The following address(es) failed:\r\n\r\nxxxxx@yourdomain.com\r\nunknown local-part \"xxxxx\" in domain \"yourdomain.com\"', 'unknown', 1),
(9, '/Invalid.*(?:alias|account|recipient|address|email|mailbox|user).*<(\\S+@\\S+\\w)>/i', 'rule: mailbox unknown;\r\nsample:\r\n<xxxxx@yourdomain.com>:\r\n111.111.111.11 does not like recipient.\r\nRemote host said: 550 Invalid recipient: <xxxxx@yourdomain.com>', 'unknown', 1),
(10, '/\\s(\\S+@\\S+\\w).*No such.*(?:alias|account|recipient|address|email|mailbox|user)>/i', 'rule: mailbox unknown;\r\nsample:\r\nSent >>> RCPT TO: <xxxxx@yourdomain.com>\r\nReceived <<< 550 xxxxx@yourdomain.com... No such user\r\n\r\nCould not deliver mail to this user.\r\nxxxxx@yourdomain.com\r\n*****************     End of message     ***************', 'unknown', 1),
(11, '/<(\\S+@\\S+\\w)>.*\\n?.*(?:alias|account|recipient|address|email|mailbox|user).*no.*accept.*mail>/i', 'rule: mailbox unknown;\r\nsample:\r\n<xxxxx@yourdomain.com>:\r\nThis address no longer accepts mail.', 'unknown', 1),
(12, '/<(\\S+@\\S+\\w)>.*\\n?.*\\n?.*over.*quota/i', 'rule: full\r\nsample 1:\r\n<xxxxx@yourdomain.com>:\r\nThis account is over quota and unable to receive mail.\r\nsample 2:\r\n<xxxxx@yourdomain.com>:\r\nWarning: undefined mail delivery mode: normal (ignored).\r\nThe users mailfolder is over the allowed quota (size). (#5.2.2)', 'full', 1),
(13, '/quota exceeded.*\\n?.*<(\\S+@\\S+\\w)>/i', 'rule: mailbox full;\r\nsample:\r\n  ----- Transcript of session follows -----\r\nmail.local: /var/mail/2b/10/kellen.lee: Disc quota exceeded\r\n554 <xxxxx@yourdomain.com>... Service unavailable', 'full', 1),
(14, '/<(\\S+@\\S+\\w)>.*\\n?.*quota exceeded/i', 'rule: mailbox full;\r\nsample:\r\nHi. This is the qmail-send program at 263.domain.com.\r\n<xxxxx@yourdomain.com>:\r\n - User disk quota exceeded. (#4.3.0)', 'full', 1),
(15, '/\\s(\\S+@\\S+\\w)\\s.*\\n?.*mailbox.*full/i', 'rule: mailbox full;\r\nsample:\r\nxxxxx@yourdomain.com\r\nmailbox is full (MTA-imposed quota exceeded while writing to file /mbx201/mbx011/A100/09/35/A1000935772/mail/.inbox):', 'full', 1),
(16, '/The message to (\\S+@\\S+\\w)\\s.*bounce.*Quota exceed/i', 'rule: mailbox full;\r\nsample:\r\nThe message to xxxxx@yourdomain.com is bounced because : Quota exceed the hard limit', 'full', 1),
(17, '/(\\S+@\\S+\\w)<br>.*\\n?.*\\n?.*user is inactive/i', 'rule: inactive\r\nsample:\r\nxxxxx@yourdomain.com\r\n553 user is inactive (eyou mta)', 'inactive', 1),
(18, '/(\\S+@\\S+\\w).*inactive account/i', 'rule: inactive\r\nsample:\r\nxxxxx@yourdomain.com [Inactive account]', 'inactive', 1),
(19, '/<(\\S+@\\S+\\w)>.*\\n?.*input\\/output error/i', 'rule: internal_error\r\nsample:\r\n<xxxxx@yourdomain.com>:\r\nUnable to switch to /var/vpopmail/domains/domain.com: input/output error. (#4.3.0)', 'internal_error', 1),
(20, '/<(\\S+@\\S+\\w)>.*\\n?.*can not open new email file/i', 'rule: internal_error\r\nsample:\r\n<xxxxx@yourdomain.com>:\r\ncan not open new email file errno=13 file=/home/vpopmail/domains/fromc.com/0/domain/Maildir/tmp/1155254417.28358.mx05,S=212350', 'internal_error', 1),
(21, '/<(\\S+@\\S+\\w)>.*\\n?.*\\n?.*Resources temporarily unavailable/i', 'rule: defer\r\nsample:\r\n<xxxxx@yourdomain.com>:\r\n111.111.111.111 failed after I sent the message.\r\nRemote host said: 451 mta283.mail.scd.yahoo.com Resources temporarily unavailable. Please try again later [#4.16.5].', 'defer', 1),
(22, '/^AutoReply message from (\\S+@\\S+\\w)/i', 'rule: autoreply\r\nsample:\r\nAutoReply message from xxxxx@yourdomain.com', 'autoreply', 1),
(23, '/<(\\S+@\\S+\\w)>.*\\n?.*does not accept[^\\r\\n]*non-Western/i', 'rule: western chars only\r\nsample:\r\n<xxxxx@yourdomain.com>:\r\nThe user does not accept email in non-Western (non-Latin) character sets.', 'latin_only', 1),
(24, '/^\\/var\\/mail\\/nobody/im', 'rule: Unknow body\r\nsample:\r\n/var/mail/nobody:\r\nUnknow body.', 'unknown', 1),
(25, '/^message delivery failure/im', 'rule: Message Delivery Failure\r\nsample:\r\nMessage Delivery Failure - E-Mail Verification:\r\nUnknow body.', 'dns_unknown', 1),
(26, '/returning message to sender/im', 'rule: Message Delivery Failure\r\nsample:\r\nMessage Delivery Failure - returning message to sender\r\nUnknow body.', 'unknown', 1),
(27, '/^550 5\\.7\\.1/im', 'rule: 550 5.7.1\r\nsample:\r\nMessage Delivery Failure - E-Mail Verification:\r\nUnknow body.', 'dns_unknown', 0),
(28, '/%G%\\#%l%\\/%H%j\\+\\$\\+\\$\\^\\$;!\\#/imu', 'rule: %G%#%l%/%H%j+$+$^$;!#\r\nsample:\r\nMessage Delivery Failure - E-Mail Verification:\r\nUnknow body.', 'dns_unknown', 0),
(29, '/550 5.7.1/im', 'rule: 550 5.7.1\r\nsample:\r\n550 5.7.1\r\nUnknow body.', 'dns_unknown', 0),
(30, '/(?:alias|account|recipient|address|email|mailbox|user).*(?:n\'t|not) exist/is', 'rule: 550 5.1.1\r\nsample:\r\n550 5.1.1\r\nUnknow user - recipient.', 'unknown', 1),
(31, '/(?:alias|account|recipient|address|email|mailbox|user)(.*)not(.*)list/is', 'rule: 550 5.1.1\r\nsample:\r\n550 5.1.1\r\nX-Notes; User xxxxx (xxxxx@yourdomain.com) not listed in public Name & Address Book', 'unknown', 1),
(32, '/no.*valid.*(?:alias|account|recipient|address|email|mailbox|user)/is', 'rule: 550 5.1.1\r\nsample:\r\n550 5.1.1\r\nSMTP; 554 qq Sorry, no valid recipients (#5.1.3)', 'unknown', 1),
(33, '/Invalid.*(?:alias|account|recipient|address|email|mailbox|user)/is', 'rule: 550 5.1.1\r\nsample:\r\nSMTP; 550 «Dªk¦a§} - invalid address (#5.5.0)\r\nSMTP; 550 Invalid recipient: <xxxxx@yourdomain.com>\r\nSMTP; 550 <xxxxx@yourdomain.com>: Invalid User', 'unknown', 1),
(34, '/(?:alias|account|recipient|address|email|mailbox|user).*(?:disabled|discontinued)/is', 'rule: 550 5.1.1\r\nsample:\r\n550 5.1.1\r\nSMTP; 554 delivery error: dd Sorry your message to xxxxx@yourdomain.com cannot be delivered.', 'unknown', 1),
(35, '/user doesn\'t have.*account/is', 'rule: 550 5.1.1\r\nsample:\r\n550 5.1.1\r\nSMTP; 554 delivery error: dd This user doesn\'t have a domain.com account (www.xxxxx@yourdomain.com)', 'unknown', 1),
(36, '/(?:unknown|illegal).*(?:alias|account|recipient|address|email|mailbox|user)/is', 'rule: 550 5.1.1\r\nsample:\r\n550 5.1.1\r\nDiagnostic-Code: SMTP; 550 5.1.1 unknown or illegal alias: xxxxx@yourdomain.com', 'unknown', 1),
(37, '/(?:alias|account|recipient|address|email|mailbox|user).*(?:un|not\\s+)available/is', 'rule: 550 5.1.1\r\nsample:\r\n550 5.1.1\r\nDiagnostic-Code: SMTP; 550 5.7.1 Requested action not taken: mailbox not available', 'unknown', 1),
(38, '/no (?:alias|account|recipient|address|email|mailbox|user)/is', 'rule: 550 5.1.1\r\nsample:\r\n550 5.1.1\r\nDiagnostic-Code: SMTP; 553 sorry, no mailbox here by that name (#5.7.1)', 'unknown', 1),
(39, '/550 access denied/im', 'rule: 550 access denied\r\nsample:\r\n550 access denied\r\nUnknow body.', 'dns_unknown', 0),
(40, '/(?:alias|account|recipient|address|email|mailbox|user).*full/is', 'Triggered by:\r\n\r\nDiagnostic-Code: smtp;552 5.2.2 This message is larger than the current system limit or the recipient\'s mailbox is full. Create a shorter message body or remove attachments and try sending it again.\r\n\r\nDiagnostic-Code: X-Postfix; host mta5.us4.domain.com.int[111.111.111.111] said:\r\n552 recipient storage full, try again later (in reply to RCPT TO command)\r\n\r\nDiagnostic-Code: X-HERMES; host 127.0.0.1[127.0.0.1] said: 551 bounce as<the\r\ndestination mailbox <xxxxx@yourdomain.com> is full> queue as\r\n100.1.ZmxEL.720k.1140313037.xxxxx@yourdomain.com (in reply to end of\r\nDATA command)', 'full', 1),
(41, '/Insufficient system storage/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 452 Insufficient system storage', 'full', 1),
(42, '/File too large/is', 'Triggered by:\r\nDiagnostic-Code: X-Postfix; cannot append message to destination file\r\n/var/mail/dale.me89g: error writing message: File too large\r\nDiagnostic-Code: X-Postfix; cannot access mailbox /var/spool/mail/b8843022 for\r\nuser xxxxx. error writing message: File too large', 'oversize', 1),
(43, '/larger than.*limit/is', 'Triggered by:\r\nDiagnostic-Code: smtp;552 5.2.2 This message is larger than the current system limit or the recipient\'s mailbox is full. Create a shorter message body or remove attachments and try sending it again.', 'oversize', 1),
(44, '/user path no exist/is', 'Triggered by:\r\nDiagnostic-Code: smtp; 450 user path no exist', 'unknown', 0),
(45, '/Relay.*(?:denied|prohibited)/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 Relaying denied.\r\nDiagnostic-Code: SMTP; 554 <xxxxx@yourdomain.com>: Relay access denied\r\nDiagnostic-Code: SMTP; 550 relaying to <xxxxx@yourdomain.com> prohibited by administrator', 'unknown', 1),
(46, '/(?:alias|account|recipient|address|email|mailbox|user).*unknown/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 User (xxxxx@yourdomain.com) unknown.\r\nDiagnostic-Code: SMTP; 553 5.3.0 <xxxxx@yourdomain.com>... Addressee unknown, relay=[111.111.111.000]', 'unknown', 1),
(47, '/(?:alias|account|recipient|address|email|mailbox|user).*disabled/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 user disabled\r\nDiagnostic-Code: SMTP; 452 4.2.1 mailbox temporarily disabled: xxxxx@yourdomain.com', 'unknown', 1),
(48, '/No such (?:alias|account|recipient|address|email|mailbox|user)/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com>: Recipient address rejected: No such user (xxxxx@yourdomain.com)', 'user_reject', 1),
(49, '/(?:alias|account|recipient|address|email|mailbox|user).*NOT FOUND/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 MAILBOX NOT FOUND\r\nDiagnostic-Code: SMTP; 550 Mailbox ( xxxxx@yourdomain.com ) not found or inactivated', 'unknown', 1),
(50, '/deactivated (?:alias|account|recipient|address|email|mailbox|user)/is', 'Triggered by:\r\nDiagnostic-Code: X-Postfix; host m2w-in1.domain.com[111.111.111.000] said: 551\r\n <xxxxx@yourdomain.com> is a deactivated mailbox (in reply to RCPT TO command)', 'inactive', 1),
(51, '/(?:alias|account|recipient|address|email|mailbox|user).*reject/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com> recipient rejected\r\n ...\r\n<<< 550 <xxxxx@yourdomain.com> recipient rejected\r\n550 5.1.1 xxxxx@yourdomain.com... User unknown', 'user_reject', 1),
(52, '/bounce.*administrator/is', 'Triggered by:\r\nDiagnostic-Code: smtp; 5.x.0 - Message bounced by administrator  (delivery attempts: 0)', 'unknown', 1),
(53, '/<.*>.*disabled/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 <maxqin> is now disabled with MTA service.', 'unknown', 1),
(54, '/not our customer/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 551 not our customer', 'unknown', 1),
(55, '/Wrong (?:alias|account|recipient|address|email|mailbox|user)/is', 'Triggered by:\r\nDiagnostic-Code: smtp; 5.1.0 - Unknown address error 540-\'Error: Wrong recipients\' (delivery attempts: 0)', 'unknown', 1),
(56, '/(?:unknown|bad).*(?:alias|account|recipient|address|email|mailbox|user)/is', 'Triggered by:\r\nDiagnostic-Code: smtp; 5.1.0 - Unknown address error 540-\'Error: Wrong recipients\' (delivery attempts: 0)\r\nDiagnostic-Code: SMTP; 501 #5.1.1 bad address xxxxx@yourdomain.com', 'unknown', 1),
(57, '/(?:alias|account|recipient|address|email|mailbox|user).*not OK/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 Command RCPT User <xxxxx@yourdomain.com> not OK', 'command_reject', 1),
(58, '/Access.*Denied/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 5.7.1 Access-Denied-XM.SSR-001', 'unknown', 1),
(59, '/(?:alias|account|recipient|address|email|mailbox|user).*lookup.*fail/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 5.1.1 <xxxxx@yourdomain.com>... email address lookup in domain map failed', 'unknown', 1),
(60, '/(?:recipient|address|email|mailbox|user).*not.*member of domain/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 User not a member of domain: <xxxxx@yourdomain.com>', 'unknown', 1),
(61, '/(?:alias|account|recipient|address|email|mailbox|user).*cannot be verified/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550-\"The recipient cannot be verified.  Please check all recipients of this', 'unknown', 1),
(62, '/Unable to relay/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 Unable to relay for xxxxx@yourdomain.com', 'unknown', 1),
(63, '/not have an account/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550-I\'m sorry but xxxxx@yourdomain.com does not have an account here. I will not', 'unknown', 1),
(64, '/(?:alias|account|recipient|address|email|mailbox|user).*is not allowed/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 This account is not allowed...xxxxx@yourdomain.com', 'unknown', 1),
(65, '/inactive.*(?:alias|account|recipient|address|email|mailbox|user)/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com>: inactive user', 'inactive', 1),
(66, '/(?:alias|account|recipient|address|email|mailbox|user).*Inactive/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 xxxxx@yourdomain.com Account Inactive', 'inactive', 1),
(67, '/(?:alias|account|recipient|address|email|mailbox|user) closed due to inactivity/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com>: Recipient address rejected: Account closed due to inactivity. No forwarding information is available.', 'inactive', 1),
(68, '/(?:alias|account|recipient|address|email|mailbox|user) not activated/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com>... User account not activated', 'inactive', 1),
(69, '/(?:alias|account|recipient|address|email|mailbox|user).*(?:suspend|expire)/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 User suspended\r\nDiagnostic-Code: SMTP; 550 account expired', 'inactive', 1),
(70, '/(?:alias|account|recipient|address|email|mailbox|user).*no longer exist/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 553 5.3.0 <xxxxx@yourdomain.com>... Recipient address no longer exists', 'inactive', 1),
(71, '/(?:forgery|abuse)/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 553 VS10-RT Possible forgery or deactivated due to abuse (#5.1.1) 111.111.111.211', 'inactive', 1),
(72, '/(?:alias|account|recipient|address|email|mailbox|user).*restrict/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 553 mailbox xxxxx@yourdomain.com is restricted', 'unknown', 1),
(73, '/(?:alias|account|recipient|address|email|mailbox|user).*locked/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com>: User status is locked.', 'inactive', 1),
(74, '/(?:alias|account|recipient|address|email|mailbox|user) refused/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 553 User refused to receive this mail.', 'unknown', 1),
(75, '/sender.*not/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 501 xxxxx@yourdomain.com Sender email is not in my domain', 'unknown', 1),
(76, '/Message (refused|reject(ed)?)/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 554 Message refused', 'content_reject', 1),
(77, '/No permit/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 5.0.0 <xxxxx@yourdomain.com>... No permit', 'warning', 1),
(78, '/domain isn\'t in.*allowed rcpthost/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 553 sorry, that domain isn\'t in my list of allowed rcpthosts (#5.5.3 - chkuser)', 'unknown', 1),
(79, '/AUTH FAILED/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 553 AUTH FAILED - xxxxx@yourdomain.com', 'warning', 1),
(80, '/relay.*not.*(?:permit|allow)/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 relay not permitted\r\nDiagnostic-Code: SMTP; 530 5.7.1 Relaying not allowed: xxxxx@yourdomain.com', 'unknown', 1),
(81, '/not local host/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 not local host domain.com, not a gateway', 'unknown', 1),
(82, '/Unauthorized relay/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 500 Unauthorized relay msg rejected', 'user_reject', 1),
(83, '/Transaction.*fail/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 554 Transaction failed', 'unknown', 1),
(84, '/Invalid data/is', 'Triggered by:\r\nDiagnostic-Code: smtp;554 5.5.2 Invalid data in message', 'content_reject', 1),
(85, '/Local user only/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 Local user only or Authentication mechanism', 'unknown', 1),
(86, '/not.*permit.*to/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550-ds176.domain.com [111.111.111.211] is currently not permitted to\r\nrelay through this server. Perhaps you have not logged into the pop/imap\r\nserver in the last 30 minutes or do not have SMTP Authentication turned on\r\nin your email client.', 'warning', 1),
(87, '/Content reject/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 Content reject. FAAAANsG60M9BmDT.1', 'content_reject', 1),
(88, '/MIME\\/REJECT/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 552 MessageWall: MIME/REJECT: Invalid structure', 'content_reject', 1),
(89, '/MIME error/is', 'Triggered by:\r\nDiagnostic-Code: smtp; 554 5.6.0 Message with invalid header rejected, id=13462-01 - MIME error: error: UnexpectedBound: part didn\'t end with expected boundary [in multipart message]; EOSToken: EOF; EOSType: EOF', 'content_reject', 1),
(90, '/Mail data refused.*AISP/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 553 Mail data refused by AISP, rule [169648].', 'content_reject', 1),
(91, '/Host unknown/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 Host unknown', 'dns_unknown', 1),
(92, '/Specified domain.*not.*allow/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 553 Specified domain is not allowed.', 'dns_loop', 1),
(93, '/No route to host/is', 'Triggered by:\r\nDiagnostic-Code: X-Postfix; delivery temporarily suspended: connect to\r\n111.111.11.112[111.111.11.112]: No route to host', 'dns_unknown', 1),
(94, '/unrouteable address/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 unrouteable address', 'dns_unknown', 1),
(95, '/System.*busy/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 451 System(u) busy, try again later.', 'internal_error', 1),
(96, '/Resources temporarily unavailable/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 451 mta172.mail.tpe.domain.com Resources temporarily unavailable. Please try again later.  [#4.16.4:70].', 'internal_error', 1),
(97, '/sender is rejected/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 554 sender is rejected: 0,mx20,wKjR5bDrnoM2yNtEZVAkBg==.32467S2', 'user_reject', 1),
(98, '/Client host rejected/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 554 <unknown[111.111.111.000]>: Client host rejected: Access denied', 'user_reject', 1),
(99, '/MAIL FROM(.*)mismatches client IP/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 554 Connection refused(mx). MAIL FROM [xxxxx@yourdomain.com] mismatches client IP [111.111.111.000].', 'unknown', 1),
(100, '/denyip/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 554 Please visit http:// antispam.domain.com/denyip.php?IP=111.111.111.000 (#5.7.1)', 'antispam', 1),
(101, '/client host.*blocked/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 554 Service unavailable; Client host [111.111.111.211] blocked using dynablock.domain.com; Your message could not be delivered due to complaints we received regarding the IP address you\'re using or your ISP. See http:// blackholes.domain.com/ Error: WS-02', 'antispam', 1),
(102, '/mail.*reject/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 Requested action not taken: mail IsCNAPF76kMDARUY.56621S2 is rejected,mx3,BM', 'user_reject', 1),
(103, '/spam.*detect/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 552 sorry, the spam message is detected (#5.6.0)', 'antispam', 1),
(104, '/reject.*spam/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 554 5.7.1 Rejected as Spam see: http:// rejected.domain.com/help/spam/rejected.html', 'antispam', 1),
(105, '/SpamTrap/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 553 5.7.1 <xxxxx@yourdomain.com>... SpamTrap=reject mode, dsn=5.7.1, Message blocked by BOX Solutions (www.domain.com) SpamTrap Technology, please contact the domain.com site manager for help: (ctlusr8012).', 'antispam', 1),
(106, '/Verify mailfrom failed/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 Verify mailfrom failed,blocked', 'antispam', 1),
(107, '/MAIL.*FROM.*mismatch/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 Error: MAIL FROM is mismatched with message header from address!', 'content_reject', 1),
(108, '/spam scale/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 554 5.7.1 Message scored too high on spam scale.  For help, please quote incident ID 22492290.', 'antispam', 1),
(109, '/junk mail/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 550 sorry, it seems as a junk mail', 'antispam', 1),
(110, '/message filtered/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 553-Message filtered. Please see the FAQs section on spam', 'antispam', 1),
(111, '/subject.*consider.*spam/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 554 5.7.1 The message from (<xxxxx@yourdomain.com>) with the subject of ( *(ca2639) 7|-{%2E* : {2\"(%EJ;y} (SBI$#$@<K*:7s1!=l~) matches a profile the Internet community may consider spam. Please revise your message before resending.', 'antispam', 1),
(112, '/Temporary local problem/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 451 Temporary local problem - please try later', 'warning', 1),
(113, '/system config error/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 553 5.3.5 system config error', 'warning', 1),
(114, '/(\\s+)?\\(RTR:BL\\)/is', 'Triggered by:\r\nDiagnostic-Code: SMTP; 554- (RTR:BL)\r\nhttp://postmaster.info.aol.com/errors/554rtrbl.html 554  Connecting IP: 111.111.111.111', 'internal_error', 1),
(115, '/delivery.*suspend/is', 'Triggered by:\r\nDiagnostic-Code: X-Postfix; delivery temporarily suspended: conversation with\r\n111.111.111.11[111.111.111.11] timed out while sending end of data -- message may be sent more than once', 'dns_loop', 1),
(116, '/(?:alias|account|recipient|address|email|mailbox|user)(.*)invalid/i', 'Triggered by:\r\n----- The following addresses had permanent fatal errors -----\r\n<xxxxx@yourdomain.com>\r\n----- Transcript of session follows -----\r\n... while talking to mta1.domain.com.:\r\n>>> DATA <<< 503 All recipients are invalid\r\n554 5.0.0 Service unavailable\r\n', 'warning', 1),
(117, '/Deferred.*No such.*(?:file|directory)/i', 'Triggered by:\r\n----- Transcript of session follows -----\r\nxxxxx@yourdomain.com... Deferred: No such file or directory', 'warning', 1),
(118, '/mail receiving disabled/i', 'Triggered by:\r\nFailed to deliver to \'<xxxxx@yourdomain.com>\'\r\nLOCAL module(account xxxx) reports:\r\nmail receiving disabled', 'inactive', 1),
(119, '/bad.*(?:alias|account|recipient|address|email|mailbox|user)/i', 'Triggered by:\r\n- These recipients of your message have been processed by the mail server:\r\nxxxxx@yourdomain.com; Failed; 5.1.1 (bad destination mailbox address)', 'dns_unknown', 1),
(120, '/over.*quota/i', 'Triggered by:\r\nThis Message was undeliverable due to the following reason:\r\nThe user(s) account is temporarily over quota.\r\n<xxxxx@yourdomain.com>\r\nRecipient address: xxxxx@yourdomain.com\r\nReason: Over quota', 'full', 1),
(121, '/quota.*exceeded/i', 'Triggered by:\r\nSorry the recipient quota limit is exceeded.\r\nThis message is returned as an error.', 'full', 1),
(122, '/exceed.*\\n?.*quota/i', 'Triggered by:\r\nThe user to whom this message was addressed has exceeded the allowed mailbox\r\nquota. Please resend the message at a later time.', 'full', 1),
(123, '/space.*not.*enough/i', 'Triggered by:\r\ngaosong \"(0), ErrMsg=Mailbox space not enough (space limit is 10240KB)', 'full', 1),
(124, '/Deferred.*Connection (?:refused|reset)/i', 'Triggered by:\r\n----- Transcript of session follows -----\r\nxxxxx@yourdomain.com... Deferred: Connection refused by nomail.tpe.domain.com.\r\nMessage could not be delivered for 5 days\r\nMessage will be deleted from queue\r\n451 4.4.1 reply: read error from www.domain.com.\r\nxxxxx@yourdomain.com... Deferred: Connection reset by www.domain.com.', 'unknown', 1),
(125, '/Invalid host name/i', 'Triggered by:\r\n----- The following addresses had permanent fatal errors -----\r\nTan XXXX SSSS <xxxxx@yourdomain..com>\r\n----- Transcript of session follows -----\r\n553 5.1.2 XXXX SSSS <xxxxx@yourdomain..com>... Invalid host name', 'dns_unknown', 1),
(126, '/Deferred.*No route to host/i', 'Triggered by:\r\n----- Transcript of session follows -----\r\nxxxxx@yourdomain.com... Deferred: mail.domain.com.: No route to host', 'dns_unknown', 1),
(127, '/Host unknown/i', 'Triggered by:\r\n----- Transcript of session follows -----\r\n550 5.1.2 xxxxx@yourdomain.com... Host unknown (Name server: .: no data known)', 'dns_unknown', 1),
(128, '/Name server timeout/i', 'Triggered by:\r\n----- Transcript of session follows -----\r\n451 HOTMAIL.com.tw: Name server timeout\r\nMessage could not be delivered for 5 days\r\nMessage will be deleted from queue', 'dns_loop', 1),
(129, '/Deferred.*Connection.*tim(?:e|ed).*out/i', 'Triggered by:\r\n----- Transcript of session follows -----\r\nxxxxx@yourdomain.com... Deferred: Connection timed out with hkfight.com.\r\nMessage could not be delivered for 5 days\r\nMessage will be deleted from queue', 'dns_loop', 1),
(130, '/Deferred.*host name lookup failure/i', 'Triggered by:\r\n----- Transcript of session follows -----\r\nxxxxx@yourdomain.com... Deferred: Name server: domain.com.: host name lookup failure', 'warning', 1),
(131, '/MX list.*point.*back/i', 'Triggered by:\r\n----- Transcript of session follows -----\r\n554 5.0.0 MX list for znet.ws. points back to mail01.domain.com\r\n554 5.3.5 Local configuration error', 'dns_unknown', 1),
(132, '/I\\/O error/i', 'Triggered by:\r\n----- Transcript of session follows -----\r\n451 4.0.0 I/O error', 'warning', 1),
(133, '/connection.*broken/i', 'Triggered by:\r\nFailed to deliver to \'xxxxx@yourdomain.com\'\r\nSMTP module(domain domain.com) reports:\r\nconnection with mx1.mail.domain.com is broken', 'internal_error', 1),
(134, '/Delivery to the following recipients failed/i', 'Triggered by:\r\nDelivery to the following recipients failed.\r\nxxxxx@yourdomain.com', 'unknown', 1),
(135, '/User unknown/i', 'Triggered by:\r\n----- The following addresses had permanent fatal errors -----\r\n<xxxxx@yourdomain.com>\r\n(reason: User unknown)\r\n550 5.1.1 xxxxx@yourdomain.com... User unknown', 'unknown', 1),
(136, '/Service unavailable/i', 'Triggered by:\r\n554 5.0.0 Service unavailable', 'internal_error', 1),
(137, '/(user\\shas\\s)?exceeded(\\s+storage\\sallocation)?/i', 'Triggered by:\r\nuser has Exceeded\r\nexceeded storage allocation', 'full', 1),
(138, '/mail(box|folder)(\\s+)?(is|full|quota|size)(\\s+)?(full|usage|limit)?(\\s+)?(exceeded)?/i', 'Triggered by:\r\nMailbox full\r\nmailbox is full\r\nMailbox quota usage exceeded\r\nMailbox size limit exceeded', 'full', 1),
(139, '/quota\\s(full|violation)/i', 'Triggered by:\r\nQuota full\r\nQuota violation', 'full', 1),
(140, '/User\\s(has|mail(box|folder))\\s+((exhausted|exceeds)\\sallowed\\s(size|.*space)|(too\\smany.*server))/i', 'Triggered by:\r\nUser has exhausted allowed storage space\r\nUser mailbox exceeds allowed size\r\nUser has too many messages on the server', 'full', 1),
(141, '/delivery\\s(temporarily\\ssuspended|attempts\\swill\\scontinue\\sto\\sbe\\smade\\sfor)/i', 'Triggered by:\r\ndelivery temporarily suspended\r\nDelivery attempts will continue to be made for', 'warning', 1),
(142, '/greylist(ing|ed)\\s(in|for)\\s(\\w+(\\sminutes)?)/i', 'Triggered by:\r\nGreylisting in action\r\nGreylisted for 5 minutes', 'antispam', 1),
(143, '/(server|system)\\s(load\\sis\\s)?(too\\s)?(busy|high)/i', 'Triggered by:\r\nServer busy\r\nserver too busy\r\nsystem load is too high', 'internal_error', 1),
(144, '/too\\s(busy|many|much)\\s(to\\saccept\\smail|connections?|sessions?|load)/i', 'Triggered by:\r\ntoo busy to accept mail\r\ntoo many connections\r\ntoo many sessions\r\nToo much load', 'internal_error', 1),
(145, '/temporarily\\s(deferred|unavailable)/i', 'Triggered by:\r\ntemporarily deferred\r\ntemporarily unavailable', 'defer', 1),
(146, '/try\\slater|retry\\stimeout\\sexceeded|queue\\stoo\\slong/i', 'Triggered by:\r\nTry later\r\nretry timeout exceeded\r\nqueue too long', 'delayed', 1),
(147, '/Benutzer\\shat\\szuviele\\sMails\\sauf\\sdem\\sServer/i', 'box full', 'full', 1),
(148, '/destin\\.\\sSconosciuto/i', 'unknown user', 'unknown', 1),
(149, '/Destinatario\\serrato/i', 'unknown', 'unknown', 1),
(150, '/Destinatario\\ssconosciuto\\so\\smailbox\\sdisatttivata/i', 'unknown', 'unknown', 1),
(151, '/Indirizzo\\sinesistente/i', 'unknown', 'unknown', 1),
(152, '/Esta\\scasilla\\sha\\sexpirado\\spor\\sfalta\\sde\\suso/i', 'expired', 'delayed', 1),
(153, '/([X-]{0,2})Auto-Response-Suppress:([\\s]*)([All|OOF])/i', 'Auto responses from mailbox', 'autoreply', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_campaigns`
--

CREATE TABLE `lethe_campaigns` (
  `ID` int(11) NOT NULL,
  `OID` int(11) NOT NULL DEFAULT '1',
  `UID` int(11) NOT NULL DEFAULT '1',
  `subject` varchar(255) DEFAULT NULL,
  `details` longtext,
  `alt_details` text,
  `launch_date` datetime DEFAULT NULL,
  `attach` varchar(255) DEFAULT NULL,
  `webOpt` tinyint(2) NOT NULL DEFAULT '0',
  `campaign_key` varchar(50) DEFAULT NULL,
  `campaign_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0=Newsletter 1=Autoresponder',
  `campaign_pos` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Sending, 2=Stopped, 3=Completed',
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `campaign_sender_title` varchar(255) DEFAULT NULL,
  `campaign_reply_mail` varchar(255) DEFAULT NULL,
  `campaign_sender_account` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_campaign_ar`
--

CREATE TABLE `lethe_campaign_ar` (
  `ID` int(11) NOT NULL,
  `OID` int(11) NOT NULL DEFAULT '1',
  `CID` int(11) NOT NULL DEFAULT '1',
  `ar_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0-After Subscription, 1-After Unsubscription, 2-Specific Date, 3-Special Date',
  `ar_time` smallint(5) NOT NULL DEFAULT '1' COMMENT 'Number as 1 minute, 1hour',
  `ar_time_type` varchar(30) NOT NULL DEFAULT 'MINUTE' COMMENT 'MINUTE, HOUR, DAY, MONTH, YEAR',
  `ar_end_date` datetime DEFAULT NULL,
  `ar_week_0` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'Sunday',
  `ar_week_1` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'Monday',
  `ar_week_2` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'Tuesday',
  `ar_week_3` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'Wednesday',
  `ar_week_4` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'Thursday',
  `ar_week_5` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'Friday',
  `ar_week_6` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'Saturday',
  `ar_end` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'On/Off'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_campaign_groups`
--

CREATE TABLE `lethe_campaign_groups` (
  `ID` int(11) NOT NULL,
  `OID` int(11) NOT NULL DEFAULT '1',
  `CID` int(11) NOT NULL DEFAULT '0',
  `GID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_chronos`
--

CREATE TABLE `lethe_chronos` (
  `ID` bigint(20) NOT NULL,
  `OID` int(11) NOT NULL DEFAULT '1',
  `CID` int(11) NOT NULL DEFAULT '1',
  `pos` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0-In Process, 1-Flag for Remove',
  `cron_command` tinytext NOT NULL,
  `launch_date` datetime DEFAULT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `SAID` int(11) NOT NULL DEFAULT '0' COMMENT 'Submission Account'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_organizations`
--

CREATE TABLE `lethe_organizations` (
  `ID` int(11) NOT NULL,
  `orgTag` varchar(30) DEFAULT NULL,
  `orgName` varchar(255) DEFAULT NULL,
  `addDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `billingDate` date DEFAULT NULL,
  `isActive` tinyint(2) NOT NULL DEFAULT '0',
  `public_key` varchar(50) DEFAULT NULL,
  `private_key` varchar(50) DEFAULT NULL,
  `isPrimary` tinyint(2) NOT NULL DEFAULT '0',
  `ip_addr` varchar(50) DEFAULT NULL,
  `api_key` varchar(50) DEFAULT NULL,
  `daily_sent` int(11) NOT NULL DEFAULT '0',
  `daily_reset` datetime DEFAULT NULL,
  `rss_url` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_organization_settings`
--

CREATE TABLE `lethe_organization_settings` (
  `ID` int(11) NOT NULL,
  `OID` int(11) NOT NULL DEFAULT '1',
  `set_key` varchar(255) DEFAULT NULL,
  `set_val` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_reports`
--

CREATE TABLE `lethe_reports` (
  `ID` bigint(20) NOT NULL,
  `OID` int(11) NOT NULL DEFAULT '1',
  `CID` int(11) NOT NULL DEFAULT '1',
  `pos` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0=Click, 1=Open, 2=Bounce',
  `ipAddr` varchar(30) DEFAULT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(100) DEFAULT NULL,
  `hit_cnt` int(11) NOT NULL DEFAULT '0',
  `bounceType` varchar(50) NOT NULL DEFAULT 'unknown',
  `extra_info` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_short_codes`
--

CREATE TABLE `lethe_short_codes` (
  `ID` int(11) NOT NULL,
  `OID` int(11) NOT NULL DEFAULT '1',
  `code_key` varchar(255) DEFAULT NULL,
  `code_val` varchar(255) DEFAULT NULL,
  `isSystem` tinyint(2) NOT NULL DEFAULT '0',
  `UID` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_submission_accounts`
--

CREATE TABLE `lethe_submission_accounts` (
  `ID` int(11) NOT NULL,
  `acc_title` varchar(255) DEFAULT NULL,
  `daily_limit` int(11) NOT NULL DEFAULT '500',
  `daily_sent` int(11) NOT NULL DEFAULT '0',
  `daily_reset` datetime DEFAULT NULL,
  `limit_range` int(11) NOT NULL DEFAULT '1440' COMMENT 'Limit range saved as minute',
  `send_per_conn` int(11) NOT NULL DEFAULT '20',
  `standby_time` int(11) NOT NULL DEFAULT '15',
  `systemAcc` tinyint(2) NOT NULL DEFAULT '0',
  `isDebug` tinyint(2) NOT NULL DEFAULT '0',
  `isActive` tinyint(2) NOT NULL DEFAULT '0',
  `from_title` varchar(255) DEFAULT NULL,
  `from_mail` varchar(100) DEFAULT NULL,
  `reply_mail` varchar(100) DEFAULT NULL,
  `test_mail` varchar(100) DEFAULT NULL,
  `mail_type` tinyint(2) NOT NULL DEFAULT '0',
  `send_method` tinyint(2) NOT NULL DEFAULT '0',
  `mail_engine` varchar(30) NOT NULL DEFAULT 'phpmailer',
  `smtp_host` varchar(100) NOT NULL DEFAULT 'localhost',
  `smtp_port` int(5) NOT NULL DEFAULT '587',
  `smtp_user` varchar(100) DEFAULT NULL,
  `smtp_pass` varchar(100) DEFAULT NULL,
  `smtp_secure` tinyint(2) NOT NULL DEFAULT '0',
  `pop3_host` varchar(100) NOT NULL DEFAULT 'localhost',
  `pop3_port` int(5) NOT NULL DEFAULT '110',
  `pop3_user` varchar(100) DEFAULT NULL,
  `pop3_pass` varchar(100) DEFAULT NULL,
  `pop3_secure` tinyint(2) NOT NULL DEFAULT '0',
  `imap_host` varchar(100) NOT NULL DEFAULT 'localhost',
  `imap_port` int(5) NOT NULL DEFAULT '143',
  `imap_user` varchar(100) DEFAULT NULL,
  `imap_pass` varchar(100) DEFAULT NULL,
  `imap_secure` tinyint(2) NOT NULL DEFAULT '0',
  `smtp_auth` tinyint(2) NOT NULL DEFAULT '1',
  `bounce_acc` tinyint(2) NOT NULL DEFAULT '1',
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aws_access_key` varchar(100) DEFAULT NULL,
  `aws_secret_key` varchar(100) DEFAULT NULL,
  `account_id` varchar(50) DEFAULT NULL,
  `dkim_active` tinyint(2) NOT NULL DEFAULT '0',
  `dkim_domain` varchar(255) DEFAULT NULL,
  `dkim_private` text,
  `dkim_selector` varchar(255) DEFAULT NULL,
  `dkim_passphrase` varchar(255) DEFAULT NULL,
  `bounce_actions` text,
  `mandrill_user` varchar(255) DEFAULT NULL,
  `mandrill_key` varchar(255) DEFAULT NULL,
  `sendgrid_user` varchar(100) DEFAULT NULL,
  `sendgrid_pass` varchar(100) DEFAULT NULL,
  `disable_bounce` tinyint(2) DEFAULT '1',
  `aws_region` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_subscribers`
--

CREATE TABLE `lethe_subscribers` (
  `ID` int(11) NOT NULL,
  `OID` int(11) DEFAULT '1',
  `GID` int(11) DEFAULT '1',
  `subscriber_name` varchar(255) DEFAULT NULL,
  `subscriber_mail` varchar(50) DEFAULT NULL,
  `subscriber_web` varchar(255) DEFAULT NULL,
  `subscriber_date` datetime DEFAULT NULL,
  `subscriber_phone` varchar(50) DEFAULT NULL,
  `subscriber_company` varchar(255) DEFAULT NULL,
  `subscriber_full_data` text,
  `subscriber_active` tinyint(2) DEFAULT '1',
  `subscriber_verify` tinyint(2) DEFAULT '0',
  `subscriber_key` varchar(50) DEFAULT NULL,
  `add_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_addr` varchar(20) DEFAULT NULL,
  `subscriber_verify_key` varchar(50) DEFAULT NULL,
  `subscriber_verify_sent_interval` datetime DEFAULT NULL,
  `local_country` varchar(30) DEFAULT 'N/A',
  `local_country_code` varchar(5) DEFAULT 'N/A',
  `local_city` varchar(30) DEFAULT 'N/A',
  `local_region` varchar(30) DEFAULT 'N/A',
  `local_region_code` varchar(5) DEFAULT 'N/A',
  `subscriber_tag` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_subscriber_groups`
--

CREATE TABLE `lethe_subscriber_groups` (
  `ID` int(11) NOT NULL,
  `OID` int(11) NOT NULL DEFAULT '1',
  `UID` int(11) NOT NULL DEFAULT '1',
  `group_name` varchar(255) DEFAULT NULL,
  `isUnsubscribe` tinyint(2) NOT NULL DEFAULT '0',
  `isUngroup` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_subscribe_forms`
--

CREATE TABLE `lethe_subscribe_forms` (
  `ID` int(11) NOT NULL,
  `OID` int(11) NOT NULL DEFAULT '1',
  `form_name` varchar(255) DEFAULT NULL,
  `form_id` varchar(50) DEFAULT NULL,
  `form_type` tinyint(2) NOT NULL DEFAULT '0',
  `form_success_url` varchar(255) DEFAULT NULL,
  `form_success_url_text` varchar(255) DEFAULT NULL,
  `form_success_text` varchar(255) DEFAULT NULL,
  `form_success_redir` int(11) NOT NULL DEFAULT '0',
  `form_remove` tinyint(2) NOT NULL DEFAULT '0',
  `add_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isSystem` tinyint(2) NOT NULL DEFAULT '0',
  `form_view` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0=Vertical, 1=Horizontal, 2=Table',
  `isDraft` tinyint(2) NOT NULL DEFAULT '1',
  `include_jquery` tinyint(2) NOT NULL DEFAULT '1',
  `include_jqueryui` tinyint(2) NOT NULL DEFAULT '1',
  `form_group` int(11) NOT NULL DEFAULT '0',
  `form_errors` tinytext,
  `subscription_stop` tinyint(2) NOT NULL DEFAULT '0',
  `UID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_subscribe_form_fields`
--

CREATE TABLE `lethe_subscribe_form_fields` (
  `ID` int(11) NOT NULL,
  `OID` int(11) NOT NULL DEFAULT '1',
  `FID` int(11) NOT NULL DEFAULT '1',
  `field_label` varchar(255) DEFAULT NULL,
  `field_name` varchar(30) DEFAULT NULL,
  `field_type` varchar(30) DEFAULT NULL,
  `field_required` tinyint(2) NOT NULL DEFAULT '0',
  `field_pattern` varchar(255) DEFAULT NULL,
  `field_placeholder` varchar(255) DEFAULT NULL,
  `sorting` int(11) NOT NULL DEFAULT '0',
  `field_data` varchar(255) DEFAULT NULL,
  `field_static` tinyint(2) NOT NULL DEFAULT '0',
  `field_save` varchar(20) DEFAULT NULL,
  `field_error` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_tasks`
--

CREATE TABLE `lethe_tasks` (
  `ID` bigint(20) NOT NULL,
  `OID` int(11) NOT NULL DEFAULT '1',
  `CID` int(11) NOT NULL DEFAULT '1',
  `subscriber_mail` varchar(100) DEFAULT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subscriber_key` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_templates`
--

CREATE TABLE `lethe_templates` (
  `ID` int(11) NOT NULL,
  `OID` int(11) NOT NULL DEFAULT '1',
  `UID` int(11) NOT NULL DEFAULT '1',
  `temp_name` varchar(255) DEFAULT NULL,
  `temp_contents` longtext,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `temp_prev` varchar(255) DEFAULT '',
  `temp_type` varchar(20) NOT NULL DEFAULT 'normal',
  `isSystem` tinyint(2) NOT NULL DEFAULT '0',
  `temp_id` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_unsubscribes`
--

CREATE TABLE `lethe_unsubscribes` (
  `ID` bigint(20) NOT NULL,
  `OID` int(11) NOT NULL DEFAULT '1',
  `CID` int(11) NOT NULL DEFAULT '1',
  `subscriber_mail` varchar(100) DEFAULT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_users`
--

CREATE TABLE `lethe_users` (
  `ID` int(11) NOT NULL,
  `OID` int(11) NOT NULL DEFAULT '1',
  `real_name` varchar(100) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `auth_mode` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0=User, 1=Admin, 2=Super Admin',
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime DEFAULT NULL,
  `isActive` tinyint(2) NOT NULL DEFAULT '0',
  `isPrimary` tinyint(2) NOT NULL DEFAULT '0',
  `session_token` varchar(50) DEFAULT NULL,
  `session_time` datetime DEFAULT NULL,
  `private_key` varchar(50) DEFAULT NULL,
  `public_key` varchar(50) DEFAULT NULL,
  `user_spec_view` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lethe_user_permissions`
--

CREATE TABLE `lethe_user_permissions` (
  `ID` int(11) NOT NULL,
  `OID` int(11) NOT NULL DEFAULT '1',
  `UID` int(11) NOT NULL DEFAULT '1',
  `perm` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `lethe_blacklist`
--
ALTER TABLE `lethe_blacklist`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `email` (`email`);

--
-- Tablo için indeksler `lethe_bounce_rules`
--
ALTER TABLE `lethe_bounce_rules`
  ADD PRIMARY KEY (`BRID`),
  ADD UNIQUE KEY `rule` (`rule`) USING BTREE;

--
-- Tablo için indeksler `lethe_campaigns`
--
ALTER TABLE `lethe_campaigns`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`) USING BTREE,
  ADD KEY `ID_2` (`ID`,`launch_date`,`campaign_pos`);

--
-- Tablo için indeksler `lethe_campaign_ar`
--
ALTER TABLE `lethe_campaign_ar`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `lethe_campaign_groups`
--
ALTER TABLE `lethe_campaign_groups`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `OIDs` (`OID`,`CID`) USING BTREE;

--
-- Tablo için indeksler `lethe_chronos`
--
ALTER TABLE `lethe_chronos`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `lethe_organizations`
--
ALTER TABLE `lethe_organizations`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `lethe_organization_settings`
--
ALTER TABLE `lethe_organization_settings`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `lethe_reports`
--
ALTER TABLE `lethe_reports`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `rep_CID` (`CID`);

--
-- Tablo için indeksler `lethe_short_codes`
--
ALTER TABLE `lethe_short_codes`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `lethe_submission_accounts`
--
ALTER TABLE `lethe_submission_accounts`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `lethe_subscribers`
--
ALTER TABLE `lethe_subscribers`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `GID_mail_unq` (`GID`,`subscriber_mail`) USING BTREE,
  ADD KEY `GID` (`GID`),
  ADD KEY `subscriber_mail` (`subscriber_mail`),
  ADD KEY `GID_2` (`GID`,`subscriber_active`,`subscriber_verify`),
  ADD KEY `sub_GID` (`GID`),
  ADD KEY `subscriber_mail_6` (`subscriber_mail`),
  ADD KEY `GID_subac_sub_ver` (`GID`,`subscriber_active`,`subscriber_verify`);

--
-- Tablo için indeksler `lethe_subscriber_groups`
--
ALTER TABLE `lethe_subscriber_groups`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `lethe_subscribe_forms`
--
ALTER TABLE `lethe_subscribe_forms`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `lethe_subscribe_form_fields`
--
ALTER TABLE `lethe_subscribe_form_fields`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `lethe_tasks`
--
ALTER TABLE `lethe_tasks`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CID_subscriber_mail` (`CID`,`subscriber_mail`),
  ADD UNIQUE KEY `CID_key_subscriber_mail` (`CID`,`subscriber_mail`,`subscriber_key`),
  ADD KEY `task_OID_CID_SUB` (`OID`,`CID`,`subscriber_mail`);

--
-- Tablo için indeksler `lethe_templates`
--
ALTER TABLE `lethe_templates`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `temp_type` (`temp_type`,`isSystem`,`temp_id`) USING BTREE;

--
-- Tablo için indeksler `lethe_unsubscribes`
--
ALTER TABLE `lethe_unsubscribes`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CD_sbmail` (`CID`,`subscriber_mail`),
  ADD UNIQUE KEY `CID_subscriber_mail` (`CID`,`subscriber_mail`);

--
-- Tablo için indeksler `lethe_users`
--
ALTER TABLE `lethe_users`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `lethe_user_permissions`
--
ALTER TABLE `lethe_user_permissions`
  ADD PRIMARY KEY (`ID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `lethe_blacklist`
--
ALTER TABLE `lethe_blacklist`
  MODIFY `ID` bigint(15) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_bounce_rules`
--
ALTER TABLE `lethe_bounce_rules`
  MODIFY `BRID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_campaigns`
--
ALTER TABLE `lethe_campaigns`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_campaign_ar`
--
ALTER TABLE `lethe_campaign_ar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_campaign_groups`
--
ALTER TABLE `lethe_campaign_groups`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_chronos`
--
ALTER TABLE `lethe_chronos`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_organizations`
--
ALTER TABLE `lethe_organizations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_organization_settings`
--
ALTER TABLE `lethe_organization_settings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_reports`
--
ALTER TABLE `lethe_reports`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_short_codes`
--
ALTER TABLE `lethe_short_codes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_submission_accounts`
--
ALTER TABLE `lethe_submission_accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_subscribers`
--
ALTER TABLE `lethe_subscribers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_subscriber_groups`
--
ALTER TABLE `lethe_subscriber_groups`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_subscribe_forms`
--
ALTER TABLE `lethe_subscribe_forms`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_subscribe_form_fields`
--
ALTER TABLE `lethe_subscribe_form_fields`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_tasks`
--
ALTER TABLE `lethe_tasks`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_templates`
--
ALTER TABLE `lethe_templates`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_unsubscribes`
--
ALTER TABLE `lethe_unsubscribes`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_users`
--
ALTER TABLE `lethe_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `lethe_user_permissions`
--
ALTER TABLE `lethe_user_permissions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
