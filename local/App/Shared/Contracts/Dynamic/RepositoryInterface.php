<?php

namespace App\Shared\Contracts\Dynamic;

use Bitrix\Crm\Item;
use Bitrix\Main\Result;

interface RepositoryInterface
{
    /**
     * Событие добавления $item элемента смарт-процесса до внесения информации в БД
     * @param Item $item
     * @param Result $result
     * @return Result
     */
    public static function onBeforeAdd(Item $item, Result $result): Result;

    /**
     * Событие добавления $item элемента смарт-процесса после внесения информации в БД
     * @param Item $item
     * @param Result $result
     * @return Result
     */
    public static function onAfterAdd(Item $item, Result $result): Result;

    /**
     * Событие обновления $item элемента смарт-процесса до внесения информации в БД
     * @param Item $item
     * @param Result $result
     * @return Result
     */
    public static function onBeforeUpdate(Item $item, Result $result): Result;

    /**
     * Событие обновления $item элемента смарт-процесса после внесения информации в БД
     * @param Item $item
     * @param Result $result
     * @return Result
     */
    public static function onAfterUpdate(Item $item, Result $result): Result;
}
