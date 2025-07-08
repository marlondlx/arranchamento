# 🍽️ Sistema de Arranchamento

## 📌 Sobre o Projeto

O **Sistema de Arranchamento** é uma aplicação web desenvolvida em PHP para gerenciar e organizar o arranchamento de militares em uma unidade.  
Permite o controle eficiente de refeições, evitando desperdícios e otimizando o planejamento logístico da alimentação.

---

## 🔥 Funcionalidades Principais

✅ Cadastro e autenticação de usuários (admin, militar, cozinheiro etc.)  
✅ Solicitação e cancelamento de refeições  
✅ Controle de efetivo presente por dia e horário  
✅ Geração de relatórios detalhados (estatísticas, consumo, previsões)  
✅ Painel administrativo para configuração e gestão de refeições e usuários  
✅ Exportação de dados em CSV e PDF  
✅ Interface responsiva para dispositivos móveis

---

## 🛠 Tecnologias Utilizadas

- **Linguagem**: PHP (Laravel ou CodeIgniter)  
- **Frontend**: HTML, CSS, JavaScript (Bootstrap)  
- **Banco de Dados**: MySQL ou PostgreSQL  
- **Servidor**: Apache ou Nginx  
- **Gerenciamento de dependências**: Composer

---

## 🚀 Como Instalar

1. Clone este repositório:
   ```bash
   git clone https://github.com/marlondlx/arranchamento.git
   cd arranchamento
   
2. Instale as dependências (caso utilize Laravel):
   composer install

3. Configure o arquivo .env com os dados do banco:
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=arranchamento
   DB_USERNAME=root
   DB_PASSWORD=seu_password

4. Execute as migrações:
   php artisan migrate

5. Gere a chave da aplicação:
   php artisan key:generate

6. Inicie o servidor local:
   php artisan serve

7. Acesse a aplicação:
   http://localhost:8000

🪖 Ideal para
Quartéis e unidades militares

Escolas militares

Instituições com controle logístico de refeições

✨ Autor
Marlon Martins
Arquiteto de soluções e desenvolvedor fullstack focado em Cloud e Web
🔗 linkedin.com/in/marlon-henrique-martins
