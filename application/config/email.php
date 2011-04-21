<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 |-------------------------------------------------------------------------
 | Name: email.php
 |-------------------------------------------------------------------------
 |
 |-------------------------------------------------------------------------
 */

$config['useragent']    = "CodeIgniter";    // The "user agent". ( None )
$config['protocol']        = "smtp";        // The mail sending protocol. ( mail, sendmail, or smtp )
$config['mailpath']        = "";                // The server path to Sendmail. ( None )

$config['smtp_host']    = "";                   // SMTP Server Address. ( None ) NOTE: This is your real account SMTP server online that you setup in your email application
$config['smtp_user']    = "";                   // SMTP Username. ( None ) NOTE: This your real online email account name that you setup in your email application!
$config['smtp_pass']    = "";                // SMTP Password. ( None ) NOTE: This is the real PASSWORD that you use to logon to your real email accout!
$config['smtp_port']    = "25";                // SMTP Port. ( None ) NOTE: Your real online SMTP PORT NUMBER, mine is 25
$config['smtp_timeout']    = 5;                // SMTP Timeout (in seconds). ( None )

$config['wordwrap']        = TRUE;                // Enable word-wrap. ( TRUE or FALSE (boolean) )
$config['wrapchars']    = "76";                // Character count to wrap at. ( None )

$config['mailtype']        = "html";            // Type of mail. If you send HTML email you must send it as a complete web page. ( text or html )
                                            // Make sure you don't have any relative links or relative image paths otherwise they will not work.

$config['charset']        = "utf-8";            // Character set (utf-8, iso-8859-1, etc.). ( None )
$config['validate']        = FALSE;            // Whether to validate the email address. ( TRUE or FALSE (boolean) )
$config['priority']        = "3";                // Email Priority. 1 = highest. 5 = lowest. 3 = normal. ( 1, 2, 3, 4, 5 )
$config['crlf']            = "\r\n";            // Newline character. (Use "\r\n" to comply with RFC 822). ( "\r\n" or "\n" or "\r" )
$config['newline']        = "\r\n";            // Newline character. (Use "\r\n" to comply with RFC 822). ( "\r\n" or "\n" or "\r" )

$config['bcc_batch_mode']    = FALSE;        // Enable BCC Batch Mode. ( TRUE or FALSE (boolean) )
$config['bcc_batch_size']    = 200;            // Number of emails in each BCC batch. ( None )

/**
 * Note: This is for XAMMP but should be something like it for MAPP and WAMP
 * Settings for php.ini
 *
 * SMTP Settings - php.ini
 *
 * [mail function]
 * ; For Win32 only.
 * ; http://php.net/smtp
 * ; BELOW - assign this your real smtp server for your online account <--- READ
 * SMTP = smtp.yoursite.com
 * ; http://php.net/smtp-port
 * smtp_port = 25
 *
 * ; For Win32 only.
 * ; http://php.net/sendmail-from
 * ; BELOW - your real email address her from your online account <--- READ
 * sendmail_from = you@yourdomain.com
 *
 * ; For Unix only.  You may supply arguments as well (default: "sendmail -t -i").
 * ; http://php.net/sendmail-path
 * ; BELOW - For sendmail
 * sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"
 *
 * ; Force the addition of the specified parameters to be passed as extra parameters
 * ; to the sendmail binary. These parameters will always replace the value of
 * ; the 5th parameter to mail(), even in safe mode.
 * ;mail.force_extra_parameters =
 *
 * ; Add X-PHP-Originating-Script: that will include uid of the script followed by the filename
 * mail.add_x_header = On
 *
 * ; Log all mail() calls including the full path of the script, line #, to address and headers
 * ;mail.log = "C:\xampp\apache\logs\php_mail.log"
 *
 */

// ------------------------------------------------------------------------
/* End of file email.php */
/* Location: ./application/config/email.php */  
