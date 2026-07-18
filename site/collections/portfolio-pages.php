<?php

/**
 * @var \Kirby\Cms\Site $site
 */

return function ($site) {
    return $site->pages()->filterBy('intendedTemplate', 'portfolio')->children()->listed();
};
