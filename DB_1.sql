CREATE TABLE Usuario (
    idUsuario          INTEGER      NOT NULL,
    nombre      VARCHAR(30)  NOT NULL,
    clave       VARCHAR(15)  NOT NULL,
    CONSTRAINT PK_USER PRIMARY KEY (idUsuario)
);

CREATE TABLE Perfil (
    idPerfil          INTEGER     NOT NULL,
    apellido    VARCHAR(30) NOT NULL,
    nombre      VARCHAR(30) NOT NULL,
    correo      VARCHAR(30),
    CONSTRAINT PK_PERFIL PRIMARY KEY (idPerfil)
);

CREATE TABLE Usuario_Perfil (   
    id_Usuario       INTEGER     NOT NULL,
    id_Perfil        INTEGER     NOT NULL,

    CONSTRAINT FK_USUARIO_PERFIL PRIMARY KEY (idUsuario, idPerfil)
);

ALTER TABLE Usuario_Perfil ADD FOREIGN KEY (id_usuario) REFERENCES Usuario(idUsuario);
ALTER TABLE Usuario_Perfil ADD FOREIGN KEY (id_perfil) REFERENCES Perfil(idPerfil);