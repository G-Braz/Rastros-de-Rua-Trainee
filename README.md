# **Trainee 2025.1**

# **Nome do seu blog**

## **Projeto Trainee, Code Jr, 2025.1**

| **Sumário** |
|-------------|
| [Desenvolvedores](#Desenvolvedores) |
| [Como executar o projeto inicial](#Descrição-do-Projeto) |
| [Git](#Git-tutorial) |
| [Informações do php](#Comandos-necessários-para-o-projeto-em-PHP) |

#### Desenvolvedores:

* Caio Ribeiro (coloque o link do github)
* Luiza Caldeira (https://github.com/luizacaldeira)
* Amanda Alvaro (coloque o link do github)
* Mickaell de Oliveira (coloque o link do github)


#### Scrum Master:

* Guilherme Braz (https://github.com/G-Braz).

#### Links Úteis:

* [Trello](https://trello.com/invite/b/67dbaac038e6f629a38db0dc/ATTI5ad5f40e871fe962f51e2fa4f07cb08dF3803E33/251-trello-do-scrum-rastros-de-rua)



## Descrição do Projeto:

* Blog / Sistema de treinamento e capacitação dos Trainees da [CodeJR](https://codejr.com.br/), na gestão 2025.1;
* Possuirá Front-End em HTML, CSS, JavaScript, Bootstrap e Back-End em PHP (puro), com Banco de Dados MySQL;





## Git Tutorial

### Instalação

Pra instalar, basta acessar a página de [downloads](https://git-scm.com/downloads) e seguir as instruções\
Pra se conectar, utilize os seguinte comandos: <sub>(Substitua o nome e o e-mail para o seu)<sub/>
```
git config --global user.name "nomeDeUsuario"
```
```
git config --global user.email email@codejr.com.br
```



### Primeira Configuração

* Pelo terminal entre na pasta onde irá guardar o projeto: cd /caminho/para/a/pasta, depois inicialize o git na pasta com o comando: `git init`

* Outro jeito de fazer o citado acima: clique com o botão direito na pasta e selecione "Git Bash Here" para abrir o terminal do git

* Crie um clone do repositório: `git clone https://github.com/link-do-repositorio`

* Entre na pasta criada pelo comando clone: cd /caminho/para/a/pasta/nova

* Crie sua branch usando como o padrão o nome da feature que você está a desenvolver: `git checkout -b nome_da_feature`

* Após criada a branch você será redirecionado automaticamente a ela, neste espaço que você desenvolverá sua parte do projteto




### Rotina

* Adicione as alterações feitas: `git add .`

* Cheque em qual branch você está e quais alterações foram adicionadas: `git status`

* Dê um commit com uma mensagem especificando as alterações realizadas: `git commit -m "mensagem especificando o que foi feito"`

* Envie o commit feito para sua branch: `git push origin suabranch`



### Quando estiver tudo prontinho *(com autorização do SCRUM Master)*

* Volte para a main: `git checkout main`

* Atualize a main: `git pull`

* Volte para a sua branch: `git checkout nomedabranch`

* Mescle a main com a sua branch : `git merge main`

* Corrija os possíveis conflitos

* Confirme o merge (apenas quando solicitado pelo Scrum Master): `git push origin suabranch`

* Espera a confirmação do seu SCRUM

* Volte para a main: `git checkout main`

* Mescle a main com as alterações enviadas para sua branch (apenas quando solicitado pelo Scrum Master): `git merge suabranch`

* Confirme o merge (apenas quando solicitado pelo Scrum Master): `git push origin main`



### Comandos Básicos

* Para atualizar a main: `git pull`

* Para atualizar alguma branch: `git pull origin branch`

* Ver informações da branch: `git status`

* Para trocar de branch: `git checkout branch_desejada`

* Adicionar todas as alterações feitas: `git add .`

* Adicionar alteração específica: `git add arquivo-especifico`

* Para mesclar sua branch com a main (estando dentro da sua branch): `git merge main`

* Para confirmar o merge: `git push origin suabranch`


## Comandos necessários para o projeto em PHP

### Como executar o projeto inicial
\* É necessário ter o _PHP 8.0+_
1. Abra o Terminal na Pasta do Projeto;

2. Instale as dependências necessárias: `composer install`;

3. Atualize as dependências: `composer update`;

4. Rode o comando composer `dump-autoload`;

5. Crie um banco de dados `sql` com o nome de `sua preferencia e coloque o nome dele dentro do arquivo start_application que está dentro do diretorio bootstrap`;
