<?php
/**
 * Created by PhpStorm.
 * User: dude
 * Date: 11/9/15
 * Time: 2:00 PM
 */

namespace TwitterStreaming\Filters;


class WithoutReplies extends Filters
{
    public function execute($tweet)
    {
        return $tweet->isReply;
    }
}