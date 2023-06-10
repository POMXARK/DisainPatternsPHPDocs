Контейнер свойств (англ. property container) — фундаментальный шаблон проектирования,
который **служит для обеспечения возможности динамического расширения свойств уже созданного объекта класса**.

Это достигается путем дополнительных свойств непосредственно самому объекту в некоторый "контейнер свойств", вместо
расширения класса новыми свойствами.

### Достоинства

Шаблон контейнер свойств **позволяет** легко и быстро **придать приложению способность изменяться в процессе** своего
жизненного
цикла и хорошо подходит для определённых типов приложений, в частности, **для реализации возможности иерархии вложения
**. В
некоторый случаях, **без применения данного шаблона не удастся** при возможности динамического расширения объекта
**инкапсулировать данные в объекте**, что влияет на безопасность и надежность приложения.

### Недостатки

При реализации контейнера свойств **теряется строгая типизация**. Интерфейс класса не полностью описывает содержание и,
возможно, потребуется модифицировать интерфейс взаимодействия с классом, чтобы реализовать преимущества, полученные от
добавленных атрибутов. Если используется **сохранение объектов в базу данных**, контейнер свойств требует написать
реализацию для передачи данных из контейнера свойств объекта в таблицу. Использование контейнера свойств увеличивает
сложность системы, вносит накладные расходы на **потребление памяти** приложением и частично **снижает быстродействие**
при
работе.

Классическим примером использованием шаблона является **приложение, используемое для хранения и классификации информации**.
Например, **приложение заказа фильмов**. При разработке класса, представляющего фильм, при разработке и запуске
приложения невозможно предусмотреть все возможные свойства (атрибуты), описывающие фильм. Поэтому класс фильма при
необходимости в любой момент может быть расширен дополнительными свойствами. Для этого требуются предусмотреть механизм
расширения свойств перед выпуском приложения.

Контейнер свойств, предоставляет механизм для динамического расширения объектов дополнительными атрибутами во время
выполнения. Кроме этого, приложению могут потребоваться ещё модули, которые явным образом используют преимущества нового
свойства, если оно было добавлено.

### Источники

- **https://logachev.pro/fundamentalnyy-shablon/property-container/**
- https://web.archive.org/web/20171102042840/http://best-practice-software-engineering.ifs.tuwien.ac.at/patterns/container.html
- https://web.archive.org/web/20171107022709/http://carfield.com.hk/document/software+design/pattern+201.pdf

## Пояснения:
- В laravel реализован у всех Model, контейнеры "attributes", "original" с методами "getAttribute", "setAttribute", но еще и с магией создания и обращения к отсутствующим свойствам через __set и __get.
- Есть методы перехватчики, которые как раз и предназначены для работы с неопределёнными методами и свойствами. __set() __get() __unset().