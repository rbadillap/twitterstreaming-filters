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
     *
     * @return bool
     */
    public function withoutRTs();

    /**
     * Exclude if is a reply
     *
     * @return bool
     */
    public function withoutReplies();

    /**
     * Exclude the limit notices
     *
     * @see https://dev.twitter.com/streaming/overview/messages-types#limit_notices
     * @return bool
     */
    public function withoutLimitNotices();

    /**
     * Exclude the delete notices
     *
     * @see https://dev.twitter.com/streaming/overview/messages-types#status_deletion_notices_delete
     * @return bool
     */
    public function withoutDeleteNotices();

    /**
     * Exclude the tweets which contains media (photos|videos).
     *
     * @return bool
     */
    public function withoutMedia();

    /**
     * Exclude the tweets which contains media photos
     *
     * @return bool
     */
    public function withoutMediaPhotos();

    /**
     * Alias of withoutMediaPhotos
     *
     * @return bool
     */
    public function withoutPhotos();

    /**
     * Include tweets which has photos
     *
     * @return bool
     */
    public function withMediaPhotos();

    /**
     * Alias of withMediaPhotos
     *
     * @return bool
     */
    public function withPhotos();

    /**
     * Exclude the tweets which contains media videos
     *
     * @return bool
     */
    public function withoutMediaVideos();

    /**
     * Alias of withoutMediaVideos
     *
     * @return bool
     */
    public function withoutVideos();

    /**
     * Include tweets which has videos
     *
     * @return bool
     */
    public function withMediaVideos();

    /**
     * Alias of withMediaVideos
     *
     * @return bool
     */
    public function withVideos();

    /**
     * Include tweets which comes from Iphone only
     *
     * @return bool
     */
    public function onlyFromIphone();

    /**
     * Alias of onlyFromIphone
     *
     * @return bool
     */
    public function onlyIphone();

    /**
     * Exclude tweets which comes from Iphone only
     *
     * @return bool
     */
    public function excludeIphone();

    /**
     * Include tweets which comes from Android only
     *
     * @return bool
     */
    public function onlyFromAndroid();

    /**
     * Alias of onlyFromAndroid
     *
     * @return bool
     */
    public function onlyAndroid();

    /**
     * Exclude tweets which comes from Android only
     *
     * @return bool
     */
    public function excludeAndroid();

    /**
     * Include tweets which comes from WP only
     *
     * @return bool
     */
    public function onlyFromWindowsPhone();

    /**
     * Alias of onlyFromWindowsPhone
     *
     * @return bool
     */
    public function onlyWindowsPhone();

    /**
     * Exclude tweets which comes from WP only
     *
     * @return bool
     */
    public function excludeWindowsPhone();

    /**
     * Include tweets which comes from BlackBerry only
     *
     * @return bool
     */
    public function onlyFromBlackBerry();

    /**
     * Alias of onlyFromBlackBerry
     *
     * @return bool
     */
    public function onlyBlackBerry();

    /**
     * Exclude tweets which comes from BlackBerry only
     *
     * @return bool
     */
    public function excludeBlackBerry();

    /**
     * Indicate the source that should be filtered
     *
     * @param string|array $source
     * @return bool
     */
    public function onlyFromSource($source);

    /**
     * Indicate the source that should be excluded
     *
     * @param string|array $source
     * @return bool
     */
    public function excludeFromSource($source);

    /**
     * Include tweets who users has defined a Geo location
     *
     * @return bool
     */
    public function withGeo();

    /**
     * Exclude tweets who users has defined a Geo location
     *
     * @return bool
     */
    public function withoutGeo();

    /**
     * Include tweets with a defined language
     *
     * @param string|array optional $language
     * @return bool
     */
    public function withLanguage($language = null);

    /**
     * Exclude tweets with a defined language
     *
     * @param string|array optional $language
     * @return bool
     */
    public function withoutLanguage($language = null);

    /**
     * Include tweets with hashtags
     *
     * @param int optional $num
     * @return bool
     */
    public function withHashtags($num = null);

    /**
     * Exclude tweets with hashtags
     *
     * @return bool
     */
    public function withoutHashtags();

    /**
     * Include tweets from verified users only
     *
     * @return bool
     */
    public function onlyVerified();

    /**
     * Include only RTs from Verified users
     *
     * @return bool
     */
    public function onlyRTsFromVerified();
}