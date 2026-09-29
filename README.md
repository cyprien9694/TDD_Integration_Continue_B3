# Student API - PHP (TDD & Intégration Continue)

Projet de gestion d'étudiants développé dans le cadre du cursus B3 IT (École Hexagone). Il met en œuvre une démarche de **Test-Driven Development (TDD)**, des tests unitaires avec **PHPUnit** et un contrôle qualité du code via **PHP_CodeSniffer**.

## 🚀 Fonctionnalités

- **Gestion des étudiants** : ajout, modification, suppression, recherche et récupération (liste complète ou par ID)
- **Statistiques** : calculs et métriques sur les étudiants
- **Validation des données** : vérification des champs obligatoires et des notes valides

## 📋 Prérequis

- **PHP** 8.1 ou supérieur
- **Composer**

## ⚙️ Installation

1. Cloner le dépôt :

   ```bash
   git clone https://github.com/cyprien9694/student-api-php.git
   cd student-api-php
   ```

2. Installer les dépendances :

   ```bash
   composer install
   ```

## 🧪 Tests et qualité du code

Lancer les tests unitaires (PHPUnit) :

```bash
composer test
```

Vérifier le style du code (PHPCS) :

```bash
composer lint
```

Corriger automatiquement les erreurs de style (PHPCBF) :

```bash
vendor/bin/phpcbf
```

## 🛠️ Structure du projet

```text
student-api-php/
├── src/
│   └── StudentManager.php   # Logique métier et gestion des étudiants
├── tests/
│   └── StudentTest.php      # Tests unitaires PHPUnit
├── composer.json            # Dépendances et scripts du projet
├── phpcs.xml                # Configuration du linter PHPCS
├── LICENSE                  # Licence MIT
└── README.md                # Documentation du projet
```

## 👤 Auteur

**Cyprien** — étudiant en développement web et mobile, École Hexagone
GitHub : [@cyprien9694](https://github.com/cyprien9694)

## 📄 Licence

Ce projet est distribué sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.
