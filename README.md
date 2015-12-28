# TwitterStreaming Filters

This is an extension of [TwitterStreaming PHP](https://github.com/rbadillap/twitterstreaming) package. To give you a set of methods that could help you to filter tweets by some specific rule.

On this document, we'll put all the available methods, and of course, we are open to receive new ones!

----------

 - [Installation](#installation)
 - [How it works](#how-it-works)
 - [More examples](#more-examples)
 - [Contributing](#contributing)

## Installation

As we said, **TwitterStreaming Filters** is an extension of  **TwitterStreaming PHP**. You can use [Composer](http://getcomposer.org/) to install it.

Just run the following command.

    composer require rbadillap/twitterstreaming-filters

There is not extra dependencies on this package, this just require the core package.

## How it works

Due **TwitterStreaming PHP** allows you to use extensions, you need to register the new `Filters` extension created. On this way:

```php
require_once 'vendor/autoload.php'; // The autoload from composer

use TwitterStreaming\Tracker;
use TwitterStreaming\Endpoints;
use TwitterStreaming\Extensions; // Add this namespace

(new Tracker);
	// Add the Filters extensions
    ->addExtension(Extensions\Filters::class)
	// Use the Public endpoint
    ->endpoint(Endpoints\PublicEndpoint::class, 'filter')
    // Set the parameters
    ->parameters([
        'track' => '#facebook'
    ])
    // Use the method 'filters' provided by the extension
    ->filters(function (Extensions\FiltersFactory $filters) {
        return $filters
		        // Use methods to filter tweets
                ->withoutRTs()
                ->withoutReplies()
                ->withVideos();
    })
    // And track the tweets
    ->track(function ($tweet) {
        print $tweet->id . PHP_EOL;
        print $tweet->text;
    });
```

On this example, we are:

 - Tracking tweets from the Public Endpoint and filter type.
 - Tracking tweets which contains the hashtag `#facebook`
 - Excluding all the Retweets.
 - Excluding all the Replies.
 - Including tweets which contains Videos attached.

Simple!

### More examples

This is the list of filters that we have implemented. (Continuously up to date).

```php
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
```

## Contributing

Use the same workflow as many of the packages that we have here in Github.

 1. Fork the project.
 2. Create your feature branch with a related-issue name.
 3. Try to be clear with the code committed and follow the [PSR-2 Coding Style Guide](http://www.php-fig.org/psr/psr-2/).
 4. Run the tests (and create your new ones if necessary).
 5. Commit and push the branch.
 6. Create the Pull Request.
