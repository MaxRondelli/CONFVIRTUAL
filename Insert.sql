/* Utente amministrore */
INSERT INTO UTENTE(Username, Nome, Cognome, LuogoDiNascita, DataDiNascita, Passwordd, Tipo) VALUES("Max", "Massimo", "Rondelli", "Bologna", '2000-05-14', "max123", 'AMMINISTRATORE');
INSERT INTO AMMINISTRATORE(UsernameUtente) VALUES("Max");

/* Utente Presenter */
INSERT INTO UTENTE(Username, Nome, Cognome, LuogoDiNascita, DataDiNascita, Passwordd, Tipo) VALUES("Giuli", "Giulia", "Monterosso", "Palermo", '2000-12-27', "giuli123", 'PRESENTER');
INSERT INTO UTENTE(Username, Nome, Cognome, LuogoDiNascita, DataDiNascita, Passwordd, Tipo) VALUES("Beppe", "Giuseppe", "Donvito", "Matera", '1998-03-15', "beppe123", 'PRESENTER');
INSERT INTO UTENTE(Username, Nome, Cognome, LuogoDiNascita, DataDiNascita, Passwordd, Tipo) VALUES("Ciccio", "Francesco", "Marino", "Catania", '1999-05-17', "ciccio123", 'PRESENTER');
INSERT INTO PRESENTER(UsernameUtente, Curriculum, Foto, NomeUniversita, NomeDipartimento) VALUES("Beppe", "Curriculum Giuseppe Donvito", null, "Politecnico di Milano", "Dipartimento di Design");
INSERT INTO PRESENTER(UsernameUtente, Curriculum, Foto, NomeUniversita, NomeDipartimento) VALUES("Ciccio", "Curriculum Francesco Marino", null, "Università degli Studi di Catania", "Dipartimento di Scienze Informatiche");
INSERT INTO PRESENTER(UsernameUtente, Curriculum, Foto, NomeUniversita, NomeDipartimento) VALUES("Giuli", "Curriculum Giulia Monterosso", null, "Università di Palermo", "Dipartimento di Ingegneria e Scienze Informatiche");

/*  Utente Speaker */
INSERT INTO UTENTE(Username, Nome, Cognome, LuogoDiNascita, DataDiNascita, Passwordd, Tipo) VALUES("Ale", "Alessia", "Gamberini", "Bologna", '2000-02-16', "ale123", 'SPEAKER');
INSERT INTO UTENTE(Username, Nome, Cognome, LuogoDiNascita, DataDiNascita, Passwordd, Tipo) VALUES("Bea", "Beatrice", "Bianchini", "Bologna", '1999-03-25', "bea123", 'SPEAKER');
INSERT INTO UTENTE(Username, Nome, Cognome, LuogoDiNascita, DataDiNascita, Passwordd, Tipo) VALUES("Ali", "Alice", "Nannini", "Bologna", '2000-01-23', "ali123", 'SPEAKER');
INSERT INTO SPEAKER(UsernameUtente, Foto, NomeUniversita, NomeDipartimento, Curriculum) VALUES("Bea", null, "Università di Bologna", "Dipartimento di Scienze Educative", "Curriculum Beatrice Bianchini");
INSERT INTO SPEAKER(UsernameUtente, Foto, NomeUniversita, NomeDipartimento, Curriculum) VALUES("Ale", null, "Università di Bologna", "Dipartimento di Economia", "Curriculum Alessia Gamberini");
INSERT INTO SPEAKER(UsernameUtente, Foto, NomeUniversita, NomeDipartimento, Curriculum) VALUES("Ali", null, "Università di Bologna", "Dipartimento di Scienze Politiche", "Curriculum Alice Nannini");

/*  Utente Speaker */
INSERT INTO UTENTE(Username, Nome, Cognome, LuogoDiNascita, DataDiNascita, Passwordd, Tipo) VALUES("Meggy", "Margherita", "Torri", "Faenza", '1999-07-20', "meggy123", 'BASE');
INSERT INTO UTENTE(Username, Nome, Cognome, LuogoDiNascita, DataDiNascita, Passwordd, Tipo) VALUES("Neroz", "Riccardo", "Nerozzi", "Bologna", '1999-09-24', "neroz123", 'BASE');
INSERT INTO UTENTE(Username, Nome, Cognome, LuogoDiNascita, DataDiNascita, Passwordd, Tipo) VALUES("Barto", "Marco", "Bartolotti", "Bologna", '2000-08-15', "barto123", 'BASE');

/*  CREAZIONE CONFERENZE */
INSERT INTO CONFERENZA(Nome, Acronimo, AnnoEdizione, Logo, Svolgimento, TotaleSponsorizzazione) VALUES("Foundations of Operations Research", "FOR", 2022, null, 'Attiva', 0);
INSERT INTO CREAZIONE(UsernameUtente, AnnoEdizione, Acronimo) VALUES("Max", 2022, "FOR");
INSERT INTO CONFERENZA(Nome, Acronimo, AnnoEdizione, Logo, Svolgimento, TotaleSponsorizzazione) VALUES("Computer Security", "CSY", 2022, null, 'Attiva', 0);
INSERT INTO CREAZIONE(UsernameUtente, AnnoEdizione, Acronimo) VALUES("Max", 2022, "CSY");
INSERT INTO CONFERENZA(Nome, Acronimo, AnnoEdizione, Logo, Svolgimento, TotaleSponsorizzazione) VALUES("Advanced Computer Architectures", "ADA", 2022, null, 'Attiva', 0);
INSERT INTO CREAZIONE(UsernameUtente, AnnoEdizione, Acronimo) VALUES("Max", 2022, "ADA");
INSERT INTO CONFERENZA(Nome, Acronimo, AnnoEdizione, Logo, Svolgimento, TotaleSponsorizzazione) VALUES("Offensive and Defensive Cybersecurity", "ODC", 2022, null, 'Attiva', 0);
INSERT INTO CREAZIONE(UsernameUtente, AnnoEdizione, Acronimo) VALUES("Max", 2022, "ODC");
INSERT INTO CONFERENZA(Nome, Acronimo, AnnoEdizione, Logo, Svolgimento, TotaleSponsorizzazione) VALUES("Cryptography and Architectures for Computer Security", "CAfCS", 2022, null, 'Attiva', 0);
INSERT INTO CREAZIONE(UsernameUtente, AnnoEdizione, Acronimo) VALUES("Max", 2022, "CAfCS");

/*  CREAZIONE DEL PROGRAMMA GIORNALIERA PER UNA SPECIFICA DATA */
INSERT INTO PROGRAMMA(IdProgramma, Data, AnnoEdizioneProgramma, AcronimoProgramma) VALUES(1, '2022-05-14', 2022, 'FOR');
INSERT INTO PROGRAMMA(IdProgramma, Data, AnnoEdizioneProgramma, AcronimoProgramma) VALUES(6, '2022-05-15', 2022, 'FOR');
INSERT INTO PROGRAMMA(IdProgramma, Data, AnnoEdizioneProgramma, AcronimoProgramma) VALUES(2, '2022-05-17', 2022, 'CSY');
INSERT INTO PROGRAMMA(IdProgramma, Data, AnnoEdizioneProgramma, AcronimoProgramma) VALUES(3, '2022-07-20', 2022, 'ADA');
INSERT INTO PROGRAMMA(IdProgramma, Data, AnnoEdizioneProgramma, AcronimoProgramma) VALUES(4, '2022-08-22', 2022, 'ODC');
INSERT INTO PROGRAMMA(IdProgramma, Data, AnnoEdizioneProgramma, AcronimoProgramma) VALUES(5, '2022-11-25', 2022, 'CAfCS');

/*  CREAZIONE DELLE SESSIONI PER LE CONFERENZE */
INSERT INTO SESSIONE(Codice, Link, Titolo, IdProgramma, OraInizio, OraFine, TotalePresentazioni) VALUES(1, "www.for_link_sessione.com", "Graph and Network Optimization", 1, '09:00:00', '12:00:00', 0);
INSERT INTO SESSIONE(Codice, Link, Titolo, IdProgramma, OraInizio, OraFine, TotalePresentazioni) VALUES(2, "www.for_link_sessione.com", "Linear Programming", 1, '15:00:00', '18:00:00', 0);
INSERT INTO SESSIONE(Codice, Link, Titolo, IdProgramma, OraInizio, OraFine, TotalePresentazioni) VALUES(3, "www.csy_link_sessione.com", "Security Engineering", 2, '11:00:00', '14:00:00', 0);
INSERT INTO SESSIONE(Codice, Link, Titolo, IdProgramma, OraInizio, OraFine, TotalePresentazioni) VALUES(4, "www.csy_link_sessione.com", "Ethical Hacking", 2, '17:00:00', '19:00:00', 0);
INSERT INTO SESSIONE(Codice, Link, Titolo, IdProgramma, OraInizio, OraFine, TotalePresentazioni) VALUES(5, "www.ada_link_sessione.com", "Pipelining and Multithreading", 3, '10:00:00', '13:00:00', 0);
INSERT INTO SESSIONE(Codice, Link, Titolo, IdProgramma, OraInizio, OraFine, TotalePresentazioni) VALUES(6, "www.ada_link_sessione.com", "Very long instruction word (VLIW)", 3, '15:00:00', '15:30:00', 0);
INSERT INTO SESSIONE(Codice, Link, Titolo, IdProgramma, OraInizio, OraFine, TotalePresentazioni) VALUES(7, "www.odc_link_sessione.com", "Offensive Technique", 4, '9:30:00', '11:00:00', 0);
INSERT INTO SESSIONE(Codice, Link, Titolo, IdProgramma, OraInizio, OraFine, TotalePresentazioni) VALUES(8, "www.odc_link_sessione.com", "Defensive Technique", 4, '15:00:00', '16:30:00', 0);
INSERT INTO SESSIONE(Codice, Link, Titolo, IdProgramma, OraInizio, OraFine, TotalePresentazioni) VALUES(9, "www.cafcs_link_sessione.com", "RSA Algorithm", 5, '10:00:00', '12:30:00', 0);
INSERT INTO SESSIONE(Codice, Link, Titolo, IdProgramma, OraInizio, OraFine, TotalePresentazioni) VALUES(10, "www.cafcs_link_sessione.com", "Secure Communication Protocols",5, '14:00:00', '16:00:00', 0);

/*  CREAZIONE DELLE PRESENTAZIONI, ARTICOLI E TUTORIAL  PER LE SESSIONI */
INSERT INTO PRESENTAZIONE(Codice, OraInizio, OraFine, NumeroSequenza) VALUES(1, '09:00:00', '12:00:00', 0);
INSERT INTO ARTICOLATA(CodiceSessione, CodicePresentazione) VALUES(1,1);
INSERT INTO ARTICOLO(Titolo, NumeroPagine, StatoSvolgimento, ParolaChiave, CodicePresentazione, UsernameUtente) VALUES("Graph and Network Optimization Lesson", 10, 'Coperto', "Lezione sui grafi e l'ottimizzazione dei network", 1, "Giuli");
INSERT INTO AUTORE(CodicePresentazione, Nome, Cognome) VALUES(1, "Giulia", "Monterosso");

INSERT INTO PRESENTAZIONE(Codice, OraInizio, OraFine, NumeroSequenza) VALUES(2, '15:00:00', '18:00:00', 0);
INSERT INTO ARTICOLATA(CodiceSessione, CodicePresentazione) VALUES(2,2);
INSERT INTO ARTICOLO(Titolo, NumeroPagine, StatoSvolgimento, ParolaChiave, CodicePresentazione, UsernameUtente) VALUES("Linear Programming Lesson", 10, 'Coperto', "Lezione sulla Programmazione Lineare", 2, "Giuli");
INSERT INTO AUTORE(CodicePresentazione, Nome, Cognome) VALUES(2, "Giulia", "Monterosso");

INSERT INTO PRESENTAZIONE(Codice, OraInizio, OraFine, NumeroSequenza) VALUES(3, '11:00:00', '14:00:00', 0);
INSERT INTO ARTICOLATA(CodiceSessione, CodicePresentazione) VALUES(3,3);
INSERT INTO ARTICOLO(Titolo, NumeroPagine, StatoSvolgimento, ParolaChiave, CodicePresentazione, UsernameUtente) VALUES("Security Engineering Lesson", 10, 'Coperto', "Lezione sulle tecniche di sicurezza informatica", 3, "Beppe");
INSERT INTO AUTORE(CodicePresentazione, Nome, Cognome) VALUES(3, "Giuseppe", "Donvito");

INSERT INTO PRESENTAZIONE(Codice, OraInizio, OraFine, NumeroSequenza) VALUES(4, '17:00:00', '19:00:00', 0);
INSERT INTO ARTICOLATA(CodiceSessione, CodicePresentazione) VALUES(4,4);
INSERT INTO ARTICOLO(Titolo, NumeroPagine, StatoSvolgimento, ParolaChiave, CodicePresentazione, UsernameUtente) VALUES("Ethical Hacking Lesson", 10, 'Coperto', "Che cosa significa Ethical Hacking?", 4, "Ciccio");
INSERT INTO AUTORE(CodicePresentazione, Nome, Cognome) VALUES(4, "Francesco", "Marino");

INSERT INTO PRESENTAZIONE(Codice, OraInizio, OraFine, NumeroSequenza) VALUES(5, '10:00:00', '13:00:00', 0);
INSERT INTO ARTICOLATA(CodiceSessione, CodicePresentazione) VALUES(5,5);
INSERT INTO TUTORIAL(CodicePresentazione, Titolo, Abstract) VALUES(5, "Pipelining and Multithreading Lesson", "Come funziona il Pipelining e il Multithreading...");
INSERT INTO PRESENTA(UsernameUtente, CodicePresentazione) VALUES("Ale",5);

INSERT INTO PRESENTAZIONE(Codice, OraInizio, OraFine, NumeroSequenza) VALUES(6, '15:00:00', '15:30:00', 0);
INSERT INTO ARTICOLATA(CodiceSessione, CodicePresentazione) VALUES(6,6);
INSERT INTO TUTORIAL(CodicePresentazione, Titolo, Abstract) VALUES(6, "Very long instruction word (VLIW) Lesson", "Che cos'è il VLIM?");
INSERT INTO PRESENTA(UsernameUtente, CodicePresentazione) VALUES("Ale",6);
