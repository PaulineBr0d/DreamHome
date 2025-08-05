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