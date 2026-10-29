# Первичная настройка проекта (запускать только один раз)
init:
	@test -f .env || cp .env.example .env
	docker compose up -d --build
	@grep -q '^APP_KEY=base64:' .env || docker compose exec app php artisan key:generate
	docker compose exec app php artisan migrate --seed --force

# Ежедневный запуск
up:
	docker compose up -d
	docker compose exec app php artisan migrate --force

down:
	docker compose down

logs:
	docker compose logs -f

# Зайти в bash самого проекта (где лежит код)
shell:
	docker compose exec app bash

test:
	docker compose exec app php artisan test --compact

# Заново пересоздает БД и прогоняет сиды (удаляет все данные!)
fresh_db:
	docker compose exec app php artisan migrate:fresh --seed