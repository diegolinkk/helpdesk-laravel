# Projeto Helpdesk em Laravel

Projeto de helpdesk feito em Laravel. 

## Models
- Usuário
    - id
    - nome
    - email
    - senha
    - equipe(fk Equipe)

- Equipe
    - nome
    - usuarios(fk N para 1 Usuario)

- Chamado
    - nome
    - descrição
    - tipo (fk TipoChamado)
    - categoria(fk Categoria)
    - atividades (fk N para 1 Atividade)
    - finalizado (bool)
    - data criação
    - data finalização(nullable)
    - finalizadoPorUsuario(fk Usuario)

- Atividade
    - nome
    - data
    - usuario (fk Usuario)
    - chamado (fk Chamado)

- TipoChamado
    - nome
    - chamados(fk N para 1 Chamado)

- Categoria
    - nome
    - chamados (fk N para 1 Chamado)

- Cliente
    - nome
    - descrição
    - equipe(fk Equipe)

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