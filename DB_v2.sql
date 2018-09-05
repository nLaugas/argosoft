-- CREATE SEQUENCE user_seq;

-- CREATE TABLE usuario (
--   id int NOT NULL DEFAULT NEXTVAL ('user_seq'),
--   email                         VARCHAR(128) NOT NULL,
--   full_name                     VARCHAR(512) NOT NULL,
--   password                      VARCHAR(256) NOT NULL,
--   status                        INT NOT NULL,
--   date_created                  TIMESTAMP(0) NOT NULL,
--   pwd_reset_token               VARCHAR(32) DEFAULT NULL,
--   pwd_reset_token_creation_date TIMESTAMP(0) DEFAULT NULL,
--   PRIMARY KEY (id),
--   CONSTRAINT email_idx UNIQUE  (email)
-- );

-- CREATE TABLE perfil (
--     id           INT     NOT NULL,
--     name         VARCHAR(50) NOT NULL,
--     description  VARCHAR(100),
--     date_created TIMESTAMP(0) NOT NULL,
--     CONSTRAINT PK_PERFIL PRIMARY KEY (id)
-- );

-- CREATE TABLE usuario_perfil (   
--     id            INT     NOT NULL,
--     id_user       INT     NOT NULL,
--     id_profile    INT     NOT NULL,
--     FOREIGN KEY (id_user)     REFERENCES usuario(id),
--     FOREIGN KEY (id_profile)  REFERENCES perfil(id),
--     CONSTRAINT FK_USUARIO_PERFIL PRIMARY KEY (id_user, id_profile)
-- );

-- CREATE TABLE operacion (
--     id      INT NOT NULL,
--     name    VARCHAR(256) NOT NULL,
--     route   VARCHAR(256) NOT NULL,
--     CONSTRAINT PK_OPERACIONES PRIMARY KEY (id)
-- );

-- CREATE TABLE modulo (
--     id            INT NOT NULL,
--     name          VARCHAR(256) NOT NULL,
--     template      VARCHAR(256) NOT NULL, -- un identificador para luego elegir que vista iria
--     icon          VARCHAR(256) NOT NULL,
--     id_module     INT,  
--     id_operation  INT,
--     CONSTRAINT PK_MODULO PRIMARY KEY (id),
--     FOREIGN KEY (id_module) REFERENCES modulo(id)
-- );

-- CREATE TABLE modulo_perfil (   
--     id_module     INT     NOT NULL,
--     id_profile    INT     NOT NULL,
--     FOREIGN KEY (id_module)   REFERENCES modulo(id),
--     FOREIGN KEY (id_profile)  REFERENCES perfil(id),
--     CONSTRAINT FK_MODULO_PERFIL PRIMARY KEY (id_module, id_profile)
-- );

-- CREATE TABLE modulo_operacion (   
--     id_module     INT     NOT NULL,
--     id_operation    INT     NOT NULL,
--     FOREIGN KEY (id_module)   REFERENCES modulo(id),
--     FOREIGN KEY (id_operation)  REFERENCES operacion(id),
--     CONSTRAINT FK_MODULO_OPERACION PRIMARY KEY (id_module, id_operation)
-- );



-- CREATE TABLE step (
--     id            INT NOT NULL,
--     name          VARCHAR(256) NOT NULL,
--     icon      VARCHAR(256) NOT NULL,
--     CONSTRAINT PK_STEP PRIMARY KEY (id)
-- );

-- CREATE TABLE form (
--     id            INT NOT NULL,
--     name          VARCHAR(256) NOT NULL,
--     template      VARCHAR(256) NOT NULL, 
--     id_step        INT,
--     FOREIGN KEY (id_step)  REFERENCES step(id), 
--     CONSTRAINT PK_FORM PRIMARY KEY (id)
-- );



-- CREATE TABLE operation_step (   
--     id_operation INT  NOT NULL,
--     id_step       INT  NOT NULL,
--     FOREIGN KEY (id_operation)   REFERENCES operacion(id),
--     FOREIGN KEY (id_step)         REFERENCES step(id),
--     CONSTRAINT FK_OPERATION_STEP  PRIMARY KEY (id_operation, id_step)
-- );


  -- \connect "argosoft";




  CREATE TABLE permit (
      id                       INT NOT NULL,
      id_general_permit         INT,
      id_protection_permit      INT,
      id_enviromental_permit    INT,
      id_residual_permit        INT,
      CONSTRAINT  PK_PERMIT  PRIMARY KEY (id),
      CONSTRAINT FK_GENERAL_PERMIT FOREIGN KEY (id_general_permit) REFERENCES general_permit(id),
      CONSTRAINT FK_PROTECTION_PERMIT FOREIGN KEY (id_protection_permit) REFERENCES protection_permit(id),
      CONSTRAINT FK_ENVIROMENTAL_PERMIT FOREIGN KEY (id_enviromental_permit) REFERENCES enviromental_permit(id),
      CONSTRAINT FK_RESIDUAL_PERMIT FOREIGN KEY (id_residual_permit) REFERENCES residual_permit(id),
  );    

  CREATE TABLE general_permit (
      id            INT NOT NULL,
      date          TIMESTAMP(0) NOT NULL,
      company       VARCHAR(256) NOT NULL, 
      work_place    VARCHAR(256) NOT NULL, 
      work_stage    VARCHAR(256) NOT NULL, 
      work_activity VARCHAR(256) NOT NULL,  
      CONSTRAINT PK_GENERAL_PERMIT PRIMARY KEY (id)
  );

  CREATE TABLE protection_state (
      id            INT NOT NULL
      name_state    VARCHAR(256) NOT NULL,
      CONSTRAINT PK_PROTECTION_STATE PRIMARY KEY (id)
  );

  CREATE TABLE protection_permit (
      id            INT NOT NULL,
      id_state      INT NOT NULL,
      CONSTRAINT FK_PROTECTION_STATE  FOREIGN KEY (id_state) REFERENCES protection_state(id),
      CONSTRAINT PK_PROTECTION_PERMITS PRIMARY KEY (id)
  );

  CREATE TABLE residual_permit (
      id               INT NOT NULL,
      team_pressure    INT,
      team_temperature INT,
      products         VARCHAR(256) NOT NULL,    
      CONSTRAINT PK_RESIDUAL_PERMITS PRIMARY KEY (id)
  );
  
  CREATE TABLE enviromental_permit (
      id            INT NOT NULL
      
      CONSTRAINT PK_ENVIROMENTAL_PERMIT PRIMARY KEY (id)
  );

DROP TABLE IF EXISTS "modulo";
CREATE TABLE "public"."modulo" (
    "id" integer NOT NULL,
    "name" character varying(256) NOT NULL,
    "template" character varying(256) NOT NULL,
    "id_module" integer,
    "icon" character varying(256),
    CONSTRAINT "pk_modulo" PRIMARY KEY ("id"),
    CONSTRAINT "modulo_id_module_fkey" FOREIGN KEY (id_module) REFERENCES modulo(id) NOT DEFERRABLE
) WITH (oids = false);

INSERT INTO "modulo" ("id", "name", "template", "id_module", "icon") VALUES
(3, 'Permisos', 'permisos_template',  NULL, 'glyphicon-paperclip'),
(2, 'Mostrar Usuarios', 'addUser_template', NULL, 'glyphicon-user'),
(1, 'Agentes',  'agentes_template', NULL, 'glyphicon-phone-alt'),
(4, 'Salir',  'logout', NULL, 'glyphicon-log-out');

update modulo set name = 'Agentes', template = 'agentes_template', icon = 'glyphicon-phone-alt' where id=1;


DROP TABLE IF EXISTS "operacion";
CREATE TABLE "public"."operacion" (
    "id" integer NOT NULL,
    "name" character varying(256) NOT NULL,
    "route" character varying(256) NOT NULL,
    CONSTRAINT "pk_operaciones" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "operacion" ("id", "name", "route") VALUES
(1, 'users',  'users'),
(2, 'operations', 'operations');



DROP TABLE IF EXISTS "perfil";
CREATE TABLE "public"."perfil" (
    "id" integer NOT NULL,
    "name" character varying(50) NOT NULL,
    "description" character varying(100),
    "date_created" timestamp(0) NOT NULL,
    CONSTRAINT "pk_perfil" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "perfil" ("id", "name", "description", "date_created") VALUES
(1, 'administrador',  NULL, '2018-07-26 20:49:51'),
(2, 'user', NULL, '2018-07-29 22:42:14');

DROP TABLE IF EXISTS "tab";
CREATE TABLE "public"."tab" (
    "id" integer NOT NULL,
    "name" character varying(256) NOT NULL,
    "icon" character varying(256) NOT NULL,
    CONSTRAINT "pk_tab" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "tab" ("id", "name", "icon") VALUES
(3, 'residuales', 'glyphicon-remove'),
(2, 'proteccion', 'glyphicon-tags'),
(4, 'ambientales',  'glyphicon-ok'),
(1, 'general',  'glyphicon-th');

DROP TABLE IF EXISTS "usuario";
DROP SEQUENCE IF EXISTS usuario_id_seq;
CREATE SEQUENCE usuario_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

DROP TABLE IF EXISTS "ficha";
CREATE TABLE "public"."ficha" (
    "id" integer NOT NULL,
    "name" character varying(256) NOT NULL,
    "template" character varying(256) NOT NULL,
    "id_tab" integer,
    CONSTRAINT "pk_record" PRIMARY KEY ("id"),
    CONSTRAINT "record_id_tab_fkey" FOREIGN KEY (id_tab) REFERENCES tab(id) NOT DEFERRABLE
) WITH (oids = false);

INSERT INTO "ficha" ("id", "name", "template", "id_tab") VALUES
(1, 'Datos Generales',  '/datos_generales', 1);

CREATE TABLE "public"."usuario" (
    "id" integer DEFAULT nextval('usuario_id_seq') NOT NULL,
    "email" character varying(128) NOT NULL,
    "full_name" character varying(512) NOT NULL,
    "password" character varying(256) NOT NULL,
    "status" integer NOT NULL,
    "date_created" timestamp(0) NOT NULL,
    "pwd_reset_token" character varying(32),
    "pwd_reset_token_creation_date" timestamp(0),
    CONSTRAINT "email_idx" UNIQUE ("email"),
    CONSTRAINT "usuario_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "usuario" ("id", "email", "full_name", "password", "status", "date_created", "pwd_reset_token", "pwd_reset_token_creation_date") VALUES
(4, 'nicolasdaniellaugas@gmail.com',  'Nico', '$2y$10$UXWM10anp1CZjEgGKBSFFuyel2hUiDSHaXHoSQPoMs870Azs7bmFe', 1,  '2018-07-21 12:52:29',  NULL, NULL),
(1, 'admin@example.com',  'Admin',  '$2y$10$vAkgnvtgE.NEah3c7Bth8uLlsfIRjIYyNuKD1z/mHKyZVcVw9P5um', 1,  '2018-07-19 22:03:51',  NULL, NULL);

DROP TABLE IF EXISTS "usuario_perfil";
CREATE TABLE "public"."usuario_perfil" (
    "id" integer NOT NULL,
    "id_user" integer NOT NULL,
    "id_profile" integer NOT NULL,
    CONSTRAINT "fk_usuario_perfil" PRIMARY KEY ("id_user", "id_profile"),
    CONSTRAINT "usuario_perfil_id_profile_fkey" FOREIGN KEY (id_profile) REFERENCES perfil(id) NOT DEFERRABLE,
    CONSTRAINT "usuario_perfil_id_user_fkey" FOREIGN KEY (id_user) REFERENCES usuario(id) NOT DEFERRABLE
) WITH (oids = false);

INSERT INTO "usuario_perfil" ("id", "id_user", "id_profile") VALUES
(1, 1,  1),
(2, 4,  2);

DROP TABLE IF EXISTS "modulo_operacion";
CREATE TABLE "public"."modulo_operacion" (
    "id_module" integer NOT NULL,
    "id_operation" integer NOT NULL,
    CONSTRAINT "fk_modulo_operacion" PRIMARY KEY ("id_module", "id_operation"),
    CONSTRAINT "modulo_operacion_id_module_fkey" FOREIGN KEY (id_module) REFERENCES modulo(id) NOT DEFERRABLE,
    CONSTRAINT "modulo_operacion_id_operation_fkey" FOREIGN KEY (id_operation) REFERENCES operacion(id) NOT DEFERRABLE
) WITH (oids = false);

INSERT INTO "modulo_operacion" ("id_module", "id_operation") VALUES
(2, 1),
(3, 2);

DROP TABLE IF EXISTS "modulo_perfil";
CREATE TABLE "public"."modulo_perfil" (
    "id_module" integer NOT NULL,
    "id_profile" integer NOT NULL,
    CONSTRAINT "fk_modulo_perfil" PRIMARY KEY ("id_module", "id_profile"),
    CONSTRAINT "modulo_perfil_id_module_fkey" FOREIGN KEY (id_module) REFERENCES modulo(id) NOT DEFERRABLE,
    CONSTRAINT "modulo_perfil_id_profile_fkey" FOREIGN KEY (id_profile) REFERENCES perfil(id) NOT DEFERRABLE
) WITH (oids = false);

INSERT INTO "modulo_perfil" ("id_module", "id_profile") VALUES
(1, 1),
(2, 1),
(3, 1),
(1, 2),
(4, 2),
(4, 1),
(3, 2);

DROP TABLE IF EXISTS "operation_tab";
CREATE TABLE "public"."operation_tab" (
    "id_operation" integer NOT NULL,
    "id_tab" integer NOT NULL,
    CONSTRAINT "fk_operation_tab" PRIMARY KEY ("id_operation", "id_tab"),
    CONSTRAINT "operation_tab_id_operation_fkey" FOREIGN KEY (id_operation) REFERENCES operacion(id) NOT DEFERRABLE,
    CONSTRAINT "operation_tab_id_tab_fkey" FOREIGN KEY (id_tab) REFERENCES tab(id) NOT DEFERRABLE
) WITH (oids = false);

INSERT INTO "operation_tab" ("id_operation", "id_tab") VALUES
(2, 1),
(2, 2);
-- 2018-08-17 23:55:19.415942+00