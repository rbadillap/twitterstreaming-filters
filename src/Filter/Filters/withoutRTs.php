<?php

namespace TwitterStreaming\Filter;

final class WithoutRTs extends Filter
{
    public function execute($tweet)
    {
        return $tweet->isRT;
    }
}