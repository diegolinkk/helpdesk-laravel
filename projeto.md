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


## Tarefas

### Backlog
- [ ] Criar cadastro de usuário
- [ ] Criar testes do sistema de login (após conseguir criar usuários e logar normalmente)

### Fazendo

### Feito
- [x] Criar form de autenticação
- [x] Implantar regra de login (somente usuários autenticados podema acessar)
- [x] Implantar bootstrap
