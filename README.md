Sistema de Arranchamento

📌 Sobre o Projeto

O Sistema de Arranchamento é uma aplicação web desenvolvida em PHP para gerenciar e organizar o arranchamento de militares em uma unidade. Ele permite que os usuários façam requisições de refeições, administrem listas de presença e gerem relatórios para controle de consumo, otimizando a gestão e evitando desperdícios.

🔥 Funcionalidades Principais

✅ Cadastro e autenticação de usuários (admin, militar, cozinheiro, etc.)
✅ Solicitação e cancelamento de refeições
✅ Controle de efetivo presente por dia e horário
✅ Geração de relatórios detalhados (estatísticas, consumo, previsões)
✅ Painel administrativo para configuração e gestão de usuários e refeições
✅ Exportação de dados em formatos CSV/PDF
✅ Responsividade para acesso via dispositivos móveis

🛠 Tecnologias Utilizadas

Linguagem: PHP (Laravel ou CodeIgniter)

Frontend: HTML, CSS, JavaScript (Bootstrap)

Banco de Dados: MySQL ou PostgreSQL

Servidor: Apache ou Nginx

Gerenciamento de dependências: Composer

🚀 Como Instalar

Clone este repositório:

git clone https://github.com/marlondlx/arranchamento.git

Acesse o diretório do projeto:

cd arranchamento

Instale as dependências (caso utilize Laravel):

composer install

Configure o arquivo .env com as credenciais do banco de dados:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=arranchamento
DB_USERNAME=root
DB_PASSWORD=seu_password

Execute as migrações para criar as tabelas no banco de dados:

php artisan migrate

Gere a chave da aplicação (caso Laravel):

php artisan key:generate

Inicie o servidor local:

php artisan serve

Acesse a aplicação no navegador:

http://localhost:8000

👨‍💻 Como Contribuir

Faça um fork do repositório.

Crie uma branch para sua feature/correção:

git checkout -b minha-feature

Faça commit das suas alterações:

git commit -m "Adiciona nova funcionalidade X"

Faça push para a branch:

git push origin minha-feature

Abra um Pull Request para análise.
