<?php
/*  +------------------------------------------------------------------------+ */
/*  | Artlantis CMS Solutions                                                | */
/*  +------------------------------------------------------------------------+ */
/*  | Lethe Newsletter & Mailing System                                      | */
/*  | Copyright (c) Artlantis Design Studio 2014. All rights reserved.       | */
/*  | Version       2.2                                                      | */
/*  | Last modified 09.12.2018                                               | */
/*  | Email         developer@artlantis.net                                  | */
/*  | Web           http://www.artlantis.net                                 | */
/*  +------------------------------------------------------------------------+ */

### LOADED: 153 RULE ###
##############################################################################################################
/*
 * <xxxxx@yourdomain.com>:
 * 111.111.111.111 does not like recipient.
 * Remote host said: 550 User unknown
*/

elseif(preg_match ("/<(\S+@\S+\w)>.*\n?.*\n?.*user unknown/i",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0001";
$result["email"]    = 1;
}

/*
 * rule: mailbox unknown;
 * sample:
 * Sorry, no mailbox here by that name. vpopmail (#5.1.1)
*/

elseif(preg_match ("/<(\S+@\S+\w)>.*\n?.*no mailbox/i",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0002";
$result["email"]    = 1;
}

/*
 * rule: mailbox unknown;
 * sample:
 * xxxxx@yourdomain.com
 * local: Sorry, can't find user's mailbox. (#5.1.1)
*/

elseif(preg_match ("/(\S+@\S+\w)<br>.*\n?.*\n?.*can't find.*mailbox/i",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0003";
$result["email"]    = 1;
}

/*
 * rule: mailbox unknown;
 * sample:
 * ##########################################################
 * #  This is an automated response from a mail delivery    #
 * #  program.  Your message could not be delivered to      #
 * #  the following address:                                #
 * #                                                        #
 * #      "|/usr/local/bin/mailfilt -u #dkms"               #
 * #        (reason: Can't create output)                   #
 * #        (expanded from: <xxxxx@yourdomain.com>)         #
 * #                                                        #
*/

elseif(preg_match ("/Can't create output.*\n?.*<(\S+@\S+\w)>/i",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0004";
$result["email"]    = 1;
}

/*
 * rule: mailbox unknown;
 * sample:
 * ????????????????:
 * xxxxx@yourdomain.com : ????, ?????.
*/

elseif(preg_match ("/(\S+@\S+\w).*=D5=CA=BA=C5=B2=BB=B4=E6=D4=DA/i",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0005";
$result["email"]    = 1;
}

/*
 * rule: mailbox unknown;
 * sample:
 * xxxxx@yourdomain.com
 * Unrouteable address
*/

elseif(preg_match ("/(\S+@\S+\w).*\n?.*Unrouteable address/i",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0006";
$result["email"]    = 1;
}

/*
 * rule: mailbox unknow;
 * sample:
 * Delivery to the following recipients failed.
 * xxxxx@yourdomain.com
*/

elseif(preg_match ("/delivery[^\n\r]+failed\S*\s+(\S+@\S+\w)\s/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0007";
$result["email"]    = 1;
}

/*
 * rule: mailbox unknown;
 * sample:
 * A message that you sent could not be delivered to one or more of its
 * recipients. This is a permanent error. The following address(es) failed:
 * xxxxx@yourdomain.com
 * unknown local-part "xxxxx" in domain "yourdomain.com"
*/

elseif(preg_match ("/(\S+@\S+\w).*\n?.*unknown local-part/i",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0008";
$result["email"]    = 1;
}

/*
 * rule: mailbox unknown;
 * sample:
 * <xxxxx@yourdomain.com>:
 * 111.111.111.11 does not like recipient.
 * Remote host said: 550 Invalid recipient: <xxxxx@yourdomain.com>
*/

elseif(preg_match ("/Invalid.*(?:alias|account|recipient|address|email|mailbox|user).*<(\S+@\S+\w)>/i",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0009";
$result["email"]    = 1;
}

/*
 * rule: mailbox unknown;
 * sample:
 * Sent >>> RCPT TO: <xxxxx@yourdomain.com>
 * Received <<< 550 xxxxx@yourdomain.com... No such user
 * Could not deliver mail to this user.
 * xxxxx@yourdomain.com
 * *****************     End of message     ***************
*/

elseif(preg_match ("/\s(\S+@\S+\w).*No such.*(?:alias|account|recipient|address|email|mailbox|user)>/i",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0010";
$result["email"]    = 1;
}

/*
 * rule: mailbox unknown;
 * sample:
 * <xxxxx@yourdomain.com>:
 * This address no longer accepts mail.
*/

elseif(preg_match ("/<(\S+@\S+\w)>.*\n?.*(?:alias|account|recipient|address|email|mailbox|user).*no.*accept.*mail>/i",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0011";
$result["email"]    = 1;
}

/*
 * rule: full
 * sample 1:
 * <xxxxx@yourdomain.com>:
 * This account is over quota and unable to receive mail.
 * sample 2:
 * <xxxxx@yourdomain.com>:
 * Warning: undefined mail delivery mode: normal (ignored).
 * The users mailfolder is over the allowed quota (size). (#5.2.2)
*/

elseif(preg_match ("/<(\S+@\S+\w)>.*\n?.*\n?.*over.*quota/i",$body,$match)){
$result["rule_cat"]    = "full";
$result["rule_no"]    = "0012";
$result["email"]    = 1;
}

/*
 * rule: mailbox full;
 * sample:
 * ----- Transcript of session follows -----
 * mail.local: /var/mail/2b/10/kellen.lee: Disc quota exceeded
 * 554 <xxxxx@yourdomain.com>... Service unavailable
*/

elseif(preg_match ("/quota exceeded.*\n?.*<(\S+@\S+\w)>/i",$body,$match)){
$result["rule_cat"]    = "full";
$result["rule_no"]    = "0013";
$result["email"]    = 1;
}

/*
 * rule: mailbox full;
 * sample:
 * Hi. This is the qmail-send program at 263.domain.com.
 * <xxxxx@yourdomain.com>:
 * - User disk quota exceeded. (#4.3.0)
*/

elseif(preg_match ("/<(\S+@\S+\w)>.*\n?.*quota exceeded/i",$body,$match)){
$result["rule_cat"]    = "full";
$result["rule_no"]    = "0014";
$result["email"]    = 1;
}

/*
 * rule: mailbox full;
 * sample:
 * xxxxx@yourdomain.com
 * mailbox is full (MTA-imposed quota exceeded while writing to file /mbx201/mbx011/A100/09/35/A1000935772/mail/.inbox):
*/

elseif(preg_match ("/\s(\S+@\S+\w)\s.*\n?.*mailbox.*full/i",$body,$match)){
$result["rule_cat"]    = "full";
$result["rule_no"]    = "0015";
$result["email"]    = 1;
}

/*
 * rule: mailbox full;
 * sample:
 * The message to xxxxx@yourdomain.com is bounced because : Quota exceed the hard limit
*/

elseif(preg_match ("/The message to (\S+@\S+\w)\s.*bounce.*Quota exceed/i",$body,$match)){
$result["rule_cat"]    = "full";
$result["rule_no"]    = "0016";
$result["email"]    = 1;
}

/*
 * rule: inactive
 * sample:
 * xxxxx@yourdomain.com
 * 553 user is inactive (eyou mta)
*/

elseif(preg_match ("/(\S+@\S+\w)<br>.*\n?.*\n?.*user is inactive/i",$body,$match)){
$result["rule_cat"]    = "inactive";
$result["rule_no"]    = "0017";
$result["email"]    = 1;
}

/*
 * rule: inactive
 * sample:
 * xxxxx@yourdomain.com [Inactive account]
*/

elseif(preg_match ("/(\S+@\S+\w).*inactive account/i",$body,$match)){
$result["rule_cat"]    = "inactive";
$result["rule_no"]    = "0018";
$result["email"]    = 1;
}

/*
 * rule: internal_error
 * sample:
 * <xxxxx@yourdomain.com>:
 * Unable to switch to /var/vpopmail/domains/domain.com: input/output error. (#4.3.0)
*/

elseif(preg_match ("/<(\S+@\S+\w)>.*\n?.*input\/output error/i",$body,$match)){
$result["rule_cat"]    = "internal_error";
$result["rule_no"]    = "0019";
$result["email"]    = 1;
}

/*
 * rule: internal_error
 * sample:
 * <xxxxx@yourdomain.com>:
 * can not open new email file errno=13 file=/home/vpopmail/domains/fromc.com/0/domain/Maildir/tmp/1155254417.28358.mx05,S=212350
*/

elseif(preg_match ("/<(\S+@\S+\w)>.*\n?.*can not open new email file/i",$body,$match)){
$result["rule_cat"]    = "internal_error";
$result["rule_no"]    = "0020";
$result["email"]    = 1;
}

/*
 * rule: defer
 * sample:
 * <xxxxx@yourdomain.com>:
 * 111.111.111.111 failed after I sent the message.
 * Remote host said: 451 mta283.mail.scd.yahoo.com Resources temporarily unavailable. Please try again later [#4.16.5].
*/

elseif(preg_match ("/<(\S+@\S+\w)>.*\n?.*\n?.*Resources temporarily unavailable/i",$body,$match)){
$result["rule_cat"]    = "defer";
$result["rule_no"]    = "0021";
$result["email"]    = 1;
}

/*
 * rule: autoreply
 * sample:
 * AutoReply message from xxxxx@yourdomain.com
*/

elseif(preg_match ("/^AutoReply message from (\S+@\S+\w)/i",$body,$match)){
$result["rule_cat"]    = "autoreply";
$result["rule_no"]    = "0022";
$result["email"]    = 1;
}

/*
 * rule: western chars only
 * sample:
 * <xxxxx@yourdomain.com>:
 * The user does not accept email in non-Western (non-Latin) character sets.
*/

elseif(preg_match ("/<(\S+@\S+\w)>.*\n?.*does not accept[^\r\n]*non-Western/i",$body,$match)){
$result["rule_cat"]    = "latin_only";
$result["rule_no"]    = "0023";
$result["email"]    = 1;
}

/*
 * rule: Unknow body
 * sample:
 * /var/mail/nobody:
 * Unknow body.
*/

elseif(preg_match ("/^\/var\/mail\/nobody/im",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0024";
$result["email"]    = 1;
}

/*
 * rule: Message Delivery Failure
 * sample:
 * Message Delivery Failure - E-Mail Verification:
 * Unknow body.
*/

elseif(preg_match ("/^message delivery failure/im",$body,$match)){
$result["rule_cat"]    = "dns_unknown";
$result["rule_no"]    = "0025";
$result["email"]    = 1;
}

/*
 * rule: Message Delivery Failure
 * sample:
 * Message Delivery Failure - returning message to sender
 * Unknow body.
*/

elseif(preg_match ("/returning message to sender/im",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0026";
$result["email"]    = 1;
}

/*
 * rule: 550 5.7.1
 * sample:
 * Message Delivery Failure - E-Mail Verification:
 * Unknow body.
*/

elseif(preg_match ("/^550 5\.7\.1/im",$body,$match)){
$result["rule_cat"]    = "dns_unknown";
$result["rule_no"]    = "0027";
$result["email"]    = 0;
}

/*
 * rule: %G%#%l%/%H%j+$+$^$;!#
 * sample:
 * Message Delivery Failure - E-Mail Verification:
 * Unknow body.
*/

elseif(preg_match ("/%G%\#%l%\/%H%j\+\$\+\$\^\$;!\#/imu",$body,$match)){
$result["rule_cat"]    = "dns_unknown";
$result["rule_no"]    = "0028";
$result["email"]    = 0;
}

/*
 * rule: 550 5.7.1
 * sample:
 * 550 5.7.1
 * Unknow body.
*/

elseif(preg_match ("/550 5.7.1/im",$body,$match)){
$result["rule_cat"]    = "dns_unknown";
$result["rule_no"]    = "0029";
$result["email"]    = 0;
}

/*
 * rule: 550 5.1.1
 * sample:
 * 550 5.1.1
 * Unknow user - recipient.
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user).*(?:n't|not) exist/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0030";
$result["email"]    = 1;
}

/*
 * rule: 550 5.1.1
 * sample:
 * 550 5.1.1
 * X-Notes; User xxxxx (xxxxx@yourdomain.com) not listed in public Name & Address Book
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user)(.*)not(.*)list/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0031";
$result["email"]    = 1;
}

/*
 * rule: 550 5.1.1
 * sample:
 * 550 5.1.1
 * SMTP; 554 qq Sorry, no valid recipients (#5.1.3)
*/

elseif(preg_match ("/no.*valid.*(?:alias|account|recipient|address|email|mailbox|user)/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0032";
$result["email"]    = 1;
}

/*
 * rule: 550 5.1.1
 * sample:
 * SMTP; 550 «Dªk¦a§} - invalid address (#5.5.0)
 * SMTP; 550 Invalid recipient: <xxxxx@yourdomain.com>
 * SMTP; 550 <xxxxx@yourdomain.com>: Invalid User
*/

elseif(preg_match ("/Invalid.*(?:alias|account|recipient|address|email|mailbox|user)/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0033";
$result["email"]    = 1;
}

/*
 * rule: 550 5.1.1
 * sample:
 * 550 5.1.1
 * SMTP; 554 delivery error: dd Sorry your message to xxxxx@yourdomain.com cannot be delivered.
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user).*(?:disabled|discontinued)/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0034";
$result["email"]    = 1;
}

/*
 * rule: 550 5.1.1
 * sample:
 * 550 5.1.1
 * SMTP; 554 delivery error: dd This user doesn't have a domain.com account (www.xxxxx@yourdomain.com)
*/

elseif(preg_match ("/user doesn't have.*account/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0035";
$result["email"]    = 1;
}

/*
 * rule: 550 5.1.1
 * sample:
 * 550 5.1.1
 * Diagnostic-Code: SMTP; 550 5.1.1 unknown or illegal alias: xxxxx@yourdomain.com
*/

elseif(preg_match ("/(?:unknown|illegal).*(?:alias|account|recipient|address|email|mailbox|user)/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0036";
$result["email"]    = 1;
}

/*
 * rule: 550 5.1.1
 * sample:
 * 550 5.1.1
 * Diagnostic-Code: SMTP; 550 5.7.1 Requested action not taken: mailbox not available
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user).*(?:un|not\s+)available/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0037";
$result["email"]    = 1;
}

/*
 * rule: 550 5.1.1
 * sample:
 * 550 5.1.1
 * Diagnostic-Code: SMTP; 553 sorry, no mailbox here by that name (#5.7.1)
*/

elseif(preg_match ("/no (?:alias|account|recipient|address|email|mailbox|user)/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0038";
$result["email"]    = 1;
}

/*
 * rule: 550 access denied
 * sample:
 * 550 access denied
 * Unknow body.
*/

elseif(preg_match ("/550 access denied/im",$body,$match)){
$result["rule_cat"]    = "dns_unknown";
$result["rule_no"]    = "0039";
$result["email"]    = 0;
}

/*
 * Triggered by:
 * Diagnostic-Code: smtp;552 5.2.2 This message is larger than the current system limit or the recipient's mailbox is full. Create a shorter message body or remove attachments and try sending it again.
 * Diagnostic-Code: X-Postfix; host mta5.us4.domain.com.int[111.111.111.111] said:
 * 552 recipient storage full, try again later (in reply to RCPT TO command)
 * Diagnostic-Code: X-HERMES; host 127.0.0.1[127.0.0.1] said: 551 bounce as<the
 * destination mailbox <xxxxx@yourdomain.com> is full> queue as
 * 100.1.ZmxEL.720k.1140313037.xxxxx@yourdomain.com (in reply to end of
 * DATA command)
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user).*full/is",$body,$match)){
$result["rule_cat"]    = "full";
$result["rule_no"]    = "0040";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 452 Insufficient system storage
*/

elseif(preg_match ("/Insufficient system storage/is",$body,$match)){
$result["rule_cat"]    = "full";
$result["rule_no"]    = "0041";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: X-Postfix; cannot append message to destination file
 * /var/mail/dale.me89g: error writing message: File too large
 * Diagnostic-Code: X-Postfix; cannot access mailbox /var/spool/mail/b8843022 for
 * user xxxxx. error writing message: File too large
*/

elseif(preg_match ("/File too large/is",$body,$match)){
$result["rule_cat"]    = "oversize";
$result["rule_no"]    = "0042";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: smtp;552 5.2.2 This message is larger than the current system limit or the recipient's mailbox is full. Create a shorter message body or remove attachments and try sending it again.
*/

elseif(preg_match ("/larger than.*limit/is",$body,$match)){
$result["rule_cat"]    = "oversize";
$result["rule_no"]    = "0043";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: smtp; 450 user path no exist
*/

elseif(preg_match ("/user path no exist/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0044";
$result["email"]    = 0;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 Relaying denied.
 * Diagnostic-Code: SMTP; 554 <xxxxx@yourdomain.com>: Relay access denied
 * Diagnostic-Code: SMTP; 550 relaying to <xxxxx@yourdomain.com> prohibited by administrator
*/

elseif(preg_match ("/Relay.*(?:denied|prohibited)/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0045";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 User (xxxxx@yourdomain.com) unknown.
 * Diagnostic-Code: SMTP; 553 5.3.0 <xxxxx@yourdomain.com>... Addressee unknown, relay=[111.111.111.000]
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user).*unknown/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0046";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 user disabled
 * Diagnostic-Code: SMTP; 452 4.2.1 mailbox temporarily disabled: xxxxx@yourdomain.com
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user).*disabled/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0047";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com>: Recipient address rejected: No such user (xxxxx@yourdomain.com)
*/

elseif(preg_match ("/No such (?:alias|account|recipient|address|email|mailbox|user)/is",$body,$match)){
$result["rule_cat"]    = "user_reject";
$result["rule_no"]    = "0048";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 MAILBOX NOT FOUND
 * Diagnostic-Code: SMTP; 550 Mailbox ( xxxxx@yourdomain.com ) not found or inactivated
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user).*NOT FOUND/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0049";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: X-Postfix; host m2w-in1.domain.com[111.111.111.000] said: 551
 * <xxxxx@yourdomain.com> is a deactivated mailbox (in reply to RCPT TO command)
*/

elseif(preg_match ("/deactivated (?:alias|account|recipient|address|email|mailbox|user)/is",$body,$match)){
$result["rule_cat"]    = "inactive";
$result["rule_no"]    = "0050";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com> recipient rejected
 * ...
 * <<< 550 <xxxxx@yourdomain.com> recipient rejected
 * 550 5.1.1 xxxxx@yourdomain.com... User unknown
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user).*reject/is",$body,$match)){
$result["rule_cat"]    = "user_reject";
$result["rule_no"]    = "0051";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: smtp; 5.x.0 - Message bounced by administrator  (delivery attempts: 0)
*/

elseif(preg_match ("/bounce.*administrator/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0052";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 <maxqin> is now disabled with MTA service.
*/

elseif(preg_match ("/<.*>.*disabled/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0053";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 551 not our customer
*/

elseif(preg_match ("/not our customer/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0054";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: smtp; 5.1.0 - Unknown address error 540-'Error: Wrong recipients' (delivery attempts: 0)
*/

elseif(preg_match ("/Wrong (?:alias|account|recipient|address|email|mailbox|user)/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0055";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: smtp; 5.1.0 - Unknown address error 540-'Error: Wrong recipients' (delivery attempts: 0)
 * Diagnostic-Code: SMTP; 501 #5.1.1 bad address xxxxx@yourdomain.com
*/

elseif(preg_match ("/(?:unknown|bad).*(?:alias|account|recipient|address|email|mailbox|user)/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0056";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 Command RCPT User <xxxxx@yourdomain.com> not OK
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user).*not OK/is",$body,$match)){
$result["rule_cat"]    = "command_reject";
$result["rule_no"]    = "0057";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 5.7.1 Access-Denied-XM.SSR-001
*/

elseif(preg_match ("/Access.*Denied/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0058";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 5.1.1 <xxxxx@yourdomain.com>... email address lookup in domain map failed
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user).*lookup.*fail/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0059";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 User not a member of domain: <xxxxx@yourdomain.com>
*/

elseif(preg_match ("/(?:recipient|address|email|mailbox|user).*not.*member of domain/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0060";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550-"The recipient cannot be verified.  Please check all recipients of this
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user).*cannot be verified/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0061";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 Unable to relay for xxxxx@yourdomain.com
*/

elseif(preg_match ("/Unable to relay/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0062";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550-I'm sorry but xxxxx@yourdomain.com does not have an account here. I will not
*/

elseif(preg_match ("/not have an account/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0063";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 This account is not allowed...xxxxx@yourdomain.com
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user).*is not allowed/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0064";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com>: inactive user
*/

elseif(preg_match ("/inactive.*(?:alias|account|recipient|address|email|mailbox|user)/is",$body,$match)){
$result["rule_cat"]    = "inactive";
$result["rule_no"]    = "0065";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 xxxxx@yourdomain.com Account Inactive
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user).*Inactive/is",$body,$match)){
$result["rule_cat"]    = "inactive";
$result["rule_no"]    = "0066";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com>: Recipient address rejected: Account closed due to inactivity. No forwarding information is available.
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user) closed due to inactivity/is",$body,$match)){
$result["rule_cat"]    = "inactive";
$result["rule_no"]    = "0067";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com>... User account not activated
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user) not activated/is",$body,$match)){
$result["rule_cat"]    = "inactive";
$result["rule_no"]    = "0068";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 User suspended
 * Diagnostic-Code: SMTP; 550 account expired
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user).*(?:suspend|expire)/is",$body,$match)){
$result["rule_cat"]    = "inactive";
$result["rule_no"]    = "0069";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 553 5.3.0 <xxxxx@yourdomain.com>... Recipient address no longer exists
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user).*no longer exist/is",$body,$match)){
$result["rule_cat"]    = "inactive";
$result["rule_no"]    = "0070";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 553 VS10-RT Possible forgery or deactivated due to abuse (#5.1.1) 111.111.111.211
*/

elseif(preg_match ("/(?:forgery|abuse)/is",$body,$match)){
$result["rule_cat"]    = "inactive";
$result["rule_no"]    = "0071";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 553 mailbox xxxxx@yourdomain.com is restricted
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user).*restrict/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0072";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com>: User status is locked.
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user).*locked/is",$body,$match)){
$result["rule_cat"]    = "inactive";
$result["rule_no"]    = "0073";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 553 User refused to receive this mail.
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user) refused/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0074";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 501 xxxxx@yourdomain.com Sender email is not in my domain
*/

elseif(preg_match ("/sender.*not/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0075";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 554 Message refused
*/

elseif(preg_match ("/Message (refused|reject(ed)?)/is",$body,$match)){
$result["rule_cat"]    = "content_reject";
$result["rule_no"]    = "0076";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 5.0.0 <xxxxx@yourdomain.com>... No permit
*/

elseif(preg_match ("/No permit/is",$body,$match)){
$result["rule_cat"]    = "warning";
$result["rule_no"]    = "0077";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 553 sorry, that domain isn't in my list of allowed rcpthosts (#5.5.3 - chkuser)
*/

elseif(preg_match ("/domain isn't in.*allowed rcpthost/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0078";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 553 AUTH FAILED - xxxxx@yourdomain.com
*/

elseif(preg_match ("/AUTH FAILED/is",$body,$match)){
$result["rule_cat"]    = "warning";
$result["rule_no"]    = "0079";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 relay not permitted
 * Diagnostic-Code: SMTP; 530 5.7.1 Relaying not allowed: xxxxx@yourdomain.com
*/

elseif(preg_match ("/relay.*not.*(?:permit|allow)/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0080";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 not local host domain.com, not a gateway
*/

elseif(preg_match ("/not local host/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0081";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 500 Unauthorized relay msg rejected
*/

elseif(preg_match ("/Unauthorized relay/is",$body,$match)){
$result["rule_cat"]    = "user_reject";
$result["rule_no"]    = "0082";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 554 Transaction failed
*/

elseif(preg_match ("/Transaction.*fail/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0083";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: smtp;554 5.5.2 Invalid data in message
*/

elseif(preg_match ("/Invalid data/is",$body,$match)){
$result["rule_cat"]    = "content_reject";
$result["rule_no"]    = "0084";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 Local user only or Authentication mechanism
*/

elseif(preg_match ("/Local user only/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0085";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550-ds176.domain.com [111.111.111.211] is currently not permitted to
 * relay through this server. Perhaps you have not logged into the pop/imap
 * server in the last 30 minutes or do not have SMTP Authentication turned on
 * in your email client.
*/

elseif(preg_match ("/not.*permit.*to/is",$body,$match)){
$result["rule_cat"]    = "warning";
$result["rule_no"]    = "0086";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 Content reject. FAAAANsG60M9BmDT.1
*/

elseif(preg_match ("/Content reject/is",$body,$match)){
$result["rule_cat"]    = "content_reject";
$result["rule_no"]    = "0087";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 552 MessageWall: MIME/REJECT: Invalid structure
*/

elseif(preg_match ("/MIME\/REJECT/is",$body,$match)){
$result["rule_cat"]    = "content_reject";
$result["rule_no"]    = "0088";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: smtp; 554 5.6.0 Message with invalid header rejected, id=13462-01 - MIME error: error: UnexpectedBound: part didn't end with expected boundary [in multipart message]; EOSToken: EOF; EOSType: EOF
*/

elseif(preg_match ("/MIME error/is",$body,$match)){
$result["rule_cat"]    = "content_reject";
$result["rule_no"]    = "0089";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 553 Mail data refused by AISP, rule [169648].
*/

elseif(preg_match ("/Mail data refused.*AISP/is",$body,$match)){
$result["rule_cat"]    = "content_reject";
$result["rule_no"]    = "0090";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 Host unknown
*/

elseif(preg_match ("/Host unknown/is",$body,$match)){
$result["rule_cat"]    = "dns_unknown";
$result["rule_no"]    = "0091";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 553 Specified domain is not allowed.
*/

elseif(preg_match ("/Specified domain.*not.*allow/is",$body,$match)){
$result["rule_cat"]    = "dns_loop";
$result["rule_no"]    = "0092";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: X-Postfix; delivery temporarily suspended: connect to
 * 111.111.11.112[111.111.11.112]: No route to host
*/

elseif(preg_match ("/No route to host/is",$body,$match)){
$result["rule_cat"]    = "dns_unknown";
$result["rule_no"]    = "0093";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 unrouteable address
*/

elseif(preg_match ("/unrouteable address/is",$body,$match)){
$result["rule_cat"]    = "dns_unknown";
$result["rule_no"]    = "0094";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 451 System(u) busy, try again later.
*/

elseif(preg_match ("/System.*busy/is",$body,$match)){
$result["rule_cat"]    = "internal_error";
$result["rule_no"]    = "0095";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 451 mta172.mail.tpe.domain.com Resources temporarily unavailable. Please try again later.  [#4.16.4:70].
*/

elseif(preg_match ("/Resources temporarily unavailable/is",$body,$match)){
$result["rule_cat"]    = "internal_error";
$result["rule_no"]    = "0096";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 554 sender is rejected: 0,mx20,wKjR5bDrnoM2yNtEZVAkBg==.32467S2
*/

elseif(preg_match ("/sender is rejected/is",$body,$match)){
$result["rule_cat"]    = "user_reject";
$result["rule_no"]    = "0097";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 554 <unknown[111.111.111.000]>: Client host rejected: Access denied
*/

elseif(preg_match ("/Client host rejected/is",$body,$match)){
$result["rule_cat"]    = "user_reject";
$result["rule_no"]    = "0098";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 554 Connection refused(mx). MAIL FROM [xxxxx@yourdomain.com] mismatches client IP [111.111.111.000].
*/

elseif(preg_match ("/MAIL FROM(.*)mismatches client IP/is",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0099";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 554 Please visit http:// antispam.domain.com/denyip.php?IP=111.111.111.000 (#5.7.1)
*/

elseif(preg_match ("/denyip/is",$body,$match)){
$result["rule_cat"]    = "antispam";
$result["rule_no"]    = "0100";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 554 Service unavailable; Client host [111.111.111.211] blocked using dynablock.domain.com; Your message could not be delivered due to complaints we received regarding the IP address you're using or your ISP. See http:// blackholes.domain.com/ Error: WS-02
*/

elseif(preg_match ("/client host.*blocked/is",$body,$match)){
$result["rule_cat"]    = "antispam";
$result["rule_no"]    = "0101";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 Requested action not taken: mail IsCNAPF76kMDARUY.56621S2 is rejected,mx3,BM
*/

elseif(preg_match ("/mail.*reject/is",$body,$match)){
$result["rule_cat"]    = "user_reject";
$result["rule_no"]    = "0102";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 552 sorry, the spam message is detected (#5.6.0)
*/

elseif(preg_match ("/spam.*detect/is",$body,$match)){
$result["rule_cat"]    = "antispam";
$result["rule_no"]    = "0103";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 554 5.7.1 Rejected as Spam see: http:// rejected.domain.com/help/spam/rejected.html
*/

elseif(preg_match ("/reject.*spam/is",$body,$match)){
$result["rule_cat"]    = "antispam";
$result["rule_no"]    = "0104";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 553 5.7.1 <xxxxx@yourdomain.com>... SpamTrap=reject mode, dsn=5.7.1, Message blocked by BOX Solutions (www.domain.com) SpamTrap Technology, please contact the domain.com site manager for help: (ctlusr8012).
*/

elseif(preg_match ("/SpamTrap/is",$body,$match)){
$result["rule_cat"]    = "antispam";
$result["rule_no"]    = "0105";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 Verify mailfrom failed,blocked
*/

elseif(preg_match ("/Verify mailfrom failed/is",$body,$match)){
$result["rule_cat"]    = "antispam";
$result["rule_no"]    = "0106";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 Error: MAIL FROM is mismatched with message header from address!
*/

elseif(preg_match ("/MAIL.*FROM.*mismatch/is",$body,$match)){
$result["rule_cat"]    = "content_reject";
$result["rule_no"]    = "0107";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 554 5.7.1 Message scored too high on spam scale.  For help, please quote incident ID 22492290.
*/

elseif(preg_match ("/spam scale/is",$body,$match)){
$result["rule_cat"]    = "antispam";
$result["rule_no"]    = "0108";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 550 sorry, it seems as a junk mail
*/

elseif(preg_match ("/junk mail/is",$body,$match)){
$result["rule_cat"]    = "antispam";
$result["rule_no"]    = "0109";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 553-Message filtered. Please see the FAQs section on spam
*/

elseif(preg_match ("/message filtered/is",$body,$match)){
$result["rule_cat"]    = "antispam";
$result["rule_no"]    = "0110";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 554 5.7.1 The message from (<xxxxx@yourdomain.com>) with the subject of ( *(ca2639) 7|-{%2E* : {2"(%EJ;y} (SBI$#$@<K*:7s1!=l~) matches a profile the Internet community may consider spam. Please revise your message before resending.
*/

elseif(preg_match ("/subject.*consider.*spam/is",$body,$match)){
$result["rule_cat"]    = "antispam";
$result["rule_no"]    = "0111";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 451 Temporary local problem - please try later
*/

elseif(preg_match ("/Temporary local problem/is",$body,$match)){
$result["rule_cat"]    = "warning";
$result["rule_no"]    = "0112";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 553 5.3.5 system config error
*/

elseif(preg_match ("/system config error/is",$body,$match)){
$result["rule_cat"]    = "warning";
$result["rule_no"]    = "0113";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: SMTP; 554- (RTR:BL)
 * http://postmaster.info.aol.com/errors/554rtrbl.html 554  Connecting IP: 111.111.111.111
*/

elseif(preg_match ("/(\s+)?\(RTR:BL\)/is",$body,$match)){
$result["rule_cat"]    = "internal_error";
$result["rule_no"]    = "0114";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Diagnostic-Code: X-Postfix; delivery temporarily suspended: conversation with
 * 111.111.111.11[111.111.111.11] timed out while sending end of data -- message may be sent more than once
*/

elseif(preg_match ("/delivery.*suspend/is",$body,$match)){
$result["rule_cat"]    = "dns_loop";
$result["rule_no"]    = "0115";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * ----- The following addresses had permanent fatal errors -----
 * <xxxxx@yourdomain.com>
 * ----- Transcript of session follows -----
 * ... while talking to mta1.domain.com.:
 * >>> DATA <<< 503 All recipients are invalid
 * 554 5.0.0 Service unavailable
*/

elseif(preg_match ("/(?:alias|account|recipient|address|email|mailbox|user)(.*)invalid/i",$body,$match)){
$result["rule_cat"]    = "warning";
$result["rule_no"]    = "0116";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * ----- Transcript of session follows -----
 * xxxxx@yourdomain.com... Deferred: No such file or directory
*/

elseif(preg_match ("/Deferred.*No such.*(?:file|directory)/i",$body,$match)){
$result["rule_cat"]    = "warning";
$result["rule_no"]    = "0117";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Failed to deliver to '<xxxxx@yourdomain.com>'
 * LOCAL module(account xxxx) reports:
 * mail receiving disabled
*/

elseif(preg_match ("/mail receiving disabled/i",$body,$match)){
$result["rule_cat"]    = "inactive";
$result["rule_no"]    = "0118";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * - These recipients of your message have been processed by the mail server:
 * xxxxx@yourdomain.com; Failed; 5.1.1 (bad destination mailbox address)
*/

elseif(preg_match ("/bad.*(?:alias|account|recipient|address|email|mailbox|user)/i",$body,$match)){
$result["rule_cat"]    = "dns_unknown";
$result["rule_no"]    = "0119";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * This Message was undeliverable due to the following reason:
 * The user(s) account is temporarily over quota.
 * <xxxxx@yourdomain.com>
 * Recipient address: xxxxx@yourdomain.com
 * Reason: Over quota
*/

elseif(preg_match ("/over.*quota/i",$body,$match)){
$result["rule_cat"]    = "full";
$result["rule_no"]    = "0120";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Sorry the recipient quota limit is exceeded.
 * This message is returned as an error.
*/

elseif(preg_match ("/quota.*exceeded/i",$body,$match)){
$result["rule_cat"]    = "full";
$result["rule_no"]    = "0121";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * The user to whom this message was addressed has exceeded the allowed mailbox
 * quota. Please resend the message at a later time.
*/

elseif(preg_match ("/exceed.*\n?.*quota/i",$body,$match)){
$result["rule_cat"]    = "full";
$result["rule_no"]    = "0122";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * gaosong "(0), ErrMsg=Mailbox space not enough (space limit is 10240KB)
*/

elseif(preg_match ("/space.*not.*enough/i",$body,$match)){
$result["rule_cat"]    = "full";
$result["rule_no"]    = "0123";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * ----- Transcript of session follows -----
 * xxxxx@yourdomain.com... Deferred: Connection refused by nomail.tpe.domain.com.
 * Message could not be delivered for 5 days
 * Message will be deleted from queue
 * 451 4.4.1 reply: read error from www.domain.com.
 * xxxxx@yourdomain.com... Deferred: Connection reset by www.domain.com.
*/

elseif(preg_match ("/Deferred.*Connection (?:refused|reset)/i",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0124";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * ----- The following addresses had permanent fatal errors -----
 * Tan XXXX SSSS <xxxxx@yourdomain..com>
 * ----- Transcript of session follows -----
 * 553 5.1.2 XXXX SSSS <xxxxx@yourdomain..com>... Invalid host name
*/

elseif(preg_match ("/Invalid host name/i",$body,$match)){
$result["rule_cat"]    = "dns_unknown";
$result["rule_no"]    = "0125";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * ----- Transcript of session follows -----
 * xxxxx@yourdomain.com... Deferred: mail.domain.com.: No route to host
*/

elseif(preg_match ("/Deferred.*No route to host/i",$body,$match)){
$result["rule_cat"]    = "dns_unknown";
$result["rule_no"]    = "0126";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * ----- Transcript of session follows -----
 * 550 5.1.2 xxxxx@yourdomain.com... Host unknown (Name server: .: no data known)
*/

elseif(preg_match ("/Host unknown/i",$body,$match)){
$result["rule_cat"]    = "dns_unknown";
$result["rule_no"]    = "0127";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * ----- Transcript of session follows -----
 * 451 HOTMAIL.com.tw: Name server timeout
 * Message could not be delivered for 5 days
 * Message will be deleted from queue
*/

elseif(preg_match ("/Name server timeout/i",$body,$match)){
$result["rule_cat"]    = "dns_loop";
$result["rule_no"]    = "0128";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * ----- Transcript of session follows -----
 * xxxxx@yourdomain.com... Deferred: Connection timed out with hkfight.com.
 * Message could not be delivered for 5 days
 * Message will be deleted from queue
*/

elseif(preg_match ("/Deferred.*Connection.*tim(?:e|ed).*out/i",$body,$match)){
$result["rule_cat"]    = "dns_loop";
$result["rule_no"]    = "0129";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * ----- Transcript of session follows -----
 * xxxxx@yourdomain.com... Deferred: Name server: domain.com.: host name lookup failure
*/

elseif(preg_match ("/Deferred.*host name lookup failure/i",$body,$match)){
$result["rule_cat"]    = "warning";
$result["rule_no"]    = "0130";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * ----- Transcript of session follows -----
 * 554 5.0.0 MX list for znet.ws. points back to mail01.domain.com
 * 554 5.3.5 Local configuration error
*/

elseif(preg_match ("/MX list.*point.*back/i",$body,$match)){
$result["rule_cat"]    = "dns_unknown";
$result["rule_no"]    = "0131";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * ----- Transcript of session follows -----
 * 451 4.0.0 I/O error
*/

elseif(preg_match ("/I\/O error/i",$body,$match)){
$result["rule_cat"]    = "warning";
$result["rule_no"]    = "0132";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Failed to deliver to 'xxxxx@yourdomain.com'
 * SMTP module(domain domain.com) reports:
 * connection with mx1.mail.domain.com is broken
*/

elseif(preg_match ("/connection.*broken/i",$body,$match)){
$result["rule_cat"]    = "internal_error";
$result["rule_no"]    = "0133";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Delivery to the following recipients failed.
 * xxxxx@yourdomain.com
*/

elseif(preg_match ("/Delivery to the following recipients failed/i",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0134";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * ----- The following addresses had permanent fatal errors -----
 * <xxxxx@yourdomain.com>
 * (reason: User unknown)
 * 550 5.1.1 xxxxx@yourdomain.com... User unknown
*/

elseif(preg_match ("/User unknown/i",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0135";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * 554 5.0.0 Service unavailable
*/

elseif(preg_match ("/Service unavailable/i",$body,$match)){
$result["rule_cat"]    = "internal_error";
$result["rule_no"]    = "0136";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * user has Exceeded
 * exceeded storage allocation
*/

elseif(preg_match ("/(user\shas\s)?exceeded(\s+storage\sallocation)?/i",$body,$match)){
$result["rule_cat"]    = "full";
$result["rule_no"]    = "0137";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Mailbox full
 * mailbox is full
 * Mailbox quota usage exceeded
 * Mailbox size limit exceeded
*/

elseif(preg_match ("/mail(box|folder)(\s+)?(is|full|quota|size)(\s+)?(full|usage|limit)?(\s+)?(exceeded)?/i",$body,$match)){
$result["rule_cat"]    = "full";
$result["rule_no"]    = "0138";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Quota full
 * Quota violation
*/

elseif(preg_match ("/quota\s(full|violation)/i",$body,$match)){
$result["rule_cat"]    = "full";
$result["rule_no"]    = "0139";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * User has exhausted allowed storage space
 * User mailbox exceeds allowed size
 * User has too many messages on the server
*/

elseif(preg_match ("/User\s(has|mail(box|folder))\s+((exhausted|exceeds)\sallowed\s(size|.*space)|(too\smany.*server))/i",$body,$match)){
$result["rule_cat"]    = "full";
$result["rule_no"]    = "0140";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * delivery temporarily suspended
 * Delivery attempts will continue to be made for
*/

elseif(preg_match ("/delivery\s(temporarily\ssuspended|attempts\swill\scontinue\sto\sbe\smade\sfor)/i",$body,$match)){
$result["rule_cat"]    = "warning";
$result["rule_no"]    = "0141";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Greylisting in action
 * Greylisted for 5 minutes
*/

elseif(preg_match ("/greylist(ing|ed)\s(in|for)\s(\w+(\sminutes)?)/i",$body,$match)){
$result["rule_cat"]    = "antispam";
$result["rule_no"]    = "0142";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Server busy
 * server too busy
 * system load is too high
*/

elseif(preg_match ("/(server|system)\s(load\sis\s)?(too\s)?(busy|high)/i",$body,$match)){
$result["rule_cat"]    = "internal_error";
$result["rule_no"]    = "0143";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * too busy to accept mail
 * too many connections
 * too many sessions
 * Too much load
*/

elseif(preg_match ("/too\s(busy|many|much)\s(to\saccept\smail|connections?|sessions?|load)/i",$body,$match)){
$result["rule_cat"]    = "internal_error";
$result["rule_no"]    = "0144";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * temporarily deferred
 * temporarily unavailable
*/

elseif(preg_match ("/temporarily\s(deferred|unavailable)/i",$body,$match)){
$result["rule_cat"]    = "defer";
$result["rule_no"]    = "0145";
$result["email"]    = 1;
}

/*
 * Triggered by:
 * Try later
 * retry timeout exceeded
 * queue too long
*/

elseif(preg_match ("/try\slater|retry\stimeout\sexceeded|queue\stoo\slong/i",$body,$match)){
$result["rule_cat"]    = "delayed";
$result["rule_no"]    = "0146";
$result["email"]    = 1;
}

/*
 * box full
*/

elseif(preg_match ("/Benutzer\shat\szuviele\sMails\sauf\sdem\sServer/i",$body,$match)){
$result["rule_cat"]    = "full";
$result["rule_no"]    = "0147";
$result["email"]    = 1;
}

/*
 * unknown user
*/

elseif(preg_match ("/destin\.\sSconosciuto/i",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0148";
$result["email"]    = 1;
}

/*
 * unknown
*/

elseif(preg_match ("/Destinatario\serrato/i",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0149";
$result["email"]    = 1;
}

/*
 * unknown
*/

elseif(preg_match ("/Destinatario\ssconosciuto\so\smailbox\sdisatttivata/i",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0150";
$result["email"]    = 1;
}

/*
 * unknown
*/

elseif(preg_match ("/Indirizzo\sinesistente/i",$body,$match)){
$result["rule_cat"]    = "unknown";
$result["rule_no"]    = "0151";
$result["email"]    = 1;
}

/*
 * expired
*/

elseif(preg_match ("/Esta\scasilla\sha\sexpirado\spor\sfalta\sde\suso/i",$body,$match)){
$result["rule_cat"]    = "delayed";
$result["rule_no"]    = "0152";
$result["email"]    = 1;
}

/*
 * Auto responses from mailbox
*/

elseif(preg_match ("/([X-]{0,2})Auto-Response-Suppress:([\s]*)([All|OOF])/i",$body,$match)){
$result["rule_cat"]    = "autoreply";
$result["rule_no"]    = "0153";
$result["email"]    = 1;
}


?>