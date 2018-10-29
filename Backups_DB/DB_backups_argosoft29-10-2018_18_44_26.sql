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
-- Name: item; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.item (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    details character varying(200) NOT NULL,
    itemtype_id integer NOT NULL
);


ALTER TABLE public.item OWNER TO postgres;

--
-- Name: itemtype; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.itemtype (
    id integer NOT NULL,
    name character varying(100) NOT NULL
);


ALTER TABLE public.itemtype OWNER TO postgres;

--
-- Name: modulo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.modulo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.modulo_id_seq OWNER TO postgres;

--
-- Name: modulo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.modulo (
    id integer DEFAULT nextval('public.modulo_id_seq'::regclass) NOT NULL,
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
-- Name: operacion_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.operacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.operacion_id_seq OWNER TO postgres;

--
-- Name: operacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.operacion (
    id integer DEFAULT nextval('public.operacion_id_seq'::regclass) NOT NULL,
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
-- Name: perfil_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.perfil_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.perfil_id_seq OWNER TO postgres;

--
-- Name: perfil; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.perfil (
    id integer DEFAULT nextval('public.perfil_id_seq'::regclass) NOT NULL,
    name character varying(50) NOT NULL,
    description character varying(100),
    date_created timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.perfil OWNER TO postgres;

--
-- Name: permit_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.permit_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permit_id_seq OWNER TO postgres;

--
-- Name: permit; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permit (
    id integer DEFAULT nextval('public.permit_id_seq'::regclass) NOT NULL,
    date_created date NOT NULL,
    start_time time without time zone NOT NULL,
    end_time time without time zone NOT NULL,
    work_reason character varying(200) NOT NULL,
    id_company integer,
    id_sector integer,
    responsable_sector_id integer,
    contractor_id integer,
    performer_id integer,
    status character(1)
);


ALTER TABLE public.permit OWNER TO postgres;

--
-- Name: permit_personal_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.permit_personal_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permit_personal_id_seq OWNER TO postgres;

--
-- Name: permit_personal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permit_personal (
    permit_id integer NOT NULL,
    personal_id integer NOT NULL,
    id integer DEFAULT nextval('public.permit_personal_id_seq'::regclass) NOT NULL
);


ALTER TABLE public.permit_personal OWNER TO postgres;

--
-- Name: permit_section_item_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.permit_section_item_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permit_section_item_id_seq OWNER TO postgres;

--
-- Name: permit_section_item; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permit_section_item (
    id integer DEFAULT nextval('public.permit_section_item_id_seq'::regclass) NOT NULL,
    permit_id integer NOT NULL,
    section_item_id integer NOT NULL,
    state character(1) NOT NULL
);


ALTER TABLE public.permit_section_item OWNER TO postgres;

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
-- Name: section; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.section (
    id integer NOT NULL,
    name character varying(200) NOT NULL
);


ALTER TABLE public.section OWNER TO postgres;

--
-- Name: section_item; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.section_item (
    id integer NOT NULL,
    section_id integer NOT NULL,
    item_id integer NOT NULL
);


ALTER TABLE public.section_item OWNER TO postgres;

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
9	17	\N	Argosoft	\N	\N	2018-09-28 20:11:28
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
-- Data for Name: item; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.item (id, name, details, itemtype_id) FROM stdin;
3	Atornilladora		1
4	Electrico		3
5	Ruido		3
6	Vibraciones		3
7	Temperatura		3
8	Radiacion		3
9	Altura		3
10	Transito		3
11	Peatonal		3
12	Diferencia de Nivel		3
13	Transito de Vehiculos		5
14	Uso de Maquinas y/o Herramientas		5
15	Operacion de Maquinas		5
16	Polvos		4
17	Humos		4
18	Liquidos		4
19	Gases		4
20	Virus		6
21	Bacterias		6
22	Hongos		6
23	Insectos		6
24	Roedores		6
25	Animales		6
26	Manejo de Carga		7
27	Movimientos Repetitivos		7
28	Aplicacion de Fuerza		7
29	Postura Forzada		7
30	Empuje y Traccion de Carga		7
31	Sobre Carga de Trabajo		8
32	Acoso Laboral		8
33	Violencia		8
34	Entorno Social		8
35	Temas Personales		8
36	Alteraciones del Medio Externo al Trabajo		8
37	Agujereadora		1
38	Martillo Percutor		1
39	Caladora		1
40	Tablero Eléctrico		1
1	Amoladora	Maquina que corta con disco	1
2	Soldadora	soladar con electrodos	1
41	Antiparras de Seguridad		9
42	Protección Facial 		9
43	Protección Auditiva		9
44	Protección Respiratoria 		9
45	Delantal		9
46	Frena Caidas		10
47	Mameluco		9
48	Equipo Autónomo		10
49	Botas de Seguridad		9
50	Tensión de Seguridad		10
51	Candados/Etiquetas		10
52	Cabo de Vida		10
53	Red Anticaidas		10
54	Punto de Anclaje (22KN)		10
55	Amortiguador de Caídas		10
56	Filtro para Gases/Vapores		10
57	Puesta a Tierra		10
58	Extintor		10
59	Señalización		10
60	Medio de Izaje de Elementos		10
61	Suministro de Aire		10
\.


--
-- Data for Name: itemtype; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.itemtype (id, name) FROM stdin;
1	Herramienta
2	Equipo
3	Fisico
4	Quimico
5	Mecanico
6	Biologico
7	Ergonomico
8	Psicosociales
9	Personal
10	Complementario
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
11	Permisos	workPermitContractor	\N	glyphicon-paperclip
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
10	1
6	2
7	2
11	2
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
-- Data for Name: permit; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.permit (id, date_created, start_time, end_time, work_reason, id_company, id_sector, responsable_sector_id, contractor_id, performer_id, status) FROM stdin;
65	2018-10-29	20:57:23	20:57:23	Limpiar Vidrios	\N	\N	\N	17	1	w
6	2018-10-18	18:51:14	18:51:14	Soldar	\N	\N	\N	17	1	f
\.


--
-- Data for Name: permit_personal; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.permit_personal (permit_id, personal_id, id) FROM stdin;
65	11	5
\.


--
-- Data for Name: permit_section_item; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.permit_section_item (id, permit_id, section_item_id, state) FROM stdin;
3	6	3	D
2	6	2	A
4	6	4	A
5	6	5	D
1	6	1	D
162	65	1	D
163	65	2	D
165	65	36	D
169	65	4	D
170	65	5	D
171	65	6	D
175	65	10	D
176	65	11	D
179	65	14	D
180	65	15	D
181	65	16	D
182	65	17	D
183	65	18	D
184	65	19	D
185	65	20	D
186	65	21	D
187	65	22	D
188	65	23	D
189	65	24	D
190	65	25	D
191	65	26	D
192	65	27	D
193	65	28	D
194	65	29	D
195	65	30	D
196	65	31	D
197	65	32	D
198	65	33	D
199	65	34	D
200	65	35	D
201	65	40	D
202	65	41	D
204	65	43	D
207	65	46	D
209	65	48	D
210	65	49	D
164	65	3	A
166	65	37	A
167	65	38	A
172	65	7	A
174	65	9	A
177	65	12	A
203	65	42	A
205	65	44	A
206	65	45	A
168	65	39	A
173	65	8	A
178	65	13	A
208	65	47	A
\.


--
-- Data for Name: personal; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.personal (id, email, full_name, date_created, seniority, id_company) FROM stdin;
10	nicolasdaniellaugas@gmail.com	nico	2018-09-28 20:12:11	1	9
11	personal@gmail.com	Juan	2018-10-10 00:00:00	5	9
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
-- Data for Name: section; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.section (id, name) FROM stdin;
1	Revisión de Equipos y Herramientas
2	Peligros y Riesgos Potenciales
3	Elementos de Protección
\.


--
-- Data for Name: section_item; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.section_item (id, section_id, item_id) FROM stdin;
1	1	1
2	1	2
3	1	3
4	2	4
5	2	5
6	2	6
7	2	8
8	2	9
9	2	10
10	2	11
11	2	12
12	2	13
13	2	14
14	2	15
15	2	16
16	2	17
17	2	18
18	2	19
19	2	20
20	2	21
21	2	22
22	2	23
23	2	24
24	2	25
25	2	26
26	2	27
27	2	28
28	2	29
29	2	30
30	2	31
31	2	32
32	2	33
33	2	34
34	2	35
35	2	36
36	1	37
37	1	38
38	1	39
39	1	40
40	3	41
41	3	42
42	3	43
43	3	44
44	3	45
45	3	46
46	3	47
47	3	48
48	3	49
49	3	50
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
17	mariano@gmail.com	Mariano	$2y$10$N0rVJCe8reoE9GoHT9QOHOGUfmuNU7wvu/OIAbrZ3c2cbbqxK5akK	1	2018-09-28 20:11:28	\N	\N
18	administrador@gmail.com	administrador	$2y$10$v4qJO8v61eEZEB2nzHxT1ulM1OEj31PznUw/2pvdDT1kYCr0F0qCK	1	2018-10-02 18:45:41	\N	\N
\.


--
-- Data for Name: usuario_perfil; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuario_perfil (id_user, id_profile) FROM stdin;
1	1
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
-- Name: modulo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.modulo_id_seq', 18, true);


--
-- Name: operacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.operacion_id_seq', 3, true);


--
-- Name: perfil_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.perfil_id_seq', 7, true);


--
-- Name: permit_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.permit_id_seq', 65, true);


--
-- Name: permit_personal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.permit_personal_id_seq', 5, true);


--
-- Name: permit_section_item_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.permit_section_item_id_seq', 210, true);


--
-- Name: personal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personal_id_seq', 11, true);


--
-- Name: residual_permit_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.residual_permit_id_seq', 8, true);


--
-- Name: usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuario_id_seq', 28, true);


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
-- Name: item item_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.item
    ADD CONSTRAINT item_pk PRIMARY KEY (id);


--
-- Name: itemtype itemtype_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.itemtype
    ADD CONSTRAINT itemtype_pk PRIMARY KEY (id);


--
-- Name: permit_personal permit_personal_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permit_personal
    ADD CONSTRAINT permit_personal_pk PRIMARY KEY (id);


--
-- Name: permit permit_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permit
    ADD CONSTRAINT permit_pk PRIMARY KEY (id);


--
-- Name: permit_section_item permit_section_item_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permit_section_item
    ADD CONSTRAINT permit_section_item_pk PRIMARY KEY (id);


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
-- Name: section_item section_item_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.section_item
    ADD CONSTRAINT section_item_pk PRIMARY KEY (id);


--
-- Name: section section_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.section
    ADD CONSTRAINT section_pk PRIMARY KEY (id);


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
-- Name: item item_itemtype; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.item
    ADD CONSTRAINT item_itemtype FOREIGN KEY (itemtype_id) REFERENCES public.itemtype(id);


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
-- Name: permit permit_contractor; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permit
    ADD CONSTRAINT permit_contractor FOREIGN KEY (contractor_id) REFERENCES public.usuario(id);


--
-- Name: section_item permit_item_section; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.section_item
    ADD CONSTRAINT permit_item_section FOREIGN KEY (section_id) REFERENCES public.section(id);


--
-- Name: permit_personal permit_personal_permit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permit_personal
    ADD CONSTRAINT permit_personal_permit FOREIGN KEY (permit_id) REFERENCES public.permit(id);


--
-- Name: permit_personal permit_personal_personal; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permit_personal
    ADD CONSTRAINT permit_personal_personal FOREIGN KEY (personal_id) REFERENCES public.personal(id);


--
-- Name: permit_section_item permit_section_item_permit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permit_section_item
    ADD CONSTRAINT permit_section_item_permit FOREIGN KEY (permit_id) REFERENCES public.permit(id);


--
-- Name: permit_section_item permit_section_item_section_item; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permit_section_item
    ADD CONSTRAINT permit_section_item_section_item FOREIGN KEY (section_item_id) REFERENCES public.section_item(id);


--
-- Name: permit permit_user; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permit
    ADD CONSTRAINT permit_user FOREIGN KEY (performer_id) REFERENCES public.usuario(id);


--
-- Name: ficha record_id_tab_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ficha
    ADD CONSTRAINT record_id_tab_fkey FOREIGN KEY (id_tab) REFERENCES public.tab(id);


--
-- Name: section_item section_item_item; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.section_item
    ADD CONSTRAINT section_item_item FOREIGN KEY (item_id) REFERENCES public.item(id);


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
-- PostgreSQL database dump complete
--

