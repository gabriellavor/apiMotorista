# API

```bash
docker-compose up -d
docker exec -it teste_app_1 /bin/bash
cd /var/www/html/apiMotorista
git clone
composer install
exit
cat script.sql | docker exec -i teste_db_1 /usr/bin/mysql -u root --password=1234 truckpad
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
