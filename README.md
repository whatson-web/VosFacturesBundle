# Installation
Créer le fichier `config/packages/vos_factures.yaml`, avec le contenu suivant :

    vos_factures:
        api_token: 'LeTokenSuperSecret'
        testMode: false // A passer à `true` une fois en production

Puis importer le projet :

    composer require whatson-web/vos-factures-bundle

# Utilisation
## Lister les factures
    $this->get('wh_vosfactures.bill_manager')->index();
## Créer une facture
    $this->get('wh_vosfactures.bill_manager')->create($data);
## Supprimer une facture
    $this->get('wh_vosfactures.bill_manager')->delete($id);
## Récupérer les informations d'une facture
    $this->get('wh_vosfactures.bill_manager')->get($id);
## Récupérer le lien PDF d'une facture
    $this->get('wh_vosfactures.bill_manager')->getPdfLink($id);
