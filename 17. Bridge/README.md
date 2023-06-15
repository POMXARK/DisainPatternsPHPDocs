Шаблон мост (англ. Bridge) — структурный шаблон проектирования, используемый в проектировании программного обеспечения
чтобы «разделять абстракцию и реализацию так, чтобы они могли изменяться независимо». Шаблон мост использует
инкапсуляцию, агрегирование и может использовать наследование для того, чтобы разделить ответственность между классами.

При частом изменении класса преимущества объектно-ориентированного подхода становятся очень полезными, позволяя делать
изменения в программе, обладая минимальными сведениями о реализации программы. Шаблон bridge является полезным там, где
часто меняется не только сам класс, но и то, что он делает.

Когда **абстракция и реализация разделены, они могут изменяться независимо**. Другими словами, при реализации через
шаблон
мост, изменение структуры интерфейса не мешает изменению структуры реализации. Рассмотрим такую абстракцию как фигура.
Существует множество типов фигур, каждая со своими свойствами и методами. Однако есть что-то, что объединяет все фигуры.
Например, каждая фигура должна уметь рисовать себя, масштабироваться и т. п. В то же время рисование графики может
отличаться в зависимости от типа ОС, или графической библиотеки. Фигуры должны иметь возможность рисовать себя в
различных графических средах, но реализовывать в каждой фигуре все способы рисования или модифицировать фигуру каждый
раз при изменении способа рисования непрактично. В этом случае помогает шаблон мост, позволяя создавать новые классы,
которые будут реализовывать рисование в различных графических средах. При использовании такого подхода очень легко можно
добавлять как новые фигуры, так и способы их рисования.

Связь, изображаемая стрелкой на диаграммах, может иметь 2 смысла: а) «разновидность», в соответствии с принципом
подстановки Лисков и б) одна из возможных реализаций абстракции. Обычно в языках используется наследование для
реализации как а), так и б), что приводит к разбуханию иерархий классов.

Мост служит именно для решения этой проблемы: объекты создаются парами из объекта класса иерархии А и иерархии B,
наследование внутри иерархии А имеет смысл «разновидность» по Лисков, а для понятия «реализация абстракции» используется
ссылка из объекта A в парный ему объект B.

Отделить абстракцию от реализации так, чтобы и то и другое можно было изменять независимо. При использовании
наследования реализация жестко привязывается к абстракции, что затрудняет независимую модификацию.

#### Реализация:

- на все реализации заводим общий интерфейс, который они (реализации) будут имплементировать.
- в интерфейсе абстракции храним ссылку на интерфейс реализации.
- интерфейс реализации содержит простейшие методы
- интерфейс абстракции методы более высокого уровня

Теперь мы можем совершенно независимо модифицировать абстракцию — путем уточнения интерфейса абстракции и реализацию —
путем имплементации интерфейса реализации.

#### Источники:
- https://habr.com/ru/articles/85137/