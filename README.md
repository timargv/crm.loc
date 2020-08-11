###### crm.loc

- PHP 7.2
- Mysql 

composer install

В файл .env (если его нет то скопируй из .env.example)
добавить данные базы данных

php artisan key:generate

 
#### В командной строке в папке проекта (cd crm.loc)
____
В командной строке в папке проекта (cd crm.loc) вводите команду
 
php artisan migrate && php artisan db:seed 

Эта команда сделает миграцию в базу данных и создать фейковых пользователей
____
###### User 1 = Директор
email: test@test.ru пароль: password

###### User 2 = Админ
email: test2@test.ru пароль: password


Если возникнут вопросы: tima.rgv@mail.ru
