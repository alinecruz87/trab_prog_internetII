
CREATE TABLE IF NOT EXISTS diaristas ( 
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT , 
    nome VARCHAR(100) NOT NULL , 
    endereco VARCHAR(200) NOT NULL , 
    telefone INT(11)  , 
    qte_pessoas INT(2)  , 
    ponto_ref varchar(150)  , 
    cpf INT(11) ,
    PRIMARY KEY (id)
    ) ;


CREATE TABLE IF NOT EXISTS voluntarios ( 
    id_v INT NOT NULL PRIMARY KEY AUTO_INCREMENT ,
    nome_v VARCHAR(100) NOT NULL ,
    endereco_v VARCHAR(200) NOT NULL ,
    telefone_v INT(11)  ,
    automovel BOOLEAN  ,
    cpf_v INT(11) ,
    PRIMARY KEY (id_v)
);


CREATE TABLE IF NOT EXISTS CREATE TABLE IF NOT EXISTS entregas ( 
    id_e INT NOT NULL PRIMARY KEY AUTO_INCREMENT , 
    id_v INT NOT NULL , 
    id_d INT NOT NULL , 
    qtde_cesta INT(2) NOT NULL , 
    FOREIGN KEY (id_v) REFERENCES voluntarios(id_v), 
    FOREIGN KEY (id_d) REFERENCES diaristas(id) 
);