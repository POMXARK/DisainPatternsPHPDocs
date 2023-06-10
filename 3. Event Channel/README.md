Канал событий (англ. event channel) — фундаментальный шаблон проектирования, используется для создания канала связи и
**коммуникации** через него **посредством событий**. Этот канал обеспечивает возможность разным издателям **публиковать
события** и
подписчикам, подписываясь на них, **получать уведомления**.

Является расширением шаблона «издатель — подписчик», добавляя к нему функции, которые присущи распределённой среде. Так
канал является централизованным и **подписчик может получать опубликованные события от более, чем одного объекта**, даже
если он зарегистрирован только на одном канале.

Распределённая система — система, для которой отношения местоположений элементов играют существенную роль с точки зрения
функционирования системы, а следовательно, и с точки зрения анализа и синтеза системы.

Шаблон Канал событий использует сильно **типизированные события**; это означает, что **подписчик может ожидать**
поступления
**определенных типов данных** события, если регистрируется для определенного события. Он также **позволяет подписчику
отправлять события**, а не только получать события, посланные ему.

##### Достоинства

Шаблон Канал событий позволяет легко и быстро создать каналы для публикации и обработки событий (или сообщений), при
этом исключив прямого взаимодействия между издателем и подписчиком, что **снижает связность объектов и упрощает
тестирование**.

##### Недостатки

При реализации шаблона Канал событий **увеличивается сложность приложения**.

##### Подробности:
- **Не требует реализации отписки подписчика**
- Event связывает "издателя" и "подписчика" работая посредником
- "Издатель" выбирает уникальное имя и привязывается к "событию"
- "Подписчик" заявляет "событию" об обновлении каких уникальных имен его оповещать
- "Издатель" и "подписчик" в своей реализации делегируют (Delegation pattern) исполнение "событию"