generate:
	./sail.sh artisan ide-helper:generate

models:
	./sail.sh artisan ide-helper:models

meta:
	./sail.sh artisan ide-helper:meta

all: generate models meta

build:
	docker build --rm -t tearu/product-catalog:latest .

migrate:
	./sail.sh artisan migrate
