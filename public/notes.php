<?php

// !Заметки

// Пример корректного(полного) варианта использования кэша
// $item = $cache->getItem('markdown_' . md5($article['content']));

// if (!$item->isHit()) {
//     $item->set($parsedown->text($article['content']));
//     $cache->save($item);
// }