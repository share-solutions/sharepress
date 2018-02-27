<?php

namespace share\SharePress\Emails;
use share\SharePress\Facades\Container;
use share\SharePress\Facades\Mailer;

/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 20/04/2017
 * Time: 11:28
 */
class EmailBase {
    protected $to;
    protected $subject;
    protected $message;
    protected $from;
    protected $isHtml;
    protected $headers;
    protected $attachments;

    public function __construct($to, $subject, $message, $from, $isHtml = true, $headers = [], $attachments = []) {
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->from = $from;
        $this->isHtml = $isHtml;
        $this->headers = $headers;
        $this->attachments = $attachments;
    }

    public function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    public function send () {
        if ($this->from != "") {
            $this->headers[] = 'From: ' . $this->from;
        }
        return Mailer::sendMail(
            $this->to,
            $this->subject,
            $this->message,
            $this->headers,
            $this->attachments,
            $this->isHtml
        );
    }
}