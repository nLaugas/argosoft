CREATE SEQUENCE user_seq;

CREATE TABLE usuario (
  id int NOT NULL DEFAULT NEXTVAL ('user_seq'),
  email varchar(128) NOT NULL,
  full_name varchar(512) NOT NULL,
  password varchar(256) NOT NULL,
  status int NOT NULL,
  date_created timestamp(0) NOT NULL,
  pwd_reset_token varchar(32) DEFAULT NULL,
  pwd_reset_token_creation_date timestamp(0) DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT email_idx UNIQUE  (email)
);
