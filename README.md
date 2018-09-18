# Installation
Ajouter les variables d'environnements :

    ### vos factures ###
    VOSFACTURES_APIKEY=vosfactures_api_token
    VOSFACTURES_ACCOUNTNAME=vosfactures_account_name
    VOSFACTURES_TESTMODE=true
    ### vos factures ###

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
