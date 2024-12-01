install:
		composer install
gendiff:
		./bin/gendiff
validate:
		composer validate
lint:
		composer exec --verbose phpcs -- --standard=PSR12 src bin
test:
		composer exec --verbose phpunit tests

test-coverage:
		composer test:coverage

test-coverage-text:
		composer test:coverage-text

test-coverage-html:
		composer test:coverage-html

.PHONY: tests