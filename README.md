# Student API - PHP (TDD & Continuous Integration)

Projet de gestion d'étudiants développé dans le cadre du cursus **B3 IT – École Hexagone**.

Ce projet met en œuvre une démarche de **Test-Driven Development (TDD)**, des tests unitaires avec **PHPUnit**, ainsi qu'un contrôle de la qualité du code avec **PHP_CodeSniffer**.

## 🚀 Fonctionnalités

- **Gestion des étudiants**
  - Ajout d'un étudiant
  - Modification d'un étudiant
  - Suppression d'un étudiant
  - Recherche d'un étudiant
  - Récupération de la liste des étudiants
  - Récupération d'un étudiant par son identifiant

- **Statistiques**
  - Calcul de différentes statistiques concernant les étudiants

- **Validation des données**
  - Vérification des champs obligatoires
  - Validation des notes
  - Contrôle des données saisies

## 📋 Prérequis

Avant d'installer le projet, assure-toi de disposer des outils suivants :

- **PHP 8.1** ou supérieur
- **Composer**
- **Git**

## ⚙️ Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/TON_USERNAME/student-api-php.git
cd student-api-php
```

2. Installer les dépendances
composer install

🧪 Tests
Le projet utilise PHPUnit pour effectuer les tests unitaires.

Pour lancer l'ensemble des tests :

composer test

Tu peux également lancer PHPUnit directement :

vendor/bin/phpunit

🔍 Qualité du code
Le projet utilise PHP_CodeSniffer (PHPCS) afin de vérifier le respect des standards de codage.

Pour lancer le linter :

composer lint

Pour corriger automatiquement certaines erreurs de style :

vendor/bin/phpcbf

🛠️ Structure du projet
student-api-php/
├── src/
│   └── StudentManager.php   # Logique métier et gestion des étudiants
├── tests/
│   └── StudentTest.php      # Tests unitaires PHPUnit
├── composer.json             # Dépendances et scripts Composer
├── phpcs.xml                 # Configuration de PHP_CodeSniffer
├── README.md                 # Documentation du projet
└── LICENSE                   # Licence du projet

🔄 TDD & Continuous Integration
Le développement du projet suit une approche TDD (Test-Driven Development) :

Écriture d'un test correspondant au comportement attendu.

Implémentation du code nécessaire pour faire passer le test.

Amélioration et refactorisation du code.

Vérification de la qualité du code avec PHP_CodeSniffer.

Les tests et les vérifications de qualité peuvent être intégrés dans une chaîne de Continuous Integration (CI) afin de détecter automatiquement les régressions et les problèmes de style.

📄 Licence
Ce projet est distribué sous licence MIT.

Voir le fichier LICENSE pour plus d'informations.
