# sistema-presenca-palestras

CRUD de palestras feito em Laravel, na arquitetura MVC. É a primeira etapa do projeto "Sistema de Presença em Palestras e Certificados", da disciplina de Programação Web (ADS, Fatec Presidente Prudente).

## O que o sistema faz

- Cadastra palestras (título, palestrante, data e hora, local e descrição)
- Lista as palestras, da mais recente para a mais antiga
- Edita e exclui palestras
- Valida os dados do formulário e mostra os erros nos campos

Tudo acontece em uma tela só: o formulário fica em cima e a lista embaixo.

## Tecnologias

PHP, Laravel, MySQL e Blade.

## Estrutura (MVC)

```
├── database/     migration da tabela palestras
├── controller/   PalestraController.php e web.php (rotas)
├── view/         palestras.blade.php
└── model/        Palestra.php
```

- **Model:** representa a tabela `palestras` e acessa o banco com o Eloquent.
- **View:** mostra o formulário e a lista de palestras.
- **Controller:** recebe a requisição, valida os dados, usa o Model e devolve a View.

## Como rodar

Você vai precisar de PHP 8.2 ou mais novo, Composer e MySQL.

1. Crie um projeto Laravel novo:

```bash
composer create-project laravel/laravel sistema-presenca-palestras
cd sistema-presenca-palestras
```

2. Copie os arquivos deste repositório para o projeto:

| Daqui | Para |
|---|---|
| `database/*.php` | `database/migrations/` |
| `controller/PalestraController.php` | `app/Http/Controllers/` |
| `controller/web.php` | `routes/web.php` (substitui o existente) |
| `view/palestras.blade.php` | `resources/views/` |
| `model/Palestra.php` | `app/Models/` |

3. Configure o banco no arquivo `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fatec_presencas
DB_USERNAME=root
DB_PASSWORD=
```

4. Crie o banco `fatec_presencas` no MySQL e rode:

```bash
php artisan migrate
php artisan serve
```

Abra http://127.0.0.1:8000 no navegador.

## Problemas comuns

- **Erro de driver do MySQL:** confirme que a extensão `pdo_mysql` do PHP está habilitada.
- **Conexão recusada:** veja se o MySQL está ligado e se o `.env` está certo.
- **MassAssignmentException:** o campo precisa estar no `$fillable` do Model.
