# Решение тестового задания для "Рабочие руки"

## <a href="https://gist.github.com/an1creator/25e5428b6bb83e313541c18b0bb4c073#описание-страниц"> Текст задания</a>

## Развёртывание 
```bash
mkdir rabochie-ruki-test-task
cd rabochie-ruki-test-task
git clone https://github.com/Akulon-dev/rabochie-ruki-test-task.git
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve & php artisan queue:work
```

## Описание
Программа реализованно в соответствии с заданием.
В качестве БД для удобства сдачи выбрана SQLite
В качестве обработки очереди - БД и queue:work
