-- MySQL Script generated by MySQL Workbench
-- Tue Nov  6 17:41:40 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema acl
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema acl
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `acl` DEFAULT CHARACTER SET utf8 ;
USE `acl` ;

-- -----------------------------------------------------
-- Table `acl`.`modulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`modulo` (
  `idModulo` INT(11) NOT NULL AUTO_INCREMENT,
  `hash` VARCHAR(50) NULL DEFAULT NULL COMMENT 'hash',
  `nombre` VARCHAR(50) NOT NULL,
  `estado` ENUM('Activo', 'Inactivo') NOT NULL,
  PRIMARY KEY (`idModulo`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idModulo`, `hash`, `nombre`, `estado`) VALUES
(1, '356a192b7913b04c54574d18c28d46e6395428ab', 'Producto', 'Activo'),
(2, 'da4b9237bacccdf19c0760cab7aec4a8359010b0', 'Venta', 'Activo');
-- -----------------------------------------------------
-- Table `acl`.`objeto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`objeto` (
  `idObjeto` INT(11) NOT NULL AUTO_INCREMENT,
  `hash` VARCHAR(50) NULL DEFAULT NULL COMMENT 'hash',
  `nombre` VARCHAR(50) NULL DEFAULT NULL,
  `imagen` VARCHAR(50) NULL DEFAULT NULL,
  `nombreControl` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Nombre del Controlador de Arranque',
  `orden` INT(11) NULL DEFAULT NULL,
  `idModulo` INT(11) NULL DEFAULT NULL,
  `estado` ENUM('Activo', 'Inactivo') NOT NULL,
  PRIMARY KEY (`idObjeto`),
  INDEX `FK_Objeto` (`idModulo` ASC),
  CONSTRAINT `FK_Objeto`
    FOREIGN KEY (`idModulo`)
    REFERENCES `acl`.`modulo` (`idModulo`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = latin1;

--
-- Volcado de datos para la tabla `objeto`
--

INSERT INTO `objeto` (`idObjeto`, `hash`, `nombre`, `imagen`, `nombreControl`, `orden`, `idModulo`, `estado`) VALUES
(1, '356a192b7913b04c54574d18c28d46e6395428ab', 'Listar Productos', NULL, 'c-producto-list', 1, 1, 'Activo'),
(2, 'da4b9237bacccdf19c0760cab7aec4a8359010b0', 'Registrar Producto', NULL, 'c-producto-new', 2, 1, 'Activo'),
(3, '77de68daecd823babbb58edb1c8e14d7106e83bb', 'Editar Producto', NULL, 'c-producto-edit', 3, 1, 'Activo'),
(4, '1b6453892473a467d07372d45eb05abc2031647a', 'Eliminar Producto', NULL, 'c-producto-delete', 4, 1, 'Activo'),
(5, 'ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', 'Listar Ventas', NULL, 'c-venta-list', 5, 2, 'Activo'),
(6, 'c1dfd96eea8cc2b62785275bca38ac261256e278', 'Registrar Venta', NULL, 'c-venta-new', 6, 2, 'Activo');
-- -----------------------------------------------------
-- Table `acl`.`rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`rol` (
  `idRol` INT(11) NOT NULL AUTO_INCREMENT,
  `hash` VARCHAR(50) NULL DEFAULT NULL COMMENT 'hash',
  `nombre` VARCHAR(50) NOT NULL,
  `estado` ENUM('Activo', 'Inactivo') NOT NULL,
  PRIMARY KEY (`idRol`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;

INSERT INTO `rol` (`idRol`, `hash`, `nombre`, `estado`) VALUES
(1, '356a192b7913b04c54574d18c28d46e6395428ab', 'Administrador', 'Activo'),
(2, 'da4b9237bacccdf19c0760cab7aec4a8359010b0', 'Ejecutivo de Ventas', 'Activo');
-- -----------------------------------------------------
-- Table `acl`.`rol_modulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`rol_modulo` (
  `idRol` INT(11) NOT NULL,
  `idModulo` INT(11) NOT NULL,
  `hash` VARCHAR(50) NULL DEFAULT NULL COMMENT 'hash',
  `estado` ENUM('Activo', 'Inactivo') NOT NULL,
  PRIMARY KEY (`idRol`, `idModulo`),
  INDEX `FK_UsuarioModulo_2` (`idModulo` ASC),
  CONSTRAINT `FK_UsuarioModulo_1`
    FOREIGN KEY (`idRol`)
    REFERENCES `acl`.`rol` (`idRol`),
  CONSTRAINT `FK_UsuarioModulo_2`
    FOREIGN KEY (`idModulo`)
    REFERENCES `acl`.`modulo` (`idModulo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

--
-- Volcado de datos para la tabla `rol_modulo`
--

INSERT INTO `rol_modulo` (`idRol`, `idModulo`, `hash`, `estado`) VALUES
(1, 1, '4442a5dbd26972f9c3cdc88ca26d25f692c416f0', 'Activo'),
(1, 2, 'e97543e8793f59c7aa79daebc8d07a0c4b291e52', 'Activo'),
(2, 2, '66f51dd12de258598aca6a343a5217561904c489', 'Activo');
-- -----------------------------------------------------
-- Table `acl`.`empleado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`empleado` (
  `idEmpleado` INT NOT NULL AUTO_INCREMENT,
  `hash` VARCHAR(50) NULL,
  `nombre` VARCHAR(90) NOT NULL,
  `apPaterno` VARCHAR(90) NULL,
  `apMaterno` VARCHAR(90) NOT NULL,
  `fechaNacimiento` DATETIME NOT NULL,
  `ci` VARCHAR(15) NOT NULL,
  `estado` ENUM('Activo', 'Inactivo') NOT NULL,
  PRIMARY KEY (`idEmpleado`))
ENGINE = InnoDB;

INSERT INTO `empleado` (`idEmpleado`, `hash`, `nombre`, `apPaterno`,`apMaterno`,`fechaNacimiento`,`ci`,`estado`) VALUES
(1,'', 'Leonardo','Perez','Justiniano','1993-08-07', '9719974' ,'Activo'),
(2,'', 'Susana','Lopez','Padilla','1991-12-01', '3190273' ,'Activo');
-- -----------------------------------------------------
-- Table `acl`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`usuario` (
  `idUsuario` INT(11) NOT NULL AUTO_INCREMENT,
  `hash` VARCHAR(50) NULL DEFAULT NULL COMMENT 'hash',
  `username` VARCHAR(50) NOT NULL COMMENT 'user',
  `password` BLOB NOT NULL COMMENT 'pswd',
  `alias` VARCHAR(50) NULL DEFAULT NULL,
  `email` VARCHAR(50) NULL DEFAULT NULL,
  `idRol` INT(11) NOT NULL,
  `estado` ENUM('Activo', 'Inactivo') NOT NULL,
  `idEmpleado` INT NOT NULL,
  PRIMARY KEY (`idUsuario`),
  INDEX `FK_Usuario` (`idRol` ASC),
  INDEX `fk_usuario_empleado1_idx` (`idEmpleado` ASC),
  CONSTRAINT `FK_Usuario`
    FOREIGN KEY (`idRol`)
    REFERENCES `acl`.`rol` (`idRol`),
  CONSTRAINT `fk_usuario_empleado1`
    FOREIGN KEY (`idEmpleado`)
    REFERENCES `acl`.`empleado` (`idEmpleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1
COMMENT = 'user';
--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `hash`, `username`, `password`, `alias`, `email`, `idRol`, `estado`,`idEmpleado`) VALUES
(1, '356a192b7913b04c54574d18c28d46e6395428ab', 'admin', 0x60f4aa7481a32daaee8b383667940ec2, 'Admin', 'admin@hotmail.com', 1, 'Activo',1),
(2, 'da4b9237bacccdf19c0760cab7aec4a8359010b0', 'vendedor', 0x60f4aa7481a32daaee8b383667940ec2, 'Vendedor', 'vendedor@hotmail.com', 2, 'Activo',2);

-- -----------------------------------------------------
-- Table `acl`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`cliente` (
  `idCliente` INT NOT NULL AUTO_INCREMENT,
  `direccion` VARCHAR(200) NOT NULL,
  `telefonoFijo` VARCHAR(45) NULL,
  `telefonoCelular` VARCHAR(20) NOT NULL,
  `estado` ENUM('Activo', 'Inactivo') NULL,
  PRIMARY KEY (`idCliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acl`.`natural`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`natural` (
  `idCliente` INT NOT NULL,
  `nombre` VARCHAR(90) NOT NULL,
  `apPaterno` VARCHAR(90) NOT NULL,
  `apMaterno` VARCHAR(45) NOT NULL,
  `fechanacimiento` VARCHAR(45) NOT NULL,
  `ci` VARCHAR(45) NOT NULL,
  `genero` ENUM('Masculino', 'Femenino', 'Otro') NOT NULL,
  PRIMARY KEY (`idCliente`),
  CONSTRAINT `fk_Natural_Cliente`
    FOREIGN KEY (`idCliente`)
    REFERENCES `acl`.`cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acl`.`juridico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`juridico` (
  `idCliente` INT NOT NULL,
  `razonSocial` VARCHAR(200) NOT NULL,
  `rpteLegal` VARCHAR(200) NOT NULL,
  `nit` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`idCliente`),
  CONSTRAINT `fk_Juridico_Cliente`
    FOREIGN KEY (`idCliente`)
    REFERENCES `acl`.`cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acl`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`categoria` (
  `idCategoria` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `descripcion` VARCHAR(200) NOT NULL,
  `estado` ENUM('Activo', 'Inactivo') NOT NULL,
  PRIMARY KEY (`idCategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acl`.`subCategoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`subCategoria` (
  `idsubCategoria` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(90) NOT NULL,
  `descripcion` VARCHAR(200) NOT NULL,
  `estado` ENUM('Activo', 'Inactivo') NOT NULL,
  `categoria_idCategoria` INT NOT NULL,
  PRIMARY KEY (`idsubCategoria`),
  INDEX `fk_subCategoria_categoria1_idx` (`categoria_idCategoria` ASC),
  CONSTRAINT `fk_subCategoria_categoria1`
    FOREIGN KEY (`categoria_idCategoria`)
    REFERENCES `acl`.`categoria` (`idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acl`.`unidadMedida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`unidadMedida` (
  `idunidadMedida` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `abrev` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idunidadMedida`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acl`.`proveedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`proveedor` (
  `idProveedor` INT NOT NULL AUTO_INCREMENT,
  `hash` VARCHAR(50) NULL,
  `company` VARCHAR(200) NOT NULL,
  `contacto` VARCHAR(100) NOT NULL,
  `direccion` VARCHAR(200) NOT NULL,
  `telefonoFijo` VARCHAR(45) NULL,
  `telefonoCelular` VARCHAR(45) NOT NULL,
  `correo` VARCHAR(250) NOT NULL,
  `paginaWeb` VARCHAR(250) NULL,
  `estado` ENUM('Activo', 'Inactivo') NOT NULL,
  PRIMARY KEY (`idProveedor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acl`.`producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`producto` (
  `idProducto` INT NOT NULL AUTO_INCREMENT,
  `hash` VARCHAR(50) NULL,
  `nombre` VARCHAR(90) NOT NULL,
  `descripcion` VARCHAR(45) NOT NULL,
  `cantidadXunidad` VARCHAR(45) NOT NULL,
  `estado` ENUM('Activo', 'Inactivo') NOT NULL,
  `peso` VARCHAR(45) NULL,
  `madein` VARCHAR(45) NULL,
  `idsubCategoria` INT NOT NULL,
  `idunidadMedida` INT NOT NULL,
  `idProveedor` INT NOT NULL,
  PRIMARY KEY (`idProducto`),
  INDEX `fk_producto_subCategoria1_idx` (`idsubCategoria` ASC),
  INDEX `fk_producto_unidadMedida1_idx` (`idunidadMedida` ASC),
  INDEX `fk_producto_proveedor1_idx` (`idProveedor` ASC),
  CONSTRAINT `fk_producto_subCategoria1`
    FOREIGN KEY (`idsubCategoria`)
    REFERENCES `acl`.`subCategoria` (`idsubCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_unidadMedida1`
    FOREIGN KEY (`idunidadMedida`)
    REFERENCES `acl`.`unidadMedida` (`idunidadMedida`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_proveedor1`
    FOREIGN KEY (`idProveedor`)
    REFERENCES `acl`.`proveedor` (`idProveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acl`.`precio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`precio` (
  `idPrecio` INT NOT NULL AUTO_INCREMENT,
  `precioCompra` FLOAT NULL COMMENT 'El precio de compra solo unica vez editado luego solo es editable el precio venta',
  `precioVenta` FLOAT NOT NULL,
  `fecha` DATETIME NOT NULL,
  `motivo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPrecio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acl`.`sucursal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`sucursal` (
  `idSucursal` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `dirrecion` VARCHAR(45) NOT NULL,
  `telefonofijo` VARCHAR(45) NULL,
  `estado` ENUM('Activo', 'Inactivo') NOT NULL,
  `abrev` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idSucursal`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acl`.`almacen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`almacen` (
  `idAlmacen` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `abrev` VARCHAR(45) NOT NULL,
  `idSucursal` INT NOT NULL,
  PRIMARY KEY (`idAlmacen`),
  INDEX `fk_almacen_sucursal1_idx` (`idSucursal` ASC),
  CONSTRAINT `fk_almacen_sucursal1`
    FOREIGN KEY (`idSucursal`)
    REFERENCES `acl`.`sucursal` (`idSucursal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acl`.`tipoPedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`tipoPedido` (
  `idtipoPedido` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(200) NOT NULL,
  `estado` ENUM('Activo', 'Inactivo') NULL,
  PRIMARY KEY (`idtipoPedido`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acl`.`pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`pedido` (
  `idPedido` INT NOT NULL AUTO_INCREMENT,
  `TotalPedido` FLOAT NULL,
  `estado` ENUM('Activo', 'Inactivo', 'Rechazado Por Falta de Stock') NOT NULL,
  `idtipoMovimiento` INT NOT NULL,
  `realizado_por` INT NOT NULL,
  `idCliente` INT NOT NULL,
  INDEX `fk_pedido_tipoMovimiento1_idx` (`idtipoMovimiento` ASC),
  PRIMARY KEY (`idPedido`),
  INDEX `fk_pedido_empleado1_idx` (`realizado_por` ASC),
  INDEX `fk_pedido_cliente1_idx` (`idCliente` ASC),
  CONSTRAINT `fk_pedido_tipoMovimiento1`
    FOREIGN KEY (`idtipoMovimiento`)
    REFERENCES `acl`.`tipoPedido` (`idtipoPedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_empleado1`
    FOREIGN KEY (`realizado_por`)
    REFERENCES `acl`.`empleado` (`idEmpleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_cliente1`
    FOREIGN KEY (`idCliente`)
    REFERENCES `acl`.`cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acl`.`producto_almacen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`producto_almacen` (
  `idProducto` INT NOT NULL,
  `idAlmacen` INT NOT NULL,
  `cantidad` FLOAT NOT NULL,
  `idPedido` INT NOT NULL,
  `fechaMovimiento` DATETIME NULL,
  PRIMARY KEY (`idProducto`, `idAlmacen`),
  INDEX `fk_producto_has_almacen_almacen1_idx` (`idAlmacen` ASC),
  INDEX `fk_producto_has_almacen_producto1_idx` (`idProducto` ASC),
  INDEX `fk_producto_almacen_pedido1_idx` (`idPedido` ASC),
  CONSTRAINT `fk_producto_has_almacen_producto1`
    FOREIGN KEY (`idProducto`)
    REFERENCES `acl`.`producto` (`idProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_has_almacen_almacen1`
    FOREIGN KEY (`idAlmacen`)
    REFERENCES `acl`.`almacen` (`idAlmacen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_almacen_pedido1`
    FOREIGN KEY (`idPedido`)
    REFERENCES `acl`.`pedido` (`idPedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acl`.`producto_precio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`producto_precio` (
  `idProducto` INT NOT NULL,
  `idPrecio` INT NOT NULL,
  `fechaAsig` DATETIME NOT NULL,
  `fechaInicio` DATETIME NOT NULL,
  `fechaFin` DATETIME NOT NULL,
  `estado` ENUM('Activo', 'Inactivo') NULL,
  PRIMARY KEY (`idProducto`, `idPrecio`),
  INDEX `fk_producto_has_precio_precio1_idx` (`idPrecio` ASC),
  INDEX `fk_producto_has_precio_producto1_idx` (`idProducto` ASC),
  CONSTRAINT `fk_producto_has_precio_producto1`
    FOREIGN KEY (`idProducto`)
    REFERENCES `acl`.`producto` (`idProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_has_precio_precio1`
    FOREIGN KEY (`idPrecio`)
    REFERENCES `acl`.`precio` (`idPrecio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acl`.`factura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`factura` (
  `idFactura` INT NOT NULL AUTO_INCREMENT,
  `hash` VARCHAR(50) NULL,
  `montoTotal` FLOAT NOT NULL,
  `impuestoTotal` FLOAT NOT NULL,
  `DescuentoTotal` FLOAT NOT NULL,
  `totalpago` FLOAT NOT NULL,
  `codigoControl` VARCHAR(45) NOT NULL,
  `fechaImpresion` DATETIME NOT NULL,
  `nroImpresion` VARCHAR(10) NULL,
  `tc` FLOAT NOT NULL,
  `correlativo` VARCHAR(10) NOT NULL,
  `autorizacion` VARCHAR(45) NOT NULL,
  `fechalimiteEmision` DATETIME NOT NULL,
  `qr` LONGTEXT NOT NULL,
  `estado` ENUM('Vigente', 'Anulado') NOT NULL,
  `idPedido` INT NOT NULL,
  PRIMARY KEY (`idFactura`),
  INDEX `fk_factura_pedido1_idx` (`idPedido` ASC),
  CONSTRAINT `fk_factura_pedido1`
    FOREIGN KEY (`idPedido`)
    REFERENCES `acl`.`pedido` (`idPedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `acl`.`auditoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `acl`.`auditoria` (
  `idAuditoria` INT NOT NULL AUTO_INCREMENT,
  `fechaMOvimiento` DATETIME NOT NULL,
  `descripcion` VARCHAR(90) NOT NULL,
  `usuario` VARCHAR(90) NOT NULL,
  `equipoApp` VARCHAR(90) NOT NULL,
  `operacion` VARCHAR(90) NOT NULL,
  `objetoAfectado` VARCHAR(90) NOT NULL,
  PRIMARY KEY (`idAuditoria`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
