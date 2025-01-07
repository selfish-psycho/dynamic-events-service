<?php

use Bitrix\Main\Application;
use Bitrix\Main\DI\ServiceLocator;
use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;

require(Application::getDocumentRoot() . "/bitrix/vendor/autoload.php");

/*****
 * Подключение кастомных классов.
 *****/
try {
    Loader::registerNamespace(
        "App",
        Loader::getDocumentRoot() . "/local/App"
    );
    Loader::includeModule('crm'); //Можно подключить в любом месте, которое посчитаете нужным
} catch (LoaderException $e) {
    //write error log
    throw new LoaderException($e->getMessage());
}

$eventManager = EventManager::getInstance();

/*****
 * Dynamic
 * Подменить контейнеры и фабрики смарт-процессов для подключения методов событий
 *****/
//Подменяем контейнер
ServiceLocator::getInstance()->addInstanceLazy('crm.service.container', [
    'className' => '\\App\\Shared\\Services\\DynamicManager\\BaseDynamic\\Fabric\\BaseDynamicContainerFabric',
]);
