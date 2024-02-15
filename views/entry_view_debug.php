<? if (isset($config->debugging) && $config->debugging) : ?>
<details class="debug">
    <summary>🔍 Entry Inspector</summary>
<?



function print_array_html(array $data) {
    foreach($data as $key=>$content) {
        if (is_array($content)) {
            echo("<details><summary><strong>{$key}</strong><br/></summary>");
            print_array_html($content);
            echo("</details>");
        } else {
            echo("<details class=\"empty\"><summary><strong>{$key}</strong>: {$content}</summary></details>");
        }
    }
}

echo('<div class="print_array">');
print_array_html($entry);
echo('</div>');


?>
</details>
<? endif; ?>