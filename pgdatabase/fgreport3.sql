toc.dat                                                                                             0000600 0004000 0002000 00000040077 15023602447 0014452 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        PGDMP   /    &                 }         	   fgreport3    12.20    16.4 :    e           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false         f           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false         g           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false         h           1262    17385 	   fgreport3    DATABASE     �   CREATE DATABASE fgreport3 WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_Indonesia.1252';
    DROP DATABASE fgreport3;
                postgres    false                     2615    2200    public    SCHEMA     2   -- *not* creating schema, since initdb creates it
 2   -- *not* dropping schema, since initdb creates it
                postgres    false         i           0    0    SCHEMA public    ACL     Q   REVOKE USAGE ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO PUBLIC;
                   postgres    false    6         �            1259    17475    10101    TABLE     �   CREATE TABLE public."10101" (
    id integer NOT NULL,
    tanggal timestamp without time zone NOT NULL,
    line character varying(100) NOT NULL,
    sku character varying(100) NOT NULL,
    no_pallet integer,
    isi_pallet integer
);
    DROP TABLE public."10101";
       public         heap    postgres    false    6         �            1259    17473    10101_id_seq    SEQUENCE     �   ALTER TABLE public."10101" ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."10101_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    207    6         �            1259    17550    10102    TABLE     �   CREATE TABLE public."10102" (
    id integer NOT NULL,
    tanggal timestamp without time zone NOT NULL,
    line character varying(20) NOT NULL,
    sku character varying(55) NOT NULL,
    no_pallet integer,
    isi_pallet integer
);
    DROP TABLE public."10102";
       public         heap    postgres    false    6         �            1259    17548    10102_id_seq    SEQUENCE     �   ALTER TABLE public."10102" ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."10102_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1
);
            public          postgres    false    6    218         �            1259    17661    11111    TABLE     �   CREATE TABLE public."11111" (
    id integer NOT NULL,
    tanggal timestamp without time zone NOT NULL,
    line character varying(20) NOT NULL,
    sku character varying(55) NOT NULL,
    no_pallet integer,
    isi_pallet integer
);
    DROP TABLE public."11111";
       public         heap    postgres    false    6         �            1259    17659    11111_id_seq    SEQUENCE     �   ALTER TABLE public."11111" ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."11111_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1
);
            public          postgres    false    221    6         �            1259    17398    alldata    TABLE     �   CREATE TABLE public.alldata (
    id integer NOT NULL,
    tanggal timestamp without time zone NOT NULL,
    line character varying(100) NOT NULL,
    sku character varying(100) NOT NULL,
    no_pallet integer,
    isi_pallet integer
);
    DROP TABLE public.alldata;
       public         heap    postgres    false    6         �            1259    17396    alldata_id_seq    SEQUENCE     �   ALTER TABLE public.alldata ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.alldata_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    205    6         �            1259    17500 	   identitas    TABLE     �   CREATE TABLE public.identitas (
    id integer NOT NULL,
    regu character varying(20),
    stock_keeper character varying(55),
    kasie character varying(55),
    spv character varying(55)
);
    DROP TABLE public.identitas;
       public         heap    postgres    false    6         �            1259    17498    identitas_id_seq    SEQUENCE     �   ALTER TABLE public.identitas ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.identitas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    212    6         �            1259    17386    line    TABLE     `   CREATE TABLE public.line (
    id_line integer NOT NULL,
    nama_line character varying(20)
);
    DROP TABLE public.line;
       public         heap    postgres    false    6         �            1259    17590 	   settmesin    TABLE     �   CREATE TABLE public.settmesin (
    id_sku bigint NOT NULL,
    nama_sku character varying(55),
    jml_mesin integer,
    speed bigint,
    downtime bigint
);
    DROP TABLE public.settmesin;
       public         heap    postgres    false    6         �            1259    17486 
   setttarget    TABLE     �   CREATE TABLE public.setttarget (
    id_sku bigint NOT NULL,
    nama_line character varying(100),
    nama_sku character varying(100),
    target character varying(100),
    keterangan character varying(100),
    id_line bigint
);
    DROP TABLE public.setttarget;
       public         heap    postgres    false    6         �            1259    17391    sku    TABLE     3  CREATE TABLE public.sku (
    id_line character varying(100),
    id_sku bigint NOT NULL,
    nama_sku character varying(100),
    jml_karton integer,
    nama_line character varying(100),
    isi_karton integer,
    std_etiket integer
);
ALTER TABLE ONLY public.sku ALTER COLUMN id_line SET STORAGE PLAIN;
    DROP TABLE public.sku;
       public         heap    postgres    false    6         �            1259    17507    tmpidentitas    TABLE     %  CREATE TABLE public.tmpidentitas (
    id integer NOT NULL,
    regu character varying(20),
    shift integer,
    stock_keeper character varying(55),
    kasie character varying(55),
    spv character varying(55),
    login_time timestamp without time zone,
    role character varying(20)
);
     DROP TABLE public.tmpidentitas;
       public         heap    postgres    false    6         �            1259    17505    tmpidentitas_id_seq    SEQUENCE     �   ALTER TABLE public.tmpidentitas ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.tmpidentitas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    6    214         �            1259    17514    tsku    TABLE     �   CREATE TABLE public.tsku (
    id integer NOT NULL,
    tanggal timestamp without time zone NOT NULL,
    line character varying(20) NOT NULL,
    sku character varying(55) NOT NULL,
    no_pallet integer,
    isi_pallet integer
);
    DROP TABLE public.tsku;
       public         heap    postgres    false    6         �            1259    17512    tsku_id_seq    SEQUENCE     �   ALTER TABLE public.tsku ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.tsku_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    216    6         �            1259    17491    users    TABLE     �   CREATE TABLE public.users (
    id integer NOT NULL,
    username character varying(50),
    password character varying(255),
    role character varying(20),
    is_active integer
);
    DROP TABLE public.users;
       public         heap    postgres    false    6         �            1259    17496    users_id_seq    SEQUENCE     �   ALTER TABLE public.users ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    6    209         T          0    17475    10101 
   TABLE DATA           P   COPY public."10101" (id, tanggal, line, sku, no_pallet, isi_pallet) FROM stdin;
    public          postgres    false    207       2900.dat _          0    17550    10102 
   TABLE DATA           P   COPY public."10102" (id, tanggal, line, sku, no_pallet, isi_pallet) FROM stdin;
    public          postgres    false    218       2911.dat b          0    17661    11111 
   TABLE DATA           P   COPY public."11111" (id, tanggal, line, sku, no_pallet, isi_pallet) FROM stdin;
    public          postgres    false    221       2914.dat R          0    17398    alldata 
   TABLE DATA           P   COPY public.alldata (id, tanggal, line, sku, no_pallet, isi_pallet) FROM stdin;
    public          postgres    false    205       2898.dat Y          0    17500 	   identitas 
   TABLE DATA           G   COPY public.identitas (id, regu, stock_keeper, kasie, spv) FROM stdin;
    public          postgres    false    212       2905.dat O          0    17386    line 
   TABLE DATA           2   COPY public.line (id_line, nama_line) FROM stdin;
    public          postgres    false    202       2895.dat `          0    17590 	   settmesin 
   TABLE DATA           Q   COPY public.settmesin (id_sku, nama_sku, jml_mesin, speed, downtime) FROM stdin;
    public          postgres    false    219       2912.dat U          0    17486 
   setttarget 
   TABLE DATA           ^   COPY public.setttarget (id_sku, nama_line, nama_sku, target, keterangan, id_line) FROM stdin;
    public          postgres    false    208       2901.dat P          0    17391    sku 
   TABLE DATA           g   COPY public.sku (id_line, id_sku, nama_sku, jml_karton, nama_line, isi_karton, std_etiket) FROM stdin;
    public          postgres    false    203       2896.dat [          0    17507    tmpidentitas 
   TABLE DATA           c   COPY public.tmpidentitas (id, regu, shift, stock_keeper, kasie, spv, login_time, role) FROM stdin;
    public          postgres    false    214       2907.dat ]          0    17514    tsku 
   TABLE DATA           M   COPY public.tsku (id, tanggal, line, sku, no_pallet, isi_pallet) FROM stdin;
    public          postgres    false    216       2909.dat V          0    17491    users 
   TABLE DATA           H   COPY public.users (id, username, password, role, is_active) FROM stdin;
    public          postgres    false    209       2902.dat j           0    0    10101_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public."10101_id_seq"', 74, true);
          public          postgres    false    206         k           0    0    10102_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public."10102_id_seq"', 13, true);
          public          postgres    false    217         l           0    0    11111_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public."11111_id_seq"', 1, false);
          public          postgres    false    220         m           0    0    alldata_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.alldata_id_seq', 85, true);
          public          postgres    false    204         n           0    0    identitas_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.identitas_id_seq', 3, true);
          public          postgres    false    211         o           0    0    tmpidentitas_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.tmpidentitas_id_seq', 1, true);
          public          postgres    false    213         p           0    0    tsku_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.tsku_id_seq', 1, false);
          public          postgres    false    215         q           0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 5, true);
          public          postgres    false    210         �
           2606    17479    10101 10101_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public."10101"
    ADD CONSTRAINT "10101_pkey" PRIMARY KEY (id);
 >   ALTER TABLE ONLY public."10101" DROP CONSTRAINT "10101_pkey";
       public            postgres    false    207         �
           2606    17554    10102 10102_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public."10102"
    ADD CONSTRAINT "10102_pkey" PRIMARY KEY (id);
 >   ALTER TABLE ONLY public."10102" DROP CONSTRAINT "10102_pkey";
       public            postgres    false    218         �
           2606    17665    11111 11111_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public."11111"
    ADD CONSTRAINT "11111_pkey" PRIMARY KEY (id);
 >   ALTER TABLE ONLY public."11111" DROP CONSTRAINT "11111_pkey";
       public            postgres    false    221         �
           2606    17402    alldata alldata_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.alldata
    ADD CONSTRAINT alldata_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.alldata DROP CONSTRAINT alldata_pkey;
       public            postgres    false    205         �
           2606    17504    identitas identitas_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.identitas
    ADD CONSTRAINT identitas_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.identitas DROP CONSTRAINT identitas_pkey;
       public            postgres    false    212         �
           2606    17390    line line_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY public.line
    ADD CONSTRAINT line_pkey PRIMARY KEY (id_line);
 8   ALTER TABLE ONLY public.line DROP CONSTRAINT line_pkey;
       public            postgres    false    202         �
           2606    17490    setttarget setpo_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.setttarget
    ADD CONSTRAINT setpo_pkey PRIMARY KEY (id_sku);
 ?   ALTER TABLE ONLY public.setttarget DROP CONSTRAINT setpo_pkey;
       public            postgres    false    208         �
           2606    17594    settmesin settmesin_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.settmesin
    ADD CONSTRAINT settmesin_pkey PRIMARY KEY (id_sku);
 B   ALTER TABLE ONLY public.settmesin DROP CONSTRAINT settmesin_pkey;
       public            postgres    false    219         �
           2606    17481    sku sku_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.sku
    ADD CONSTRAINT sku_pkey PRIMARY KEY (id_sku);
 6   ALTER TABLE ONLY public.sku DROP CONSTRAINT sku_pkey;
       public            postgres    false    203         �
           2606    17511    tmpidentitas tmpidentitas_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.tmpidentitas
    ADD CONSTRAINT tmpidentitas_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.tmpidentitas DROP CONSTRAINT tmpidentitas_pkey;
       public            postgres    false    214         �
           2606    17518    tsku tsku_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.tsku
    ADD CONSTRAINT tsku_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.tsku DROP CONSTRAINT tsku_pkey;
       public            postgres    false    216         �
           2606    17495    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    209                                                                                                                                                                                                                                                                                                                                                                                                                                                                         2900.dat                                                                                            0000600 0004000 0002000 00000000055 15023602447 0014247 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        74	2025-06-16 00:04:01	PC32	SPC 35	1	48
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   2911.dat                                                                                            0000600 0004000 0002000 00000000055 15023602447 0014251 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        13	2025-06-16 00:04:51	PC32	SPC 68	1	48
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   2914.dat                                                                                            0000600 0004000 0002000 00000000005 15023602447 0014247 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           2898.dat                                                                                            0000600 0004000 0002000 00000005501 15023602447 0014270 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	2025-05-19 19:33:03	PC32	SPC 35	1	48
2	2025-05-19 20:13:22	PC32	SPC 35	2	48
3	2025-05-19 20:41:32	PC32	SPC 35	3	48
4	2025-05-20 19:52:03	PC32	SPC 35	4	48
5	2025-05-21 09:10:13	PC32	SPC 35	5	48
6	2025-05-21 09:11:49	PC32	SPC 35	6	48
7	2025-05-21 09:16:06	PC32	SPC 35	7	48
8	2025-05-21 21:19:46	PC32	SPC 35	8	48
9	2025-06-03 04:41:08	PC32	SPC 35	11	48
10	2025-06-03 04:49:35	PC32	SPC 35	12	48
11	2025-06-03 04:50:43	PC32	SPC 35	13	48
12	2025-06-03 04:50:54	PC32	SPC 35	14	48
13	2025-06-03 04:53:40	PC32	SPC 35	15	48
14	2025-06-03 04:54:20	PC32	SPC 35	16	48
15	2025-06-03 04:56:22	PC32	SPC 35	17	48
16	2025-06-03 05:00:16	PC32	SPC 35	18	48
24	2025-06-04 18:57:24	PC32	SPC 35	19	48
25	2025-06-04 19:59:47	PC32	SPC 35	1	48
26	2025-06-04 21:04:33	PC32	SPC 35	1	48
27	2025-06-04 23:25:03	PC32	SPC 35	1	48
28	2025-06-06 22:44:25	PC32	SPC 35	2	48
29	2025-06-07 00:16:58	PC32	SPC 35	3	48
30	2025-06-07 00:18:19	PC32	SPC 35	4	48
31	2025-06-07 00:18:36	PC32	SPC 35	5	48
32	2025-06-07 00:18:46	PC32	SPC 35	6	48
36	2025-06-07 02:08:06	PC32	SPC 35	1	48
37	2025-06-07 02:49:55	PC32	SPC 35	2	48
38	2025-06-07 02:51:19	PC32	SPC 35	1	48
39	2025-06-07 02:51:55	PC32	SPC 35	2	4
40	2025-06-07 03:04:46	PC32	SPC 35	3	48
41	2025-06-07 07:12:19	PC32	SPC 35	1	48
42	2025-06-07 07:12:32	PC32	SPC 35	2	48
43	2025-06-07 16:00:26	PC32	SPC 35	1	48
44	2025-06-07 17:07:15	PC32	SPC 35	2	48
45	2025-06-07 17:07:47	PC32	SPC 35	3	48
46	2025-06-07 17:29:00	PC32	SPC 35	4	48
47	2025-06-07 17:52:00	PC32	SPC 35	5	48
48	2025-06-07 17:52:05	PC32	SPC 35	6	48
49	2025-06-07 17:55:15	PC32	SPC 35	7	48
50	2025-06-07 18:00:04	PC14	SPC 35	8	48
51	2025-06-07 18:03:22	PC14	SPC 35	9	48
52	2025-06-07 18:07:49	PC32	SPC 35	1	48
53	2025-06-07 18:08:26	PC32	SPC 35	2	48
54	2025-06-07 21:58:00	PC32	SPC 35	3	48
55	2025-06-08 01:10:54	copack	ori	1	34
56	2025-06-08 07:23:39	PC32	SPC 35	1	48
57	2025-06-08 07:23:56	PC32	SPC 35	2	48
59	2025-06-08 09:15:42	PC32	SPC 68	1	42
61	2025-06-08 09:45:02	PC32	SPC 68	1	48
62	2025-06-08 09:52:58	PC32	SPC 35	2	48
63	2025-06-08 11:33:11	PC32	SPC 35	3	48
64	2025-06-08 11:48:58	PC32	SPC 35	1	48
65	2025-06-10 00:55:33	PC32	SPC 35	1	48
66	2025-06-10 02:06:26	PC32	SPC 35	2	48
67	2025-06-10 02:06:42	PC32	SPC 35	3	48
68	2025-06-10 02:06:48	PC32	SPC 35	4	48
69	2025-06-10 02:18:40	PC32	SPC 68	1	48
70	2025-06-10 06:05:30	PC32	SPC 35	5	48
71	2025-06-10 10:00:43	PC32	SPC 35	6	48
72	2025-06-10 10:17:10	PC32	SPC 35	7	48
73	2025-06-10 15:02:00	PC32	SPC 35	8	48
74	2025-06-12 08:24:01	PC14	SPC 35	1	48
75	2025-06-12 08:24:17	PC14	SPC 35	2	48
76	2025-06-12 08:24:25	PC14	SPC 35	3	48
78	2025-06-13 12:37:11	PC32	SPC 68	2	48
79	2025-06-13 12:38:03	PC32	SPC 68	3	48
80	2025-06-13 12:47:05	PC32	SPC 68	4	48
81	2025-06-15 00:23:06	copack	ori	1	34
82	2025-06-15 01:54:25	PC32	SPC 68	5	48
83	2025-06-15 03:07:16	copack	ori	2	34
84	2025-06-16 00:04:01	PC32	SPC 35	1	48
85	2025-06-16 00:04:51	PC32	SPC 68	1	48
\.


                                                                                                                                                                                               2905.dat                                                                                            0000600 0004000 0002000 00000000064 15023602447 0014254 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        2	B	SA	ARW	TAN
3	C	ddd	eee	fff
1	A	aaa	bbb	ccc
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                            2895.dat                                                                                            0000600 0004000 0002000 00000000031 15023602447 0014256 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        101	PC32
102	copack
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       2912.dat                                                                                            0000600 0004000 0002000 00000000075 15023602447 0014254 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        10102	SPC 68	3	60	0
11111	ori	0	0	0
10101	SPC 35	2	90	0
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                   2901.dat                                                                                            0000600 0004000 0002000 00000000035 15023602447 0014246 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        10102	PC32	SPC 68			101
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   2896.dat                                                                                            0000600 0004000 0002000 00000000147 15023602447 0014267 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        101	10101	SPC 35	48	PC32	40	4545
101	10102	SPC 68	48	PC32	30	3846
102	11111	ori	48	copack	30	3846
\.


                                                                                                                                                                                                                                                                                                                                                                                                                         2907.dat                                                                                            0000600 0004000 0002000 00000000062 15023602447 0014254 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	B	1	SA	ARW	TAN	2025-06-15 23:29:39	fgstock
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                              2909.dat                                                                                            0000600 0004000 0002000 00000000005 15023602447 0014253 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           2902.dat                                                                                            0000600 0004000 0002000 00000000502 15023602447 0014246 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	monitor	$2y$10$ca3XWnrI67Hb7mdG6S.ryeGGPjJOBW.4KzomuJwQ3cYs5SdgWxzM.	monitor	1
4	admin	$2y$10$ZwvXdPrS7w8vo15SZNW26eDBuYi3t6G1DsJrn8uDro78YUWkxeVny	admin	1
2	fgstock	$2y$10$ca3XWnrI67Hb7mdG6S.ryeGGPjJOBW.4KzomuJwQ3cYs5SdgWxzM.	fgstock	1
3	office	$2y$10$QdJqX6ZOmrkMB2EW40g/fOQD3CQdGpKei5YgyBXeD1I09n5NKjW9C	kasie	1
\.


                                                                                                                                                                                              restore.sql                                                                                         0000600 0004000 0002000 00000034060 15023602447 0015372 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        --
-- NOTE:
--
-- File paths need to be edited. Search for $$PATH$$ and
-- replace it with the path to the directory containing
-- the extracted data files.
--
--
-- PostgreSQL database dump
--

-- Dumped from database version 12.20
-- Dumped by pg_dump version 16.4

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

DROP DATABASE fgreport3;
--
-- Name: fgreport3; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE fgreport3 WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_Indonesia.1252';


ALTER DATABASE fgreport3 OWNER TO postgres;

\connect fgreport3

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

--
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

-- *not* creating schema, since initdb creates it


ALTER SCHEMA public OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: 10101; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."10101" (
    id integer NOT NULL,
    tanggal timestamp without time zone NOT NULL,
    line character varying(100) NOT NULL,
    sku character varying(100) NOT NULL,
    no_pallet integer,
    isi_pallet integer
);


ALTER TABLE public."10101" OWNER TO postgres;

--
-- Name: 10101_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."10101" ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."10101_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: 10102; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."10102" (
    id integer NOT NULL,
    tanggal timestamp without time zone NOT NULL,
    line character varying(20) NOT NULL,
    sku character varying(55) NOT NULL,
    no_pallet integer,
    isi_pallet integer
);


ALTER TABLE public."10102" OWNER TO postgres;

--
-- Name: 10102_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."10102" ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."10102_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1
);


--
-- Name: 11111; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."11111" (
    id integer NOT NULL,
    tanggal timestamp without time zone NOT NULL,
    line character varying(20) NOT NULL,
    sku character varying(55) NOT NULL,
    no_pallet integer,
    isi_pallet integer
);


ALTER TABLE public."11111" OWNER TO postgres;

--
-- Name: 11111_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."11111" ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."11111_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1
);


--
-- Name: alldata; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.alldata (
    id integer NOT NULL,
    tanggal timestamp without time zone NOT NULL,
    line character varying(100) NOT NULL,
    sku character varying(100) NOT NULL,
    no_pallet integer,
    isi_pallet integer
);


ALTER TABLE public.alldata OWNER TO postgres;

--
-- Name: alldata_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.alldata ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.alldata_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: identitas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.identitas (
    id integer NOT NULL,
    regu character varying(20),
    stock_keeper character varying(55),
    kasie character varying(55),
    spv character varying(55)
);


ALTER TABLE public.identitas OWNER TO postgres;

--
-- Name: identitas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.identitas ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.identitas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: line; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.line (
    id_line integer NOT NULL,
    nama_line character varying(20)
);


ALTER TABLE public.line OWNER TO postgres;

--
-- Name: settmesin; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.settmesin (
    id_sku bigint NOT NULL,
    nama_sku character varying(55),
    jml_mesin integer,
    speed bigint,
    downtime bigint
);


ALTER TABLE public.settmesin OWNER TO postgres;

--
-- Name: setttarget; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.setttarget (
    id_sku bigint NOT NULL,
    nama_line character varying(100),
    nama_sku character varying(100),
    target character varying(100),
    keterangan character varying(100),
    id_line bigint
);


ALTER TABLE public.setttarget OWNER TO postgres;

--
-- Name: sku; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sku (
    id_line character varying(100),
    id_sku bigint NOT NULL,
    nama_sku character varying(100),
    jml_karton integer,
    nama_line character varying(100),
    isi_karton integer,
    std_etiket integer
);
ALTER TABLE ONLY public.sku ALTER COLUMN id_line SET STORAGE PLAIN;


ALTER TABLE public.sku OWNER TO postgres;

--
-- Name: tmpidentitas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tmpidentitas (
    id integer NOT NULL,
    regu character varying(20),
    shift integer,
    stock_keeper character varying(55),
    kasie character varying(55),
    spv character varying(55),
    login_time timestamp without time zone,
    role character varying(20)
);


ALTER TABLE public.tmpidentitas OWNER TO postgres;

--
-- Name: tmpidentitas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.tmpidentitas ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.tmpidentitas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: tsku; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tsku (
    id integer NOT NULL,
    tanggal timestamp without time zone NOT NULL,
    line character varying(20) NOT NULL,
    sku character varying(55) NOT NULL,
    no_pallet integer,
    isi_pallet integer
);


ALTER TABLE public.tsku OWNER TO postgres;

--
-- Name: tsku_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.tsku ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.tsku_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    username character varying(50),
    password character varying(255),
    role character varying(20),
    is_active integer
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.users ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Data for Name: 10101; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."10101" (id, tanggal, line, sku, no_pallet, isi_pallet) FROM stdin;
\.
COPY public."10101" (id, tanggal, line, sku, no_pallet, isi_pallet) FROM '$$PATH$$/2900.dat';

--
-- Data for Name: 10102; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."10102" (id, tanggal, line, sku, no_pallet, isi_pallet) FROM stdin;
\.
COPY public."10102" (id, tanggal, line, sku, no_pallet, isi_pallet) FROM '$$PATH$$/2911.dat';

--
-- Data for Name: 11111; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."11111" (id, tanggal, line, sku, no_pallet, isi_pallet) FROM stdin;
\.
COPY public."11111" (id, tanggal, line, sku, no_pallet, isi_pallet) FROM '$$PATH$$/2914.dat';

--
-- Data for Name: alldata; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.alldata (id, tanggal, line, sku, no_pallet, isi_pallet) FROM stdin;
\.
COPY public.alldata (id, tanggal, line, sku, no_pallet, isi_pallet) FROM '$$PATH$$/2898.dat';

--
-- Data for Name: identitas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.identitas (id, regu, stock_keeper, kasie, spv) FROM stdin;
\.
COPY public.identitas (id, regu, stock_keeper, kasie, spv) FROM '$$PATH$$/2905.dat';

--
-- Data for Name: line; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.line (id_line, nama_line) FROM stdin;
\.
COPY public.line (id_line, nama_line) FROM '$$PATH$$/2895.dat';

--
-- Data for Name: settmesin; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.settmesin (id_sku, nama_sku, jml_mesin, speed, downtime) FROM stdin;
\.
COPY public.settmesin (id_sku, nama_sku, jml_mesin, speed, downtime) FROM '$$PATH$$/2912.dat';

--
-- Data for Name: setttarget; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.setttarget (id_sku, nama_line, nama_sku, target, keterangan, id_line) FROM stdin;
\.
COPY public.setttarget (id_sku, nama_line, nama_sku, target, keterangan, id_line) FROM '$$PATH$$/2901.dat';

--
-- Data for Name: sku; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sku (id_line, id_sku, nama_sku, jml_karton, nama_line, isi_karton, std_etiket) FROM stdin;
\.
COPY public.sku (id_line, id_sku, nama_sku, jml_karton, nama_line, isi_karton, std_etiket) FROM '$$PATH$$/2896.dat';

--
-- Data for Name: tmpidentitas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tmpidentitas (id, regu, shift, stock_keeper, kasie, spv, login_time, role) FROM stdin;
\.
COPY public.tmpidentitas (id, regu, shift, stock_keeper, kasie, spv, login_time, role) FROM '$$PATH$$/2907.dat';

--
-- Data for Name: tsku; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tsku (id, tanggal, line, sku, no_pallet, isi_pallet) FROM stdin;
\.
COPY public.tsku (id, tanggal, line, sku, no_pallet, isi_pallet) FROM '$$PATH$$/2909.dat';

--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, username, password, role, is_active) FROM stdin;
\.
COPY public.users (id, username, password, role, is_active) FROM '$$PATH$$/2902.dat';

--
-- Name: 10101_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."10101_id_seq"', 74, true);


--
-- Name: 10102_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."10102_id_seq"', 13, true);


--
-- Name: 11111_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."11111_id_seq"', 1, false);


--
-- Name: alldata_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.alldata_id_seq', 85, true);


--
-- Name: identitas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.identitas_id_seq', 3, true);


--
-- Name: tmpidentitas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tmpidentitas_id_seq', 1, true);


--
-- Name: tsku_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tsku_id_seq', 1, false);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 5, true);


--
-- Name: 10101 10101_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."10101"
    ADD CONSTRAINT "10101_pkey" PRIMARY KEY (id);


--
-- Name: 10102 10102_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."10102"
    ADD CONSTRAINT "10102_pkey" PRIMARY KEY (id);


--
-- Name: 11111 11111_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."11111"
    ADD CONSTRAINT "11111_pkey" PRIMARY KEY (id);


--
-- Name: alldata alldata_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alldata
    ADD CONSTRAINT alldata_pkey PRIMARY KEY (id);


--
-- Name: identitas identitas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.identitas
    ADD CONSTRAINT identitas_pkey PRIMARY KEY (id);


--
-- Name: line line_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.line
    ADD CONSTRAINT line_pkey PRIMARY KEY (id_line);


--
-- Name: setttarget setpo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.setttarget
    ADD CONSTRAINT setpo_pkey PRIMARY KEY (id_sku);


--
-- Name: settmesin settmesin_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.settmesin
    ADD CONSTRAINT settmesin_pkey PRIMARY KEY (id_sku);


--
-- Name: sku sku_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sku
    ADD CONSTRAINT sku_pkey PRIMARY KEY (id_sku);


--
-- Name: tmpidentitas tmpidentitas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tmpidentitas
    ADD CONSTRAINT tmpidentitas_pkey PRIMARY KEY (id);


--
-- Name: tsku tsku_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tsku
    ADD CONSTRAINT tsku_pkey PRIMARY KEY (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE USAGE ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                