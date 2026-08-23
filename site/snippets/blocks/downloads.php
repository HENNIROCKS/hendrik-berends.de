<?php

/**
 * @var \Kirby\Cms\Block $block
 */

$files = $block->files()->toFiles();

// Both cells carry the same utilities, so they stay in one place instead of
// being repeated verbatim. Tailwind still sees them: the string is a literal
// in this file, which is all its scanner looks for.
//
// Below xl the table stacks and each cell is labelled from its data-label
// attribute, so the bottom rule moves to the row that wraps the block.
$cell = 'border-b border-foreground p-md [border-bottom-style:dashed] '
    . 'max-xl:block max-xl:border-b-0 max-xl:before:block max-xl:before:font-bold '
    . 'max-xl:before:uppercase max-xl:before:content-[attr(data-label)]';

?>

<?php if ($files->isNotEmpty()): ?>
    <table class="mb-xl w-full border-collapse">
        <thead class="max-xl:hidden">
            <tr>
                <th class="border-t border-b-2 border-foreground p-md text-left font-bold">Datei</th>
                <th class="border-t border-b-2 border-foreground p-md text-left font-bold">Download</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files->sortBy('title', 'asc', 'filename', 'asc') as $file): ?>
                <tr class="max-xl:border max-xl:border-dashed max-xl:border-foreground">
                    <td class="<?= $cell ?>" data-label="Datei">
                        <strong>
                            <?php if ($file->title()->isNotEmpty()): ?>
                                <?= $file->title() ?>
                            <?php else: ?>
                                <?= $file->name() ?>
                            <?php endif ?>
                        </strong>

                        <?php if ($file->caption()->isNotEmpty()): ?>
                            <br><?= $file->caption()->inline() ?>
                        <?php endif ?>
                    </td>
                    <td class="<?= $cell ?>" data-label="Download">
                        <?php
                        // The label on screen is the file size alone, which reads as
                        // "2.3 MB, 1.1 MB, 4.7 MB" down a column of links. The name
                        // goes into aria-label, keeping the size in it so the label
                        // on screen stays part of the accessible name (WCAG 2.5.3).
                        $fileName = $file->title()->or($file->name());
                        ?>
                        <a class="inline-block cursor-pointer border border-background-inverse bg-background-inverse px-5 py-2.5 text-center font-display font-normal no-underline text-md text-foreground-inverse hover:border-link hover:bg-link focus:border-link focus:bg-link" href="<?= $file->url() ?>" target="_blank" aria-label="<?= esc($fileName) ?> herunterladen, <?= $file->niceSize() ?>" title="Datei herunterladen">
                            <?php snippet('icon', ['name' => 'download']) ?>
                            <?= $file->niceSize() ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>
