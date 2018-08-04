/*
Created		12/06/2018
Modified		07/07/2018
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/




Create table aluno (
	matricula_alu Int NOT NULL AUTO_INCREMENT COMMENT 'N�mero da matr�cula do aluno',
	nome_alu Varchar(30) NOT NULL COMMENT 'Nome do aluno',
	sobrenome_alu Char(70) NOT NULL COMMENT 'Sobrenome do aluno',
	cpf_alu Char(14) NOT NULL COMMENT 'CPF do aluno',
	rg_alu Varchar(16) COMMENT 'RG do aluno',
	dt_nasc_alu Date NOT NULL COMMENT 'Data de nascimento do aluno',
	nome_pai Varchar(100) COMMENT 'Nome do pai do aluno',
	nome_mae Varchar(100) COMMENT 'Nome da m�e do aluno',
	sexo_alu Char(1) NOT NULL COMMENT 'Sexo do aluno',
	num_chamada Varchar(3) COMMENT 'N�mero do aluno na chamada',
	tipo_alu Char(1) NOT NULL COMMENT 'Tipo do aluno (ensino integrado ou subsequente)',
	usuario_alu Varchar(20) COMMENT 'Nome de usuario do aluno, para acesso a plataforma',
	senha_alu Varchar(40) COMMENT 'Senha de acesso a plataforma do aluno',
	nivel Char(1) COMMENT 'Nivel de acesso do aluno ao sistema',
	ativo_usu_alu Char(1) COMMENT 'Status do aluno usuario (ativo ou inativo)',
	cep Char(9) NOT NULL COMMENT 'CEP do aluno',
	num_resid_alu Varchar(6) COMMENT 'N�mero da resid�ncia do aluno',
	complemento_alu Varchar(20) COMMENT 'Complemento da resid�ncia do aluno (quando houver)',
	UNIQUE (matricula_alu),
	UNIQUE (cpf_alu),
	UNIQUE (usuario_alu),
 Primary Key (matricula_alu)) ENGINE = InnoDB;

Create table funcionario (
	id_func Int NOT NULL AUTO_INCREMENT COMMENT 'ID do funcion�rio',
	nome_func Varchar(30) NOT NULL COMMENT 'Nome do funcion�rio',
	sobrenome_func Varchar(20) COMMENT 'Sobrenome do funcion�rio
',
	cpf_func Char(14) NOT NULL COMMENT 'CPF do funcion�rio',
	rg_fun Varchar(16) NOT NULL COMMENT 'RG do funcion�rio',
	dt_nasc_func Date NOT NULL COMMENT 'Data de nascimento do funcion�rio',
	cep Char(9) NOT NULL COMMENT 'CEP do funcion�rio',
	num_resid_func Varchar(6) COMMENT 'N�mero da resid�ncia do funcion�rio',
	complemento_func Varchar(6) COMMENT 'Complemento da resid�ncia do funcion�rio (quando houver)',
	id_setor Int NOT NULL COMMENT 'C�digo do setor ao qual o funcion�rio faz parte',
	UNIQUE (id_func),
	UNIQUE (cpf_func),
 Primary Key (id_func)) ENGINE = InnoDB;

Create table disciplina (
	id_disc Int NOT NULL AUTO_INCREMENT COMMENT 'ID da disciplina',
	nome_disc Varchar(100) NOT NULL COMMENT 'Nome da disciplina',
	ch_disc Char(20) NOT NULL COMMENT 'Cargaga hor�ria da disciplina',
	id_cur Varchar(4) NOT NULL COMMENT 'C�digo do curso a qual a disciplina pertence',
 Primary Key (id_disc)) ENGINE = InnoDB;

Create table turma (
	id_turma Varchar(10) NOT NULL COMMENT 'Id da turma',
	ano_letivo Year(4) NOT NULL COMMENT 'Ano letivo da turma',
	turno Varchar(5) NOT NULL COMMENT 'Turno de atividades da turma (manh�, tarde ou noite)',
	dt_inicio Date NOT NULL COMMENT 'Data de in�cio da turma',
	dt_fim Date COMMENT 'Data de encerramento da turma',
	id_cur Varchar(4) NOT NULL COMMENT 'C�digo do curso que a turma faz parte',
	UNIQUE (id_turma),
 Primary Key (id_turma)) ENGINE = InnoDB;

Create table setor (
	id_setor Int NOT NULL AUTO_INCREMENT COMMENT 'Id do setor',
	nome_setor Varchar(20) NOT NULL COMMENT 'Nome do setor',
	UNIQUE (id_setor),
 Primary Key (id_setor)) ENGINE = InnoDB;

Create table sala (
	id_sala Int NOT NULL AUTO_INCREMENT,
	nome_sala Varchar(2) NOT NULL,
	situacao Varchar(100) NOT NULL,
	capacidade Varchar(4),
	tipo Varchar(100),
 Primary Key (id_sala)) ENGINE = InnoDB;

Create table curso (
	id_cur Varchar(4) NOT NULL COMMENT 'ID do curso',
	nome_cur Varchar(30) NOT NULL COMMENT 'Nome do curso',
	ch_cur Varchar(10) NOT NULL COMMENT 'Carga hor�ria do curso',
	UNIQUE (id_cur),
 Primary Key (id_cur)) ENGINE = InnoDB;

Create table usuario (
	id_usu Int NOT NULL AUTO_INCREMENT COMMENT 'ID do usuario',
	nome_usu Varchar(100) NOT NULL COMMENT 'Nome do usuario',
	usuario Varchar(20) NOT NULL COMMENT 'Nome de usuario para acesso ao sistema',
	senha Varchar(40) NOT NULL COMMENT 'Senha do usuario para acesso ao sistema',
	email Varchar(30) COMMENT 'E-mail do usuario',
	nivel Char(1) NOT NULL COMMENT 'N�vel de acesso do usuario ao sistema',
	ativo Varchar(7) NOT NULL COMMENT 'Status do usuario (ativo ou inativo)',
	id_func Int NOT NULL COMMENT 'Codigo do funcionario usuario do sistema',
	UNIQUE (id_usu),
	UNIQUE (usuario),
	UNIQUE (email),
 Primary Key (id_usu)) ENGINE = InnoDB;

Create table ministra (
	dt_inicio Date NOT NULL COMMENT 'Data em que um professor come�a a ministrar uma disciplina',
	dt_fim Date COMMENT 'Data em que um professor termina de ministrar uma disciplina',
	id_func Int NOT NULL,
	id_disc Int NOT NULL) ENGINE = InnoDB;

Create table matriculado (
	tipo_matricula Char(1) COMMENT 'Tipo da matr�cula do aluno (ensino integrado ou subsequente)',
	dt_matricula Date NOT NULL COMMENT 'Data da realiza��o da matr�cula
',
	ano_letivo Year(4) COMMENT 'Ano letivo em que o aluno foi matriculado',
	matricula_alu Int NOT NULL,
	id_turma Varchar(10) NOT NULL,
	id_disc Int NOT NULL) ENGINE = InnoDB;

Create table horario (
	id_horario Int NOT NULL AUTO_INCREMENT,
	dia_semana Varchar(20) NOT NULL COMMENT 'Dia da semana do respectivo hor�rio',
	hr_inicio Time NOT NULL COMMENT 'Hor�rio de in�cio',
	hr_fim Time COMMENT 'Hor�rio de fim',
	qtd_tempos Int NOT NULL,
	id_func Int NOT NULL,
	id_turma Varchar(10) NOT NULL,
	id_sala Int NOT NULL,
	id_disc Int NOT NULL,
 Primary Key (id_horario)) ENGINE = InnoDB;

Create table localidade (
	cep Char(9) NOT NULL COMMENT 'C�digo de Endere�amento Postal',
	tp_logradouro Varchar(12) COMMENT 'Tipo do logradouro',
	logradouro Varchar(60) COMMENT 'Nome do logradouro',
	bairro Varchar(20) NOT NULL COMMENT 'Nome do bairro',
	cidade Varchar(20) COMMENT 'Nome da cidade',
	uf Char(2) NOT NULL COMMENT 'Unidade da federa��o',
	UNIQUE (cep),
 Primary Key (cep)) ENGINE = InnoDB;

Create table conteudo (
	id_cont Int NOT NULL AUTO_INCREMENT COMMENT 'ID do conte�do',
	nome_cont Varchar(50) NOT NULL COMMENT 'Nome do conte�do',
	descricao Varchar(500) NOT NULL COMMENT 'Descri��o do conte�do',
	dt_conteudo Date NOT NULL COMMENT 'Data em que o conte�do foi ministrado',
	id_horario Int NOT NULL,
	UNIQUE (id_cont),
 Primary Key (id_cont)) ENGINE = InnoDB;

Create table avaliacao (
	id_ava Int NOT NULL AUTO_INCREMENT COMMENT 'ID da avaliacao',
	nome_ava Varchar(30) COMMENT 'Nome da avalia�ao',
	tipo_ava Char(20) COMMENT 'Tipo da avalia��o (regular ou recupera��o).',
	num_etapa Int COMMENT 'Numero da etapa referente a avalia��o',
	periodicidade Varchar(20) COMMENT 'Periodicidade daquela avalia�ao (bimestral ou trimestral)',
	ano_letivo Date NOT NULL COMMENT 'Ano letivo referente a avalia��o',
	nota Decimal(2,2) COMMENT 'Nota da avalia�ao (0 a 10)',
	id_disc Int NOT NULL COMMENT 'C�digo da disciplina referente � avalia��o
',
	matricula_alu Int NOT NULL COMMENT 'Matricula do aluno avaliado',
	id_func Int NOT NULL COMMENT 'Codigo do professor avaliador',
	UNIQUE (id_ava),
 Primary Key (id_ava)) ENGINE = InnoDB;

Create table cargo (
	id_cargo Int NOT NULL AUTO_INCREMENT COMMENT 'ID do cargo',
	nome_cargo Varchar(20) NOT NULL COMMENT 'Nome do cargo',
	UNIQUE (id_cargo),
 Primary Key (id_cargo)) ENGINE = InnoDB;

Create table funcao (
	id_funcao Int NOT NULL AUTO_INCREMENT COMMENT 'ID da fun��o',
	nome_funcao Varchar(30) NOT NULL COMMENT 'Nome da fun��o',
	UNIQUE (id_funcao),
 Primary Key (id_funcao)) ENGINE = InnoDB;

Create table cargo_funcionario (
	dt_inicio Date COMMENT 'Data em que o funcion�rio comecou a exercer um determinado cargo.',
	dt_fim Date COMMENT 'Data em que o funcion�rio deixou de exercer um determinado cargo',
	id_func Int NOT NULL,
	id_cargo Int NOT NULL) ENGINE = InnoDB;

Create table funcao_funcionario (
	dt_inicio Char(20) COMMENT 'Data em que o funcion�rio come�ou a exercer uma determinada fun��o',
	dt_fim Char(20) COMMENT 'Data em que o funcion�rio deixou de exercer uma determinada fun��o',
	id_func Int NOT NULL,
	id_funcao Int NOT NULL) ENGINE = InnoDB;

Create table frequencia (
	id_freq Int NOT NULL AUTO_INCREMENT COMMENT 'ID da frequ�ncia',
	dt_freq Date NOT NULL COMMENT 'Data da frequ�ncia',
	presenca Char(6) NOT NULL COMMENT 'Status da presen�a (* ou F)',
	matricula_alu Int NOT NULL,
	id_horario Int NOT NULL,
 Primary Key (id_freq)) ENGINE = InnoDB;

Create table resultado (
	id_resultado Int NOT NULL AUTO_INCREMENT COMMENT 'ID do resultado',
	resultado Char(10) NOT NULL,
	matricula_alu Int NOT NULL,
	cod_coc Int NOT NULL,
	id_disc Int NOT NULL,
	UNIQUE (id_resultado),
 Primary Key (id_resultado)) ENGINE = InnoDB;

Create table coc (
	cod_coc Int NOT NULL AUTO_INCREMENT,
	titulo_coc Varchar(20),
 Primary Key (cod_coc)) ENGINE = InnoDB;

Create table reuniao (
	id_reuniao Int NOT NULL AUTO_INCREMENT,
	dt_reuniao Date NOT NULL,
	hr_inicio Time,
	hr_fim Time,
	id_func Int NOT NULL,
	cod_coc Int NOT NULL,
 Primary Key (id_reuniao)) ENGINE = InnoDB;

Create table transferencia_turma (
	id_trans Int NOT NULL AUTO_INCREMENT COMMENT 'ID da transfer�ncia',
	dt_trans Date NOT NULL COMMENT 'Data da transfer�ncia',
	matricula_alu Int NOT NULL,
	id_turma Varchar(10) NOT NULL,
 Primary Key (id_trans)) ENGINE = InnoDB;

Create table transferencia_ue (
	id_trans Int NOT NULL AUTO_INCREMENT COMMENT 'ID da tr�nsferencia de UE
',
	dt_trans Date NOT NULL COMMENT 'Data da transfer�ncia de UE',
	matricula_alu Int NOT NULL,
	id_ue Int NOT NULL,
	UNIQUE (id_trans),
 Primary Key (id_trans)) ENGINE = InnoDB;

Create table unidade_estudantil (
	id_ue Int NOT NULL AUTO_INCREMENT COMMENT 'ID da UE
',
	nome_ue Char(20) NOT NULL COMMENT 'Nome da UE',
	tel_ue Char(13) COMMENT 'Telefone da UE',
	UNIQUE (id_ue),
 Primary Key (id_ue)) ENGINE = InnoDB;

Create table responsavel (
	id_resp Int NOT NULL AUTO_INCREMENT COMMENT 'ID do respons�vel
',
	nome_resp Varchar(30) NOT NULL COMMENT 'Nome do respons�vel
',
	sobrenome_resp Varchar(70) NOT NULL COMMENT 'Sobrenome do respons�vel',
	cpf_resp Char(14) NOT NULL COMMENT 'CPF do respons�vel
',
	rg_resp Varchar(14) COMMENT 'RG do respons�vel',
	cel_resp Varchar(14),
	tel_resp Varchar(13) COMMENT 'Telefone residencial do respons�vel',
	email_resp Varchar(60) NOT NULL,
	matricula_alu Int NOT NULL,
	UNIQUE (id_resp),
	UNIQUE (cpf_resp),
	UNIQUE (email_resp),
 Primary Key (id_resp)) ENGINE = InnoDB;

Create table logatv_usuario (
	id_log Int NOT NULL AUTO_INCREMENT COMMENT 'ID do log da atividade do usu�rio',
	atv Text NOT NULL COMMENT 'C�digo SQL da atividade do usu�rio',
	dthr_atv Datetime NOT NULL COMMENT 'Data e hora da atividade',
	id_usu Int NOT NULL COMMENT 'ID do usu�rio que realizou a atividade',
	UNIQUE (id_log),
 Primary Key (id_log)) ENGINE = InnoDB;












Alter table matriculado add Foreign Key (matricula_alu) references aluno (matricula_alu) on delete  restrict on update  restrict;
Alter table avaliacao add Foreign Key (matricula_alu) references aluno (matricula_alu) on delete  restrict on update  restrict;
Alter table frequencia add Foreign Key (matricula_alu) references aluno (matricula_alu) on delete  restrict on update  restrict;
Alter table resultado add Foreign Key (matricula_alu) references aluno (matricula_alu) on delete  restrict on update  restrict;
Alter table transferencia_turma add Foreign Key (matricula_alu) references aluno (matricula_alu) on delete  restrict on update  restrict;
Alter table transferencia_ue add Foreign Key (matricula_alu) references aluno (matricula_alu) on delete  restrict on update  restrict;
Alter table responsavel add Foreign Key (matricula_alu) references aluno (matricula_alu) on delete  restrict on update  restrict;
Alter table usuario add Foreign Key (id_func) references funcionario (id_func) on delete  restrict on update  restrict;
Alter table avaliacao add Foreign Key (id_func) references funcionario (id_func) on delete  restrict on update  restrict;
Alter table horario add Foreign Key (id_func) references funcionario (id_func) on delete  restrict on update  restrict;
Alter table ministra add Foreign Key (id_func) references funcionario (id_func) on delete  restrict on update  restrict;
Alter table reuniao add Foreign Key (id_func) references funcionario (id_func) on delete  restrict on update  restrict;
Alter table cargo_funcionario add Foreign Key (id_func) references funcionario (id_func) on delete  restrict on update  restrict;
Alter table funcao_funcionario add Foreign Key (id_func) references funcionario (id_func) on delete  restrict on update  restrict;
Alter table avaliacao add Foreign Key (id_disc) references disciplina (id_disc) on delete  restrict on update  restrict;
Alter table horario add Foreign Key (id_disc) references disciplina (id_disc) on delete  restrict on update  restrict;
Alter table ministra add Foreign Key (id_disc) references disciplina (id_disc) on delete  restrict on update  restrict;
Alter table resultado add Foreign Key (id_disc) references disciplina (id_disc) on delete  restrict on update  restrict;
Alter table matriculado add Foreign Key (id_disc) references disciplina (id_disc) on delete  restrict on update  restrict;
Alter table matriculado add Foreign Key (id_turma) references turma (id_turma) on delete  restrict on update  restrict;
Alter table horario add Foreign Key (id_turma) references turma (id_turma) on delete  restrict on update  restrict;
Alter table transferencia_turma add Foreign Key (id_turma) references turma (id_turma) on delete  restrict on update  restrict;
Alter table funcionario add Foreign Key (id_setor) references setor (id_setor) on delete  restrict on update  restrict;
Alter table horario add Foreign Key (id_sala) references sala (id_sala) on delete  restrict on update  restrict;
Alter table disciplina add Foreign Key (id_cur) references curso (id_cur) on delete  restrict on update  restrict;
Alter table turma add Foreign Key (id_cur) references curso (id_cur) on delete  restrict on update  restrict;
Alter table logatv_usuario add Foreign Key (id_usu) references usuario (id_usu) on delete  restrict on update  restrict;
Alter table conteudo add Foreign Key (id_horario) references horario (id_horario) on delete  restrict on update  restrict;
Alter table frequencia add Foreign Key (id_horario) references horario (id_horario) on delete  restrict on update  restrict;
Alter table funcionario add Foreign Key (cep) references localidade (cep) on delete  restrict on update  restrict;
Alter table aluno add Foreign Key (cep) references localidade (cep) on delete  restrict on update  restrict;
Alter table cargo_funcionario add Foreign Key (id_cargo) references cargo (id_cargo) on delete  restrict on update  restrict;
Alter table funcao_funcionario add Foreign Key (id_funcao) references funcao (id_funcao) on delete  restrict on update  restrict;
Alter table reuniao add Foreign Key (cod_coc) references coc (cod_coc) on delete  restrict on update  restrict;
Alter table resultado add Foreign Key (cod_coc) references coc (cod_coc) on delete  restrict on update  restrict;
Alter table transferencia_ue add Foreign Key (id_ue) references unidade_estudantil (id_ue) on delete  restrict on update  restrict;






