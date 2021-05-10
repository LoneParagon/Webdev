--
-- PostgreSQL database dump
--

-- Dumped from database version 13.2
-- Dumped by pg_dump version 13.2

-- Started on 2021-05-06 09:18:10

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
-- TOC entry 201 (class 1259 OID 16422)
-- Name: products; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.products (
    id integer NOT NULL,
    name character varying(250) NOT NULL,
    code character varying(100) NOT NULL,
    price double precision NOT NULL,
    image character varying(250) NOT NULL
);


ALTER TABLE public.products OWNER TO postgres;

--
-- TOC entry 200 (class 1259 OID 16420)
-- Name: cart_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cart_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cart_id_seq OWNER TO postgres;

--
-- TOC entry 3028 (class 0 OID 0)
-- Dependencies: 200
-- Name: cart_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cart_id_seq OWNED BY public.products.id;


--
-- TOC entry 207 (class 1259 OID 16507)
-- Name: news; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.news (
    id integer NOT NULL,
    author character varying NOT NULL,
    image character varying NOT NULL,
    header character varying NOT NULL,
    content character varying NOT NULL
);


ALTER TABLE public.news OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 16505)
-- Name: news_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.news_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.news_id_seq OWNER TO postgres;

--
-- TOC entry 3029 (class 0 OID 0)
-- Dependencies: 206
-- Name: news_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.news_id_seq OWNED BY public.news.id;


--
-- TOC entry 205 (class 1259 OID 16484)
-- Name: orders; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.orders (
    id integer NOT NULL,
    productcodes character varying[] NOT NULL,
    productquantities character varying[] NOT NULL,
    email character varying NOT NULL,
    shipping boolean NOT NULL
);


ALTER TABLE public.orders OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 16482)
-- Name: orders_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.orders_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.orders_id_seq OWNER TO postgres;

--
-- TOC entry 3030 (class 0 OID 0)
-- Dependencies: 204
-- Name: orders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.orders_id_seq OWNED BY public.orders.id;


--
-- TOC entry 203 (class 1259 OID 16443)
-- Name: subscribers; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.subscribers (
    id integer NOT NULL,
    email character varying(100) NOT NULL,
    date date NOT NULL
);


ALTER TABLE public.subscribers OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 16441)
-- Name: subscribers_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.subscribers_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.subscribers_id_seq OWNER TO postgres;

--
-- TOC entry 3031 (class 0 OID 0)
-- Dependencies: 202
-- Name: subscribers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.subscribers_id_seq OWNED BY public.subscribers.id;


--
-- TOC entry 2874 (class 2604 OID 16510)
-- Name: news id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.news ALTER COLUMN id SET DEFAULT nextval('public.news_id_seq'::regclass);


--
-- TOC entry 2873 (class 2604 OID 16487)
-- Name: orders id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orders ALTER COLUMN id SET DEFAULT nextval('public.orders_id_seq'::regclass);


--
-- TOC entry 2871 (class 2604 OID 16425)
-- Name: products id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products ALTER COLUMN id SET DEFAULT nextval('public.cart_id_seq'::regclass);


--
-- TOC entry 2872 (class 2604 OID 16446)
-- Name: subscribers id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.subscribers ALTER COLUMN id SET DEFAULT nextval('public.subscribers_id_seq'::regclass);


--
-- TOC entry 3022 (class 0 OID 16507)
-- Dependencies: 207
-- Data for Name: news; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.news (id, author, image, header, content) FROM stdin;
1	Admin	./images/news1.jpg	Styling White Shirts After A Cool Day	Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium, numquam non provident rem sed minus natus unde vel modi!
2	Admin	./images/news2.jpg	Styling White Shirts After A Cool Day	Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium, numquam non provident rem sed minus natus unde vel modi!
3	Admin	./images/news3.jpg	Styling White Shirts After A Cool Day	Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium, numquam non provident rem sed minus natus unde vel modi!
4	Admin	./images/news4.jpg	Styling White Shirts After A Cool Day	Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium, numquam non provident rem sed minus natus unde vel modi!
5	Admin	./images/news5.jpg	Styling White Shirts After A Cool Day	Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium, numquam non provident rem sed minus natus unde vel modi!
\.


--
-- TOC entry 3020 (class 0 OID 16484)
-- Dependencies: 205
-- Data for Name: orders; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.orders (id, productcodes, productquantities, email, shipping) FROM stdin;
1	{Laptop01,Headphone02,iphone02}	{1,8,4}	abs@abs.abs	t
2	{Laptop01,Headphone02,iphone02}	{1,8,2}	abs@abs.abs	t
3	{Headphone02,iphone01,iphone03,Laptop01}	{5,4,3,2}	abs@abs.abs	t
4	{Headphone02,iphone01,iphone03,Laptop01}	{5,4,4,2}		t
5	{Headphone02,iphone01,iphone03,Laptop01}	{5,4,4,3}		t
6	{Headphone02,iphone01,iphone03,Laptop01}	{5,4,4,3}		t
7	{Headphone02,iphone01,iphone03,Laptop01}	{5,4,4,3}		t
8	{Headphone02,iphone01,iphone03,Laptop01}	{5,4,4,3}		t
9	{Headphone02,iphone01,iphone03,Laptop01}	{5,4,4,3}		t
10	{Headphone02,iphone01,iphone03,Laptop01}	{5,4,4,3}	abs@abs.abs	t
11	{Headphone02,iphone01,iphone03,Laptop01}	{7,4,5,6}		f
12	{Headphone02,iphone01,iphone03,Laptop01}	{7,4,5,6}		f
13	{Headphone02,iphone01,iphone03,Laptop01}	{7,4,5,6}		f
14	{Headphone02,iphone01,iphone03,Laptop01}	{7,4,5,6}		f
15	{Headphone02,iphone01,iphone03,Laptop01}	{7,4,5,6}		f
16	{Headphone02,iphone01,iphone03,Laptop01}	{7,4,5,6}		f
17	{Headphone02,iphone01,iphone03,Laptop01}	{7,4,5,6}		f
18	{Headphone02,iphone01,iphone03,Laptop01}	{7,4,5,6}		f
19	{Headphone02,iphone01,iphone03,Laptop01}	{7,4,5,6}		f
20	{Headphone02,iphone01,iphone03,Laptop01}	{7,4,5,6}		f
21	{Headphone02,iphone01,iphone03,Laptop01}	{7,4,5,6}		f
22	{Headphone02,iphone01,iphone03,Laptop01}	{7,4,5,6}		f
23	{Headphone02,iphone01,iphone03,Laptop01}	{9,6,4,8}	abs@abs.abs	t
24	{Headphone02,iphone01,iphone03,Laptop01,iphone02}	{3,6,5,3,1}	abs@abs.abs	t
25	{Headphone02,iphone01,iphone03,Laptop01,iphone02}	{3,6,5,3,1}		f
\.


--
-- TOC entry 3016 (class 0 OID 16422)
-- Dependencies: 201
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.products (id, name, code, price, image) FROM stdin;
4	Laptop Core i5	Laptop01	600	images/products/laptopcore.jpg
5	Laptop Bag	Bag01	50	images/products/laptop-bag.jpg
6	iPhone X	iphone01	700	images/products/iphonex.jpg
14	Sony WH-CH510	Headphone02	265	/images/products/headphone/headphone2.jpeg
15	Apple iPhone 11	iphone02	850	/images/products/iphone/iphone2.jpeg
16	Apple iPhone 11	iphone04	290	/images/products/iphone/iphone4.jpeg
17	Sony WH-CH510	Headphone03	250	/images/products/headphone/headphone3.jpeg
18	iPhone XR	iphone03	650	images/products/iPhone/iphone3.jpeg
\.


--
-- TOC entry 3018 (class 0 OID 16443)
-- Dependencies: 203
-- Data for Name: subscribers; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.subscribers (id, email, date) FROM stdin;
1	abs@gmail.com	2021-04-04
2	bsa@gmail.com	2021-04-04
3	abs@gmail.com	2021-05-05
\.


--
-- TOC entry 3032 (class 0 OID 0)
-- Dependencies: 200
-- Name: cart_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cart_id_seq', 18, true);


--
-- TOC entry 3033 (class 0 OID 0)
-- Dependencies: 206
-- Name: news_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.news_id_seq', 5, true);


--
-- TOC entry 3034 (class 0 OID 0)
-- Dependencies: 204
-- Name: orders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.orders_id_seq', 25, true);


--
-- TOC entry 3035 (class 0 OID 0)
-- Dependencies: 202
-- Name: subscribers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.subscribers_id_seq', 3, true);


--
-- TOC entry 2876 (class 2606 OID 16432)
-- Name: products cart_code_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT cart_code_key UNIQUE (code);


--
-- TOC entry 2878 (class 2606 OID 16430)
-- Name: products cart_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT cart_pkey PRIMARY KEY (id);


--
-- TOC entry 2884 (class 2606 OID 16515)
-- Name: news news_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.news
    ADD CONSTRAINT news_pkey PRIMARY KEY (id);


--
-- TOC entry 2882 (class 2606 OID 16492)
-- Name: orders orders_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_pkey PRIMARY KEY (id);


--
-- TOC entry 2880 (class 2606 OID 16448)
-- Name: subscribers subscribers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.subscribers
    ADD CONSTRAINT subscribers_pkey PRIMARY KEY (id);


-- Completed on 2021-05-06 09:18:10

--
-- PostgreSQL database dump complete
--

