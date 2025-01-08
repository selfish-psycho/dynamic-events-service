<?php

namespace App\Shared\Services\DynamicManager\BaseDynamic\Controllers;

use App\Domains\Dynamic\Enums\EntityTypeCodesEnum;
use App\Shared\Contracts\Dynamic\ControllerInterface;
use App\Shared\Contracts\Dynamic\RepositoryInterface;
use Bitrix\Crm\Model\Dynamic\TypeTable;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectNotFoundException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;

class BaseDynamicController implements ControllerInterface
{
    private static RepositoryInterface $repository;

    public static function setRepository(RepositoryInterface $repository): void
    {
        self::$repository = $repository;
    }

    public static function getRepository(): RepositoryInterface
    {
        return self::$repository;
    }

    /**
     * Метод возвращает кастомный репозиторий Смарт-процесса по его Entity Type ID
     * @param int $entityTypeId
     * @return RepositoryInterface
     * @throws SystemException
     * @throws ObjectNotFoundException
     */
    public static function initRepositoryByEntityTypeId(int $entityTypeId): RepositoryInterface
    {
        //Получаем репозиторий смарт-процесса по его Entity Type ID
        try {
            $dynamicCode = static::getDynamicCodeById($entityTypeId);
            if ($class = EntityTypeCodesEnum::tryFromName($dynamicCode)->value) {
                return new $class();
            }
        } catch (ArgumentException|ObjectPropertyException|SystemException $e) {
            throw new SystemException('Не удалось получить код смарт-процесса по Entity Type ID: ' . $e->getMessage());
        }

        throw new SystemException("Не найден кастомный репозиторий для смарт-процесса с Entity Type ID $entityTypeId");
    }

    /**
     * Метод получает код смарт-процесса по его type ID
     * @param int $entityTypeId
     * @return string
     * @throws ObjectNotFoundException
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    private static function getDynamicCodeById(int $entityTypeId): string
    {
        return
            TypeTable::getList([
                'select' => ['CODE'],
                'filter' => ['ENTITY_TYPE_ID' => $entityTypeId]
            ])->fetchRaw()['CODE'] ?:
                throw new ObjectNotFoundException("Не найден код для смарт-процесса с ID $entityTypeId");
    }
}
