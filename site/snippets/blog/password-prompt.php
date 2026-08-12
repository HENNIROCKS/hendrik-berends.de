<?php

/**
 * @var bool $error
 */

?>

<div class="password-prompt">
    <p class="password-prompt__text">
        Dieser Beitrag ist privat. Bitte gib das Passwort ein, um ihn zu lesen.
    </p>

    <?php if ($error): ?>
        <p class="password-prompt__error">
            Falsches Passwort.
        </p>
    <?php endif ?>

    <form class="password-prompt__form" method="post">
        <input type="hidden" name="csrf" value="<?= csrf() ?>">

        <label class="sr-only" for="password-prompt-input">Passwort</label>
        <input class="password-prompt__input" id="password-prompt-input" type="password" name="password" placeholder="Passwort" required autofocus>

        <button class="button password-prompt__submit" type="submit">Freischalten</button>
    </form>
</div>
