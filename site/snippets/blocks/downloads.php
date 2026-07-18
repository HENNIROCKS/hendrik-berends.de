<?php

/**
 * @var \Kirby\Cms\Block $block
 */

$files = $block->files()->toFiles();

?>

<?php if ($files->isNotEmpty()): ?>
    <div class="downloads">
        <table class="table">
            <thead class="table__head">
                <tr class="table__row">
                    <th class="table__column">Datei</th>
                    <th class="table__column">Download</th>
                </tr>
            </thead>
            <tbody class="table__body">
                <?php foreach ($files->sortBy('title', 'asc', 'filename', 'asc') as $file): ?>
                    <tr class="table__row">
                        <td class="table__column" data-label="Datei">
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
                        <td class="table__column" data-label="Download">
                            <a class="button button--download" href="<?= $file->url() ?>" target="_blank" title="Datei herunterladen">
                                <?= $file->niceSize() ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php endif ?>