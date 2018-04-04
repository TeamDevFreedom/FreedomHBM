alter table `vecteur` change column `description` `description_ok` text not null;
alter table `vecteur` add description_nok text not null;
alter table `vecteur` change column `statut` `statut` enum('CREE','VALIDE','ADMINISTRE', 'PERIME') NOT NULL DEFAULT 'CREE';