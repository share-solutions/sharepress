<?php

namespace prevenir\Emails;

use share\SharePress\Emails\EmailBase;

class SampleMail extends EmailBase {
    public function __construct() {
        $to = "pedro.gaspar@plotcontent.com";
        $subject = "[Sample] Email";
        $message = view("emails/notification", [
                "title" => "Sample Title",
                "content" => "Sample Content"
            ]);
        parent::__construct($to, $subject, $message, '', true, null, null);
    }
}