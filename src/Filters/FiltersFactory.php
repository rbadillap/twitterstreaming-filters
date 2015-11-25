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

    private function _checkPhone($phone, $tweet)
    {
        if ($this->with('source', $tweet) && !empty($tweet->source)) {
            return strpos(strtolower($tweet->source), $phone) !== false;
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

            return $this->_checkPhone('iphone', $tweet);

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

            return !$this->_checkPhone('iphone', $tweet);

        }, __METHOD__);

        return $this;
    }

    public function onlyFromAndroid()
    {

        BaseBehaviors::add(function ($tweet) {

            return $this->_checkPhone('android', $tweet);

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

            return !$this->_checkPhone('android', $tweet);

        }, __METHOD__);

        return $this;
    }

    public function onlyFromWindowsPhone()
    {
        BaseBehaviors::add(function ($tweet) {

            return $this->_checkPhone('windows', $tweet);

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

            return !$this->_checkPhone('windows', $tweet);

        }, __METHOD__);

        return $this;
    }

    public function onlyFromBlackBerry()
    {
        BaseBehaviors::add(function ($tweet) {

            return $this->_checkPhone('blackberry', $tweet);

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

            return !$this->_checkPhone('blackberry', $tweet);

        }, __METHOD__);

        return $this;
    }
}