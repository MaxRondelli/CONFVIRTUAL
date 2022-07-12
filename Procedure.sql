DELIMITER &&
/* Operazioni che riguardano tutti gli utenti **/

/** Registrazione alla piattaforma **/
CREATE PROCEDURE registrazionePiattaforma(IN UsernameA VARCHAR(20), IN NomeA VARCHAR(20), IN CognomeA VARCHAR(20), 
IN LuogoDiNascitaA VARCHAR(30), IN DataDiNascitaA date, IN PassworddA VARCHAR(30))
    BEGIN 
    DECLARE UsernameI INT; 
    SET UsernameI = (SELECT COUNT(*) FROM UTENTE WHERE (Username = UsernameA));
     
    IF(UsernameI != 1) THEN 
    INSERT INTO UTENTE(Username, Nome, Cognome, LuogoDiNascita, DataDiNascita, Passwordd) 
        VALUES(UsernameA, NomeA, CognomeA, LuogoDiNascitaA, DataDiNascitaA, PassworddA);        
    END IF;
END&&

/** Registrazione ad una conferenza **/
CREATE PROCEDURE registrazioneConferenza(IN AcronimoA VARCHAR(20), IN AnnoEdizioneA INT, IN UsernameA VARCHAR(20))
    BEGIN 
    DECLARE UsernameI INT;
    DECLARE Conferenza INT; 
    SET UsernameI = (SELECT COUNT(*) FROM REGISTRA WHERE(Username = UsernameA AND AnnoEdizioneA = AnnoEdizione AND AcronimoA = Acronimo));

#   SET UsernameI = (SELECT COUNT(*) FROM UTENTE WHERE(Username = UsernameA));   
#   SET Conferenza = (SELECT COUNT(*) FROM CONFERENZA WHERE(AnnoEdizione = AnnoEdizioneA AND Acronimo = AcronimoA));

    IF(UsernameI != 1) THEN
        INSERT INTO REGISTRA(Acronimo, AnnoEdizione, Username) VALUES(AcronimoA, AnnoEdizioneA, UsernameA);
    END IF;

END&&

/** Inserisci nuovo utente **/
CREATE PROCEDURE inserisciUtente(IN UsernameA VARCHAR(20), IN NomeA VARCHAR(20), IN CognomeA VARCHAR(20),
IN LuogoDiNascitaA VARCHAR(30), IN DataDiNascitaA date, IN PassworddA VARCHAR(30), IN TipoA ENUM("SPEAKER", "PRESENTER", "BASE"))
    BEGIN
    INSERT INTO UTENTE(Username, Nome, Cognome, LuogoDiNascita, DataDiNascita, Passwordd, Tipo) 
        VALUES(UsernameA, NomeA, CognomeA, LuogoDiNascitaA, DataDiNascitaA, PassworddA, TipoA);   
END&&

/** Inserimento nella chat di sessione **/
CREATE PROCEDURE inserimentoChat(IN UsernameUtenteA VARCHAR(20), IN DataInserimentoA date, IN TestoA VARCHAR(400), IN CodiceSessioneA INT)
    BEGIN
    DECLARE UsernameI INT;
    DECLARE CodiceSessioneI INT;
    SET UsernameI = (SELECT COUNT(*) FROM UTENTE WHERE (Username = UsernameUtenteA));
    SET CodiceSessioneI = (SELECT COUNT(*) FROM SESSIONE WHERE(Codice = CodiceSessioneA));

    IF(UsernameI = 1 AND CodiceSessioneI = 1) THEN
        INSERT INTO MESSAGGIO(UsernameUtente, DataInserimento, Testo, CodiceSessione) 
            VALUES(UsernameUtenteA, DataInserimentoA, TestoA, CodiceSessioneA);
    END IF;
END&&

/** Inserimento lista presentazioni favorite **/
CREATE PROCEDURE inserimentoLista(IN UsernameUtenteA VARCHAR(20), IN CodicePresentazioneA INT)
    BEGIN
    DECLARE UsernameI INT;
    DECLARE CodicePresentazioneI INT;   
    SET UsernameI = (SELECT COUNT(*) FROM UTENTE WHERE (Username = UsernameUtenteA));
    SET CodicePresentazioneI = (SELECT COUNT(*) FROM PRESENTAZIONE WHERE(Codice = CodicePresentazioneA));

    IF(UsernameI = 1 AND CodicePresentazioneI = 1) THEN
        INSERT INTO COMPOSTO(UsernameUtente, CodicePresentazione) VALUES(UsernameUtenteA, CodicePresentazioneA);
    END IF;
END&&

/* Operazioni che riguardano SOLO gli utenti AMMINISTRATORE */

/** CREAZIONE DI UNA NUOVA CONFERENZA **/
CREATE PROCEDURE creazioneConferenza(IN AcronimoA VARCHAR(20), IN SvolgimentoA ENUM('Attiva', 'Completata'), IN LogoA BLOB, 
IN NomeA VARCHAR(20), IN AnnoEdizioneA INT, IN TotaleSponsorizzazioneA INT)
    BEGIN 
    DECLARE AcronimoI INT;
    SET AcronimoI = (SELECT COUNT(*) FROM CONFERENZA WHERE(Acronimo = AcronimoA AND AnnoEdizione = AnnoEdizioneA));

    IF(AcronimoI != 1) THEN
        INSERT INTO CONFERENZA(Acronimo, Svolgimento, Logo, Nome, AnnoEdizione, TotaleSponsorizzazione)
            VALUES(AcronimoA, SvolgimentoA, LogoA, NomeA, AnnoEdizioneA, TotaleSponsorizzazioneA);
    ELSE 
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "ERROR PROCEDURA";
    END IF;
END&&    

/** CREAZIONE DI UNA NUOVA SESSIONE DI UNA CONFERENZA **/
CREATE PROCEDURE creazioneSessione(IN CodiceA INT, IN LinkA VARCHAR(20), IN TitoloA VARCHAR(100), IN OraInizioA TIME, IN OraFineA TIME)
    BEGIN  
    INSERT INTO SESSIONE(Codice, Link, Titolo, OraInizio, OraFine) VALUES(CodiceA, LinkA, TitoloA, OraInizioA, OraFineA);
END&&

/** INSERIMENTO DELLE PRESENTAZIONI IN UNA SESSIONE **/

CREATE PROCEDURE inserimentoPresentazioni(IN CodiceSessioneA INT, IN CodicePresentazioneA INT, IN OraInizioA TIME, IN OraFineA TIME, IN NumeroSequenzaA INT)
    BEGIN 
    IF(OraInizioA < ALL(SELECT S.OraInizio FROM SESSIONE AS S WHERE S.Codice = CodiceSessioneA)) OR 
    (OraFineA > ALL(SELECT S.OraFine FROM SESSIONE AS S WHERE S.Codice = CodiceSessioneA)) 
    THEN
    	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error OrariPresentazioni';
    ELSE 
        INSERT INTO PRESENTAZIONE(Codice, OraInizio, OraFine, NumeroSequenza) VALUES(CodicePresentazioneA, OraInizioA, OraFineA, NumeroSequenza);
        INSERT INTO ARTICOLATA(CodiceSessione, CodicePresentazione) VALUES(CodiceSessioneA, CodicePresentazioneA);
    END IF;
END&&


/** ASSOCIAZIONE DI UNO SPEAKER ALLA PRESENTAZIONE DI UN TUTORIAL **/
CREATE PROCEDURE associazioneSpeaker(IN UsernameUtenteA VARCHAR(20), IN CodicePresentazioneA INT)
    BEGIN 
    DECLARE UsernameI INT;
    DECLARE CodicePresentazioneI INT;
    SET UsernameI = (SELECT COUNT(*) FROM SPEAKER WHERE (UsernameUtente = UsernameUtenteA));
    SET CodicePresentazioneI = (SELECT COUNT(*) FROM TUTORIAL WHERE (CodicePresentazione = CodicePresentazioneA));

    IF(CodicePresentazioneI = 1 AND UsernameI = 1) THEN
        INSERT INTO PRESENTA(UsernameUtente, CodicePresentazione) VALUES(UsernameUtenteA, CodicePresentazioneA);
    END IF;
END&&

/** ASSOCIAZIONE DI UN PRESENTAR ALLA PRESENTAZIONE DI UN ARTICOLO**/
CREATE PROCEDURE associazionePresenter(IN UsernameUtenteA VARCHAR(20), IN CodicePresentazioneA INT)
    BEGIN 
    DECLARE UsernameI INT;
    DECLARE CodicePresentazioneI INT;
    SET UsernameI = (SELECT COUNT(*) FROM PRESENTER WHERE(UsernameUtente = UsernameUtenteA));
    SET CodicePresentazioneI = (SELECT COUNT(*) FROM PRESENTAZIONE WHERE(Codice = CodicePresentazioneA));

    IF(UsernameI = 1 AND CodicePresentazioneI = 1) THEN
        UPDATE ARTICOLO SET UsernameUtente = UsernameUtenteA WHERE CodicePresentazione = CodicePresentazioneA;
        UPDATE ARTICOLO SET StatoSvolgimento = "Coperto" WHERE CodicePresentazione = CodicePresentazioneA;
    END IF;
END&&

/** INSERIMENTO DELLE VALUTAZIONI SULLE PRESENTAZIONI **/
CREATE PROCEDURE inserimentoValutazioni(IN VotoA INT, IN NoteA VARCHAR(50), IN CodicePresentazioneA INT, IN UsernameUtenteA VARCHAR(20))
    BEGIN 
    DECLARE UsernameI INT;
    DECLARE CodicePresentazioneI INT;   
    SET UsernameI = (SELECT COUNT(*) FROM AMMINISTRATORE WHERE (UsernameUtente = UsernameUtenteA));
    SET CodicePresentazioneI = (SELECT COUNT(*) FROM PRESENTAZIONE WHERE (Codice = CodicePresentazioneA));

    IF(UsernameI = 1 AND CodicePresentazioneI = 1) THEN 
        INSERT INTO VALUTAZIONE(Voto, Note, CodicePresentazione, UsernameUtente) VALUES(VotoA, NoteA, CodicePresentazioneA, UsernameUtenteA);
    END IF;
END&&

/** INSERIMENTO DI UNO SPONSOR **/
CREATE PROCEDURE inserimentoSponsor(IN NomeA VARCHAR(20), IN AcronimoA VARCHAR(20), IN AnnoEdizioneA INT)
    BEGIN
    DECLARE NomeI INT;
    DECLARE AcronimoI INT;

    SET NomeI = (SELECT COUNT(*) FROM SPONSOR WHERE(Nome = NomeA));
    SET AcronimoI = (SELECT COUNT(*) FROM CONFERENZA WHERE (Acronimo = AcronimoA AND AnnoEdizione = AnnoEdizioneA));

    IF(NomeI = 1 AND AcronimoI = 1) THEN
        INSERT INTO SPONSOR(Nome) VALUES(NomeA);
        INSERT INTO SOSTIENE(Nome, AnnoEdizione, Acronimo) VALUES(NomeA, AnnoEdizioneA, AcronimoA);
    ELSE
        INSERT INTO SOSTIENE(Nome, AnnoEdizione, Acronimo) VALUES(NomeA, AnnoEdizioneA, AcronimoA);
    END IF;
END&&

/* Operazioni che riguardano SOLO gli utenti PRESENTER */

/** INSERIMENTO CV **/
CREATE PROCEDURE inserimentoCVPRESENTER(IN UsernameUtenteA VARCHAR(20), IN CurriculumA VARCHAR(30))
    BEGIN 
    DECLARE UsernameI INT;
    SET UsernameI = (SELECT COUNT(*) FROM UTENTE WHERE (Username = UsernameUtenteA));

    IF(UsernameI = 1) THEN
        UPDATE PRESENTER SET Curriculum = CurriculumA WHERE UsernameUtente = UsernameUtenteA;
    END IF;
END&&

/** INSERIMENTO FOTO **/
CREATE PROCEDURE inserimentoFotoPRESENTER(IN UsernameUtenteA VARCHAR(20), IN FotoA BLOB)
    BEGIN 
    DECLARE UsernameI INT;
    SET UsernameI = (SELECT COUNT(*) FROM UTENTE WHERE (Username = UsernameUtenteA));

    IF(UsernameI = 1) THEN
        UPDATE PRESENTER SET Foto = FotoA WHERE UsernameUtente = UsernameUtenteA;
    END IF;
END&&

/** INSERIMENTO AFFILIAZIONE UNIVERSITARIA **/
CREATE PROCEDURE inserimentoAffiliazioneUniPRESENTER(IN UsernameUtenteA VARCHAR(20), IN NomeUniversitaA VARCHAR(50), IN NomeDipartimentoA VARCHAR(50))
    BEGIN 
    DECLARE UsernameI INT;
    SET UsernameI = (SELECT COUNT(*) FROM UTENTE WHERE (Username = UsernameUtenteA));

    IF(UsernameI = 1) THEN
        UPDATE PRESENTER SET NomeUniversita = NomeUniversitaA WHERE UsernameUtente = UsernameUtenteA;        
        UPDATE PRESENTER SET NomeDipartimento = NomeDipartimentoA WHERE UsernameUtente = UsernameUtenteA;
    END IF;
END&&

/* Operazioni che riguardano SOLO gli utenti SPEAKER */

/** INSERIMENTO CV **/
CREATE PROCEDURE inserimentoCVSPEAKER(IN UsernameUtenteA VARCHAR(20), IN CurriculumA VARCHAR(30))
    BEGIN 
    DECLARE UsernameI INT;
    SET UsernameI = (SELECT COUNT(*) FROM UTENTE WHERE (Username = UsernameUtenteA));

    IF(UsernameI = 1) THEN
        UPDATE SPEAKER SET Curriculum = CurriculumA WHERE UsernameUtente = UsernameUtenteA;
    END IF;
END&&

/** INSERIMENTO FOTO **/
CREATE PROCEDURE inserimentoFotoSPEAKER(IN UsernameUtenteA VARCHAR(20), IN FotoA BLOB)
    BEGIN 
    DECLARE UsernameI INT;
    SET UsernameI = (SELECT COUNT(*) FROM UTENTE WHERE (Username = UsernameUtenteA));

    IF(UsernameI = 1) THEN
        UPDATE SPEAKER SET Foto = FotoA WHERE UsernameUtente = UsernameUtenteA;
    END IF;
END&&

/** INSERIMENTO AFFILIAZIONE UNIVERSITARIA **/
CREATE PROCEDURE inserimentoAffiliazioneUniSPEAKER(IN UsernameUtenteA VARCHAR(20), IN NomeUniversitaA VARCHAR(50), IN NomeDipartimentoA VARCHAR(50))
    BEGIN 
    DECLARE UsernameI INT;
    SET UsernameI = (SELECT COUNT(*) FROM UTENTE WHERE (Username = UsernameUtenteA));

    IF(UsernameI = 1) THEN
        UPDATE SPEAKER SET NomeUniversita = NomeUniversitaA WHERE UsernameUtente = UsernameUtenteA;        
        UPDATE SPEAKER SET NomeDipartimento = NomeDipartimentoA WHERE UsernameUtente = UsernameUtenteA;
    END IF;
END&&

/** INSERIMENTO RISORSA **/
CREATE PROCEDURE inserimentoRisorsa(IN LinkA VARCHAR(20), IN DescrizioneA VARCHAR(20), IN UsernameUtenteA VARCHAR(20), IN CodicePresentazioneA INT)
    BEGIN
    DECLARE UsernameI INT;
    DECLARE CodicePresentazioneI INT;
    SET UsernameI = (SELECT COUNT(*) FROM UTENTE WHERE (Username = UsernameUtenteA));
    SET CodicePresentazioneI = (SELECT COUNT(*) FROM TUTORIAL WHERE (CodicePresentazione = CodicePresentazioneA));

    IF(UsernameI = 1 AND CodicePresentazioneI = 1) THEN
        INSERT INTO RISORSA(UsernameUtente, Link, Descrizione, CodicePresentazione) 
            VALUES(UsernameUtenteA, LinkA, DescrizioneA, CodicePresentazioneA);
    END IF;
END&& 

/* TRIGGER */
DELIMITER $
CREATE TRIGGER IncrementoTotalePresentazioni 
AFTER INSERT ON ARTICOLATA 
FOR EACH ROW 
BEGIN     
UPDATE SESSIONE SET SESSIONE.TotalePresentazioni = SESSIONE.TotalePresentazioni + 1 WHERE SESSIONE.Codice = NEW.CodiceSessione; 
END;
$ DELIMITER ;

DELIMITER $
CREATE TRIGGER ControlloCodiceSessione
BEFORE INSERT ON ARTICOLATA
FOR EACH ROW 
BEGIN
    IF(NOT EXISTS(SELECT * FROM SESSIONE AS S WHERE S.Codice = NEW.CodiceSessione)) THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error CodiceSessione Errato';
    END IF;
END;
$ DELIMITER ;

DELIMITER $
CREATE TRIGGER CoperturaArticolo
BEFORE UPDATE ON ARTICOLO 
FOR EACH ROW 
BEGIN 
    IF(EXISTS(SELECT * FROM PRESENTER WHERE UsernameUtente = NEW.UsernameUtente )) THEN
        SET NEW.StatoSvolgimento = "COPERTO";
    END IF;
END;
$ DELIMITER ;