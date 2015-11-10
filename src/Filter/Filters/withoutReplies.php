<?php

namespace TwitterStreaming\Filter;

class WithoutReplies extends Filter
{
    public function execute($tweet)
    {
        return $tweet->isReply;
    }
}