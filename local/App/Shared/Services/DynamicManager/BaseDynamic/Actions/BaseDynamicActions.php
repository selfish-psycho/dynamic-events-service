<?php

namespace App\Shared\Services\DynamicManager\BaseDynamic\Actions;

use App\Shared\Contracts\Dynamic\ActionsInterface;
use App\Shared\Contracts\Dynamic\RepositoryInterface;
use App\Shared\Services\DynamicManager\BaseDynamic\Controllers\BaseDynamicController;
use Bitrix\Crm\Item;
use Bitrix\Crm\Service\Operation;
use Bitrix\Crm\Service\Operation\Action;
use Bitrix\Crm\Service\Operation\Add;
use Bitrix\Crm\Service\Operation\Update;
use Bitrix\Main\ArgumentOutOfRangeException;
use Bitrix\Main\Result;

class BaseDynamicActions implements ActionsInterface
{
    public function __construct(RepositoryInterface $dynamicRepository)
    {
        BaseDynamicController::setRepository($dynamicRepository);
    }

    /**
     * Метод инициализирует метод события перед добавлением у смарт-процесса переданного в репозитории (в __construct())
     * @param Add $operation
     * @param Item $item Элемент создаваемого смарт-процесса
     * @return Add
     * @throws ArgumentOutOfRangeException
     */
    public function setOnBeforeAddAction(Add $operation, Item $item): Add
    {
        $operation->addAction(
            Operation::ACTION_BEFORE_SAVE,
            new class extends Action {
                public function process(Item $item): Result
                {
                    return BaseDynamicController::getRepository()::onBeforeAdd($item, (new Result()));
                }
            }
        );

        return $operation;
    }

    /**
     * Метод инициализирует метод события после добавления у смарт-процесса переданного в репозитории (в __construct())
     * @param Add $operation
     * @param Item $item Элемент создаваемого смарт-процесса
     * @return Add
     * @throws ArgumentOutOfRangeException
     */
    public function setOnAfterAddAction(Add $operation, Item $item): Add
    {
        $operation->addAction(
            Operation::ACTION_BEFORE_SAVE,
            new class extends Action {
                public function process(Item $item): Result
                {
                    return BaseDynamicController::getRepository()::onBeforeAdd($item, (new Result()));
                }
            }
        );

        return $operation;
    }

    /**
     * Метод инициализирует метод события перед обновлением у смарт-процесса переданного в репозитории (в __construct())
     * @param Update $operation
     * @param Item $item Элемент обновляемого смарт-процесса
     * @return Update
     * @throws ArgumentOutOfRangeException
     */
    public function setOnBeforeUpdateAction(Update $operation, Item $item): Update
    {
        $operation->addAction(
            Operation::ACTION_BEFORE_SAVE,
            new class extends Action {
                public function process(Item $item): Result
                {
                    return BaseDynamicController::getRepository()::onBeforeUpdate($item, (new Result()));
                }
            }
        );

        return $operation;
    }

    /**
     * Метод инициализирует метод события после добавления у смарт-процесса переданного в репозитории (в __construct())
     * @param Update $operation
     * @param Item $item Элемент обновляемого смарт-процесса
     * @return Update
     * @throws ArgumentOutOfRangeException
     */
    public function setOnAfterUpdateAction(Update $operation, Item $item): Update
    {
        $operation->addAction(
            Operation::ACTION_AFTER_SAVE,
            new class extends Action {
                public function process(Item $item): Result
                {
                    return BaseDynamicController::getRepository()::onAfterUpdate($item, (new Result()));
                }
            }
        );

        return $operation;
    }
}
