# #1 Homepage

### **Structure de la page**

Votre page devra contenir :

### **a) Barre de navigation**

- Logo ou **titre du site** : *Find My Dream Home*
- Liens de navigation :
    - **Login**
    - **House**
    - **Appartement**
- La barre doit rester **fixée en haut** lors du défilement de la page.

---

### **b) Contenu principal**

Sous la barre de navigation, afficher :

1. **Section “Nos annonces de maison”**
    - Titre : Nos annonces de maison
    - Afficher **3 annonces** côte à côte.
2. **Section “Nos annonces d’appartements”**
    - Titre : Nos annonces d’appartements
    - Afficher **3 annonces** côte à côte.

---

### **c) Footer**

- Un pied de page simple avec par exemple :
    
    > © 2025 Find My Dream Home – Tous droits réservés.
    > 

---

### **2. Structure d’une annonce**

Chaque annonce doit contenir :

- **Image** de l’annonce
- **Titre** de l’annonce
- **Prix**
- **Localisation** (ville)
- **Description** courte
- **Type** : *Rent* (location) ou *Sale* (vente)
- **Bouton “Contact”** (lien factice pour le moment)

---

### **3. Contraintes techniques**

- Utiliser **PHP intégré dans le HTML** pour générer dynamiquement les annonces.
- Les annonces doivent être définies dans un **tableau PHP associatif** *(minimum 3 maisons & 3 appartements).*
- Les **maisons** et **appartements** doivent être séparés dans deux tableaux.
- Utiliser une **boucle PHP** pour générer automatiquement les fiches à partir du tableau.

# #2 Login / Register

### **Pages à créer**

### **a) Page de connexion (login.php)**

- Doit contenir :
    - **Titre** : *Connexion à Find My Dream Home*
    - **Formulaire** avec les champs :
        - **Email**
        - **Mot de passe**
        - **Bouton “Se connecter”**
    - Bonus : Un lien, “*Pas encore de compte ? Inscrivez-vous”* (vers la page d’inscription)

---

### **b) Page d’inscription (register.php)**

- Doit contenir :
    - **Titre** : *Créer un compte sur Find My Dream Home*
    - **Formulaire** avec les champs :
        - **Email**
        - **Mot de passe**
        - **Confirmation du mot de passe**
        - **Bouton “S’inscrire”**
    - Bonus : Un lien, “*Déjà inscrit ? Connectez-vous”* (vers la page de connexion)

---

### **3. Contraintes techniques**

- **Aucune mise en base de données pour le moment** : on se concentre sur la structure et la validation visuelle.
- Vous devez **prévoir un minimum de validation (coté Client)** :
    - Vérifier que tous les champs sont remplis

# #3 Add listing

### **Pages à créer**

### **a) Bouton dans le header**

- Ajouter dans la **barre de navigation** un lien intitulé **Add**
- Ce lien doit pointer vers un nouveau fichier
- Le style du bouton doit être cohérent avec les autres liens du menu
- Le bouton doit rester visible même lors du défilement

---

### **b) Page d’ajout d’annonce**

- Doit contenir :
    - **Titre**
    - **Formulaire** avec les champs :
        - **Image**
        - **Titre**
        - **Prix**
        - **Ville**
        - **Description courte**
        - **Type** *(Rent / Sale)*
        - **Bouton “Enregistrer”**
    - Un lien **“Retour à l’accueil”** sous le formulaire

---

### **3. Contraintes techniques**

- Le formulaire doit être en **méthode POST**.
- Tous les champs sont **obligatoires**.
- **Aucune sauvegarde réelle** pour le moment (pas d’écriture en base de données) :
    - Afficher simplement un message de confirmation après soumission.
- Validation côté client & côté serveur

# #4 Session

### **Pages à modifier / créer**

### **a) Initialisation de la session**

- Activer l’utilisation des **sessions PHP** sur **toutes les pages** du site
- Permettre ainsi de stocker et partager des informations sur l’utilisateur connecté entre les pages.

---

### **b) Page de connexion simulée**

- Conserver la structure existante de la page de connexion.
- Lorsqu’un utilisateur se connecte :
    - Simuler la connexion en enregistrant dans la session les informations de l’utilisateur (par exemple, son email).
    - Rediriger l’utilisateur vers la page d’accueil.

---

### **c) Page de déconnexion**

- Créer une page permettant de **supprimer les données de session** pour déconnecter l’utilisateur.
- Rediriger ensuite vers la page d’accueil.

---

### **d) Adaptation du header**

- Si **l’utilisateur est connecté** :
    - Afficher un message de bienvenue avec son nom ou email.
    - Afficher un lien **“Déconnexion”**.
    - Afficher le bouton **“Ajouter une annonce”**.
- Si **l’utilisateur n’est pas connecté** :
    - Afficher uniquement les liens **Login** et les catégories d’annonces.
    - Masquer le bouton **“Ajouter une annonce”**.

---

### **3. Contraintes techniques**

- La session doit être active sur toutes les pages.
- La connexion est **uniquement simulée** (pas de vérification réelle en base de données).
- L’accès à la page **Ajouter une annonce** doit être **réservé aux utilisateurs connectés** :
    - Si un utilisateur non connecté tente d’y accéder, il doit être redirigé vers la page de connexion.

# #5 BDD

### **Pages à modifier / créer**

[Structure TABLE](https://www.notion.so/Structure-TABLE-24757d7de0c0803caa69d11db8426735?pvs=21)

### **a) Base de données**

- Créer une base de données adaptée au projet.
- Créer les tables suivantes :
    - **user** : informations sur les utilisateurs (id, email, mot de passe, etc.).
    - **propertyType** : types de biens (maison, appartement, etc.).
    - **transactionType** : types de transaction (vente, location).
    - **listing** : annonces avec relation vers les autres tables (utilisateur, type de bien, type de transaction).
- Ajouter des données de test pour chaque table.

---

### **b) Connexion avec PDO**

- Mettre en place une connexion à la base de données avec **PDO**.
- Centraliser la connexion dans un fichier commun pour pouvoir la réutiliser sur toutes les pages.

---

### **c) Adaptation de l’affichage des annonces**

- Modifier la page d’accueil pour **récupérer les annonces depuis la base de données** au lieu d’utiliser les tableaux PHP statiques.
- Afficher les informations complètes d’une annonce en utilisant les relations entre les tables.

---

### **d) Page d’ajout d’annonce**

- Adapter le formulaire pour **insérer la nouvelle annonce dans la base de données**.
- Utiliser **PDO** pour exécuter la requête d’insertion.
- Récupérer les valeurs possibles pour **propertyType** et **transactionType** depuis la base de données pour remplir les listes déroulantes.

---

### **e) Page de connexion**

- Adapter la page de connexion pour **vérifier les identifiants** dans la table **user**. (Pas de hachage de mot de passe pour le moment)
- Utiliser **PDO** pour effectuer la requête de sélection.

---

### **3. Contraintes techniques**

- Toutes les interactions avec la base doivent passer par **PDO**.
- Les requêtes doivent être préparées pour éviter les injections SQL.
- Les pages doivent utiliser les données réelles issues de la base, plus de données codées en dur dans des tableaux PHP.
- Les relations entre les tables doivent être exploitées pour récupérer les informations complètes (jointures).

# #6 Roles & CRUD & Favorite

### **Modifications à apporter**

### **a) Ajout du champ role dans la table user**

- Ajouter une colonne role dans la table user.
- Les rôles attendus :
    - agent : peut publier, modifier, supprimer **ses propres annonces**.
    - admin : peut publier, modifier, supprimer **toutes les annonces**.
    - user (ou rôle par défaut) : ne peut **pas publier**, mais peut **ajouter des annonces en favoris**.

---

### **b) Accès à l’ajout d’annonce**

- Restreindre l’accès à la page :
    - Seuls les utilisateurs connectés ayant le rôle **agent ou admin** peuvent y accéder.
    - Rediriger tout autre utilisateur vers la page d’accueil avec un message d’erreur.

---

### **c) Modification d’une annonce**

- Créer une page permettant de modifier une annonce existante.
- Seuls les utilisateurs suivants peuvent accéder à la modification :
    - L’utilisateur **créateur** de l’annonce.
    - Un utilisateur ayant le rôle **admin**.

---

### **d) Suppression d’une annonce**

- Ajouter une option de suppression visible uniquement si :
    - L’annonce appartient à l’utilisateur connecté.
    - Ou que l’utilisateur a le rôle **admin**.
- Empêcher toute tentative de suppression non autorisée côté serveur.

---

### **e) Favoris (accessible à tous les utilisateurs connectés)**

- Ajouter une **fonctionnalité “Ajouter aux favoris”** sur chaque annonce visible.
- Tous les utilisateurs **connectés**, quel que soit leur rôle (user, agent, admin), peuvent :
    - Ajouter une annonce à leurs favoris.
    - Retirer une annonce de leurs favoris.
    - Visualiser une liste de leurs annonces favorites.
- Créer une table favorite permettant de stocker la relation entre un utilisateur et une annonce.

---

### **3. Contraintes techniques**

- Tous les contrôles d’autorisation (ajout, modification, suppression) doivent être **gérés côté serveur**.
- Seuls les utilisateurs **connectés** peuvent interagir avec les annonces (ajout, modification, suppression, favoris).
- Les pages doivent s’adapter dynamiquement :
    - Afficher ou masquer les actions en fonction des droits de l’utilisateur connecté.
- Prévoir un affichage personnalisé des favoris (ex : section “Mes favoris”).

# #7 - Paginate

### **Pages à créer**

### **a) Page house**

- Afficher uniquement les annonces dont le type de bien est “Maison”.
- Afficher **12 annonces maximum par page**.
- Afficher en bas de la liste :
    - Les liens pour naviguer vers les **pages suivantes / précédentes**.
    - Le numéro de page actif.

---

### **b) Page appartment**

- Afficher uniquement les annonces dont le type de bien est “Appartement”.
- Appliquer exactement le **même système de pagination** que sur la page house.

---

### **Fonctionnement attendu**

- Utiliser un paramètre en **GET** (?page=1, ?page=2, etc.) pour déterminer quelle portion des annonces afficher.
- La page doit :
    - Calculer le **nombre total d’annonces** correspondant au type sélectionné.
    - Déterminer le **nombre total de pages**.
    - Récupérer uniquement les **annonces de la page en cours**.
- Ne pas afficher de lien vers une page inexistante (ex : page 6 si seulement 3 pages).

---

### **3. Contraintes techniques**

- Les annonces doivent être récupérées depuis la base de données via **PDO**.
- La requête SQL doit utiliser **LIMIT** et **OFFSET** en fonction de la page en cours.
- Tous les contrôles doivent être faits côté serveur :
    - Si aucun paramètre page n’est passé → afficher la **page 1 par défaut**.
    - Si un numéro de page incorrect est passé → rediriger vers la page 1.
- Le lien actif (page en cours) doit être **clairement visible** dans la pagination.

# #8 - Search Filter

### Pages à créer

### **a) Page de recherche**

- Ajouter un **formulaire de recherche** au-dessus de la liste des annonces.
- Ce formulaire doit permettre de saisir ou sélectionner les champs suivants :
    - **Ville** (champ texte)
    - **Prix maximum** (champ numérique)
    - **Type de bien** (liste déroulante alimentée depuis la base de données)
    - **Type de transaction** (liste déroulante alimentée depuis la base de données)
- Le formulaire doit envoyer les données en **méthode GET** pour afficher les résultats sur la même page.

---

### **b) Adaptation du header**

- Ajouter un lien vers la page de recherche search.php dans la **barre de navigation** du site.

---

### **Fonctionnement attendu**

- Lorsqu’un utilisateur valide le formulaire :
    - La liste des annonces est **filtrée dynamiquement** selon les critères remplis.
    - Il est possible de combiner **un ou plusieurs** critères.
    - Les filtres doivent rester visibles avec les valeurs sélectionnées après soumission.

---

### **3. Contraintes techniques**

- Le filtrage doit se faire **au niveau de la requête SQL** (via PDO), en fonction des valeurs reçues en GET.
- Si aucun filtre n’est appliqué, **toutes les annonces** doivent être affichées par défaut.
- Les filtres doivent être **compatibles entre eux** (ex : ville + type de bien + prix).
- Utiliser des **requêtes préparées** pour éviter toute injection SQL.