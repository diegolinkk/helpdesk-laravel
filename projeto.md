# Projeto Helpdesk em Laravel

Projeto de helpdesk feito em Laravel. 

## Models
- User
    - id
    - name
    - email
    - password
    - team_id(fk Team)

- Team
    - id
    - name
    - users(fk N para 1 User)

- Ticket
    - name
    - description
    - type_id (fk TicketType)
    - category_id(fk Category)
    - activities (fk N para 1 Activity)
    - finished (bool)
    - created_date
    - finished_date(nullable)
    - finished_by_user_id(fk User)

- Activity
    - name
    - date
    - user_id (fk Usuario)
    - ticket_id (fk Ticket)

- TicketType
    - name
    - tickets(fk N para 1 Ticket)

- Category
    - name
    - tickets (fk N para 1 Ticket)

- Client
    - name
    - description
    - team_id(fk Team)

## Regras de negócio
- Usuário tem login
- Usuário faz parte de uma equipe
- Usuário pode criar chamados
    - Cada chamado tem categoria
    - Cada chamado tem cliente
    - Cada chamado tem tipo
    - Cada chamado tem data de criação e finalização
    - Cada chamado tem uma finalização por usuário
- Os chamados e clientes criados por um usuário da equipe podem ser manipulados por usuários da outra equipe
- Cada chamado tem atividades
    - E cada atividade tem um tipo
    - cada atividade tem data e hora
- Relatórios
    - Chamados por cliente
    - Chamados por usuário
    - Chamados por mês

## Observações
Seguir padrão REST para as rotas e controllers. Criar padrão repository para cada Model [link](https://www.twilio.com/blog/repository-pattern-in-laravel-application)
- lista de resources para padronização de rotas e controllers [link](https://laravel.com/docs/9.x/controllers#actions-handled-by-resource-controller)

# Sprints
## Feature 1 - funcionalidades básicas
### Contexto
### Backlog
### Fazendo
### Feito
[x] - criar campo is_admin na model de User (nullable)
- [x] Equipe - READ
- [x] Criar tabela de equipes (Teams)
- [x] Criar fk da equipe no usuário(User)
- [x] Criar testes do sistema de login (após conseguir criar usuários e logar normalmente)
- [x] Criar cadastro de usuário
- [x] Criar form de autenticação
- [x] Implantar regra de login (somente usuários autenticados podema acessar)
- [x] Implantar bootstrap
---

## Feature 2 - Usuários e equipes

### Contexto
- o usuário sem uma equipe (criado por fora) sempre vai ser um admin e ja vai receber o nome de uma equipe.
- já dentro do painel, o usuário vai ter opções de criar usuários para a equipe (opção - gerenciar equipes).
- cada usuário também tem um login e nome, não é admin por padrão e vai participar da mesma equipe do admin que criou.
- esse usuário não admin não tem acesso ao painel de gerenciamento (nem se tentar forçar na request)

### Backlog
[ ] - criar menu de gerenciar equipes para admin
[ ] - criar cadastro de usuários dentro do gerenciamento de equipes
[ ] - assegurar que um usuário não admin NÃO consiga administrar equipe
[ ] - assegurar que um admin NÃO consiga administrar outras equipes
[ ] - fazer bateria de testes para essas features acima

### Fazendo

### Feito
[x] - criar campo de cadastro para equipe no ato de cadastrar usuário