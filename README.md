# Trabalho-Proz-PHP

# Aplicação de Autenticação e Banco de Questões
Descrição
Esta aplicação web permite o registro, login, verificação de e-mail, recuperação de senha e exclusão de conta para usuários. Além disso, oferece um sistema de banco de questões, onde os usuários autenticados podem criar, editar, excluir e filtrar questões.

# Funcionalidades
Autenticação de Usuários:
Registro de usuários com verificação de e-mail.
Login com verificação de senha.
Recuperação de senha com envio de código por e-mail.
Exclusão de conta com confirmação de usuário.
Banco de Questões:
Criação, edição e exclusão de questões.
Filtragem de questões por assunto.
Segurança:
Hash de senhas com password_hash para segurança.
Autenticação em 2 etapas via código de verificação enviado por e-mail.
Verificação de força de senha no frontend.
Validação de dados e controle de sessão para evitar acesso não autorizado.
Tecnologias Utilizadas
Frontend:
HTML, CSS, JavaScript.
Backend:
PHP para lógica de servidor e gerenciamento de sessões.
MySQL para gerenciamento do banco de dados.
Bibliotecas:
PHPMailer para envio de e-mails.
PHP session_start() para controle de sessões.

# Fluxo de Funcionamento

Registro de Usuário:

O usuário preenche o formulário de registro com e-mail e senha.
Um código de verificação é enviado ao e-mail do usuário para validar a conta.
Login de Usuário:

O usuário insere seu e-mail e senha.
Se a senha estiver correta e a conta verificada, o login é concluído e o usuário é redirecionado para o painel de questões.

Redefinição de Senha:

O usuário pode solicitar a redefinição de senha, recebendo um código por e-mail.
Ao inserir o código corretamente, o usuário pode definir uma nova senha.
Banco de Questões:

Usuários autenticados podem criar novas questões, editar questões existentes ou excluir questões.
As questões podem ser filtradas por assunto.
Exclusão de Conta:

O usuário pode excluir sua conta, garantindo a conformidade com a LGPD (Lei Geral de Proteção de Dados).
Todos os dados associados à conta são removidos do banco de dados.
Rotas Importantes
/registro: Página de registro de novos usuários.
/login: Página de login de usuários existentes.
/esqueci-senha: Página para solicitar a redefinição de senha.
/banco-questoes: Página para visualizar e gerenciar o banco de questões.
/exclusao-usuario: Página para excluir a conta do usuário.

# Segurança

Hash de Senha: As senhas dos usuários são armazenadas de forma segura utilizando a função password_hash() do PHP.
Autenticação em 2 Etapas: Após o login, um código de verificação é enviado para o e-mail do usuário.
Sessões Seguras: As sessões são gerenciadas com session_start() e os dados são protegidos.
PHPMailer: O envio de e-mails (como verificação e redefinição de senha) é feito com a biblioteca PHPMailer.
Como Usar

# Instalação:

Faça o download do projeto ou clone este repositório.
Configure o banco de dados MySQL conforme o script fornecido.
Altere as configurações de conexão no arquivo conexao.php para refletir seu ambiente de banco de dados.
Executar o Projeto:

Hospede os arquivos PHP em um servidor web com suporte a PHP e MySQL.
Acesse a aplicação através de um navegador web.
Pontuação dos Tópicos
Esta aplicação foi projetada para atender a diversos requisitos de pontuação, conforme segue:

Deleção em Cascata: Implementado nas tabelas codigos_verificacao e codigos_redefinicao.
Hash de Senha: Implementado com password_hash() e password_verify().
Sessões: Uso de session_start() para controle de sessões.
Cookies: Possibilidade de lembrar usuário com cookies.
Funções: Uso de funções PHP e JavaScript para validações e envio de e-mails.
Include/Require: Reutilização de código com include e require.
Conexão MySQLi: Conexão com o banco de dados utilizando mysqli_connect().
Try...catch: Captura de erros com try...catch para envio de e-mails.
Estruturas de Controle: Uso de if, elseif, else, e while no controle de fluxos.
CRUD Completo: Implementação de CRUD para usuários e questões.
Autenticação em 2 Etapas: Envio de código de verificação via e-mail após login.
