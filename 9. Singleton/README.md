Одиночка (англ. Singleton) — порождающий шаблон проектирования, гарантирующий, что в однопоточном приложении будет
**единственный экземпляр** некоторого класса, и предоставляющий глобальную точку доступа к этому экземпляру.

У класса есть только один экземпляр, и он предоставляет к нему глобальную точку доступа. При попытке создания данного
объекта он создаётся только в том случае, если ещё не существует, в противном случае возвращается ссылка на уже
существующий экземпляр и **нового выделения памяти не происходит**. Существенно то, что можно пользоваться именно
экземпляром класса, так как при этом во многих случаях становится доступной более широкая функциональность. Например, к
описанным компонентам класса можно обращаться через интерфейс, если такая возможность поддерживается языком.

#### Плюсы:

- Наведение порядка в глобальном пространстве имён.
- Ускорение начального запуска программы, если есть множество одиночек, которые не нужны для запуска. Особенно удачно
  выходит, если создание всех «одиночек» даёт ощутимую задержку, а создание каждого отдельного — практически незаметно.
- Упрощение кода инициализации — система автоматически неявно отделит нужные компоненты от ненужных и проведёт
  топологическую сортировку.
- Одиночку можно в дальнейшем превратить в шаблон-стратегию или несколько таких объектов.

#### Минусы:
- сложность тестирования
- многопоточность

#### Применение:

- должен быть ровно один экземпляр некоторого класса, легко доступный всем клиентам;
- единственный экземпляр должен расширяться путём порождения подклассов, и клиентам нужно иметь возможность работать с
  расширенным экземпляром без модификации своего кода.

#### Для многопоточных приложений:
синхронизация метода getInstance() (многопоточное приложение java) может замедлить его выполне- ние в сто и более раз.
- Создавайте экземпляр заранее
- Воспользуйтесь «условной блокировкой», чтобы свести к минимуму использование синхронизации в getInstance()
- 