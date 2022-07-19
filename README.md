# Projeto Helpdesk Laravel

Projeto Helpdesk Feito em Laravel.

- Para conhecer mais sobre Laravel, clique [aqui](https://laravel.com/)
- Prints em breve =)
- Link para testar online em breve =)

## como executar o projeto ?

### Requisitos
É necessário ter instalado o PHP versão 8.1.7 ou superior

O php pode ser baixado [aqui](https://windows.php.net/download#php-8.1)

Além do PHP, é necessário ter instalado o Composer versão 2.2.3 ou superior

O composer pode ser baixado [aqui](https://getcomposer.org/download/)

### 1 - Renomear o arquivo de ambiente
powershell:

```powershell
rename-item .env.example .env
```
### 2 - Criar o arquivo de database
powershell:
```powershel
 New-Item -Path .\database\database.sqlite -ItemType File 
 ```

 ### 3 - Instalar dependências do composer
 powershell:
 ```powershell
 composer install
 ```

 ### 4 - Rodar os arquivos de migração
 powershell:
 ```powershell
 php artisan migrate
 ```

 ### 5 - Gerar uma chave de APP
 powershell:
 ```powershell
 php artisan key:generate
 ```

 ### 6 - Executar o projeto
 powershell:
 ```powershell
 php artisan serve
 ```

### 7 - Utilizar a ferramenta
Pronto, agora basta acessar: [localhost:8000](http://localhost:8000) e utilizar a ferramenta normalmente