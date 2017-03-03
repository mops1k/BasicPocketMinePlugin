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

### Сборка плагина в phar
Для сборки плагина:
1. Добавьте все созданные Вами директории в box.json
2. выполните команду
```
$ vendor/bin/box.bat build
```
Как команда будет выполнена, в корневой папке появится ваш plugin.phar

*Желаю Вам удачи в создании Ваших плагинов*