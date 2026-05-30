# 💅 Sistema de Agendamento para Nail Designer

Sistema web para gerenciamento de agendamentos de uma designer de unhas, com flu
xo de solicitação e aprovação manual de horários.

Projeto desenvolvido com foco em estudo de arquitetura backend, regras de negóci
o e construção de portfólio.

---

## 🚀 Objetivo

Resolver problemas comuns de agenda como:

- conflitos de horários
- dificuldade em remarcar clientes
- controle manual de agendamentos
- organização dos serviços do dia
- gestão de disponibilidade

O sistema permite que clientes solicitem horários e que a profissional aprove ou recuse agendamentos por um painel administrativo.

---

# ✨ Funcionalidades (MVP)

## 👤 Área do Cliente
- Cadastro de usuários
- Login
- Visualização de serviços
- Solicitação de agendamento
- Consulta de agendamentos
- Cancelamento com 48 horas de antecedência

---

## 🛠 Área Administrativa
- Login administrativo
- Cadastro e gerenciamento de serviços
- Painel de pedidos pendentes
- Aprovar agendamentos
- Recusar solicitações
- Reagendar clientes
- Gestão de horários disponíveis
- Bloqueio manual de horários

---

# 🔄 Fluxo do Sistema

```text
Cliente escolhe serviço
↓
Sistema mostra horários disponíveis
↓
Cliente solicita agendamento
↓
Status: PENDENTE
↓
Administrador avalia
├─ Aprova
└─ Recusa
↓
Se aprovado:
Status → APROVADO
Horário → Ocupado
```

---

# 📌 Regras de Negócio

## Status dos Agendamentos

- Disponível
- Pendente
- Aprovado
- Cancelado
- Concluído
- Bloqueado

---

## Cancelamento
Permitido apenas com:

- mínimo de 48 horas de antecedência

---

## Aprovação Manual
Todo agendamento feito pelo cliente:

- entra como pendente
- precisa ser aprovado pela profissional

Objetivo:

- organização da agenda
- preparo dos serviços do dia
- evitar sobrecarga

---

## Conflito de Horários

Regra para impedir sobreposição:

```sql
(data_inicio < fim AND data_fim > inicio)
```

---

# 🧱 Arquitetura

Projeto estruturado em MVC simplificado.

```text
app/
├── controllers
├── models
└── core

views/
public/
config/
routes.php
```

---

# 🛠 Stack

- PHP (POO)
- MySQL
- HTML
- CSS
- XAMPP
- MVC simplificado

Conceitos aplicados:

- Herança
- Polimorfismo
- PDO
- Prepared Statements
- Separação de responsabilidades

---

# 🗄 Modelagem Inicial

## usuarios
```sql
id
nome
email
senha
tipo
created_at
```

---

## servicos
```sql
id
nome
duracao
preco
ativo
```

---

## agendamentos
```sql
id
usuario_id
servico_id
data
hora_inicio
hora_fim
status
observacoes
created_at
```

---

# 📋 Roadmap

## MVP
- [ ] Autenticação
- [ ] Cadastro de serviços
- [ ] Solicitação de agendamento
- [ ] Aprovação administrativa
- [ ] Cancelamento 48h
- [ ] Agenda por horários

---

## Versão 2
- [ ] Notificações WhatsApp
- [ ] Lembretes automáticos
- [ ] Dashboard
- [ ] Histórico de clientes

---

## Versão 3
- [ ] Multi profissionais
- [ ] Pagamentos
- [ ] SaaS

---

# ⚙️ Instalação

Clone o projeto:

```bash
git clone https://github.com/SEU-USUARIO/sistema-agendamento-php.git
```

Entre no diretório:

```bash
cd sistema-agendamento-php
```

Configure o banco de dados e importe:

```bash
sql/schema.sql
```

Rodar no XAMPP:

```bash
http://localhost/sistema-agendamento-php
```

---

# 📂 Estrutura do Projeto

```text
.
├── app/
├── config/
├── docs/
├── public/
├── sql/
├── views/
├── routes.php
└── README.md
```

---

# 📚 Aprendizados do Projeto

Este projeto foi pensado para praticar:

- Arquitetura MVC
- Regras de negócio reais
- Modelagem de banco
- PHP orientado a objetos
- Desenvolvimento incremental por MVP

---

## 🚧 Status

Projeto em desenvolvimento.

---

## Autor

Desenvolvido por Alan Victor.

