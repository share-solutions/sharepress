<?php

namespace share\SharePress\Emails;

/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 20/04/2017
 * Time: 11:28
 */
class EmailSender implements IEmailSender {

    protected $attachments;

    public function set_email_content_type_to_html () {
        return "text/html";
    }

    public function sendMail ($to, $subject, $message, $headers = [], $attachments = [], $html = true) {
        $this->attachments = $this->categorize_attachments($attachments);
        !$html || add_filter( 'wp_mail_content_type', array($this, 'set_email_content_type_to_html'));

        add_action( 'phpmailer_init', array($this, 'attach_streams') );

        $return = wp_mail(
            $to,
            $subject,
            $message,
            $headers,
            $this->attachments['files']
        );

        !$html || remove_filter( 'wp_mail_content_type', array($this, 'set_email_content_type_to_html'));
        return $return ? true : $GLOBALS['phpmailer']->ErrorInfo;
    }

    public function attach_streams (\PHPMailer $phpmailer) {
        foreach ($this->attachments['blobs'] as $attachment) {
            $phpmailer->AddStringAttachment(
                $attachment['slashed_file_content']?stripslashes($attachment['content']):$attachment['content'],
                $attachment['name'],
                isset($attachment['encoding'])?$attachment['encoding']:'base64',
                $attachment['type']
            );
        }
    }

    private function categorize_attachments ($attachments) {
        $ret = [
            'files' => [],
            'blobs' => []
        ];
        if(!!$attachments) {
			foreach ($attachments as $attachment) {
				if (!is_array($attachment)) {
					$ret['files'][] = $attachment;
				} else {
					$ret['blobs'][] = $attachment;
				}
			}
		}
        return $ret;
    }
}