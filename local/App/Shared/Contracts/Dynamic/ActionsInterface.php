<?php

namespace App\Shared\Contracts\Dynamic;

use Bitrix\Crm\Item;
use Bitrix\Crm\Service\Operation\Add;
use Bitrix\Crm\Service\Operation\Update;

interface ActionsInterface
{
    public function setOnBeforeAddAction(Add $operation, Item $item): Add;

    public function setOnAfterAddAction(Add $operation, Item $item): Add;

    public function setOnBeforeUpdateAction(Update $operation, Item $item): Update;

    public function setOnAfterUpdateAction(Update $operation, Item $item): Update;
}
