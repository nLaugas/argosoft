CREATE TABLE USUARIO (
    id          INTEGER      NOT NULL,
    nombre      VARCHAR(50)  NOT NULL,
    apellido    VARCHAR(50)  NOT NULL,
    clave       VARCHAR(30)  NOT NULL,
    email       VARCHAR(100),
    CONSTRAINT PK_USER PRIMARY KEY (id)
);

CREATE TABLE USUARIO (
    id          INTEGER      NOT NULL,
  email varchar(128) NOT NULL,
  full_name varchar(512) NOT NULL,
  password varchar(256) NOT NULL,
  status integer(11) NOT NULL,
  date_created timestamp ,
  pwd_reset_token varchar(32),
  pwd_reset_token_creation_date datetime,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_idx` (`email`)

CREATE TABLE PERFIL (
    id          INTEGER     NOT NULL,
    nombre      VARCHAR(50) NOT NULL,
    descripcion VARCHAR(100),
    CONSTRAINT PK_PERFIL PRIMARY KEY (id)
);

CREATE TABLE USUARIO_PERFIL (   
    idUsuario       INTEGER     NOT NULL,
    idPerfil        INTEGER     NOT NULL,

    CONSTRAINT FK_USUARIO_PERFIL PRIMARY KEY (idUsuario, idPerfil)
);

ALTER TABLE USUARIO_PERFIL ADD FOREIGN KEY (idUsuario) REFERENCES USUARIO(id);
ALTER TABLE USUARIO_PERFIL ADD FOREIGN KEY (idPerfil) REFERENCES PERFIL(id);


INSERT INTO USUARIO (id,nombre,apellido,clave,email) VALUES (1, 'Paul','Perez', '12345678','PaulPerez@gmail.com');
INSERT INTO USUARIO (id,nombre,apellido,clave,email) VALUES (2, 'Oscar','Garcia', '11111111','OscarGarcia@gmail.com');
INSERT INTO USUARIO (id,nombre,apellido,clave,email) VALUES (3, 'Eric','Tunez', '222222222','EricTunez@gmail.com');
INSERT INTO USUARIO (id,nombre,apellido,clave,email) VALUES (4, 'Marcos','Dominguez', 'sssssssss','MarcosDominguez@gmail.com');

INSERT INTO PERFIL (id,nombre,descripcion) VALUES (1, 'administrador','es un admin');
INSERT INTO PERFIL (id,nombre,descripcion) VALUES (2, 'empleado','es un empleado');

INSERT INTO USUARIO_PERFIL (idUsuario,idPerfil) VALUES (1, 1);
INSERT INTO USUARIO_PERFIL (idUsuario,idPerfil) VALUES (1, 2);
INSERT INTO USUARIO_PERFIL (idUsuario,idPerfil) VALUES (2, 1);
INSERT INTO USUARIO_PERFIL (idUsuario,idPerfil) VALUES (3, 2);
INSERT INTO USUARIO_PERFIL (idUsuario,idPerfil) VALUES (4, 2);
