CREATE KEYSPACE FotoDeteccion WITH replication = {'class':'SimpleStrategy', 'replication_factor':1};
USE FotoDeteccion;

// Q1:
CREATE TABLE infracciones_by_placa (infracciones_placa TEXT, fecha TIMESTAMP, velocidad INT, lugar INT, PRIMARY KEY (infracciones_placa,fecha,velocidad,lugar)) WITH CLUSTERING ORDER BY (fecha ASC, velocidad ASC, lugar ASC);

/* SELECT fecha, lugar FROM infracciones_by_placa WHERE infracciones_placa=? and velocidad=? and fecha>?; */

// Q2:
CREATE TABLE estadistica_mensual (infracciones_placa TEXT, fecha TIMESTAMP, lugar INT, PRIMARY KEY (infracciones_placa,fecha,lugar)) WITH CLUSTERING ORDER BY (fecha ASC, lugar ASC);

/* SELECT lugar FROM estadistica_mensual WHERE fecha=? and infracciones_placa=?; */

// Q3:
CREATE TABLE infracciones_by_cedula (cedula INT, velocidad INT, lugar INT, fecha TIMESTAMP, infracciones_placa TEXT, PRIMARY KEY (cedula,velocidad,lugar,fecha,infracciones_placa)) WITH CLUSTERING ORDER BY (velocidad ASC, lugar ASC, fecha ASC, infracciones_placa ASC);

/* SELECT velocidad, lugar, fecha, infracciones_placa FROM infracciones_by_cedula WHERE cedula=? and velocidad>?; */

// Q4:
CREATE TABLE infracciones_by_lugar (lugar INT, fecha TIMESTAMP, infracciones_placa TEXT, velocidad INT, PRIMARY KEY ((lugar,fecha),infracciones_placa)) WITH CLUSTERING ORDER BY (infracciones_placa ASC);

/* SELECT fecha, infracciones_placa, velocidad FROM infracciones_by_lugar WHERE lugar=? and fecha=?; */

// Q5:
CREATE TABLE infracciones_by_fecha (fecha TIMESTAMP, velocidad INT, lugar INT, infracciones_placa TEXT, PRIMARY KEY (fecha,velocidad,lugar,infracciones_placa)) WITH CLUSTERING ORDER BY (velocidad ASC, lugar ASC, infracciones_placa ASC);

/* SELECT fecha, lugar, infracciones_placa FROM infracciones_by_fecha WHERE fecha=? and velocidad>?; */

// Q6:
CREATE TABLE personas_by_placa (infracciones_placa TEXT, velocidad INT, lugar INT, fecha TIMESTAMP, cedula INT, nombre TEXT, telefono SET<INT>, PRIMARY KEY (infracciones_placa,velocidad,lugar,fecha)) WITH CLUSTERING ORDER BY (velocidad ASC, lugar ASC, fecha ASC);

/* SELECT cedula, nombre, telefono FROM personas_by_placa WHERE infracciones_placa=? and velocidad>?; */

