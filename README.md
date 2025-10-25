# Ribarnica - Pokretanje i gašenje projekta

Ovaj vodič prikazuje osnovne komande za pokretanje i zaustavljanje Docker kontejnera Laravel projekta Ribarnica koristeći Makefile.  
Laravel aplikacija će biti dostupna na [http://localhost:8000](http://localhost:8000) dok su kontejneri pokrenuti.


```bash
# Build i start Docker kontejnera
make up

# Provera statusa kontejnera
make ps

# Prikaz logova
make logs

# Zaustavljanje svih kontejnera
make down

