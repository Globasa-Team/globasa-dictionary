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


$candidate = isset($request->options['candidate']) ? $request->options['candidate'] : "";

foreach ($homonyms as $word => $generated_words):

    if (sizeof($generated_words) > 1 && isset($generated_words[$candidate])):
?>
    <li>
        <header><?= $word; ?></header>
        <section>
        <?php
        $first = true;
        foreach ($generated_words as $data):
            if ($first) $first = false;
            else print(', ');
            
            if (isset($data['pre'])) {
                if ($data['pre']!==$candidate) :
                    print(" <strong>" . WorldlangDictUtils::makeLink($config, $request, "lexi", $data['pre'], $data['pre']) . "</strong>");
                else :
                    print($candidate);
                endif;
                print(' + ');
            }
            if ($data['root']!==$candidate) :
                print(" <strong>" . WorldlangDictUtils::MakeLink($config, $request, 'lexi', $data['root'], $data['root']) . "</strong>");
            else:
                print($candidate);
            endif;
            if (isset($data['suf'])) {
                if ($data['suf']!==$candidate) :
                    print(' + ');
                    print(" <strong>" . WorldlangDictUtils::MakeLink($config, $request, 'lexi', $data['suf'], $data['suf']) . "</strong>");
                else:
                    print($candidate);
                endif;
            }
        endforeach;
        ?>
        </section>
    </li>
<?php
    endif;
endforeach;
?>
</ul>