<?php

/**
 * @var \Kirby\Cms\Site $site
 */

return function ($site) {
    // return $site->pages()->published()->not('error');
    return $site->pages()->published()->not('error', 'home');
};
