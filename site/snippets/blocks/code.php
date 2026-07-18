<?php

/** 
 * @var \Kirby\Cms\Block $block
 * */

?>

<pre class="code"><code class="code__language code__language--<?= $block->language()->or('text') ?>"><?= $block->code()->html(false) ?></code></pre>