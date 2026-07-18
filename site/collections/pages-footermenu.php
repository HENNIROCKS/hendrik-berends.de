<?php

/**
 * @var \Kirby\Cms\Site $site
 */

return function ($site) {
    return $site->footermenu()->toPages();
};
