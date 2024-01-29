--
-- PostgreSQL database dump
--

-- Dumped from database version 16.1 (Debian 16.1-1.pgdg120+1)
-- Dumped by pg_dump version 16.0

-- Started on 2024-01-28 15:21:20 CET

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 221 (class 1259 OID 16425)
-- Name: roles; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.roles (
    id integer NOT NULL,
    name character varying(255)
);


ALTER TABLE public.roles OWNER TO docker;

--
-- TOC entry 216 (class 1259 OID 16386)
-- Name: user_details; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.user_details (
    id integer NOT NULL,
    name character varying(255),
    surname character varying(255),
    phone character varying(20)
);


ALTER TABLE public.user_details OWNER TO docker;

--
-- TOC entry 215 (class 1259 OID 16385)
-- Name: user_details_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.user_details_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.user_details_id_seq OWNER TO docker;

--
-- TOC entry 3395 (class 0 OID 0)
-- Dependencies: 215
-- Name: user_details_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.user_details_id_seq OWNED BY public.user_details.id;


--
-- TOC entry 222 (class 1259 OID 16430)
-- Name: user_roles; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.user_roles (
    user_id integer NOT NULL,
    role_id integer NOT NULL
);


ALTER TABLE public.user_roles OWNER TO docker;

--
-- TOC entry 218 (class 1259 OID 16395)
-- Name: users; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.users (
    id integer NOT NULL,
    user_details_id integer,
    email character varying(255),
    password character varying(255)
);


ALTER TABLE public.users OWNER TO docker;

--
-- TOC entry 217 (class 1259 OID 16394)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO docker;

--
-- TOC entry 3396 (class 0 OID 0)
-- Dependencies: 217
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- TOC entry 220 (class 1259 OID 16409)
-- Name: visits; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.visits (
    id integer NOT NULL,
    doctor integer,
    patient integer,
    date_time timestamp without time zone,
    completed boolean
);


ALTER TABLE public.visits OWNER TO docker;

--
-- TOC entry 219 (class 1259 OID 16408)
-- Name: visits_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.visits_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.visits_id_seq OWNER TO docker;

--
-- TOC entry 3397 (class 0 OID 0)
-- Dependencies: 219
-- Name: visits_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.visits_id_seq OWNED BY public.visits.id;


--
-- TOC entry 3221 (class 2604 OID 16389)
-- Name: user_details id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.user_details ALTER COLUMN id SET DEFAULT nextval('public.user_details_id_seq'::regclass);


--
-- TOC entry 3222 (class 2604 OID 16398)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 3223 (class 2604 OID 16412)
-- Name: visits id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.visits ALTER COLUMN id SET DEFAULT nextval('public.visits_id_seq'::regclass);


--
-- TOC entry 3388 (class 0 OID 16425)
-- Dependencies: 221
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public.roles (id, name) FROM stdin;
1	doctor
2	patient
3	admin
\.


--
-- TOC entry 3383 (class 0 OID 16386)
-- Dependencies: 216
-- Data for Name: user_details; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public.user_details (id, name, surname, phone) FROM stdin;
3	Doctor	Pepper	333333333
1	Doctor	Oetker	111111111
4	Mariusz	Pudzianowski	211111111
2	Doctor	Dolittle	222222222
\.


--
-- TOC entry 3389 (class 0 OID 16430)
-- Dependencies: 222
-- Data for Name: user_roles; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public.user_roles (user_id, role_id) FROM stdin;
2	1
1	1
3	1
4	2
\.


--
-- TOC entry 3385 (class 0 OID 16395)
-- Dependencies: 218
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public.users (id, user_details_id, email, password) FROM stdin;
1	1	doctor1@gmail.com	$2y$10$LrpzBFDfdnvwvPwUK5ZRe.jh9Ug62CaAXMCaxNk/104Le2Uy./98q
2	2	doctor2@gmail.com	$2y$10$jYD9fZoeddsATq7vZTbT4.LrbGz4JHlXoChB0L5.pMhadLoz7OTqi
3	3	doctor3@gmail.com	$2y$10$vMoTf8zNA4pstJ5qbffEJ.RqaFdXU.IcclJjpgKQQQdMOhIIcFeKC
4	4	patient1@gmail.com	$2y$10$6rX3AVacjRWf6agqmXolNupo7YKJG3cteNckklSeNFO/fyGxL5Qym
\.


--
-- TOC entry 3387 (class 0 OID 16409)
-- Dependencies: 220
-- Data for Name: visits; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public.visits (id, doctor, patient, date_time, completed) FROM stdin;
2	1	\N	2023-11-03 16:01:00	f
5	1	\N	2023-11-03 14:10:00	f
6	1	\N	2023-11-03 14:20:00	f
7	1	\N	2023-11-03 14:30:00	f
8	1	\N	2023-11-03 14:40:00	f
9	1	\N	2023-11-03 10:00:00	f
10	1	\N	2024-11-03 10:00:00	f
11	1	\N	2023-11-03 10:00:00	f
12	1	\N	2024-10-01 10:00:00	f
13	1	\N	2024-10-01 10:00:00	f
14	1	\N	2023-10-03 10:00:00	f
15	1	\N	2023-11-03 14:20:00	f
16	1	\N	2023-12-03 14:20:00	f
17	1	\N	2023-01-30 10:00:00	f
18	1	\N	2023-01-30 14:20:00	f
19	1	\N	2023-01-30 14:20:00	f
20	1	\N	2024-01-12 13:50:00	f
21	1	\N	2024-03-14 14:00:00	f
22	1	\N	2024-01-18 14:20:00	f
23	1	\N	2024-01-19 13:50:00	f
24	1	4	2024-01-29 07:00:00	f
\.


--
-- TOC entry 3398 (class 0 OID 0)
-- Dependencies: 215
-- Name: user_details_id_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.user_details_id_seq', 4, true);


--
-- TOC entry 3399 (class 0 OID 0)
-- Dependencies: 217
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.users_id_seq', 4, true);


--
-- TOC entry 3400 (class 0 OID 0)
-- Dependencies: 219
-- Name: visits_id_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.visits_id_seq', 24, true);


--
-- TOC entry 3231 (class 2606 OID 16429)
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);


--
-- TOC entry 3225 (class 2606 OID 16393)
-- Name: user_details user_details_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.user_details
    ADD CONSTRAINT user_details_pkey PRIMARY KEY (id);


--
-- TOC entry 3233 (class 2606 OID 16434)
-- Name: user_roles user_roles_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.user_roles
    ADD CONSTRAINT user_roles_pkey PRIMARY KEY (user_id, role_id);


--
-- TOC entry 3227 (class 2606 OID 16402)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 3229 (class 2606 OID 16414)
-- Name: visits visits_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.visits
    ADD CONSTRAINT visits_pkey PRIMARY KEY (id);


--
-- TOC entry 3237 (class 2606 OID 16440)
-- Name: user_roles user_roles_role_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.user_roles
    ADD CONSTRAINT user_roles_role_id_fkey FOREIGN KEY (role_id) REFERENCES public.roles(id);


--
-- TOC entry 3238 (class 2606 OID 16435)
-- Name: user_roles user_roles_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.user_roles
    ADD CONSTRAINT user_roles_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id);


--
-- TOC entry 3234 (class 2606 OID 16403)
-- Name: users users_user_details_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_user_details_id_fkey FOREIGN KEY (user_details_id) REFERENCES public.user_details(id);


--
-- TOC entry 3235 (class 2606 OID 16415)
-- Name: visits visits_doctor_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.visits
    ADD CONSTRAINT visits_doctor_fkey FOREIGN KEY (doctor) REFERENCES public.users(id);


--
-- TOC entry 3236 (class 2606 OID 16420)
-- Name: visits visits_patient_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.visits
    ADD CONSTRAINT visits_patient_fkey FOREIGN KEY (patient) REFERENCES public.users(id);


-- Completed on 2024-01-28 15:21:21 CET

--
-- PostgreSQL database dump complete
--

