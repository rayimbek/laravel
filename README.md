
## Laravel setup with Docker

### Setup
Clone the repository
Change the values of the .env file to the ones you want

Commands:

docker compose up --build --detach
docker-compose exec app php artisan migrate

Чтобы остановить контейнеры, выполните команду:
docker-compose down

Чтобы поднять: 
docker-compose up -d


Откройте браузер и перейдите по адресу:
http://localhost:8080


## API Documentation
Base url:
http://localhost:8080/api

Эндпоинты
1. Регистрация пользователя
   Метод: POST
   URL: /register
   Описание: Регистрирует нового пользователя. Требует имя, email и пароль.
   Ответ: Сообщение об успешной регистрации.

3. Вход пользователя
   Метод: POST
   URL: /login
   Описание: Аутентифицирует пользователя и возвращает токен для доступа к защищённым эндпоинтам.
   Ответ: Токен аутентификации и данные пользователя.

5. Выход пользователя
   Метод: POST
   URL: /logout
   Описание: Завершает сеанс пользователя и удаляет текущий токен.
   Ответ: Сообщение об успешном выходе.

7. Получение данных текущего пользователя
   Метод: GET
   URL: /me
   Описание: Возвращает данные текущего аутентифицированного пользователя.
   Ответ: Данные пользователя (ID, имя, email, дата создания и обновления).

Примеры использования
Регистрация: Отправьте имя, email и пароль на /register.
Вход: Отправьте email и пароль на /login, чтобы получить токен.
Получение данных: Используйте токен в заголовке Authorization для доступа к /me.
Выход: Используйте токен в заголовке Authorization для выхода через /logout.


- **https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**
