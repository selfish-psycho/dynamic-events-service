<?php

namespace App\Shared\Services\DynamicManager\BaseDynamic\Fabric;

use App\Shared\Enums\DynamicManager\ServicesEnums;
use App\Shared\Services\DynamicManager\BaseDynamic\Controllers\BaseDynamicController;
use App\Shared\Services\DynamicManager\DynamicManagerService;
use Bitrix\Crm\Service\Container;
use Bitrix\Crm\Service\Factory;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\DI\ServiceLocator;
use Bitrix\Main\ObjectNotFoundException;
use Bitrix\Main\SystemException;
use Psr\Container\NotFoundExceptionInterface;

/*****
 * Класс переопределяет родной Container битрикса для подключения кастомных Действий
 *****/
class BaseDynamicContainerFabric extends Container
{
    /**
     * Переопределение получения фабрики для контейнера сервисов
     * @param int $entityTypeId
     * @return Factory|null
     * @throws ObjectNotFoundException
     * @throws ArgumentException
     * @throws NotFoundExceptionInterface
     */
    public function getFactory(int $entityTypeId): ?Factory //Без "?" CRM будет падать, т.к. метод отрабатывает в init
    {
        //Если существует кастомный репозиторий событий для собираемого смарт-процесса, возвращаем подменённую фабрику
        try {
            $repository = BaseDynamicController::initRepositoryByEntityTypeId($entityTypeId);
        } catch (ObjectNotFoundException|SystemException $e) {
            return parent::getFactory($entityTypeId);
        }

        //Собираем подсервис Actions для полученного репозитория
        $container = DynamicManagerService::create(ServicesEnums::BASE->value);
        $actions = $container->actions($repository);

        //Сгенерируем название сервиса
        $identifier = static::getIdentifierByClassName(static::$dynamicFactoriesClassName, [$entityTypeId]);

        //И проверим - вдруг уже есть объект класса?
        if (ServiceLocator::getInstance()->has($identifier)) {
            return ServiceLocator::getInstance()->get($identifier);
        }

        //Объекта нет. Получим "объект смарт-процесса"
        $type = $this->getTypeByEntityTypeId($entityTypeId);
        if (!$type) {
            //Не получилось, смарт-процесс удален
            return null;
        }

        //Создадим фабрику
        $factory = new BaseDynamicFactoryFabric($type);

        //Прокинем ей класс с переопределёнными методами
        $factory->setActions($actions);

        //Заставим CRM запомнить её
        ServiceLocator::getInstance()->addInstance(
            $identifier,
            $factory
        );
        //Вернем подмененную фабрику
        return $factory;
    }
}
