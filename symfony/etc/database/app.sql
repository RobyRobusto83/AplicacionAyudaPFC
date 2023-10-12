CREATE TABLE task
(
    id          INT AUTO_INCREMENT   NOT NULL,
    uuid        CHAR(36)             NOT NULL COMMENT '(DC2Type:guid)',
    name        VARCHAR(255)         NOT NULL,
    description LONGTEXT   DEFAULT NULL,
    priority    VARCHAR(20)          NOT NULL,
    time_total  INT        DEFAULT NULL,
    id_project  INT                  NOT NULL,
    created_at  DATETIME             NOT NULL,
    color       VARCHAR(20)          NOT NULL,
    done        TINYINT(1) DEFAULT 0 NOT NULL,
    is_deleted  TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE document
(
    id         INT AUTO_INCREMENT NOT NULL,
    uuid       CHAR(36)           NOT NULL COMMENT '(DC2Type:guid)',
    title      VARCHAR(255) DEFAULT NULL,
    version    INT                NOT NULL,
    created_at DATETIME           NOT NULL,
    content    LONGTEXT     DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB;
