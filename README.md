Base plugin structure
==========
Структура для создания плагинов для PocketMine-MP v1.6

### Использованные ресурсы
1. [composer](https://getcomposer.org)
2. [box](https://packagist.org/packages/herrera-io/box)
3. [LessQL](http://lessql.net/)

### Установка
- Выполните
```bash
$ composer install
```
- Отредактируйте конфигурацию плагина в файлах `plugin.yml` и `src/PluginConfig.yml`
- Создайте папки своего плагина согласно настрокенного `namespace` и создайте папки `Command` и `Listener`. 

```
Например namespace = mops1k/firstPlugin
Структура папок тогда:
src
    mops1k
        firstPlugin
            Command
            Listener
```

Все создаваемые команды плагина должны помещаться в конечную папку `Command` и наследовать `\BasePlugin\Common\CustomCommand`

Все создаваемые слушатели плагина должны помещаться в конечную папку `Listener` и реализовать интерфейс `\pocketmine\event\Listener`

*Желаю Вам удачи в создании Ваших плагинов*