<?php

namespace TwitterStreaming\Extensions\Interfaces;

/**
 * This interface can help you to identify all the methods that we have
 * on this extension.
 *
 * Interface Filterable
 * @package TwitterStreaming\Extensions\Interfaces
 */
interface Filterable
{
    /**
     * Exclude if is a retweet
     * @return mixed
     */
    public function withoutRTs();

    /**
     * Exclude if is a reply
     * @return mixed
     */
    public function withoutReplies();

    /**
     * Exclude the limit notices
     * @see https://dev.twitter.com/streaming/overview/messages-types#limit_notices
     * @return mixed
     */
    public function withoutLimitNotices();

    /**
     * Exclude the delete notices
     * @see https://dev.twitter.com/streaming/overview/messages-types#status_deletion_notices_delete
     * @return mixed
     */
    public function withoutDeleteNotices();

    /**
     * Exclude the tweets which contains media (photos|videos).
     * @return mixed
     */
    public function withoutMedia();

    /**
     * Exclude the tweets which contains media photos
     *
     * @return mixed
     */
    public function withoutMediaPhotos();

    /**
     * Alias of withoutMediaPhotos
     *
     * @return mixed
     */
    public function withoutPhotos();

    /**
     * Include tweets which has photos
     *
     * @return mixed
     */
    public function withMediaPhotos();

    /**
     * Alias of withMediaPhotos
     *
     * @return mixed
     */
    public function withPhotos();

    /**
     * Exclude the tweets which contains media videos
     *
     * @return mixed
     */
    public function withoutMediaVideos();

    /**
     * Alias of withoutMediaVideos
     *
     * @return mixed
     */
    public function withoutVideos();

    /**
     * Include tweets which has videos
     *
     * @return mixed
     */
    public function withMediaVideos();

    /**
     * Alias of withMediaVideos
     *
     * @return mixed
     */
    public function withVideos();

    /**
     * Include tweets which comes from Iphone only
     *
     * @return mixed
     */
    public function onlyFromIphone();

    /**
     * Alias of onlyFromIphone
     *
     * @return mixed
     */
    public function onlyIphone();

    /**
     * Exclude tweets which comes from Iphone only
     *
     * @return mixed
     */
    public function excludeIphone();

    /**
     * Include tweets which comes from Android only
     *
     * @return mixed
     */
    public function onlyFromAndroid();

    /**
     * Alias of onlyFromAndroid
     *
     * @return mixed
     */
    public function onlyAndroid();

    /**
     * Exclude tweets which comes from Android only
     *
     * @return mixed
     */
    public function excludeAndroid();

    /**
     * Include tweets which comes from WP only
     *
     * @return mixed
     */
    public function onlyFromWindowsPhone();

    /**
     * Alias of onlyFromWindowsPhone
     *
     * @return mixed
     */
    public function onlyWindowsPhone();

    /**
     * Exclude tweets which comes from WP only
     *
     * @return mixed
     */
    public function excludeWindowsPhone();

    /**
     * Include tweets which comes from BlackBerry only
     *
     * @return mixed
     */
    public function onlyFromBlackBerry();

    /**
     * Alias of onlyFromBlackBerry
     *
     * @return mixed
     */
    public function onlyBlackBerry();

    /**
     * Exclude tweets which comes from BlackBerry only
     *
     * @return mixed
     */
    public function excludeBlackBerry();
}