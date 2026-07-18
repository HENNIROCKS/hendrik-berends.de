<?php

/**
 * @var \Kirby\Cms\Site $site
 */

return function ($site) {
    return $site->find('impressum', 'datenschutzerklaerung');
};
