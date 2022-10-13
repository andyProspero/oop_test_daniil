<?php

// начнём с простого
class DebugLocal
{
    function pr($data)
    {
        echo '<pre>',print_r($data,1),'</pre>';
    }

    function vd($data)
    {
        echo '<pre>',var_dump($data,1),'</pre>';
    }

    // Здесь был объявлен некий класс для дебага, который упрощает вызов функций для наглядного вывода массива
    // прим.: vd($arResult['SOMENAME']);

}



// Интерфейс. Служит для декларативного объявления переменных, массивов и функций
// Всё что объявлено в интерфейсе, должно быть реализованно в классах
interface ForProduct
{
    function getProductNames();
}

// Класс может служить для расширения функционала другого класса, уже существующего,
// либо существовать самостоятельно там, где требуются новые объекты, функции и/или переменные с массивами
class Product
{
    // допустим этот класс ничего не наследует, а существует для объявления некоего объекта - Product
    // Мы задаём параметры и функции для чего-либо

    // предположим мы получаем массив элементов из БД
    function getArray()
    {
        $order = [];
        $select = [];
        $filter = [];
        $group = [];
        $limit = 1000;
        $offset = 0;
        $count_total = 1;
        $runtime = [];
        $data_doubling = false;
        $cache = [
            'ttl' => 3600, // Время жизни кеша
            'cache_joins' => true // Кешировать ли выборки с JOIN
        ];
    }

}

// Наследование ... []
class ResultProduct extends Product implements ForProduct
{
    // ... []
    function getProductNames()
    {
        $select = ['ID', 'NAME', 'IBLOCK_ID', 'PREVIEW_TEXT', 'PREVIEW_IMAGE'];
        $filter = ['IBLOCK_ID' => 4];

        \Bitrix\Main\Loader::includeModule('iblock');

        $dbItems = \Bitrix\Iblock\ElementTable::getList(
            [
                'order' => $order,
                'select' => $select,
                'filter' => $filter,
                'group' => $group,
                'limit' => $limit,
                'offset' => $offset,
                'count_total' => $count_total, // дает возможность получить кол-во элементов через метод getCount()
                'runtime' => $runtime,
                'data_doubling' => $data_doubling,
                'cache' => $cache
            ]
        );

        $this->arResult['AR_ITEMS'] = $dbItems;
    }
}

// $arResult['ITEMS'][] = ... []
