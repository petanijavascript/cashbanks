<?php
//
//return [
//
//	/*
//	|--------------------------------------------------------------------------
//	| Mail Driver
//	|--------------------------------------------------------------------------
//	|
//	| Laravel supports both SMTP and PHP's "mail" function as drivers for the
//	| sending of e-mail. You may specify which one you're using throughout
//	| your application here. By default, Laravel is setup for SMTP mail.
//	|
//	| Supported: "smtp", "mail", "sendmail", "mailgun", "mandrill", "log"
//	|
//	*/
//
//	'driver' => 'smtp',
//
//	/*
//	|--------------------------------------------------------------------------
//	| SMTP Host Address
//	|--------------------------------------------------------------------------
//	|
//	| Here you may provide the host address of the SMTP server used by your
//	| applications. A default option is provided that is compatible with
//	| the Mailgun mail service which will provide reliable deliveries.
//	|
//	*/
//
//	'host' => 'smtp.mailgun.org',
//
//	/*
//	|--------------------------------------------------------------------------
//	| SMTP Host Port
//	|--------------------------------------------------------------------------
//	|
//	| This is the SMTP port used by your application to deliver e-mails to
//	| users of the application. Like the host we have set this value to
//	| stay compatible with the Mailgun e-mail application by default.
//	|
//	*/
//
//	'port' => 587,
//
//	/*
//	|--------------------------------------------------------------------------
//	| Global "From" Address
//	|--------------------------------------------------------------------------
//	|
//	| You may wish for all e-mails sent by your application to be sent from
//	| the same address. Here, you may specify a name and address that is
//	| used globally for all e-mails that are sent by your application.
//	|
//	*/
//
////	'from' => ['address' => null, 'name' => null],
//    'from' => [
//        'address' => 'no-reply@example.org', 
//        'name'    => 'No Reply'
//    ],
//
//	/*
//	|--------------------------------------------------------------------------
//	| E-Mail Encryption Protocol
//	|--------------------------------------------------------------------------
//	|
//	| Here you may specify the encryption protocol that should be used when
//	| the application send e-mail messages. A sensible default using the
//	| transport layer security protocol should provide great security.
//	|
//	*/
//
//	'encryption' => 'tls',
//
//	/*
//	|--------------------------------------------------------------------------
//	| SMTP Server Username
//	|--------------------------------------------------------------------------
//	|
//	| If your SMTP server requires a username for authentication, you should
//	| set it here. This will get used to authenticate with your server on
//	| connection. You may also set the "password" value below this one.
//	|
//	*/
//
//	'username' => null,
//
//	/*
//	|--------------------------------------------------------------------------
//	| SMTP Server Password
//	|--------------------------------------------------------------------------
//	|
//	| Here you may set the password required by your SMTP server to send out
//	| messages from your application. This will be given to the server on
//	| connection so that the application will be able to send messages.
//	|
//	*/
//
//	'password' => null,
//
//	/*
//	|--------------------------------------------------------------------------
//	| Sendmail System Path
//	|--------------------------------------------------------------------------
//	|
//	| When using the "sendmail" driver to send e-mails, we will need to know
//	| the path to where Sendmail lives on this server. A default path has
//	| been provided here, which will work well on most of your systems.
//	|
//	*/
//
//	'sendmail' => '/usr/sbin/sendmail -bs',
//
//	/*
//	|--------------------------------------------------------------------------
//	| Mail "Pretend"
//	|--------------------------------------------------------------------------
//	|
//	| When this option is enabled, e-mail will not actually be sent over the
//	| web and will instead be written to your application's logs files so
//	| you may inspect the message. This is great for local development.
//	|
//	*/
//
//	'pretend' => false,
//
//];




 

return [
 
// host ciputra co.id
'driver' => 'smtp',
'host' => 'mail.ciputra.co.id',
'port' => 587,  
'encryption' => 'tls',
'username' => 'sh2mailsender@ciputra.co.id',
'password' => 'Sungairaya2021',
'sendmail' => '/usr/sbin/sendmail -bs',
'pretend' => false,

// // host ciputra com
// 'driver' => 'smtp',
// 'host' => 'smtp.office365.com',
// 'port' => 587,  
// 'encryption' => 'tls',
// 'username' => 'sh2mailsender@ciputra.com',
// 'password' => 'Sungairaya789',
// 'sendmail' => '/usr/sbin/sendmail -bs',
// 'pretend' => false,
// // 'stream' => [
// //     'ssl' => [
// //         'allow_self_signed' => true,
// //         'verify_peer' => false,
// //         'verify_peer_name' => false,
// //     ],
// // ],
    
////    host gmail
//    'driver' => 'smtp',
//    'host' => 'smtp.gmail.com',
//    'port' => 587,
//    'from' => array('address' => 'riekylesmana46@gmail.com', 'name' => 'RIEKY'),
//    'encryption' => 'tls',
//    'username' => 'riekylesmana46@gmail.com',
//    'password' => '456shit456',
//    'sendmail' => '/usr/sbin/sendmail -bs',
//    'pretend' => false,
    
    // host ciputra
    //'driver' => 'smtp',
    //'host' => 'mail.ciputra.co.id',
    //'port' => 587,  
    //'encryption' => 'tls',
    //'username' => 'sh2.mailsender@ciputra.co.id',
    //'password' => 'sungai#76567',
    //'sendmail' => '/usr/sbin/sendmail -bs',
    //'pretend' => false,
	
	
    // host ciputra
    //'driver' => 'smtp',
   // 'host' => 'mail.ciputra.co.id',
   // 'port' => 587,  
   // 'encryption' => 'tls',
   // 'username' => 'mis.kpjkt@ciputra.co.id',
   // 'password' => 'sun641r4y4',
   // 'sendmail' => '/usr/sbin/sendmail -bs',
   // 'pretend' => false,
	

//    
//    //host mailtrap
//    'driver' => 'smtp',
//    'host' => 'mailtrap.io',
//    'port' => 25,
//    'from' => array('address' => 'admin@ciputra.co.id', 'name' => 'RIEKY LESMANA'),
//    'encryption' => 'tls',
//    'username' => '76ba3c18d7811c',
//    'password' => 'f4f0f527d00a23',
//    'sendmail' => '/usr/sbin/sendmail -bs',
//    'pretend' => false,
 
    

];





























