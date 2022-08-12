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
    - team_id(fk Team)
    - activities (fk N para 1 Activity)
    - finished (bool)
    - created_date
    - finished_date(nullable)
    - finished_by_user_id(fk User)
    - user(fk User)

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

### Fazendo

### Feito
[x] - criar menu de gerenciar equipes para admin (rota e controller ja criados)
    [x] - adicionar usuário
    [x] - remover usuário
    [x] - editar usuário (não é possível trocar equipe - nem trocar a sneha)
    [x] - trocar senha usuário
    [x] - Garantir que um admin de equipe consiga atualizar SOMENTE USUÁRIOS DA PRÓPRIA EQUIPE - TESTAR
[x] - assegurar que um admin NÃO consiga administrar outras equipes - a rota não aceita parâmetros mas sim pega os dados do usuário logado
[x] - assegurar que um usuário não admin NÃO consiga administrar equipe
[x] - criar campo de cadastro para equipe no ato de cadastrar usuário

### Testes
[x] - fazer bateria de testes para a feature 2
    [x] - teste adicionar usuário
    [x] - teste remover usuário
    [x] - teste editar usuário (não é possível trocar equipe - nem trocar a senha)
    [x] - teste trocar senha usuário
    [x] - teste Garantir que um admin de equipe consiga atualizar SOMENTE USUÁRIOS DA PRÓPRIA EQUIPE - TESTAR

---

## Feature 3 - Chamados
### Contexto
O usuário (tanto admin como não admin) poderá criar chamados de acordo com os campos definidos na tabela. Dentro desse formulário, ao lado do campo de categoria e tipo de chamado, existirá um link para criação da chave estrangeira. 
Quando o usuário abrir o chamado, o usuário vinculado será o mesmo, mas é possível fazer a alteração do chamado (listando todos os usuários da equipe).
Cada chamado é vinculado diretamente à uma equipe, onde todos os usuários da mesma equipe podem ver esses chamados mas não podem ver os chamados de outras equipes (nem mesmo se tentar forçar via rota).
Os chamados abertos devem aparecer primeiro, seguidos dos chamados fechados.
Os comandos de fechar/abrir chamado devem ser feitos diretamente e não alterando seu status, pois 
Por enquanto os chamados não terão atividades vinculadas.

### Backlog
[x] - Criar banco de dados e modelos de tipo de chamado
[x] - Criar banco de dados e modelos de categoria de chamado
[x] - Criar banco de dados e modelos de chamados
    [x] - Vincular com tipo de chamado
    [x] - Vincular com tipo de categoria
    [x] - Vincular com tipo de equipe
    [x] - Vincular com finalizado por usuário
[ ] - Criar validação de formulário para o cadastro de chamado 
[ ] - Criar validação de formulário para o cadastro de categoria 
[ ] - Criar validação de formulário para o cadastro de tipo de chamado 
[ ] - Criar bateria de testes

### Fazendo

### Feito
[x] - Criar função de fechar de chamados
[x] - Criar função de exibir detalhes do chamados
[x] - Criar função de atualizar chamados
[x] - Vincular técnico ao chamado
[x] - Lista de chamados (não precisa ter visual refinado)
[x] - Criar formulário de criação de categoria
[x] - Criar formulário de criação de tipo de chamado
[x] - Criar formulário de criação de chamados

### Testes


---
Feature 4 - Roleta Russa
### Contexto
Para que os tickets não fiquem ociosos e não sejam atribuídos à um técnico. O ticket agora será atribuído ao técnico que esteja há mais tempo em ociosidade. Por exemplo:

Ticket 1:
- Maria (pega chamado)
- João
- Mané

Ticket 2:
- Maria 
- João (pega chamado)
- Mané

Ticket 3:
- Maria 
- João
- Mané (pega chamado)

Ticket 4:
- Maria (pega chamado novamente pq ja rodou a fila de todos os técnicos)
- João
- Mané 

### Backlog
### Fazendo
### Feito
### Testes