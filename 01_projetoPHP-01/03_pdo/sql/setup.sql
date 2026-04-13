
mariadb -u root -p -h 127.0.0.1 --skip-ssl


-- Selecionar o banco criado pelo docker-compose
USE dwii_db;

-- Criar a tabela de tecnologias
CREATE TABLE tecnologias (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nome        VARCHAR(100) NOT NULL,
    categoria   VARCHAR(50)  NOT NULL,
    descricao   TEXT,
    ano_criacao INT,
    criado_em   TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Verificar se a tabela foi criada
SHOW TABLES;
DESCRIBE tecnologias;


INSERT INTO tecnologias (nome, categoria, descricao, ano_criacao) VALUES
('HTML',       'Frontend',  'Linguagem de marcação para estrutura de páginas web.', 1993),
('CSS',        'Frontend',  'Linguagem de estilos para apresentação visual de páginas.', 1996),
('PHP',        'Backend',   'Linguagem server-side amplamente usada para web dinâmica.', 1994),
('MariaDB',    'Banco de Dados', 'Sistema de gerenciamento de banco de dados relacional open-source.', 2009),
('JavaScript', 'Frontend',  'Linguagem de programação para interatividade no navegador.', 1995),
('Git',        'DevOps',    'Sistema de controle de versão distribuído.', 2005);
-- Verificar os dados inseridos
SELECT * FROM tecnologias;
-- Sair do MariaDB
EXIT;