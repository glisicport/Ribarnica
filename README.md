# Ribarnica - Pokretanje i gašenje projekta

Ovaj vodič prikazuje osnovne komande za pokretanje i zaustavljanje Docker kontejnera Laravel projekta Ribarnica koristeći Makefile.  
Sve se radi jednostavno, bez potrebe za lokalnim PHP-om ili Composer-om.

```bash
# Build i start Docker kontejnera
make up

# Provera statusa kontejnera
make ps

# Prikaz logova
make logs

# Zaustavljanje svih kontejnera
make down

