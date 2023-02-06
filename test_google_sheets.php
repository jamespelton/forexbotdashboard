<?php
$url = 'https://docs.google.com/spreadsheets/d/1kz_8QwluvXZcj5RGJJcQvLlOdKqbgLjzJRrZqJ5b9Y0/edit#gid=486434658';

$data = file_get_contents($url);

$rows = explode("\n", $data);

foreach ($rows as $row) {
    $cols = explode("\t", $row);
    echo $cols[0]." | ".$cols[1]."\n";
}
?>