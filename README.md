# Application de Gestion de Requêtes

Une application full-stack de gestion de requêtes développée avec Angular, Laravel et Docker.

## 🚀 Technologies

- **Frontend** : Angular 17+
- **Backend** : Laravel 10+ 
- **Base de données** : MySQL 8
- **Conteneurisation** : Docker & Docker Compose

## 📦 Installation

### Prérequis
- Docker
- Docker Compose

### Démarrage
```bash
# Cloner le projet
git clone , fin vous connaissez
cd request-app
#Vous installer les dependances du back et du front , generez la cle et faites un copy du .env 
#fin vous connaissez 
#ou vous m'envoyez fapcent je vous send mon .env 😉
 Nettoyage :
 
docker-compose down     

# Nettoyer les images et volumes (si nécessaire)
 docker system prune -f

# Lancer l'application
docker-compose up --build

#les Accès
Frontend : http://localhost:4200

Backend API : http://localhost:9000

Base de données : localhost:3308