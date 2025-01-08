<?php

namespace App\Shared\Services\DynamicManager\BaseDynamic\Fabric;

use App\Shared\Contracts\Dynamic\ActionsInterface;
use Bitrix\Crm\Item;
use Bitrix\Crm\Service\Context;
use Bitrix\Crm\Service\Factory\Dynamic;
use Bitrix\Crm\Service\Operation\Add;
use Bitrix\Crm\Service\Operation\Update;

class BaseDynamicFactoryFabric extends Dynamic
{
    /**
     * Класс операций над элементом Смарт-процесса с определёнными репозиторием методами
     * @var ActionsInterface
     */
    private ActionsInterface $actions;

    /**
     * @return ActionsInterface
     */
    public function getActions(): ActionsInterface
    {
        return $this->actions;
    }

    /**
     * @param ActionsInterface $actions
     * @return $this
     */
    public function setActions(ActionsInterface $actions): static
    {
        $this->actions = $actions;
        return $this;
    }

    /**
     * Метод добавляет события до и после сохранения данных в БД при создании элемента Смарт-процесса
     * @param Item $item
     * @param Context|null $context
     * @return Add
     */
    public function getAddOperation(Item $item, Context $context = null): Add
    {
        //Получаем стандартную операцию над элементами
        $operation = parent::getAddOperation($item, $context);

        //Прописываем события до и после сохранения по репозиториям
        $this->getActions()->setOnBeforeAddAction($operation, $item);
        $this->getActions()->setOnAfterAddAction($operation, $item);

        return $operation;
    }

    /**
     * Метод добавляет события до и после сохранения данных в БД при обновлении элемента Смарт-процесса
     * @param Item $item
     * @param Context|null $context
     * @return Update
     */
    public function getUpdateOperation(Item $item, Context $context = null): Update
    {
        //Получаем стандартную операцию над элементами
        $operation = parent::getUpdateOperation($item, $context);

        //Прописываем события до и после сохранения по репозиториям
        $this->getActions()->setOnBeforeUpdateAction($operation, $item);
        $this->getActions()->setOnAfterUpdateAction($operation, $item);

        return $operation;
    }
}
