<?php

namespace App\Domains\Dynamic\Events;

use App\Shared\Contracts\Dynamic\RepositoryInterface;
use Bitrix\Crm\Item;
use Bitrix\Main\Result;

/*****
 * Класс-репозиторий событий для элементов смарт-процесса "Посещения" для примера работы сервиса
 *****/
class VisitEvents implements RepositoryInterface
{
    /**
     * Событие добавления $item элемента смарт-процесса до внесения информации в БД
     *  Пример:
     *  <code>
     *  if ($item->getTitle() === "TEST") {
     *      $result->addError(new Error("Нельзя добавлять тестовое посещение"));
     *  }
     *  return $result;
     *  </code>
     * @param Item $item
     * @param Result $result
     * @return Result
     */
    public static function onBeforeAdd(Item $item, Result $result): Result
    {
        //your code here...
        return $result;
    }

    /**
     * Событие добавления $item элемента смарт-процесса после внесения информации в БД
     * @param Item $item
     * @param Result $result
     * @return Result
     */
    public static function onAfterAdd(Item $item, Result $result): Result
    {
        //your code here...
        return $result;
    }

    /**
     * Событие обновления $item элемента смарт-процесса до внесения информации в БД
     * @param Item $item
     * @param Result $result
     * @return Result
     */
    public static function onBeforeUpdate(Item $item, Result $result): Result
    {
        //your code here...
        return $result;
    }

    /**
     * Событие обновления $item элемента смарт-процесса после внесения информации в БД
     * @param Item $item
     * @param Result $result
     * @return Result
     */
    public static function onAfterUpdate(Item $item, Result $result): Result
    {
        //your code here...
        return $result;
    }
}
