CREATE TABLE Usuario (
    id          INTEGER      NOT NULL,
    nombre      VARCHAR(30)  NOT NULL,
    clave       VARCHAR(15)  NOT NULL,
    CONSTRAINT PK_USER PRIMARY KEY (id)
);

CREATE TABLE Perfil (
    id          INTEGER     NOT NULL,
    apellido    VARCHAR(30) NOT NULL,
    nombre      VARCHAR(30) NOT NULL,
    correo      VARCHAR(30),
    CONSTRAINT PK_PERFIL PRIMARY KEY (id)
);

CREATE TABLE Usuario_Perfil (   
    idUsuario       INTEGER     NOT NULL,
    idPerfil        INTEGER     NOT NULL,

    CONSTRAINT FK_USUARIO_PERFIL PRIMARY KEY (idUsuario, idPerfil)
);

ALTER TABLE Usuario_Perfil ADD FOREIGN KEY (idUsuario) REFERENCES Usuario(id);
ALTER TABLE Usuario_Perfil ADD FOREIGN KEY (idPerfil) REFERENCES Perfil(id);