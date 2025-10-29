# Ribarnica - Instalacija i pokretanje

Vodič za rad sa Docker kontejnerima Laravel projekta Ribarnica pomoću Makefile komandi.

---

## Prvo pokretanje

Pre prvog pokretanja potrebno je izgraditi Docker image:
```bash
make build
```

Ova komanda automatski:
- Gradi Docker image
- Kreira `.env` fajl iz `.env.example`
- Instalira Faker biblioteku
- Generiše application key
- Pokreće migracije
- Seeduje bazu podataka

---

## Svakodnevno korišćenje

### Pokretanje aplikacije
```bash
make up
```

Aplikacija će biti dostupna na: **http://localhost:8000**

### Zaustavljanje aplikacije
```bash
make down
```

### Pregled statusa kontejnera
```bash
make ps
```

### Praćenje logova
```bash
make logs
```

---

## Docker komande

| Komanda | Opis |
|---------|------|
| `make up` | Pokreće kontejnere u pozadini |
| `make down` | Zaustavlja i uklanja kontejnere |
| `make logs` | Prikazuje logove svih kontejnera u realnom vremenu |
| `make ps` | Prikazuje status pokrenutih kontejnera |
| `make exec` | Otvara bash terminal unutar Laravel kontejnera |

---

## Laravel komande

| Komanda | Opis |
|---------|------|
| `make migrate` | Pokreće migracije baze podataka |
| `make migrate-fresh` | Resetuje i ponovo pokreće sve migracije |
| `make seed` | Seeduje bazu podataka test podacima |
| `make tinker` | Otvara Laravel Tinker REPL konzolu |
| `make key` | Generiše application key (kreira .env ako ne postoji) |

---

## MySQL komande

| Komanda | Opis |
|---------|------|
| `make mysql` | Otvara MySQL konzolu (user: admin) |

---


## Kontejneri

- **ribarnica-app** - Laravel aplikacija
- **ribarnica-db** - MySQL baza podataka
