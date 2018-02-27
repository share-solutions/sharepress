<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 14:26
 */

namespace share\SharePress\Emails;


interface IEmailSender
{
	public function sendMail ($to, $subject, $message, $headers = [], $attachments = [], $html = true);
}