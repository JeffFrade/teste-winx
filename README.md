# Teste Winx
---

Para o desenvolvimento desse teste foi utilizado o framework `Laravel` em sua versão 11 e o projeto inteiro foi desenvolvido sobre o `Docker`.

### Executar o Projeto
---

Para executar o projeto, basta executar o comando `sh config.sh`, pois ele já tem todos os passos necessários para colocar a aplicação de pé, incluindo massa de dados para teste.

### Login Sistema
---

Para logar no sistema, as credenciais são `admin@mail.com` (E-mail) e `123` (Senha).

### Login na API
---

Para logar na `API` é preciso entrar na aba de `Perfil` ou editar o usuário para obter o `client_id` e o `client_secret`.
Feito isso, na raiz do projeto há um arquivo `Winx.postman_collection.json` que contém todos os endpoints que a `API` possui e como efetuar o login na mesma.

### Testes
---

Para executar a bateria de testes que vem com o coverage, basta executar `sh coverage.sh` e será gerado arquivos dentro de `coverage`, há um arquivo `index.html` dentro dessa pasta, basta o abrir em qualquer navegador e haverá o coverage do projeto.
