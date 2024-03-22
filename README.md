# API

Teste de API com registros em uma agenda telefonica. 

## Rotas

Os endpoints da API são os seguintes: 

* `/agenda` é rota que adiciona um registro novo via método HTTP POST.

* `/agenda/{id}` é rota que atualiza um registro via método HTTP PUT, atualiza o registro do id informado na URL.

* `/delete/{nome}` é rota que deleta um registro via método HTTP DELETE, deleta o registro do nome informado na URL.

* `/agenda/relatorio` é rota que lista os nomes (gerando um HTML) via método HTTP GET.

* `/` a rota inicial tem uma página HTML de apresentação.

## JSON

O formato do json que deve ser enviado na requisição para realizar o insert e update é o seguinte:

```json
{
    "name": "Programador da Silva",
    "email": "email@usuario.com",
    "birth": "1994-10-30",
    "cpf": "12345678912",
    "phone": "88889999"
}
```

Se os dados não passarem na validação, um aviso será lançado como retorno da requisição informando o erro.

### Configuraçao

Para rodar o projeto tem que criar o banco de dados (nomeado de `api_agenda`) e depois rodar a migration que cria a tabela. As informações de acesso ao banco de dados devem ser colocadas num arquivo `.env` (na pasta raiz do projeto) com o seguinte modelo:

```
APP_NAME=ApiAgenda
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost
APP_TIMEZONE=UTC

DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=api_agenda
DB_USERNAME=
DB_PASSWORD=
```

Esse que é modelo com as configurações do framework Lumen, que foi o framework usado por mim para realizar esse teste prático.