📊 Descrição do Projeto – Sistema ERP Atlas

O presente projeto consiste no desenvolvimento de um sistema web de gestão empresarial (ERP), denominado Atlas ERP, com o objetivo de centralizar, organizar e facilitar o controle de dados operacionais de uma empresa. O sistema está sendo desenvolvido como projeto acadêmico, dividido em etapas progressivas que abrangem desde a construção da interface até a integração completa com banco de dados.

A aplicação utiliza tecnologias fundamentais do desenvolvimento web, sendo elas HTML, CSS, JavaScript, PHP e MySQL, com foco na construção de uma arquitetura organizada, escalável e próxima de sistemas utilizados no mercado profissional.

🏗️ Estrutura e Funcionalidades

O sistema é composto por módulos que representam áreas essenciais de um ERP:

Dashboard: painel principal com indicadores visuais, apresentando informações resumidas como quantidade de produtos, fornecedores e transações, além de movimentações recentes e alertas de estoque baixo. O objetivo é fornecer uma visão rápida e estratégica do sistema.
Gestão de Produtos: módulo responsável pela listagem e controle de produtos cadastrados, incluindo funcionalidades de edição e exclusão. Está prevista a implementação completa de operações CRUD (Create, Read, Update, Delete).
Clientes: área destinada ao gerenciamento de clientes, atualmente em versão inicial, com expansão futura para operações completas de cadastro e manutenção de dados.
Relatórios: módulo analítico que utiliza dados avançados do banco para gerar informações estratégicas, como:
Curva ABC
Produtos sem saída por período
Giro de estoque
Volume de movimentações
🧱 Banco de Dados

O sistema utiliza um banco de dados relacional MySQL denominado atlas, estruturado com diversas tabelas, incluindo:

produtos
categorias
fornecedores
transacoes
tipoMovimentacao
auditoria
periodoEstoque

Como diferencial técnico, o projeto implementa recursos avançados de banco de dados:

Triggers: responsáveis por garantir integridade dos dados, como bloqueio de estoque negativo, atualização automática de estoque e registro de auditoria.
Views: utilizadas para abstração e otimização de consultas, como:
estoque atual
histórico de movimentações
giro de estoque
curva ABC
produtos sem movimentação
Procedures: responsáveis pela geração de relatórios complexos diretamente no banco de dados.
🎨 Interface e Experiência do Usuário

A interface foi desenvolvida com foco em usabilidade e organização visual, apresentando:

Layout inspirado em sistemas ERP profissionais
Menu lateral fixo para navegação
Dashboard com cards informativos coloridos
Tabelas organizadas para visualização de dados
Design responsivo básico
Separação entre estrutura (HTML) e estilo (CSS)
🚀 Evolução do Projeto

O desenvolvimento está dividido em três etapas principais:

Frontend estático: construção da interface e organização visual do sistema.
Integração com backend: utilização de JavaScript (fetch API) e PHP para comunicação com o servidor e manipulação dinâmica dos dados.
Integração com banco de dados: conexão com MySQL, substituindo dados estáticos por dados reais e utilizando consultas avançadas (views e procedures).
🎯 Objetivo Final

O objetivo do projeto é desenvolver um sistema ERP funcional e didático, que demonstre:

Organização em camadas (frontend, backend e banco de dados)
Aplicação de boas práticas de desenvolvimento web
Integração completa entre interface e banco de dados
Utilização de recursos avançados em SQL
Interface moderna e intuitiva

O projeto busca não apenas atender aos requisitos acadêmicos, mas também servir como base prática para atuação profissional na área de desenvolvimento de sistemas.
