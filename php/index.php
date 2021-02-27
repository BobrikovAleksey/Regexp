<?php

include_once './library/LinksDisabler.php';

$html = [
    '<p>' .
    '<a href="yandex.ru">Весна</a> 2020 года, по <a href="nevatrip.ru">мнению</a> многих экологов, стала ' .
    '<a href="student.nevatrip.ru">настоящей</a> «передышкой для ' .
    '<a href="https://yandex.ru/search/?text=yandex&amp;&amp;lr=2">природы</a>». Пандемия повлияла не только на нас, ' .
    '<a href="moskvatrip.ru/ekskursii-po-moskve-reke/obzornaya-ekskursiya-na-teplohode">обычных людей</a>, жителей Петербурга, Москвы и ' .
    '<a href="https://vk.com/feed">других</a> городов и стран мира, но и на ' .
    '<a href="http://yandex.ru/search/?text=yandex&amp;&amp;lr=2">окружающий</a> мир. ' .
    '<a href="https://prahatrip.cz/">Преобразились</a> улицы и <a href="https://prahatrip.cz/">проспекты</a>, леса и поля, ' .
    '<a href="https://prahatripo.cz/">реки</a> и озера. Так ' .
    '<a href="https://prahatrip.cz/">какой</a> же <a href="vk.com/feed">стала экология</a> в период ' .
    '<a href="vnevatrip.ru">карантина</a>?' .
    '</p>',
    '<p>' .
    'Изменения <a href="https://busguide.ru">затронули</a> многие уголки <a href="https://busguide.ru">планеты</a>, и в первую ' .
    '<a href="busguide.ru">очередь</a>, конечно же, Китай, где и зародился коронавирус. До эпидемии эта страна была одним из главных загрязнителей ' .
    '<a href="http://busguide.ru">воздуха</a>. Но вспышка <a href="http://www.busguide.ru">заболевания</a> остановила ' .
    '<a href="https://moskvatrip.ru//">работу</a> практически всех заводов и ' .
    '<a href="prahatrip.ru">предприятий</a>, а еще – рекордно снизила количество автомобилей на дорогах и, ' .
    '<a href="https://moskvatrip.ru/progulki-po-moskve-reke/teplohod-redisson-ot-parka-gorkogo">соответственно</a>, ' .
    'число выхлопных газов. Результатом стало снижение выбросов двуокиси азота в атмосферу аж на целых 25%. Это, кстати, не выдумки, а чистая правда, ' .
    '<a href="http://moskvatrip.ru/progulki-po-moskve-reke/teplohod-redisson-ot-parka-gorkogo">подтвержденная</a> снимками НАСА.' .
    '</p>',
];

$ignoreHosts = [
    'prahatrip.cz',
    'nevatrip.ru',
    'moskvatrip.ru',
    'busguide.ru',
];

$htmlDisabledLinks = [
    (new LinksDisabler($html[0], $ignoreHosts))->getHtml(),
    (new LinksDisabler($html[1], $ignoreHosts))->getHtml(),
];

?>

<h2>Оригинальный текст</h2>
<?= $html[0]; ?>
<?= $htmlDisabledLinks[0]; ?><br>

<h2>Текст с отключенными ссылками</h2>
<?= $html[0]; ?>
<?= $htmlDisabledLinks[0]; ?><br>

<h2>Первый абзац</h2>
<p><?= htmlentities($html[0]); ?></p>
<p><?= htmlentities($htmlDisabledLinks[0]); ?></p><br>

<h2>Второй абзац</h2>
<p><?= htmlentities($html[1]); ?></p>
<p><?= htmlentities($htmlDisabledLinks[1]); ?></p><br>
