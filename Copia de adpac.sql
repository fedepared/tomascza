--
-- PostgreSQL database dump
--

SET client_encoding = 'LATIN1';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'Standard public schema';


--
-- Name: plpgsql; Type: PROCEDURAL LANGUAGE; Schema: -; Owner: postgres
--

CREATE PROCEDURAL LANGUAGE plpgsql;


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: ids; Type: TABLE; Schema: public; Owner: adpac; Tablespace: 
--

CREATE TABLE ids (
    id integer,
    tabla character varying(55)
);


ALTER TABLE public.ids OWNER TO adpac;

--
-- Name: medicos; Type: TABLE; Schema: public; Owner: adpac; Tablespace: 
--

CREATE TABLE medicos (
    med_id integer NOT NULL,
    med_nombre character varying(255)
);


ALTER TABLE public.medicos OWNER TO adpac;

--
-- Name: pacientes; Type: TABLE; Schema: public; Owner: adpac; Tablespace: 
--

CREATE TABLE pacientes (
    pac_id integer NOT NULL,
    pac_nombre character varying(255),
    pac_apellido character varying(255),
    pac_direccion character varying(255),
    pac_telefono character varying(255),
    pac_email character varying(255),
    pac_observaciones text,
    pac_med_id integer NOT NULL
);


ALTER TABLE public.pacientes OWNER TO adpac;

--
-- Data for Name: ids; Type: TABLE DATA; Schema: public; Owner: adpac
--

COPY ids (id, tabla) FROM stdin;
3	medicos
14	pacientes
\.


--
-- Data for Name: medicos; Type: TABLE DATA; Schema: public; Owner: adpac
--

COPY medicos (med_id, med_nombre) FROM stdin;
1	Tomás
2	Diana
\.


--
-- Data for Name: pacientes; Type: TABLE DATA; Schema: public; Owner: adpac
--

COPY pacientes (pac_id, pac_nombre, pac_apellido, pac_direccion, pac_telefono, pac_email, pac_observaciones, pac_med_id) FROM stdin;
14	Tomás	Di Doménico	Av. Callao 1052 5B	cac12	1213	adsdsdasdassa	1
\.


--
-- Name: medicos_pkey; Type: CONSTRAINT; Schema: public; Owner: adpac; Tablespace: 
--

ALTER TABLE ONLY medicos
    ADD CONSTRAINT medicos_pkey PRIMARY KEY (med_id);


--
-- Name: pacientes_pkey; Type: CONSTRAINT; Schema: public; Owner: adpac; Tablespace: 
--

ALTER TABLE ONLY pacientes
    ADD CONSTRAINT pacientes_pkey PRIMARY KEY (pac_id);


--
-- Name: fk_medicos; Type: FK CONSTRAINT; Schema: public; Owner: adpac
--

ALTER TABLE ONLY pacientes
    ADD CONSTRAINT fk_medicos FOREIGN KEY (pac_med_id) REFERENCES medicos(med_id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

