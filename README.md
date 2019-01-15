# CONFIGURAR AMBIENTE

```bash
Baixe a pasta docker
docker-compose up -d
docker exec -it docker_app_1 /bin/bash
cd /var/www/html
git clone https://github.com/gabriellavor/apiMotorista.git
cd apiMotorista
composer install
cp /var/www/html/apiMotorista/config/app.default.php /var/www/html/apiMotorista/config/app.php
exit
cat script.sql | docker exec -i docker_db_1 /usr/bin/mysql -u root --password=1234 truckpad

configure o seu host para
127.0.0.1 truckpad.localhost

para acessar truckpad.localhost:8080
```
# API de Motorista
##### API para listar motoristas cadastrados (GET)

/api/motoristas

##### API para alterar motoristas cadastrados (PUT)

/api/motorista

##### API para incluir motoristas cadastrados (POST)

/api/motorista
    
##### API para listar tipos de veiculos cadastrados (GET)    

/api/tipo-veiculos

##### API busca o tipo de veiculo por código cadastrados (GET)    

/api/tipo-veiculos/:id

##### API veículos carregados (GET)    
    
/api/caminhoes-carregados

##### API veículos próprios (GET)    

/api/veiculos-proprios

##### API origem e destino por tipo de veículo (GET)    

/api/origem-destino-por-tipo-veiculo

##### API origem e destino do motorista (GET)    

/api/origem-destino-por-motorista

##### API para listar veículos sem carga (GET)    

/api/motorista-sem-carga
