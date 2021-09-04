CREATE TABLE `users` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`name` VARCHAR(250) NOT NULL,
	`email` VARCHAR(250) NOT NULL,
	`document` VARCHAR(250) NOT NULL,
	`password` VARCHAR(250) NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL
);

CREATE TABLE `estados` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(250) NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL
);

CREATE TABLE `cidades` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(250) NOT NULL,
	`estado_id` BIGINT NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL,
	CONSTRAINT `fk_cidade_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados`(`id`)
);

CREATE TABLE `cores` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(250) NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL
);

CREATE TABLE `times` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(250) NOT NULL,
	`ano_fundacao` DATETIME NOT NULL,
	`cidade_id` BIGINT NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL,
	CONSTRAINT `fk_time_cidade` FOREIGN KEY (`cidade_id`) REFERENCES `cidades`(`id`)
);

CREATE TABLE `cores_times` (
	`time_id` BIGINT NOT NULL,
	`cor_id` BIGINT NOT NULL,
	CONSTRAINT `fk_time_cores_times` FOREIGN KEY (`time_id`) REFERENCES `times`(`id`),
	CONSTRAINT `fk_cor_cores_times` FOREIGN KEY (`cor_id`) REFERENCES `cores`(`id`)
);

CREATE TABLE `presidentes` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(250) NOT NULL,
	`mandato_inicio` DATETIME NOT NULL,
	`mandato_fim` DATETIME NULL,
	`time_id` BIGINT NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL,
	CONSTRAINT `fk_presidente_time` FOREIGN KEY (`time_id`) REFERENCES `times`(`id`)
);

CREATE TABLE `estadios` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(250) NOT NULL,
	`capacidade_total` INTEGER NOT NULL,
	`data_construcao` DATETIME NOT NULL,
	`time_id` BIGINT NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL,
	CONSTRAINT `fk_estadio_time` FOREIGN KEY (`time_id`) REFERENCES `times`(`id`)
);

CREATE TABLE `uniformes` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`temporada` VARCHAR(20) NOT NULL,
	`modelo_principal` VARCHAR(250) NOT NULL,
	`modelo_secundario` VARCHAR(250) NOT NULL,
	`time_id` BIGINT NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL,
	CONSTRAINT `fk_uniforme_time` FOREIGN KEY (`time_id`) REFERENCES `times`(`id`)
);

CREATE TABLE `comissoes_tecnicas` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`time_id` BIGINT NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL,
	CONSTRAINT `fk_comissao_time` FOREIGN KEY (`time_id`) REFERENCES `times`(`id`)
);

CREATE TABLE `membros` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(250) NOT NULL,
	`funcao` VARCHAR(20) NOT NULL, # tecnico, auxiliar, preparador_fisico
	`data_admissao` DATETIME NOT NULL,
	`comissao_id` BIGINT NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL,
	CONSTRAINT `fk_membro_comissao` FOREIGN KEY (`comissao_id`) REFERENCES `comissoes_tecnicas`(`id`)
);

CREATE TABLE `planteis` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`temporada` VARCHAR(20) NOT NULL,
	`time_id` BIGINT NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL,
	CONSTRAINT `fk_plantel_time` FOREIGN KEY (`time_id`) REFERENCES `times`(`id`)
);

CREATE TABLE `jogadores` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(250) NOT NULL,
	`temporada` VARCHAR(20) NOT NULL,
	`data_admissao` DATETIME NOT NULL,
	`posicao` VARCHAR(250) NOT NULL,
	`data_nascimento` DATETIME NOT NULL,
	`plantel_id` BIGINT NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL,
	CONSTRAINT `fk_jogador_plantel` FOREIGN KEY (`plantel_id`) REFERENCES `planteis`(`id`)
);

CREATE TABLE `campeonatos` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(250) NOT NULL,
	`temporada` VARCHAR(20) NOT NULL,
	`tipo` VARCHAR(20) NOT NULL, # pontos_corridos, mata_mata
	`premiacao_valor` DECIMAL(8,2) NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL
);

CREATE TABLE `campeonatos_times` (
	`time_id` BIGINT NOT NULL,
	`campeonato_id` BIGINT NOT NULL,
	CONSTRAINT `fk_time_campeonatos_times` FOREIGN KEY (`time_id`) REFERENCES `times`(`id`),
	CONSTRAINT `fk_campeonato_campeonatos_times` FOREIGN KEY (`campeonato_id`) REFERENCES `campeonatos`(`id`)
);

CREATE TABLE `patrocinadores` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(250) NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL
);

CREATE TABLE `campeonatos_patrocinadores` (
	`patrocinador_id` BIGINT NOT NULL,
	`campeonato_id` BIGINT NOT NULL,
	CONSTRAINT `fk_patrocinador_campeonatos_patrocinadores` FOREIGN KEY (`patrocinador_id`) REFERENCES `patrocinadores`(`id`),
	CONSTRAINT `fk_campeonato_campeonatos_patrocinadores` FOREIGN KEY (`campeonato_id`) REFERENCES `campeonatos`(`id`)
);

CREATE TABLE `campeoes` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`time_id` BIGINT NOT NULL,
	`campeonato_id` BIGINT NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL,
	CONSTRAINT `fk_campeoes_time` FOREIGN KEY (`time_id`) REFERENCES `campeoes`(`id`),
	CONSTRAINT `fk_campeoes_campeonato` FOREIGN KEY (`campeonato_id`) REFERENCES `campeonatos`(`id`)
);

CREATE TABLE `partidas` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`data_partida` DATETIME NOT NULL,
	`mandante_id` BIGINT NOT NULL,
	`visitante_id` BIGINT NOT NULL,
	`campeonato_id` BIGINT NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL,
	CONSTRAINT `fk_mandante_time` FOREIGN KEY (`mandante_id`) REFERENCES `times`(`id`),
	CONSTRAINT `fk_visitante_time` FOREIGN KEY (`visitante_id`) REFERENCES `times`(`id`),
	CONSTRAINT `fk_partida_campeonato` FOREIGN KEY (`campeonato_id`) REFERENCES `campeonatos`(`id`)
);

CREATE TABLE `resultados` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`gols_mandante` INTEGER NOT NULL,
	`gols_visitante` INTEGER NOT NULL,
	`mandante_id` BIGINT NOT NULL,
	`visitante_id` BIGINT NOT NULL,
	`partida_id` BIGINT NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL,
	CONSTRAINT `fk_resultados_mandante` FOREIGN KEY (`mandante_id`) REFERENCES `times`(`id`),
	CONSTRAINT `fk_resultados_visitante` FOREIGN KEY (`visitante_id`) REFERENCES `times`(`id`),
	CONSTRAINT `fk_resultados_partida` FOREIGN KEY (`partida_id`) REFERENCES `partidas`(`id`)
);

CREATE TABLE `transmissoes` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`tipo` VARCHAR(20) NOT NULL, # TV, Rádio, Lives
	`narrador` VARCHAR(250) NOT NULL, # Nome do narrador
	`data_transmissao` DATETIME NOT NULL,
	`partida_id` BIGINT NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL,
	CONSTRAINT `fk_transmissao_partida` FOREIGN KEY (`partida_id`) REFERENCES `partidas`(`id`)
);

CREATE TABLE `ambitragens` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`partida_id` BIGINT NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL,
	CONSTRAINT `fk_arbitragem_partida` FOREIGN KEY (`partida_id`) REFERENCES `partidas`(`id`)
);

CREATE TABLE `arbitros` (
	`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(250) NOT NULL,
	`data_nascimento` DATETIME NOT NULL,
	`tipo` VARCHAR(20) NOT NULL, # principal, auxiliar, quatro_arbitro, arbitro_var
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL
);

CREATE TABLE `arbitros_ambitragens` (
	`arbitragem_id` BIGINT NOT NULL,
	`arbitro_id` BIGINT NOT NULL,
	CONSTRAINT `fk_arbitragem_arbitros_ambitragens` FOREIGN KEY (`arbitragem_id`) REFERENCES `ambitragens`(`id`),
	CONSTRAINT `fk_arbitro_arbitros_ambitragens` FOREIGN KEY (`arbitro_id`) REFERENCES `arbitros`(`id`)
);