# dynamic-events-service
Сервис событий для элементов смарт-процессов Bitrix24 на архитектуре DDD.

Сама система сервисов была создана по статьям:
<ul>
  <li><a href='https://habr.com/ru/articles/824946/'>Часть 1</a></li>
  <li><a href='https://habr.com/ru/articles/869428/'>Часть 2</a></li>
</ul>

В проекте присутствует репозиторий событий для смарт-процесса "Посещения", оставленный для примера работы сервиса. При копировании сервиса в собственный проект необходимо удалить сам репозиторий (\App\Domains\Dynamic\Events\VisitEvents) и его указание в Enum (\App\Domains\Dynamic\Enums\EntityTypeCodesEnum).
