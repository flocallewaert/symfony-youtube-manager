# Symfony Youtube Manager
Florian CALLEWAERT repository

## Docker
I can't use Docker on my computer.
So, I code this project without docker.
I let docker-compose files from the lesson but __I haven't use or test it__.
Use it as your own risk.

## Video Entity
I choose to make the 'category' property a collection to use ManyToMany relation.


## Category Controller
I choose to make the 'title' property unique to use it as an identifier.
So, I use a ParamConverter on the 'title' method from the CategoryController class.