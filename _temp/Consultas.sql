-- Consulta de empleado con respectivo usuario y su rol
SELECT t1.idEmpleado as t1_idEmpleado, CONCAT(t1.nombre,' ', t1.apPaterno,' ', t1.apMaterno) AS t1_nombreCompleto, 
DATE_FORMAT(t1.fechaNacimiento,'%d/%m/%Y') AS t1_fechaNacimiento,t1.ci AS t1_ci , t2.username AS t2_usuario,
t2.email AS t2_email, t3.nombre AS t3_rol FROM `empleado` as t1
INNER JOIN usuario t2 on t1.idEmpleado = t2.idEmpleado and t1.estado = 'activo'
INNER JOIN rol t3 on t2.idRol = t3.idRol
-- -----------------------------------------------------------------------------------------------------------------------------------------------
