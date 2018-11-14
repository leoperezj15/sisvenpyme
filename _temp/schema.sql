Create Table rol(
    idRol int not null AUTO_INCREMENT,
    hash varchar(50) COMMENT 'hash',
    nombre varchar(50) not null,
    estado enum('Activo', 'Inactivo') not null,
    CONSTRAINT PK_Rol PRIMARY KEY (idRol)
) ENGINE = InnoDB CHARSET = Latin1;

Create Table usuario(
    idUsuario int not null AUTO_INCREMENT,
    hash varchar(50) COMMENT 'hash',
    username varchar(50) not null COMMENT 'user',
    password blob not null COMMENT 'pswd',
    alias varchar(50),
    email varchar(50),
    idRol int not null,
    estado enum('Activo','Inactivo') not null,
    CONSTRAINT PK_Usuario PRIMARY KEY (idUsuario),
    CONSTRAINT FK_Usuario FOREIGN KEY (idRol) REFERENCES rol (idRol)
) ENGINE = InnoDB CHARSET = Latin1 COMMENT 'user';

Create Table modulo(
    idModulo int not null AUTO_INCREMENT,
    hash varchar(50) COMMENT 'hash',
    nombre varchar(50) not null,
    estado enum('Activo', 'Inactivo') not null,
    CONSTRAINT PK_Modulo PRIMARY KEY (idModulo)
) ENGINE = InnoDB CHARSET = Latin1;

Create Table objeto(
    idObjeto int not null AUTO_INCREMENT,
    hash varchar(50) COMMENT 'hash',
    nombre varchar(50),
    imagen varchar(50),
    nombreControl varchar(50) COMMENT 'Nombre del Controlador de Arranque',
    orden int,
    idModulo int,
    estado enum('Activo', 'Inactivo') not null,
    CONSTRAINT PK_Objeto PRIMARY KEY (idObjeto),
    CONSTRAINT FK_Objeto FOREIGN KEY (idModulo) REFERENCES modulo (idModulo)
) ENGINE = InnoDB CHARSET = Latin1;

Create Table rol_modulo(
    idRol int not null,
    idModulo int not null,
    hash varchar(50) COMMENT 'hash',
    estado enum('Activo', 'Inactivo') not null,
    CONSTRAINT PK_UsuarioModulo PRIMARY KEY (idRol, idModulo),
    CONSTRAINT FK_UsuarioModulo_1 FOREIGN KEY (idRol) REFERENCES rol (idRol),
    CONSTRAINT FK_UsuarioModulo_2 FOREIGN KEY (idModulo) REFERENCES modulo (idModulo)
) ENGINE = InnoDB CHARSET = Latin1;
