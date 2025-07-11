CREATE TYPE statut_compte AS ENUM ('ACTIF', 'INACTIF');

DROP TYPE statut_compte;
CREATE TYPE type_transaction AS ENUM ('DEPOT', 'RETRAIT', 'PAIEMENT');

CREATE TABLE client (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(20) UNIQUE NOT NULL,
    adresse TEXT,
    numero_piece_identite VARCHAR(50) UNIQUE,
    photo_recto TEXT,
    photo_verso TEXT
);

CREATE TYPE statut_compte AS ENUM ('PRINCIPAL', 'SECONDAIRE');




CREATE TABLE compte (
    id SERIAL PRIMARY KEY,
    utilisateur_id INTEGER NOT NULL REFERENCES client(id) ON DELETE CASCADE,
    numero VARCHAR(50) UNIQUE NOT NULL,
    solde NUMERIC(15,2) DEFAULT 0,
    statut statut_compte NOT NULL DEFAULT 'PRINCIPAL'
   
);

CREATE TABLE transaction (
    id SERIAL PRIMARY KEY,
    compte_id INTEGER NOT NULL REFERENCES compte(id) ON DELETE CASCADE,
    montant NUMERIC(15,2) NOT NULL,
    date_transaction TIMESTAMPTZ DEFAULT NOW(),
    type type_transaction NOT NULL,
    description TEXT
);

CREATE TABLE servicecommercial (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    adresse TEXT,
    matricule VARCHAR(100)
);

INSERT INTO client VALUES(
   1,'diop','soda','776543432','dakar','198020000898','recto','verso'
);

