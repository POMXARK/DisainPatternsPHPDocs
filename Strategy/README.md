Стратегия — это поведенческий паттерн проектирования, который определяет семейство схожих алгоритмов и помещает каждый
из них в собственный класс, после чего алгоритмы можно взаимозаменять прямо во время исполнения программы

Паттерн Стратегия определяет семейство алгоритмов,
инкапсулирует каждый из них и обеспечивает их взаимозаменяемость.
Он позволяет модифицировать алгоритмы независимо от их использования на стороне клиента

#### Мотивы:

- Программа должна обеспечивать различные варианты алгоритма или поведения
- Нужно изменять поведение каждого экземпляра класса
- Необходимо изменять поведение объектов на стадии выполнения
- Введение интерфейса позволяет классам-клиентам ничего не знать о классах, реализующих этот интерфейс и инкапсулирующих
  в себе конкретные алгоритмы

#### Способ решения:

- Отделение процедуры выбора алгоритма от его реализации. Это позволяет сделать выбор на основании контекста.

#### Участники:

- Класс **Strategy** определяет, как будут использоваться различные алгоритмы.
- Конкретные классы **ConcreteStrategy** реализуют эти различные алгоритмы.
- Класс **Context** использует конкретные классы ConcreteStrategy посредством ссылки на конкретный тип абстрактного
  класса
  Strategy. Классы Strategy и Context взаимодействуют с целью реализации выбранного алгоритма (в некоторых случаях
  классу Strategy требуется посылать запросы классу Context). Класс Context пересылает классу Strategy запрос,
  поступивший от его класса-клиента.

#### Следствия:

- Шаблон Strategy определяет семейство алгоритмов.
- Это **позволяет отказаться от использования переключателей и/или условных операторов**.
- Вызов всех алгоритмов должен осуществляться стандартным образом (все они должны иметь одинаковый интерфейс).

#### Реализация:

Класс, который использует алгоритм (Context),
включает абстрактный класс (Strategy),
обладающий абстрактным методом,
определяющим способ вызова алгоритма.
Каждый производный класс реализует один требуемый вариант алгоритма.

Замечание: метод вызова алгоритма не должен быть абстрактным,
если требуется реализовать некоторое поведение, принимаемое по умолчанию

#### Полезные сведения:

- и стратегия, и декоратор могут применяться для изменения поведения конкретных классов.
- Достоинство стратегии в том, что интерфейс кастомизации не совпадает с публичным интерфейсом
  и может быть куда более удобным,
- а недостаток в том, что для использования стратегии необходимо изначально проектировать класс
  с возможностью регистрации стратегий.

задача - **выделить схожие алгоритмы**, решающие конкретную задачу.
Реализация алгоритмов выносится в отдельные классы и
предоставляется **возможность выбирать алгоритмы** во время выполнения программы

Шаблон дает возможность в процессе выполнения выбрать стратегию (алгоритм, инструмент, подход) решения задачи.

Стратегия - решает такую задачу. Он предлагает **выделить семейство похожих алгоритмов**, вынести их в отдельные классы.
Это
позволит без проблем **изменять** нужный **алгоритм**, расширять его, сводя к минимум конфликты разработки, зависимости
от
других классов и функционала. Вместо того, чтобы реализовывать алгоритм в едином классе, наш класс будет работать с
объектами классов-стратегиями через объект-контекста и в нужным момент делегировать работу нужному объекту. **Для смены
алгоритма достаточно в нужным момент подставить в контекст нужный объект-стратегию**.

Чтобы работа нашего класса была одинаковой для разного поведения, **у объектов-стратегии должен быть общий интерфейс**.
Используя такой интерфейс вы делаете независимым наш класс-контекста от классов-стратегий.

#### Когда когда применяется шаблон Strategy?

- есть множество похожих реализаций отличающихся незначительным поведением.
- можно вынести отличающее поведение в классы-стратегии, а повторяющий код свести к единому классу-контекста.
- алгоритм реализован в супер-классе с множественными условными операторами.
- Выделите блоки условных операторов в отдельные классы-стратегии,
- а управление вызовов нужных доверьте классу-контекста

Конкретные стратегии позволяют инкапсулировать алгоритмы в своих конкретных классах.
Используйте этот подход для снижения зависимостей от других классов.

В зависимости от ситуации вы можете менять стратегию выполнения задачи в процессе выполнения программы.
Например, в зависимости от скорости интернета использовать разные стратегии-поведения,
возвращающие разный набор данных для отображения страницы.

#### Источники:

- https://habr.com/ru/articles/552278/
- https://radioprog.ru/post/1504