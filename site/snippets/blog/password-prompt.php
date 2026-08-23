<?php

/**
 * @var bool $error
 */

?>

<div class="mx-auto my-md md:w-[50vw]">
    <p>
        Dieser Beitrag ist privat. Bitte gib das Passwort ein, um ihn zu lesen.
    </p>

    <?php if ($error): ?>
        <p class="mb-md text-link">
            Falsches Passwort.
        </p>
    <?php endif ?>

    <form class="mt-md flex flex-wrap gap-sm" method="post">
        <input type="hidden" name="csrf" value="<?= csrf() ?>">

        <label class="sr-only" for="password-prompt-input">Passwort</label>
        <input class="flex-1 border border-foreground bg-background px-5 py-2.5 text-foreground" id="password-prompt-input" type="password" name="password" placeholder="Passwort" required autofocus>

        <button class="inline-block cursor-pointer border border-background-inverse bg-background-inverse px-5 py-2.5 text-center font-display font-normal no-underline text-md text-foreground-inverse hover:border-link hover:bg-link focus:border-link focus:bg-link" type="submit">Freischalten</button>
    </form>
</div>
