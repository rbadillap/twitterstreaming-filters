<?php

namespace TwitterStreaming\Extensions;

use TwitterStreaming\Core\BaseBehaviors;
use TwitterStreaming\Extensions\Interfaces\Filterable;

/**
 * Filter factory is where the magic happens. We have defined all the methods
 * and registered to the BaseBehaviors module which is part of the TwitterStreaming Core
 *
 * Remember, each method should have a callback that must returns a boolean value
 * to determine if the tweet should be filtered or not.
 *
 * Class FiltersFactory
 * @package TwitterStreaming\Extensions
 */
class FiltersFactory implements Filterable
{
    /**
     * A little helper to check if there is present an specific key into the give array
     *
     * @param $key
     * @param $obj
     * @return bool
     */
    private function with($key, $obj)
    {
        return array_key_exists($key, $obj);
    }

    /**
     * Check if within the entities there could be a photo attached
     *
     * @param $tweet
     * @return bool
     */
    private function _withMediaPhotos($tweet)
    {
        if ($this->with('extended_entities', $tweet) && $this->with('media', $tweet->extended_entities)) {
            foreach ($tweet->extended_entities->media as $media) {
                if ($media->type == 'photo') {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Same functionality but checking the videos, on this case, Twitter indicates a video with a animated_gif type.
     *
     * @param $tweet
     * @return bool
     */
    private function _withMediaVideos($tweet)
    {
        if ($this->with('extended_entities', $tweet) && $this->with('media', $tweet->extended_entities)) {
            foreach ($tweet->extended_entities->media as $media) {
                if ($media->type == 'animated_gif') {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Source is the channel where the user wrote the tweet, with this method
     * you can check the source if match with some specific name
     *
     * @param $source
     * @param $tweet
     * @return bool
     */
    private function _checkSource($source, $tweet)
    {
        if ($this->with('source', $tweet) && !empty($tweet->source)) {

            // Check the argument, array and strings are allowed
            if (is_array($source)) {
                foreach ($source as $device) {
                    if (strpos(strtolower($tweet->source), $device) !== false) {
                        return true;
                    }
                }
                return false;
            }

            return strpos(strtolower($tweet->source), $source) !== false;
        }

        return false;
    }

    /**
     * Check the language of the tweet
     *
     * @param $language
     * @param $tweet
     * @return bool
     */
    private function _checkLanguage($language, $tweet)
    {
        if ($this->with('lang', $tweet) && !empty($tweet->lang) && $tweet->lang !== 'und') {

            // Returns true, doesn't matter if user doesn't provide an specific
            // language, at least there is some defined by the tweet
            if (!$language) {
                return true;
            }

            // Check the argument, array and strings are allowed
            if (is_array($language)) {
                foreach ($language as $lang) {
                    if (strtolower($lang) == strtolower($tweet->lang)) {
                        return true;
                    }
                }
                return false;
            }

            return strtolower($tweet->lang) == strtolower($language);
        }
        return false;
    }

    public function withoutRTs()
    {
        BaseBehaviors::add(function ($tweet) {

            return !$this->with('retweeted_status', $tweet);

        }, __METHOD__);

        return $this;
    }

    public function withoutReplies()
    {
        BaseBehaviors::add(function ($tweet) {

            return !$this->with('in_reply_to_status_id', $tweet) || is_null($tweet->in_reply_to_status_id);

        }, __METHOD__);

        return $this;
    }

    public function withoutLimitNotices()
    {
        BaseBehaviors::add(function ($tweet) {

            /*
             * Avoid the limit notices
             * @see https://dev.twitter.com/streaming/overview/messages-types#limit_notices
             */
            return !$this->with('limit', $tweet);

        }, __METHOD__);

        return $this;
    }

    public function withoutDeleteNotices()
    {
        BaseBehaviors::add(function ($tweet) {

            /**
             * Avoid the deleted notices
             * @see https://dev.twitter.com/streaming/overview/messages-types#status_deletion_notices_delete
             */
            return !$this->with('delete', $tweet);

        }, __METHOD__);

        return $this;
    }

    public function withoutMedia()
    {
        BaseBehaviors::add(function ($tweet) {

            if ($this->with('entities', $tweet)) {
                return !$this->with('media', $tweet->entities);
            }

        }, __METHOD__);

        return $this;
    }

    public function withoutMediaPhotos()
    {
        BaseBehaviors::add(function ($tweet) {

            return !$this->_withMediaPhotos($tweet);

        }, __METHOD__);

        return $this;
    }

    public function withoutPhotos()
    {
        return $this->withoutMediaPhotos();
    }

    public function withMediaPhotos()
    {
        BaseBehaviors::add(function ($tweet) {

            return $this->_withMediaPhotos($tweet);

        }, __METHOD__);

        return $this;
    }

    public function withPhotos()
    {
        return $this->withMediaPhotos();
    }

    public function withoutMediaVideos()
    {
        BaseBehaviors::add(function ($tweet) {

            return !$this->_withMediaVideos($tweet);

        }, __METHOD__);

        return $this;
    }

    public function withoutVideos()
    {
        return $this->withoutMediaVideos();
    }

    public function withMediaVideos()
    {
        BaseBehaviors::add(function ($tweet) {

            return $this->_withMediaVideos($tweet);

        }, __METHOD__);

        return $this;
    }

    public function withVideos()
    {
        return $this->withMediaVideos();
    }

    public function onlyFromIphone()
    {
        BaseBehaviors::add(function ($tweet) {

            return $this->_checkSource('iphone', $tweet);

        }, __METHOD__);

        return $this;
    }

    public function onlyIphone()
    {
        return $this->onlyFromIphone();
    }

    public function excludeIphone()
    {
        BaseBehaviors::add(function ($tweet) {

            return !$this->_checkSource('iphone', $tweet);

        }, __METHOD__);

        return $this;
    }

    public function onlyFromAndroid()
    {
        BaseBehaviors::add(function ($tweet) {

            return $this->_checkSource('android', $tweet);

        }, __METHOD__);

        return $this;
    }

    public function onlyAndroid()
    {
        return $this->onlyFromAndroid();
    }

    public function excludeAndroid()
    {
        BaseBehaviors::add(function ($tweet) {

            return !$this->_checkSource('android', $tweet);

        }, __METHOD__);

        return $this;
    }

    public function onlyFromWindowsPhone()
    {
        BaseBehaviors::add(function ($tweet) {

            return $this->_checkSource('windows', $tweet);

        }, __METHOD__);

        return $this;
    }

    public function onlyWindowsPhone()
    {
        return $this->onlyFromWindowsPhone();
    }

    public function excludeWindowsPhone()
    {
        BaseBehaviors::add(function ($tweet) {

            return !$this->_checkSource('windows', $tweet);

        }, __METHOD__);

        return $this;
    }

    public function onlyFromBlackBerry()
    {
        BaseBehaviors::add(function ($tweet) {

            return $this->_checkSource('blackberry', $tweet);

        }, __METHOD__);

        return $this;
    }

    public function onlyBlackBerry()
    {
        return $this->onlyFromBlackBerry();
    }

    public function excludeBlackBerry()
    {
        BaseBehaviors::add(function ($tweet) {

            return !$this->_checkSource('blackberry', $tweet);

        }, __METHOD__);

        return $this;
    }

    public function onlyFromSource($source)
    {
        BaseBehaviors::add(function ($tweet) use ($source) {

            return $this->_checkSource($source, $tweet);

        }, __METHOD__);

        return $this;
    }

    public function excludeFromSource($source)
    {
        BaseBehaviors::add(function ($tweet) use ($source) {

            return !$this->_checkSource($source, $tweet);

        }, __METHOD__);

        return $this;
    }

    public function withGeo()
    {
        BaseBehaviors::add(function ($tweet) {

            return $this->with('geo', $tweet) && !is_null($tweet->geo);

        }, __METHOD__);

        return $this;
    }

    public function withoutGeo()
    {
        BaseBehaviors::add(function ($tweet) {

            return $this->with('geo', $tweet) && is_null($tweet->geo);

        }, __METHOD__);

        return $this;
    }

    public function withLanguage($language = null)
    {
        BaseBehaviors::add(function ($tweet) use ($language) {

            return $this->_checkLanguage($language, $tweet);

        }, __METHOD__);

        return $this;
    }

    public function withoutLanguage($language = null)
    {
        BaseBehaviors::add(function ($tweet) use ($language) {

            return !$this->_checkLanguage($language, $tweet);

        }, __METHOD__);

        return $this;
    }

    public function withHashtags($num = null)
    {
        BaseBehaviors::add(function ($tweet) use ($num) {

            $num = intval($num);

            if (!$this->with('entities', $tweet)) {
                return false;
            }

            if (!$this->with('hashtags', $tweet->entities)) {
                return false;
            }

            if ($num > 0) {
                return count($tweet->entities->hashtags) == $num;
            } else {
                return count($tweet->entities->hashtags) > 0;
            }

        }, __METHOD__);

        return $this;
    }

    public function withoutHashtags()
    {
        BaseBehaviors::add(function ($tweet) {

            if (!$this->with('entities', $tweet)) {
                return true;
            }

            if (!$this->with('hashtags', $tweet->entities)) {
                return true;
            }

            return count($tweet->entities->hashtags) == 0;

        }, __METHOD__);

        return $this;
    }

    public function onlyVerified()
    {
        BaseBehaviors::add(function ($tweet) {

            return $this->with('user', $tweet) && $tweet->user->verified;

        }, __METHOD__);

        return $this;
    }

    public function onlyRTsFromVerified()
    {
        BaseBehaviors::add(function ($tweet) {

            return $this->with('retweeted_status', $tweet) && $tweet->retweeted_status->user->verified;

        }, __METHOD__);

        return $this;
    }
}
