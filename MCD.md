```mermaid
classDiagram
direction TB
    class ROLE {
	    INT id_role : PK
	    VARCHAR libelle_role
    }

    class UTILISATEUR {
	    INT id_utilisateur : PK
	    VARCHAR nom
	    VARCHAR prenom
	    VARCHAR email
	    VARCHAR mot_de_passe
	    VARCHAR telephone
	    VARCHAR civilite
    }

    class ENTREPRISE {
	    INT id_entreprise : PK
	    VARCHAR nom
	    VARCHAR description
	    VARCHAR email_contact
	    VARCHAR telephone_contact
	    VARCHAR adresse
    }

    class OFFRE {
	    INT id_offre : PK
	    VARCHAR titre
	    TEXT description
	    DECIMAL base_remuneration
	    DATE date_offre
	    VARCHAR duree_stage
	    VARCHAR statut_offre
    }

    class COMPETENCE {
	    INT id_competence : PK
	    VARCHAR nom_competence
    }

    class CANDIDATURE {
	    INT id_candidature : PK
	    DATE date_candidature
	    VARCHAR cv
	    TEXT lettre_motivation
	    VARCHAR statut_candidature
    }



    ROLE "0,n" --> "1,1" UTILISATEUR : est attribué
	UTILISATEUR "0,n" --> "0,n" ENTREPRISE : gère
	UTILISATEUR "0,n" --> "1,1" OFFRE : crée
    ENTREPRISE "0,n" --> "1,1" OFFRE : propose
    OFFRE "0,n" --> "1,1" CANDIDATURE : recoit
    UTILISATEUR "0,n" --> "1,1" CANDIDATURE : effectue
	UTILISATEUR "0,n" --> "0,n" OFFRE : wishliste
    UTILISATEUR "0,n" --> "0,n" ENTREPRISE : évalue
    OFFRE "0,n" --> "0,n" COMPETENCE : necessite
	UTILISATEUR "1,1" --> "1,1" OFFRE : wishliste
    UTILISATEUR "0,n" --> "1,1" ENTREPRISE : évalue
    OFFRE "0,n" --> "0,n" COMPETENCE : necessite
