<?php

/**
 * @var \Kirby\Cms\Site $site
 */

return function ($site) {
    return $site->pages()->listed();
};
