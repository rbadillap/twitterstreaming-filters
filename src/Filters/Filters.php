<?php

namespace TwitterStreaming\Extensions;

use Closure;

/**
 * This extensions is helpful when you wanna filter the tweets by some
 * specific logic. Instead of create all the conditions in your script, Filters
 * can help you defining which tweets passes and which doesnt.
 * You can take a look the documentation to see which methods are created
 * on this extension.
 *
 * Class Filters
 * @package TwitterStreaming\Extensions
 */
class Filters
{
    /**
     * This is the public method that will be used in your script
     *
     * @param Closure $callback
     * @return mixed
     */
    public function filters(Closure $callback)
    {
        if ($callback instanceof Closure) {
            return $callback(new FiltersFactory());
        }
    }
}
