DROP DATABASE IF EXISTS CONFVIRTUAL;
CREATE DATABASE CONFVIRTUAL;
USE CONFVIRTUAL;

CREATE TABLE SPONSOR(
    Nome VARCHAR(20) PRIMARY KEY,
    Logo BLOB,
    Importo DOUBLE
) ENGINE = INNODB;

CREATE TABLE UTENTE(
    Username VARCHAR(20),
    Nome VARCHAR(20),
    Cognome VARCHAR(20),
    LuogoDiNascita VARCHAR(30),
    DataDiNascita DATE,
    Passwordd VARCHAR(30),
    Tipo ENUM("AMMINISTRATORE", "SPEAKER", "PRESENTER", "BASE") DEFAULT "BASE",
    PRIMARY KEY(Username)
) ENGINE = INNODB;

CREATE TABLE SOSTIENE(
    Nome VARCHAR(20),
    AnnoEdizione INT,
    Acronimo VARCHAR(20),
    PRIMARY KEY(Nome, AnnoEdizione, Acronimo)
) ENGINE = INNODB;

CREATE TABLE CONFERENZA (
    Nome VARCHAR(200),
    Acronimo VARCHAR(200),
    AnnoEdizione INT,  
    Logo BLOB,
    Svolgimento ENUM("Attiva", "Completata") DEFAULT "Attiva",   
    TotaleSponsorizzazione INT DEFAULT 0,
    PRIMARY KEY(AnnoEdizione, Acronimo)
) ENGINE = INNODB;

CREATE TABLE REGISTRA(
    Acronimo VARCHAR(20),
    AnnoEdizione INT, 
    Username VARCHAR(20),
    PRIMARY KEY(Acronimo, AnnoEdizione, Username),
    FOREIGN KEY(AnnoEdizione, Acronimo) REFERENCES CONFERENZA(AnnoEdizione, Acronimo) ON DELETE CASCADE,
    FOREIGN KEY(Username) REFERENCES UTENTE(Username) ON DELETE CASCADE
) ENGINE = INNODB;

CREATE TABLE PROGRAMMA(
    IdProgramma INT,
    Data DATE,
    AnnoEdizioneProgramma INT,
    AcronimoProgramma VARCHAR(20),
    PRIMARY KEY(IdProgramma),
    FOREIGN KEY(AnnoEdizioneProgramma, AcronimoProgramma) REFERENCES CONFERENZA(AnnoEdizione, Acronimo) ON DELETE CASCADE
) ENGINE = INNODB;

CREATE TABLE SESSIONE(
    Codice INT,
    Link VARCHAR(20),
    Titolo VARCHAR(100),
    IdProgramma INT,
    OraInizio TIME,
    OraFine TIME,
    TotalePresentazioni INT DEFAULT 0, 
    PRIMARY KEY(Codice),
    FOREIGN KEY(IdProgramma) REFERENCES PROGRAMMA(IdProgramma) ON DELETE CASCADE
) ENGINE = INNODB;

CREATE TABLE MESSAGGIO(
    UsernameUtente VARCHAR(20),
    DataInserimento DATE,
    Testo VARCHAR(400),
    CodiceSessione INT,
    PRIMARY KEY(UsernameUtente, DataInserimento, Testo),
    FOREIGN KEY(UsernameUtente) REFERENCES UTENTE(Username) ON DELETE CASCADE,
    FOREIGN KEY(CodiceSessione) REFERENCES SESSIONE(Codice) ON DELETE CASCADE
) ENGINE = INNODB;

CREATE TABLE AMMINISTRATORE(
    UsernameUtente VARCHAR(20),
    PRIMARY KEY(UsernameUtente),
    FOREIGN KEY(UsernameUtente) REFERENCES UTENTE(Username) ON DELETE CASCADE
) ENGINE = INNODB;

CREATE TABLE PRESENTER(
    UsernameUtente VARCHAR(20),
    Curriculum VARCHAR(30),
    Foto BLOB,
    NomeUniversita VARCHAR(50),
    NomeDipartimento VARCHAR(50),
    PRIMARY KEY(UsernameUtente),
    FOREIGN KEY(UsernameUtente) REFERENCES UTENTE(Username) ON DELETE CASCADE
) ENGINE = INNODB;

CREATE TABLE SPEAKER(
    UsernameUtente VARCHAR(20),
    Foto BLOB,
    NomeUniversita VARCHAR(50) DEFAULT NULL,
    NomeDipartimento VARCHAR(50) DEFAULT NULL,
    Curriculum VARCHAR(30) DEFAULT NULL,
    PRIMARY KEY(UsernameUtente),
    FOREIGN KEY(UsernameUtente) REFERENCES UTENTE(Username) ON DELETE CASCADE
) ENGINE = INNODB;  

CREATE TABLE PRESENTA(
    UsernameUtente VARCHAR(20),
    CodicePresentazione INT,
    PRIMARY KEY(UsernameUtente, CodicePresentazione)
) ENGINE = INNODB;

CREATE TABLE PRESENTAZIONE(
    Codice INT,
    OraInizio TIME,
    OraFine TIME,
    NumeroSequenza INT,
    PRIMARY KEY(Codice)
) ENGINE = INNODB;

CREATE TABLE RISORSA(
    UsernameUtente VARCHAR(20),
    Link VARCHAR(20),
    Descrizione VARCHAR(100),
    CodicePresentazione INT,
    PRIMARY KEY(UsernameUtente, Link, Descrizione),
    FOREIGN KEY(UsernameUtente) REFERENCES UTENTE(Username) ON DELETE CASCADE,
    FOREIGN KEY(CodicePresentazione) REFERENCES PRESENTAZIONE(Codice) ON DELETE CASCADE
) ENGINE = INNODB;

CREATE TABLE VALUTAZIONE(
    Voto INT,
    Note VARCHAR(50),
    CodicePresentazione INT,
    UsernameUtente VARCHAR(20),
    PRIMARY KEY(CodicePresentazione, UsernameUtente, Voto, Note)
) ENGINE = INNODB;

CREATE TABLE ARTICOLO(
    Titolo VARCHAR(100),
    NumeroPagine INT,
    StatoSvolgimento ENUM("Coperto", "Non coperto") DEFAULT "Non coperto",
    ParolaChiave VARCHAR(20),
    CodicePresentazione INT,
    UsernameUtente VARCHAR(20),
    PRIMARY KEY(CodicePresentazione),
    FOREIGN KEY(CodicePresentazione) REFERENCES PRESENTAZIONE(Codice) ON DELETE CASCADE,
    FOREIGN KEY(UsernameUtente) REFERENCES PRESENTER(UsernameUtente) ON DELETE CASCADE
) ENGINE = INNODB;

CREATE TABLE SCRIVE(
    Nome VARCHAR(20),
    Cognome VARCHAR(20),
    ParolaChiave VARCHAR(20),
    PRIMARY KEY(Nome, Cognome, ParolaChiave)
) ENGINE = INNODB;

CREATE TABLE AUTORE(
    CodicePresentazione INT,
    Nome VARCHAR(20),
    Cognome VARCHAR(20),
    PRIMARY KEY(CodicePresentazione, Nome, Cognome)
) ENGINE = INNODB;

CREATE TABLE TUTORIAL(
    CodicePresentazione INT,
    Titolo VARCHAR(100),
    Abstract VARCHAR(500),
    PRIMARY KEY(CodicePresentazione),
    FOREIGN KEY(CodicePresentazione) REFERENCES PRESENTAZIONE(Codice) ON DELETE CASCADE
) ENGINE = INNODB;

CREATE TABLE ARTICOLATA(
    CodiceSessione INT,
    CodicePresentazione INT,
    PRIMARY KEY(CodiceSessione, CodicePresentazione),
    FOREIGN KEY(CodiceSessione) REFERENCES SESSIONE(Codice) ON DELETE CASCADE,
    FOREIGN KEY(CodicePresentazione) REFERENCES PRESENTAZIONE(Codice) ON DELETE CASCADE
) ENGINE = INNODB;

CREATE TABLE CREAZIONE(
    UsernameUtente VARCHAR(20),
    AnnoEdizione INT,
    Acronimo VARCHAR(200),
    PRIMARY KEY(UsernameUtente, AnnoEdizione, Acronimo),
    FOREIGN KEY(UsernameUtente) REFERENCES UTENTE(Username) ON DELETE CASCADE,
    FOREIGN KEY(AnnoEdizione, Acronimo) REFERENCES CONFERENZA(AnnoEdizione, Acronimo) ON DELETE CASCADE
) ENGINE = INNODB;

CREATE TABLE FAVORITE(
    UsernameUtente VARCHAR(20),
    CodicePresentazione INT, 
    PRIMARY KEY(UsernameUtente, CodicePresentazione),
    FOREIGN KEY(UsernameUtente) REFERENCES UTENTE(Username) ON DELETE CASCADE,
    FOREIGN KEY(CodicePresentazione) REFERENCES PRESENTAZIONE(Codice) ON DELETE CASCADE
) ENGINE = INNODB;


# RANKING VIEW
CREATE VIEW Ranking (UsernameUtente, Voto) AS 
SELECT SPEAKER.UsernameUtente, Voto FROM SPEAKER, PRESENTA, VALUTAZIONE WHERE PRESENTA.CodicePresentazione = VALUTAZIONE.CodicePresentazione
UNION
SELECT ARTICOLO.UsernameUtente, Voto FROM ARTICOLO, VALUTAZIONE WHERE ARTICOLO.CodicePresentazione = VALUTAZIONE.CodicePresentazione;

# datamassima VIEW
CREATE VIEW dataMassima(Acronimo, Data) AS
SELECT Data, Acronimo FROM PROGRAMMA, CONFERENZA WHERE PROGRAMMA.AcronimoProgramma = CONFERENZA.Acronimo

# SVOLGIMENTO EVENTT 
CREATE DEFINER=`root`@`localhost` EVENT `Svolgimento` ON SCHEDULE EVERY 5 SECOND STARTS '2022-04-24 15:15:59' ENDS '2023-04-24 15:15:59' ON COMPLETION PRESERVE ENABLE DO 
UPDATE conferenza SET Svolgimento = "Completata" WHERE (Acronimo = (SELECT Acronimo FROM datamassima WHERE ((diff(CURRENT_DATE, Data)))))