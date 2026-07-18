<?php

/**
 * @var \Kirby\Cms\Site $site
 */

return function ($site) {
  return $site->links()->toStructure();
};

/*
links:
  label: Links
  type: structure
  fields:
    name:
      type: text
    url:
      type: url
    icon:
      type: files
      multiple: false
      query: site.images
    rel:
      label: Linkbeziehung (rel)
      type: text
      placeholder: nofollow noopener
*/