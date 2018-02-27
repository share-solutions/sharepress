<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 09:17
 */

namespace share\SharePress\ServiceProviders;


use share\SharePress\Emails\EmailSender;
use share\SharePress\Facades\Config;
use share\SharePress\Facades\Container;

class EmailsServiceProvider implements IServiceProvider
{
	public function boot()
	{
		if (!!Config::get("app.emails")) {
			/**
			 * Bootstrap Email Sender Support
			 */
			$mailSenderClass = Config::get("app.emails.sender");
			if(!$mailSenderClass) {
				$mailSenderClass = EmailSender::class;
			}
			Container::singleton("mail_sender", function () use ($mailSenderClass) {
				$mailSender = new $mailSenderClass();
				return $mailSender;
			});
		}
	}
	public function register()
	{
		// TODO: Implement register() method.
	}
}