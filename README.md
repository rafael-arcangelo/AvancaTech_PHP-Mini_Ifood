# 🌍🍔 World Food (Mini iFood)

Projeto desenvolvido como trabalho prático para o curso AvançaTech – PHP com MySQL.

O Explora Food é uma plataforma simplificada de gestão de cardápios online. O sistema permite que proprietários de restaurantes se cadastrem para gerenciar seus produtos em uma área administrativa exclusiva, simulando as funcionalidades de back-office de grandes aplicativos de delivery.

---

## 🚀 Novidades da Versão 2.0

- Vitrine Dinâmica: Página inicial que lista automaticamente todos os restaurantes cadastrados.
- Cardápio Público: Visualização de pratos organizada por categorias (Entradas, Principais, Bebidas, etc.).
- Layout "Clássico": Interface de cardápio em lista, otimizada para leitura linear com suporte a descrições detalhadas.

---

## 🚀 Funcionalidades Implementadas

1 Área do Cliente (Pública)
 - Exploração: Navegação por todos os restaurantes da plataforma.
 - Cardápio Inteligente: Visualização de pratos com preços formatados e agrupamento automático por categoria.
 - Design Responsivo: Interface adaptada para dispositivos móveis e desktop.

2 Área do Administrador (Restrita)
 - Gestão de Perfil: Cadastro e edição de dados do restaurante (nome, logo, etc.).
 - Controle de Inventário: CRUD completo de produtos (refeições) com controle de disponibilidade.
 - Segurança: Autenticação via sessões PHP e proteção de dados entre diferentes usuários.

---

## 🛠️ Tecnologias Utilizadas

- Backend: PHP 8.x (Arquitetura Procedural)
- Banco de Dados: MySQL
- Frontend: HTML5, CSS3 e JavaScript (Vanilla)
- Servidor Local: XAMPP
- Versionamento: Git

---

## 📂 Estrutura do Projeto

- /admin: Telas de gerenciamento (Restritas)
- /config: Configurações de DB e Autenticação
- /css: Estilização (style.css)
- /database: Scripts SQL para criação do banco
- /public: Telas acessíveis ao visitante (Login, Index)

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

## 🛠️ Em Desenvolvimento (Roadmap)

- [ ] Filtros de busca por categoria na área administrativa.
- [ ] Refatoração para melhoria de performance SQL.

---

## 👤 Autor

Rafael Arcangelo – GitHub: https://github.com/rafael-arcangelo

---

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.
Projeto desenvolvido para fins estritamente acadêmicos e educacionais.
