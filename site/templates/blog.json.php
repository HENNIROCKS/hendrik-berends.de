<?php

foreach ($articles as $article) {

    // $html .= snippet('blog/article', ['article' => $article, 'class' => 'blog-article'], true);
    $html .= snippet('blog/article', ['article' => $article], true);
}

$json['html'] = $html;
$json['more'] = $more;

echo json_encode($json);
