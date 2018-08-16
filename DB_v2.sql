CREATE SEQUENCE user_seq;

CREATE TABLE usuario (
  id int NOT NULL DEFAULT NEXTVAL ('user_seq'),
  email                         VARCHAR(128) NOT NULL,
  full_name                     VARCHAR(512) NOT NULL,
  password                      VARCHAR(256) NOT NULL,
  status                        INT NOT NULL,
  date_created                  TIMESTAMP(0) NOT NULL,
  pwd_reset_token               VARCHAR(32) DEFAULT NULL,
  pwd_reset_token_creation_date TIMESTAMP(0) DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT email_idx UNIQUE  (email)
);

CREATE TABLE perfil (
    id           INT     NOT NULL,
    name         VARCHAR(50) NOT NULL,
    description  VARCHAR(100),
    date_created TIMESTAMP(0) NOT NULL,
    CONSTRAINT PK_PERFIL PRIMARY KEY (id)
);

CREATE TABLE usuario_perfil (   
    id            INT     NOT NULL,
    id_user       INT     NOT NULL,
    id_profile    INT     NOT NULL,
    FOREIGN KEY (id_user)     REFERENCES usuario(id),
    FOREIGN KEY (id_profile)  REFERENCES perfil(id),
    CONSTRAINT FK_USUARIO_PERFIL PRIMARY KEY (id_user, id_profile)
);

CREATE TABLE operacion (
    id      INT NOT NULL,
    name    VARCHAR(256) NOT NULL,
    route   VARCHAR(256) NOT NULL,
    CONSTRAINT PK_OPERACIONES PRIMARY KEY (id)
);

CREATE TABLE modulo (
    id            INT NOT NULL,
    name          VARCHAR(256) NOT NULL,
    template      VARCHAR(256) NOT NULL, -- un identificador para luego elegir que vista iria
    icon          VARCHAR(256) NOT NULL,
    id_module     INT,  
    id_operation  INT,
    CONSTRAINT PK_MODULO PRIMARY KEY (id),
    FOREIGN KEY (id_module) REFERENCES modulo(id)
);

CREATE TABLE modulo_perfil (   
    id_module     INT     NOT NULL,
    id_profile    INT     NOT NULL,
    FOREIGN KEY (id_module)   REFERENCES modulo(id),
    FOREIGN KEY (id_profile)  REFERENCES perfil(id),
    CONSTRAINT FK_MODULO_PERFIL PRIMARY KEY (id_module, id_profile)
);

CREATE TABLE modulo_operacion (   
    id_module     INT     NOT NULL,
    id_operation    INT     NOT NULL,
    FOREIGN KEY (id_module)   REFERENCES modulo(id),
    FOREIGN KEY (id_operation)  REFERENCES operacion(id),
    CONSTRAINT FK_MODULO_OPERACION PRIMARY KEY (id_module, id_operation)
);



CREATE TABLE step (
    id            INT NOT NULL,
    name          VARCHAR(256) NOT NULL,
    icon      VARCHAR(256) NOT NULL,
    CONSTRAINT PK_STEP PRIMARY KEY (id)
);

CREATE TABLE form (
    id            INT NOT NULL,
    name          VARCHAR(256) NOT NULL,
    template      VARCHAR(256) NOT NULL, 
    id_step        INT,
    FOREIGN KEY (id_step)  REFERENCES step(id), 
    CONSTRAINT PK_FORM PRIMARY KEY (id)
);



CREATE TABLE operation_step (   
    id_operation INT  NOT NULL,
    id_step       INT  NOT NULL,
    FOREIGN KEY (id_operation)   REFERENCES operacion(id),
    FOREIGN KEY (id_step)         REFERENCES step(id),
    CONSTRAINT FK_OPERATION_STEP  PRIMARY KEY (id_operation, id_step)
);
