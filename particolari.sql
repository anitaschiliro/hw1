
CREATE DATABASE PARTICOLARI;
USE PARTICOLARI;

CREATE TABLE CLIENTE(
    username varchar(255) primary key,
	email varchar(255),
    pwd varchar(255),
    nome varchar(255),
    cognome varchar(255)
    );

create table articoli(
    codice integer primary key,
    descrizione varchar(255),
    marca varchar(20),
    prezzo float not null,
    image varchar(255),
    num_recensioni integer
   );

create table disponibilità(
    codice integer,
    misura varchar(10),
    quantita integer,
    PRIMARY key(codice,misura),
    FOREIGN key (codice) REFERENCES articoli(codice)
    );
   
   create table carrello(
       username varchar(255),
       codice integer,
       descrizione varchar(255),
       marca varchar(20),
       prezzo float not null,
       image varchar(255),
       misura varchar(10),
       quantita integer,
       primary key(username,codice,misura),
       FOREIGN key (codice) REFERENCES articoli(codice),
       FOREIGN key (username) REFERENCES cliente(username)
   );

create table ordine(
    codice integer primary key AUTO_INCREMENT,
    cliente varchar(255),
    num_spedizione integer,
    indirizzo varchar(255),
    costo float,
    FOREIGN key (cliente) REFERENCES cliente(username)
    );

  create table acquisti(
      ordine integer,
      articolo integer,
      misura varchar(20),
      quantita integer,
      costo float,
      PRIMARY key(ordine,articolo),
      FOREIGN key (ordine) REFERENCES ordine(codice),
      FOREIGN key(articolo) REFERENCES articoli(codice)
      );

    create table recensione(
    ordine integer,
    articolo integer,
    username varchar(255),
    recensione varchar(255),
    primary key(ordine,articolo,username),
     FOREIGN key(ordine) REFERENCES ordine(codice),
      FOREIGN key (articolo) REFERENCES articoli(codice),
       FOREIGN key (username) REFERENCES cliente(username) 
       );
      
    create table home(
    id integer PRIMARY key AUTO_INCREMENT,
    titolo varchar(20),
    descrizione varchar(255),
    img varchar(255)
    );

    insert into home values (1,"0-36 mesi","Ti accompagniamo fin dalla nascita.","http://localhost/HW1/css/immagini/0_1.jpg");
    insert into home VALUES (2,"3-7 anni","Cresci con noi.","http://localhost/HW1/css/immagini/7_1.jpg");
    insert into home VALUES(3,"8-14 anni","Vivi le migliori avventure indossando i nostri capi.","http://localhost/HW1/css/immagini/14_1.jpg");

    INSERT INTO cliente values ("hello01","hello01@gmail.com","1234","Mario","Rossi");
    INSERT INTO cliente values ("peach","peach@gmail.com","0987","Bianca","Verdi");
    INSERT INTO cliente values ("mario","mario01@gmail.com","6543","Luca","Bianchi");

    insert into articoli values("1234","Abito neonata","IDo","49.90","css/immagini/0_1.jpg",0);
    insert into articoli values("5678","Bermuda bimbo","IDo","29.90","css/immagini/bermuda.png",0);
    insert into articoli values("5794","Tuta neonato","IDo","39.90","css/immagini/tuta_neonato.png",0);
    insert into articoli values("6734","Abito ragazza","IDo","59.90","css/immagini/abito_ragazza.png",0);
    insert into articoli values("3589","Tuta bimba","IDo","25.90","css/immagini/tuta_bimba.png",0);

    insert into disponibilità values("1234","9 mesi",1);  
    insert into disponibilità values("1234","12 mesi",1);
    insert into disponibilità values("1234","18 mesi",1);
    insert into disponibilità values("1234","24 mesi",1);
    insert into disponibilità values("5678","9 mesi",1);
    insert into disponibilità values("5678","12 mesi",1);
    insert into disponibilità values("5678","18 mesi",1);
    insert into disponibilità values("5678","24 mesi",1);
    insert into disponibilità values("5794","24 mesi",1);
    insert into disponibilità values("5794","12 mesi",1);
    insert into disponibilità values("5794","18 mesi",1);
    insert into disponibilità values("5794","36 mesi",1);
    insert into disponibilità values("6734","12 anni",1);
    insert into disponibilità values("6734","10 anni",1);
    insert into disponibilità values("6734","14 anni",1);
    insert into disponibilità values("6734","16 anni",1);
    insert into disponibilità values("6734","8 anni",1);
    insert into disponibilità values("6734","7 anni",1);
    insert into disponibilità values("3589","5 anni",1);
    insert into disponibilità values("3589","7 anni",1);
    insert into disponibilità values("3589","6 anni",1);
    insert into disponibilità values("3589","4 anni",2);
      
      
    insert into ordine values("1","peach","1020300","Via verdi 20, Catania",73.8);
    insert into ordine values("2","mario","1020301","Via garibaldi 20, Catania",13.90);
      
    INSERT into acquisti values ("1","3589","7 anni",1,"25.90");
    INSERT into acquisti values ("1","6734","12 anni",1,"59.90");
    INSERT into acquisti values ("2","3589","5 anni",1,"25.90");
      
    INSERT into recensione(ordine,articolo,username,recensione) values ("1","6734","peach","Taglia perfetta per la mia bambina!");
    INSERT into recensione(ordine,articolo,username,recensione) values ("2","3589","mario","Mia figlia l'ha adorata fin dall'inizio!
 Cotone di buona qualità.");

    insert into carrello values("peach","1234","Abito neonata","IDo","49.90","css/immagini/0_1.jpg","12 mesi","1");
    insert into carrello values("peach","5678","Bermuda bimbo","IDo","29.90","css/immagini/bermuda.png","12 mesi","1");

DELIMITER //
CREATE TRIGGER AGGIORNA_RECENSIONI 
after INSERT ON recensione 
FOR EACH ROW 
BEGIN
 UPDATE articoli 
 SET num_recensioni=num_recensioni+1 
 WHERE codice=new.articolo; 
END//
DELIMITER ;

DELIMITER //
CREATE TRIGGER ELIMINA_RECENSIONI 
after DELETE ON recensione 
FOR EACH ROW 
BEGIN
 UPDATE articoli 
 SET num_recensioni=num_recensioni-1 
 WHERE codice= old.articolo;
END//
DELIMITER;

DELIMITER //
CREATE TRIGGER AGGIORNA_DISPONIBILITA
after INSERT ON acquisti
FOR EACH ROW 
BEGIN
    IF EXISTS (SELECT * FROM disponibilità where disponibilità.codice=new.articolo and disponibilità.misura=new.misura and disponibilità.quantita>0)
    THEN
        UPDATE disponibilità
        SET quantita=quantita-NEW.quantita
        WHERE codice= new.articolo and disponibilità.misura=new.misura;
    END IF;
    IF EXISTS(SELECT * FROM disponibilità where disponibilità.codice=new.articolo and disponibilità.misura=new.misura and disponibilità.quantita=0)
    THEN
        DELETE FROM disponibilità
        WHERE codice= new.articolo and disponibilità.misura=new.misura;
    END IF;
END//
DELIMITER;

DELIMITER //
CREATE TRIGGER UPDATE_CARRELLO
BEFORE UPDATE ON carrello
FOR EACH ROW 
BEGIN
    IF EXISTS (SELECT * FROM disponibilità where disponibilità.codice=new.codice and disponibilità.misura=new.misura and disponibilità.quantita<NEW.quantita)
    THEN
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT= 'Quantità non disponibile!';
    END IF;
END//

CREATE TRIGGER INSERT_CARRELLO
BEFORE INSERT ON carrello
FOR EACH ROW 
BEGIN
    IF EXISTS (SELECT * FROM disponibilità where disponibilità.codice=new.codice and disponibilità.misura=new.misura and disponibilità.quantita<NEW.quantita)
    THEN
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT= 'Quantità non disponibile!';
    END IF;
END//

