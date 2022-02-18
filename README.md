# ENGINE

Controle de sessão e cookies do PHP

    composer require elegance/session


---
### Manipula variaveis de sessão

**session**
Manipula uma variavel de sessão

    session(string $name)

**session_check**
Verifica se uma variavel de sessão existe ou se tem um valor igual ao fornecido

    session_check(string $name)

**session_set**
Define um valor para uma variavel de sessão

    session_set(string $name, $value = null)

**session_get**
Retorna o valor de uma variavel de sessão

    session_get(string $name)

**session_remove**
Remove uma variavel de sessão

    session_remove(string $name)

---
### Manipula cookies do projeto

**cookie**
Manipula um cookie

    cookie(string $name)

**cookie_check**
Verifica se um cookie existe ou se tem um valor igual ao fornecido

    cookie_check(string $name)

**cookie_set**
Define um valor para um cookie

    cookie_set(string $name, $value = null)

**cookie_get**
Retorna o valor de um cookie

    cookie_get(string $name)

**cookie_remove**
Remove um cookie

    cookie_remove(string $name)

> Um cookie com o nome iniciado com **#** tem seu nome e valor codificados


