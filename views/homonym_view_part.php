<?php

declare(strict_types=1);

namespace WorldlangDict;
?>

<h1><?= $config->getTrans('homonym terminator title'); ?></h1>
<p><?= $config->getTrans('homonym terminator description'); ?></p>

<?php if ($page->show_input): ?>
    <form class="tool" action="<?= WorldlangDictUtils::makeUri(config: $config, controller: 'tool', arg: 'samaeskri-lexi', request: $request); ?>" method="get" accept-charset="utf-8">
        <input type="text" name="candidate" placeholder="<?= $config->getTrans('homonym terminator new placeholder'); ?>" />
        <input type="submit" value="<?= $config->getTrans('homonym terminator new button'); ?>" />
    </form>
<?php endif;

if (empty($homonyms)) {
    $page->content .= $config->getTrans("none found");
}
?>
<ul>
<?php
$searchTerm = isset($request->options['word']) ? $request->options['word'] : "";

foreach ($homonyms as $word => $generated_words):

    if (sizeof($generated_words) > 1 && (!isset($request->options['candidate']) || isset($generated_words[$request->options['candidate']]))):
?>
    <li>
        <header><?= $word; ?></header>
        <section>
        <?php foreach ($generated_words as $data): ?>
            <span class="hl h2"><?
                if (isset($data['pre'])) {
                    print(WorldlangDictUtils::makeLink($config, $request, "lexi", $data['pre'], $data['pre']));
                    print(' + ');
                }
                print(" <strong>" . WorldlangDictUtils::MakeLink($config, $request, 'lexi', $data['root'], $data['root']) . "</strong> ");
                if (isset($data['suf'])) {
                    print(' + ');
                    print(WorldlangDictUtils::MakeLink($config, $request, 'lexi', $data['suf'], $data['suf']));
                }
                ?></span>,
        <?php endforeach; ?>
        </section>
    </li>
<?php
    endif;
endforeach;
?>
</ul>