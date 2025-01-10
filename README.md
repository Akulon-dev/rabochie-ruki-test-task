# Решение тестового задания для "Рабочие руки"

## <a href="https://gist.github.com/an1creator/25e5428b6bb83e313541c18b0bb4c073#описание-страниц"> Текст задания</a>

## Развёртывание 
```bash
git clone https://github.com/Akulon-dev/rabochie-ruki-test-task.git
cd rabochie-ruki-test-task
cp .env.example .env
composer install
php artisan key:generate
composer update
php artisan migrate
php artisan db:seed
php artisan serve & php artisan queue:work
```

## Описание
Программа реализованно в соответствии с заданием.
В качестве БД для удобства сдачи выбрана SQLite
В качестве обработки очереди - БД и queue:work
