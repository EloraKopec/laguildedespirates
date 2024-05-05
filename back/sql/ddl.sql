DROP TABLE IF EXISTS CRENEAU_PILLAGE;
DROP TABLE IF EXISTS ROUTE;
DROP TABLE IF EXISTS MEMBRE;

CREATE TABLE MEMBRE (
  ID_MEMBRE VARCHAR(50) PRIMARY KEY,
  NOM VARCHAR(50) NOT NULL,
  MOT_DE_PASSE CHAR(60) CHARACTER SET ascii COLLATE ascii_bin NOT NULL
);

CREATE TABLE ROUTE (
  ID_ROUTE INT PRIMARY KEY,
  NOM_ROUTE VARCHAR(50) NOT NULL,
  NOM_EXPLOITANT VARCHAR(50) NOT NULL,
  TYPE_CARGAISON VARCHAR(50) NOT NULL,
  PORT_DEPART VARCHAR(50) NOT NULL,
  PORT_ARRIVEE VARCHAR(50) NOT NULL
);


CREATE TABLE CRENEAU_PILLAGE (
  ID_CRENEAU_PILLAGE INT PRIMARY KEY,
  DEBUT DATETIME NOT NULL,
  FIN DATETIME NOT NULL,
  ID_MEMBRE VARCHAR(50) NOT NULL,
  ID_ROUTE INT NOT NULL,
  FOREIGN KEY (ID_MEMBRE) REFERENCES MEMBRE(ID_MEMBRE),
  FOREIGN KEY (ID_ROUTE) REFERENCES ROUTE(ID_ROUTE)
);