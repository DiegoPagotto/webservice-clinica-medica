CREATE DATABASE CLINICA_MEDICA;
USE CLINICA_MEDICA;

CREATE TABLE ADMINISTRADOR(
	ID INT AUTO_INCREMENT,
	LOGIN VARCHAR(20) UNIQUE,
    SENHA CHAR(60),
    CONSTRAINT ADMINISTRADOR_PK PRIMARY KEY (ID)
);

CREATE TABLE ESPECIALIDADE(
	ID INT AUTO_INCREMENT,
    ESPECIALIDADE VARCHAR(40),
    CONSTRAINT ESPECIALIDADE_PK PRIMARY KEY(ID)
);

CREATE TABLE PACIENTE(
	ID INT AUTO_INCREMENT,
    NOME VARCHAR(60) NOT NULL,
    DATA_NASCIMENTO DATE,
    CONSTRAINT PACIENTE_PK PRIMARY KEY(ID)
);

CREATE TABLE MEDICO(
	ID INT AUTO_INCREMENT,
    NOME VARCHAR(60) NOT NULL,
    ID_ESPECIALIDADE INT,
    CONSTRAINT ID_ESPEC_FK FOREIGN KEY (ID_ESPECIALIDADE) REFERENCES ESPECIALIDADE(ID),
    CONSTRAINT MEDICO_PK PRIMARY KEY (ID)
);

CREATE TABLE CONSULTA(
	ID INT AUTO_INCREMENT,
    ID_PACIENTE INT,
    ID_MEDICO INT,
    DATA_CONSULTA DATETIME,
    CONSTRAINT CONSULTA_PAC_ID FOREIGN KEY (ID_PACIENTE) REFERENCES PACIENTE(ID),
    CONSTRAINT CONSULTA_MED_ID FOREIGN KEY (ID_MEDICO) REFERENCES MEDICO(ID),
    CONSTRAINT CONSULTA_PK PRIMARY KEY (ID)
);

INSERT INTO ESPECIALIDADE(ESPECIALIDADE) VALUES
('Acupuntura'),
('Alergia e imunologia'),
('Anestesiologia'),
('Angiologia'),
('Cardiologia'),
('Cirurgia cardiovascular'),
('Cirurgia da mão'),
('Cirurgia de cabeça e pescoço'),
('Cirurgia do aparelho digestivo'),
('Cirurgia geral'),
('Cirurgia oncológica'),
('Cirurgia pediátrica'),
('Cirurgia plástica'),
('Cirurgia torácica'),
('Cirurgia vascular'),
('Clínica médica'),
('Coloproctologia'),
('Dermatologia'),
('Endocrinologia e metabologia'),
('Endoscopia'),
('Gastroenterologia'),
('Genética médica'),
('Geriatria'),
('Ginecologia e obstetrícia'),
('Hematologia e hemoterapia'),
('Homeopatia'),
('Infectologia'),
('Mastologia'),
('Medicina de emergência'),
('Medicina de família e comunidade'),
('Medicina do trabalho'),
('Medicina de tráfego'),
('Medicina esportiva'),
('Medicina física e reabilitação'),
('Medicina intensiva'),
('Medicina legal e perícia médica'),
('Medicina nuclear'),
('Medicina preventiva e social'),
('Nefrologia'),
('Neurocirurgia'),
('Neurologia'),
('Nutrologia'),
('Oftalmologia'),
('Oncologia clínica'),
('Ortopedia e traumatologia'),
('Otorrinolaringologia'),
('Patologia'),
('Patologia clínica/medicina laboratorial'),
('Pediatria'),
('Pneumologia'),
('Psiquiatria'),
('Radiologia e diagnóstico por imagem'),
('Radioterapia'),
('Reumatologia'),
('Urologia');

SELECT * FROM ESPECIALIDADE;
