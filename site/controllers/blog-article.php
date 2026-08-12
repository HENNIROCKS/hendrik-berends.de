<?php

return function ($page) {

    $private = $page->private()->toBool();

    if ($private === false) {
        return ['locked' => false, 'error' => false];
    }

    $session  = kirby()->session();
    $error    = false;
    $expected = (string)env('BLOG_PRIVATE_PASSWORD');

    if (kirby()->request()->is('POST')) {
        $lockedUntil = (int)$session->get('private-articles-locked-until', 0);

        if ($lockedUntil > time()) {
            $error = true;
        } elseif (csrf(get('csrf')) === false) {
            $error = true;
        } else {
            $password = get('password');

            if ($expected !== '' && $password !== null && hash_equals($expected, (string)$password)) {
                $session->set('private-articles-unlocked', true);
                $session->remove('private-articles-attempts');
                $session->remove('private-articles-locked-until');
            } else {
                $attempts = (int)$session->get('private-articles-attempts', 0) + 1;
                $session->set('private-articles-attempts', $attempts);

                if ($attempts >= 5) {
                    $session->set('private-articles-locked-until', time() + 60);
                }

                $error = true;
            }
        }
    }

    $locked = isArticleLocked($page);

    return compact('locked', 'error');
};
