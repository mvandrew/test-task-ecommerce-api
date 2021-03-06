# Документация API микросервиса каталога товаров

Документация API тестового задания по созданию минимального API для Интернет-магазина в формате OpenAPI.

Проект поддерживает средства сборки для размещения собранной версии документации на собственном хостинге.

## Сборка проекта

Сборка проекта выполняется в подкаталог `dist` текущего проекта.

Запуск процедуры сборки:

```shell
$ yarn install && yarn build
```

Если `node_modules` предварительно уже установлены, то для сборки достаточно выполнить:

```shell
$ yarn build
```

Полученная сборка в подкаталоге `dist` полностью независима и может быть размещена на хостинге без необходимости установки каких-либо дополнительных пакетов.

## Запуск локального dev сервера

Локальный dev сервер нужен для разработки документации и отслеживания корректности изменений.

Не рекомендуется использовать dev сервер в production режиме.

Запуск сервера:

```shell
$ yarn install && yarn start
```

Если `node_modules` предварительно уже установлены, то для запуска dev сервера достаточно выполнить:

```shell
$ yarn start
```

По-умолчанию сервер будет запущен на порту `19888`.
