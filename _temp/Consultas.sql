-- Consulta de empleado con respectivo usuario y su rol
SELECT t1.idEmpleado as t1_idEmpleado, CONCAT(t1.nombre,' ', t1.apPaterno,' ', t1.apMaterno) AS t1_nombreCompleto, 
DATE_FORMAT(t1.fechaNacimiento,'%d/%m/%Y') AS t1_fechaNacimiento,t1.ci AS t1_ci , t2.username AS t2_usuario,
t2.email AS t2_email, t3.nombre AS t3_rol FROM `empleado` as t1
INNER JOIN usuario t2 on t1.idEmpleado = t2.idEmpleado and t1.estado = 'activo'
INNER JOIN rol t3 on t2.idRol = t3.idRol
-- -----------------------------------------------------------------------------------------------------------------------------------------------
-- Insert de Categoria
INSERT INTO `categoria`(`idCategoria`, `nombre`, `descripcion`, `estado`) VALUES 
(0,'Herramientas Electricas','Todas las electricas ','Activo'),
(0,'Herramientas Manuales','Todas de manipulacion manual','Activo'),
(0,'Maquinas Soldadoras y componentes','Equipos y componentes de Soldar','Activo'),
(0,'Equipos de Construccion','Todas de construccion','Activo'),
(0,'Equipos Agroforestales','Equipos y herramientas Agroforestales','Activo'),
(0,'Bombas de Fluido','De diferentes caudales','Activo'),
(0,'Grupos Electrogenos','Generadores de energia  de diferentes voltages','Activo'),
(0,'Iluminacion','Todas de iluminacion','Activo'),
(0,'Equipos de Helevacion y Carga','De elevacion y carga','Activo'),
(0,'Equipos Generadores de Aire','Generadores y compresores','Activo');
----------------------------------------------------------------------------------------------------------------------------------------------------
--Insert de Sub Categoria
INSERT INTO `subcategoria`(`idsubCategoria`, `nombre`, `descripcion`, `estado`, `idCategoria`) VALUES 
(0,'Herramientas Electricas Industriales','','Activo',1),
(0,'Herramientas Electricas Profesionales','','Activo',1),
(0,'Herramientas de Medicion','','Activo',1),
(0,'Herramientas Electricas Multiuso','','Activo',1),
(0,'Alicates','','Activo',1),
(0,'Llaves','','Activo',1),
(0,'Medicion y Trazado','','Activo',2),
(0,'Dados y Accesorios','','Activo',2),
(0,'Herramientas de Golpe','','Activo',2),
(0,'Herramientas de Corte y Terminacion','','Activo',2),
(0,'Herramientas de Fijacion','','Activo',2),
(0,'Almacenaje o Gabinetes','','Activo',2),
(0,'Prensas','','Activo',2),
(0,'Juego de Herramientas','','Activo',2),
(0,'Herramientas Mecanicas','','Activo',2);