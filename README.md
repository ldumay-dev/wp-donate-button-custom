# WP Donate Button Custom

## Description

Le module **WP Donate Button Custom** est un module WordPress qui permet d'ajouter un bouton de don sur votre site. Ce bouton est personnalisable et peut être configuré depuis le back-office de WordPress. Le module est conçu pour être facile à utiliser et à configurer, même pour les utilisateurs non techniques.

## Cadre de conception du module - Fonctionnalités et exigences

- **La maintenance du module** :
    - **L'installation** :
        - Le module est installé dans le répertoire des modules de WordPress.
    - **L'activation** :
        - Le module est activé dans le back-office de WordPress.
        - Le module crée une table dédiée de configuration dans la base de données de WordPress.
    - **La mise à jour** :
        - Le module est mis à jour dans le répertoire des modules de WordPress.
        - Le module met à jour la table de configuration dans la base de données de WordPress.
    - **La désactivation** :
        - Le module est désactivé dans le back-office de WordPress.
    - **La désintallation** :
        - Le module est désinstallé du répertoire des modules de WordPress.
        - Le module supprime la table de configuration dans la base de données de WordPress.
- **Le rendu, les statistiques et la configuration du module** :
    - **Le rendu** :
        - Le module est rendu dans le front-end de WordPress.
        - Le rendu affiche un bouton de don.
        - Le bouton de don a une icone, un titre et d'autres boutons d'action personnalisable.
        - Le bouton de don est possède un effet de survol.
        - Le bouton a une position fixe personnalisable.
        - Le bouton de don est visible sur toutes les pages du front-office du front-end de WordPress.
    - **Les statistiques** :
        - **Widget de statistiques** :
            - Le module dipose de deux sections : raccourcis et statistiques.
                - La section raccourci permet d'afficher les raccourcis vers les pages du module.
                - La section statistiques affiche le nombre de clics sur le bouton de don.
    - **La configuration** :
        - Le module est configurable depuis le back-office de WordPress.
        - Le module peux activer ou désactiver le bouton de don.
        - Le module possède une section de configuration du thème du bouton de don.
            - Le bouton de don possède une position fixe personnalisable.
            - Le bouton de don possède un effet de survol personnalisable.
            - Le bouton de don possède une couleur personnalisable.
        - Le module possède une section de configuration des informations du bouton de don.
            - Le bouton de don possède une icone personnalisable.
            - Le bouton de don possède un titre personnalisable.
        - Le module possède une section de configuration des bouton d'action du bouton de don.
            - Le bouton de don possède un nombre de bouton d'action personnalisable.
            - Un bouton d'action est un bouton qui permet d'effectuer une action.
            - Un bouton d'action possède un titre personnalisable, avec une nombre de caractères maximum.
            - Un bouton d'action possède une url personnalisable.
    - **La sauvegarde des données** :
        - Les modifications sont sauvegardées dans la base de données de l'application, dans une table de configuration pour le module.

## Arborescence du module

```
.
├── CHANGELOG.md
├── LICENCE.txt
├── README.md
├── src
│   ├── assets
│   │   ├── css
│   │   │   └── wp-donate-button-custom.css
│   │   └── js
│   │       └── wp-donate-button-custom.js
│   ├── back-end
│   │   └── wp-donate-button-custom.php
│   ├── core
│   │   ├── classes
│   │   │   └── wp-donate-button-custom.php
│   │   └── functions
│   │       └── wp-donate-button-custom.php
│   ├── front-end
│   │   ├── back-office
│   │   │   ├── about.php
│   │   │   ├── capabilities.php
│   │   │   ├── navigation.php
│   │   │   ├── roles.php
│   │   │   ├── settings.php
│   │   │   ├── shortcode.php
│   │   │   └── widget.php
│   │   └── front-office
│   │       └── render.php
│   ├── languages
│   │   ├── wp-donate-button-custom-de_DE.pot
│   │   ├── wp-donate-button-custom-en_US.pot
│   │   ├── wp-donate-button-custom-es_ES.pot
│   │   └── wp-donate-button-custom-fr_FR.pot
│   └── setup
│       ├── enable-and-disable.php
│       ├── install-and-uninstall.php
│       └── update.php
└── wp-donate-button-custom.php
```