--
-- PostgreSQL database dump
--

-- Dumped from database version 10.4
-- Dumped by pg_dump version 10.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

ALTER TABLE ONLY public.usuario_perfil DROP CONSTRAINT usuario_perfil_id_user_fkey;
ALTER TABLE ONLY public.usuario_perfil DROP CONSTRAINT usuario_perfil_id_profile_fkey;
ALTER TABLE ONLY public.ficha DROP CONSTRAINT record_id_tab_fkey;
ALTER TABLE ONLY public.operation_tab DROP CONSTRAINT operation_tab_id_tab_fkey;
ALTER TABLE ONLY public.operation_tab DROP CONSTRAINT operation_tab_id_operation_fkey;
ALTER TABLE ONLY public.modulo_perfil DROP CONSTRAINT modulo_perfil_id_profile_fkey;
ALTER TABLE ONLY public.modulo_perfil DROP CONSTRAINT modulo_perfil_id_module_fkey;
ALTER TABLE ONLY public.modulo_operacion DROP CONSTRAINT modulo_operacion_id_operation_fkey;
ALTER TABLE ONLY public.modulo_operacion DROP CONSTRAINT modulo_operacion_id_module_fkey;
ALTER TABLE ONLY public.modulo DROP CONSTRAINT modulo_id_module_fkey;
ALTER TABLE ONLY public.company DROP CONSTRAINT fk_company_user;
ALTER TABLE ONLY public.personal DROP CONSTRAINT fk_company;
ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_pkey;
ALTER TABLE ONLY public.tab DROP CONSTRAINT pk_tab;
ALTER TABLE ONLY public.residual_permit DROP CONSTRAINT pk_residual_permits;
ALTER TABLE ONLY public.ficha DROP CONSTRAINT pk_record;
ALTER TABLE ONLY public.perfil DROP CONSTRAINT pk_perfil;
ALTER TABLE ONLY public.operacion DROP CONSTRAINT pk_operaciones;
ALTER TABLE ONLY public.modulo DROP CONSTRAINT pk_modulo;
ALTER TABLE ONLY public.general DROP CONSTRAINT pk_general;
ALTER TABLE ONLY public.personal DROP CONSTRAINT personal_pkey;
ALTER TABLE ONLY public.usuario_perfil DROP CONSTRAINT fk_usuario_perfil;
ALTER TABLE ONLY public.operation_tab DROP CONSTRAINT fk_operation_tab;
ALTER TABLE ONLY public.modulo_perfil DROP CONSTRAINT fk_modulo_perfil;
ALTER TABLE ONLY public.modulo_operacion DROP CONSTRAINT fk_modulo_operacion;
ALTER TABLE ONLY public.usuario DROP CONSTRAINT email_idx;
ALTER TABLE ONLY public.personal DROP CONSTRAINT email_id_personal;
ALTER TABLE ONLY public.company DROP CONSTRAINT company_pkey;
DROP TABLE public.usuario_perfil;
DROP TABLE public.usuario;
DROP SEQUENCE public.usuario_id_seq;
DROP TABLE public.tab;
DROP TABLE public.residual_permit;
DROP SEQUENCE public.residual_permit_id_seq;
DROP TABLE public.personal;
DROP SEQUENCE public.personal_id_seq;
DROP TABLE public.perfil;
DROP TABLE public.operation_tab;
DROP TABLE public.operacion;
DROP TABLE public.modulo_perfil;
DROP TABLE public.modulo_operacion;
DROP TABLE public.modulo;
DROP TABLE public.general;
DROP SEQUENCE public.general_id_seq;
DROP TABLE public.ficha;
DROP TABLE public.company;
DROP SEQUENCE public.company_id_seq;
DROP EXTENSION plpgsql;
DROP SCHEMA public;
--
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO postgres;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: company_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.company_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.company_id_seq OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: company; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.company (
    id integer DEFAULT nextval('public.company_id_seq'::regclass) NOT NULL,
    id_user integer NOT NULL,
    email character varying(128),
    name character varying(512) NOT NULL,
    address character varying(256),
    cuit integer,
    date_created timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.company OWNER TO postgres;

--
-- Name: ficha; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ficha (
    id integer NOT NULL,
    name character varying(256) NOT NULL,
    template character varying(256) NOT NULL,
    id_tab integer,
    status smallint
);


ALTER TABLE public.ficha OWNER TO postgres;

--
-- Name: general_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.general_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.general_id_seq OWNER TO postgres;

--
-- Name: general; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.general (
    id integer DEFAULT nextval('public.general_id_seq'::regclass) NOT NULL,
    date timestamp(0) without time zone NOT NULL,
    company character varying(256) NOT NULL,
    work_place character varying(256) NOT NULL,
    work_stage character varying(256) NOT NULL,
    work_activity character varying(256) NOT NULL
);


ALTER TABLE public.general OWNER TO postgres;

--
-- Name: modulo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.modulo (
    id integer NOT NULL,
    name character varying(256) NOT NULL,
    template character varying(256) NOT NULL,
    id_module integer,
    icon character varying(256)
);


ALTER TABLE public.modulo OWNER TO postgres;

--
-- Name: modulo_operacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.modulo_operacion (
    id_module integer NOT NULL,
    id_operation integer NOT NULL
);


ALTER TABLE public.modulo_operacion OWNER TO postgres;

--
-- Name: modulo_perfil; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.modulo_perfil (
    id_module integer NOT NULL,
    id_profile integer NOT NULL
);


ALTER TABLE public.modulo_perfil OWNER TO postgres;

--
-- Name: operacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.operacion (
    id integer NOT NULL,
    name character varying(256) NOT NULL,
    route character varying(256) NOT NULL
);


ALTER TABLE public.operacion OWNER TO postgres;

--
-- Name: operation_tab; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.operation_tab (
    id_operation integer NOT NULL,
    id_tab integer NOT NULL
);


ALTER TABLE public.operation_tab OWNER TO postgres;

--
-- Name: perfil; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.perfil (
    id integer NOT NULL,
    name character varying(50) NOT NULL,
    description character varying(100),
    date_created timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.perfil OWNER TO postgres;

--
-- Name: personal_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.personal_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personal_id_seq OWNER TO postgres;

--
-- Name: personal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personal (
    id integer DEFAULT nextval('public.personal_id_seq'::regclass) NOT NULL,
    email character varying(128) NOT NULL,
    full_name character varying(512) NOT NULL,
    date_created timestamp(0) without time zone NOT NULL,
    seniority integer,
    id_company integer NOT NULL
);


ALTER TABLE public.personal OWNER TO postgres;

--
-- Name: residual_permit_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.residual_permit_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.residual_permit_id_seq OWNER TO postgres;

--
-- Name: residual_permit; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.residual_permit (
    id integer DEFAULT nextval('public.residual_permit_id_seq'::regclass) NOT NULL,
    team_pressure integer,
    team_temperature integer,
    products character varying(256) NOT NULL
);


ALTER TABLE public.residual_permit OWNER TO postgres;

--
-- Name: tab; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tab (
    id integer NOT NULL,
    name character varying(256) NOT NULL,
    icon character varying(256) NOT NULL
);


ALTER TABLE public.tab OWNER TO postgres;

--
-- Name: usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_id_seq OWNER TO postgres;

--
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario (
    id integer DEFAULT nextval('public.usuario_id_seq'::regclass) NOT NULL,
    email character varying(128) NOT NULL,
    full_name character varying(512) NOT NULL,
    password character varying(256) NOT NULL,
    status integer NOT NULL,
    date_created timestamp(0) without time zone NOT NULL,
    pwd_reset_token character varying(32),
    pwd_reset_token_creation_date timestamp(0) without time zone
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- Name: usuario_perfil; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario_perfil (
    id_user integer NOT NULL,
    id_profile integer NOT NULL
);


ALTER TABLE public.usuario_perfil OWNER TO postgres;

--
-- Data for Name: company; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.company (id, id_user, email, name, address, cuit, date_created) FROM stdin;
7	15	\N	Coca-Cola	\N	\N	2018-09-27 15:27:12
8	16	\N	Arcor	\N	\N	2018-09-27 15:39:17
9	17	\N	Argosoft	\N	\N	2018-09-28 20:11:28
10	18	\N		\N	\N	2018-10-02 18:45:41
\.


--
-- Data for Name: ficha; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ficha (id, name, template, id_tab, status) FROM stdin;
1	Datos Generales	/datos_generales	1	\N
\.


--
-- Data for Name: general; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.general (id, date, company, work_place, work_stage, work_activity) FROM stdin;
1	2018-09-05 19:30:51	claro	soldadura	Pintura	Romper
2	2018-09-05 19:31:17	nextel	soldadura	Pintura	Lavar
3	2018-09-05 21:09:21	claro	soldadura	Pintura	Romper
5	2018-09-07 17:30:36	coca-cola	tecnica	Pintura	Romper
7	2018-09-10 16:04:25	coca-cola	tecnica	Pintura	Romper
\.


--
-- Data for Name: modulo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.modulo (id, name, template, id_module, icon) FROM stdin;
3	Permisos	permisos_template	\N	glyphicon-paperclip
5	Consultas	check-work-permits	\N	glyphicon-search
10	Salir	logout	\N	glyphicon-log-out
6	ART	art	\N	glyphicon-plus
7	Empresa	company	\N	glyphicon-home
1	Personal	personal	\N	glyphicon-user
2	Usuarios	addUser_template	\N	glyphicon-user
\.


--
-- Data for Name: modulo_operacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.modulo_operacion (id_module, id_operation) FROM stdin;
2	1
3	2
\.


--
-- Data for Name: modulo_perfil; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.modulo_perfil (id_module, id_profile) FROM stdin;
2	1
3	1
1	2
5	1
10	1
6	2
7	2
10	2
\.


--
-- Data for Name: operacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.operacion (id, name, route) FROM stdin;
1	users	users
2	operations	operations
\.


--
-- Data for Name: operation_tab; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.operation_tab (id_operation, id_tab) FROM stdin;
2	1
2	2
\.


--
-- Data for Name: perfil; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.perfil (id, name, description, date_created) FROM stdin;
1	administrador	\N	2018-07-26 20:49:51
2	Contratista	\N	2018-07-29 22:42:14
\.


--
-- Data for Name: personal; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.personal (id, email, full_name, date_created, seniority, id_company) FROM stdin;
8	fede@gmail.com	fede	2018-09-27 15:38:01	4	7
9	miguel@gmail.com	miguel	2018-09-27 15:39:55	5	8
10	nicolasdaniellaugas@gmail.com	nico	2018-09-28 20:12:11	1	9
\.


--
-- Data for Name: residual_permit; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.residual_permit (id, team_pressure, team_temperature, products) FROM stdin;
1	3	432	llave
2	2	2	llave
3	2	6	llave
5	3	3	termocupla
7	5	5	llave
\.


--
-- Data for Name: tab; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tab (id, name, icon) FROM stdin;
3	residuales	glyphicon-remove
2	proteccion	glyphicon-tags
1	general	glyphicon-th
4	proteccion	glyphicon-ok
\.


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuario (id, email, full_name, password, status, date_created, pwd_reset_token, pwd_reset_token_creation_date) FROM stdin;
1	admin@example.com	Admin	$2y$10$UXWM10anp1CZjEgGKBSFFuyel2hUiDSHaXHoSQPoMs870Azs7bmFe	1	2018-07-19 22:03:51	\N	\N
15	cocacola@gmail.com	Carlos	$2y$10$HbkLVRFQOhDFi9Gq9ZvkoeWmvbtDyqjrBZYsKpXRl2qTh1TiRQ3rS	1	2018-09-27 15:27:12	\N	\N
16	arcor@gmail.com	arcor	$2y$10$3A1o5oB6BLQTlvmM0pIf1uWFosvFj.ucJbCK5QX.cY/d3t9f1zvXG	1	2018-09-27 15:39:17	\N	\N
17	mariano@gmail.com	Mariano	$2y$10$N0rVJCe8reoE9GoHT9QOHOGUfmuNU7wvu/OIAbrZ3c2cbbqxK5akK	1	2018-09-28 20:11:28	\N	\N
18	administrador@gmail.com	administrador	$2y$10$v4qJO8v61eEZEB2nzHxT1ulM1OEj31PznUw/2pvdDT1kYCr0F0qCK	1	2018-10-02 18:45:41	\N	\N
\.


--
-- Data for Name: usuario_perfil; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuario_perfil (id_user, id_profile) FROM stdin;
1	1
15	2
16	2
17	2
18	1
\.


--
-- Name: company_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.company_id_seq', 10, true);


--
-- Name: general_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.general_id_seq', 8, true);


--
-- Name: personal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personal_id_seq', 10, true);


--
-- Name: residual_permit_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.residual_permit_id_seq', 8, true);


--
-- Name: usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuario_id_seq', 18, true);


--
-- Name: company company_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.company
    ADD CONSTRAINT company_pkey PRIMARY KEY (id);


--
-- Name: personal email_id_personal; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal
    ADD CONSTRAINT email_id_personal UNIQUE (email);


--
-- Name: usuario email_idx; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT email_idx UNIQUE (email);


--
-- Name: modulo_operacion fk_modulo_operacion; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.modulo_operacion
    ADD CONSTRAINT fk_modulo_operacion PRIMARY KEY (id_module, id_operation);


--
-- Name: modulo_perfil fk_modulo_perfil; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.modulo_perfil
    ADD CONSTRAINT fk_modulo_perfil PRIMARY KEY (id_module, id_profile);


--
-- Name: operation_tab fk_operation_tab; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.operation_tab
    ADD CONSTRAINT fk_operation_tab PRIMARY KEY (id_operation, id_tab);


--
-- Name: usuario_perfil fk_usuario_perfil; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_perfil
    ADD CONSTRAINT fk_usuario_perfil PRIMARY KEY (id_user, id_profile);


--
-- Name: personal personal_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal
    ADD CONSTRAINT personal_pkey PRIMARY KEY (id);


--
-- Name: general pk_general; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.general
    ADD CONSTRAINT pk_general PRIMARY KEY (id);


--
-- Name: modulo pk_modulo; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.modulo
    ADD CONSTRAINT pk_modulo PRIMARY KEY (id);


--
-- Name: operacion pk_operaciones; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.operacion
    ADD CONSTRAINT pk_operaciones PRIMARY KEY (id);


--
-- Name: perfil pk_perfil; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.perfil
    ADD CONSTRAINT pk_perfil PRIMARY KEY (id);


--
-- Name: ficha pk_record; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ficha
    ADD CONSTRAINT pk_record PRIMARY KEY (id);


--
-- Name: residual_permit pk_residual_permits; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.residual_permit
    ADD CONSTRAINT pk_residual_permits PRIMARY KEY (id);


--
-- Name: tab pk_tab; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tab
    ADD CONSTRAINT pk_tab PRIMARY KEY (id);


--
-- Name: usuario usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id);


--
-- Name: personal fk_company; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal
    ADD CONSTRAINT fk_company FOREIGN KEY (id_company) REFERENCES public.company(id);


--
-- Name: company fk_company_user; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.company
    ADD CONSTRAINT fk_company_user FOREIGN KEY (id_user) REFERENCES public.usuario(id);


--
-- Name: modulo modulo_id_module_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.modulo
    ADD CONSTRAINT modulo_id_module_fkey FOREIGN KEY (id_module) REFERENCES public.modulo(id);


--
-- Name: modulo_operacion modulo_operacion_id_module_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.modulo_operacion
    ADD CONSTRAINT modulo_operacion_id_module_fkey FOREIGN KEY (id_module) REFERENCES public.modulo(id);


--
-- Name: modulo_operacion modulo_operacion_id_operation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.modulo_operacion
    ADD CONSTRAINT modulo_operacion_id_operation_fkey FOREIGN KEY (id_operation) REFERENCES public.operacion(id);


--
-- Name: modulo_perfil modulo_perfil_id_module_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.modulo_perfil
    ADD CONSTRAINT modulo_perfil_id_module_fkey FOREIGN KEY (id_module) REFERENCES public.modulo(id);


--
-- Name: modulo_perfil modulo_perfil_id_profile_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.modulo_perfil
    ADD CONSTRAINT modulo_perfil_id_profile_fkey FOREIGN KEY (id_profile) REFERENCES public.perfil(id);


--
-- Name: operation_tab operation_tab_id_operation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.operation_tab
    ADD CONSTRAINT operation_tab_id_operation_fkey FOREIGN KEY (id_operation) REFERENCES public.operacion(id);


--
-- Name: operation_tab operation_tab_id_tab_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.operation_tab
    ADD CONSTRAINT operation_tab_id_tab_fkey FOREIGN KEY (id_tab) REFERENCES public.tab(id);


--
-- Name: ficha record_id_tab_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ficha
    ADD CONSTRAINT record_id_tab_fkey FOREIGN KEY (id_tab) REFERENCES public.tab(id);


--
-- Name: usuario_perfil usuario_perfil_id_profile_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_perfil
    ADD CONSTRAINT usuario_perfil_id_profile_fkey FOREIGN KEY (id_profile) REFERENCES public.perfil(id);


--
-- Name: usuario_perfil usuario_perfil_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_perfil
    ADD CONSTRAINT usuario_perfil_id_user_fkey FOREIGN KEY (id_user) REFERENCES public.usuario(id);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

