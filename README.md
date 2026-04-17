# 🌍🍔 World Foods (Mini iFood)

Projeto desenvolvido como trabalho prático para o curso AvançaTech – PHP com MySQL.

World Foods é uma plataforma fictícia simplificada de gestão de cardápios online, inspirada em aplicativos de delivery. O sistema permite que proprietários de restaurantes se cadastrem e gerenciem seus produtos em uma área administrativa exclusiva, simulando funcionalidades essenciais de back‑office utilizadas em plataformas reais do mercado.

---

## 🚀 Visão Geral do Projeto

A aplicação é dividida em duas grandes áreas:
    - Área Pública, onde visitantes podem explorar restaurantes e visualizar cardápios.
    - Área Administrativa, restrita a usuários autenticados, responsável pela gestão do restaurante e de seus produtos.

O sistema foi desenvolvido com foco em organização de código, separação de responsabilidades, segurança por sessão e consistência visual entre temas claro e escuro.

---

✅ Funcionalidades Implementadas

🌐 Área do Cliente (Pública)
- Vitrine Dinâmica
  Página inicial que lista automaticamente todos os restaurantes cadastrados.

- Cardápio Público
  Exibição de pratos organizados por categorias (Entradas, Principais, Bebidas, Sobremesas e Combos).

- Leitura Otimizada
  Layout em lista, com preços formatados e descrições detalhadas.

- Interface Responsiva
  Compatível com desktop e dispositivos móveis.


🔐 Área Administrativa (Restrita)
- Autenticação Segura
  Login via sessões PHP com proteção de rotas administrativas.

- Painel Administrativo
  Visualização de dados do restaurante, data atual e métricas do cardápio.

- Métricas do Cardápio
  Quantidade total de refeições cadastradas e número de refeições indisponíveis.

- Gestão de Perfil
  Edição de dados do restaurante (nome, e‑mail e imagem/logo).

- Controle de Cardápio
  CRUD completo de refeições com controle de disponibilidade.

- Isolamento de Dados
  Cada usuário visualiza e gerencia apenas os próprios registros.

- Tema Claro e Escuro
  Alternância de tema persistida em sessão e aplicada em todo o sistema.

---

## 🛠️ Tecnologias Utilizadas

- Backend: PHP 8.x (Arquitetura Procedural)
- Banco de Dados: MySQL
- Frontend: HTML5 e CSS3
- Servidor Local: XAMPP
- Versionamento: Git

---

## 📂 Estrutura do Projeto

- /admin: Área administrativa (protegida)
- /config: Configurações de banco de dados e autenticação
- /css: Estilos globais (tema claro/escuro)
- /database: Scripts SQL para criação do banco
- /public: Área pública (index, login, cardápio)

---

## 🔧 Como Executar Localmente

1 Clone o repositório:
 - Use o comando git clone seguido da URL do seu repositório.

2 Configure o Banco de Dados:
 - Importe o arquivo SQL localizado em /database no seu MySQL (Workbench ou phpMyAdmin).
 - Renomeie o arquivo config/db.example.php para config/db.php.
 - Ajuste as credenciais (host, usuário, senha) no novo db.php.

3 Inicie o Servidor:
 - Ative o Apache e o MySQL no XAMPP.
 - Certifique-se de que a pasta está dentro do diretório htdocs.
 - Acesse no navegador: http://localhost/seu-projeto/public/index.php.

---

## 👤 Autor

Rafael Arcangelo – GitHub: https://github.com/rafael-arcangelo

---

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.
Projeto desenvolvido para fins estritamente acadêmicos e educacionais.
