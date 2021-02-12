# Запуск через docker
```bash
git clone https://github.com/baryshev1983/process-leads.git
```

```bash
cd process-leads
```
```bash
docker-compose up
```
В ходе сборки запустится обработка лидов и выведет результат

### Запуск кода вручную
```bash
docker run -ti pthreads bash
```
```bash
php index.php
```
или
```bash
docker-compose run php index.php
```

