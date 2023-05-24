INSERT INTO Tipo_Usuario (Nombre) VALUES ('Administrador');
INSERT INTO Tipo_Usuario (Nombre) VALUES ('Profesor');
INSERT INTO Tipo_Usuario (Nombre) VALUES ('Administrativo');
INSERT INTO Tipo_Usuario (Nombre) VALUES ('Personal de Mantenimiento');
INSERT INTO Tipo_Usuario (Nombre) VALUES ('Estudiante');

INSERT INTO Tipo_Publicacion (Nombre) VALUES ('Sugerencia');
INSERT INTO Tipo_Publicacion (Nombre) VALUES ('Queja');

INSERT INTO Categoria (Nombre, Descripcion) VALUES ('Administración', 'Comentarios relacionados con la gestión administrativa de la institución');
INSERT INTO Categoria (Nombre, Descripcion) VALUES ('Académico', 'Comentarios relacionados con la enseñanza y el aprendizaje');
INSERT INTO Categoria (Nombre, Descripcion) VALUES ('Infraestructura/Instalaciones', 'Comentarios relacionados con las instalaciones físicas de la institución');
INSERT INTO Categoria (Nombre, Descripcion) VALUES ('Servicios', 'Comentarios relacionados con los servicios ofrecidos por la institución');
INSERT INTO Categoria (Nombre, Descripcion) VALUES ('Eventos', 'Comentarios relacionados con eventos y actividades realizadas en la institución');
INSERT INTO Categoria (Nombre, Descripcion) VALUES ('Recursos', 'Comentarios relacionados con los recursos disponibles para los usuarios');
INSERT INTO Categoria (Nombre, Descripcion) VALUES ('Comunicación', 'Comentarios relacionados con la comunicación interna y externa de la institución');
INSERT INTO Categoria (Nombre, Descripcion) VALUES ('Programas Académicos', 'Comentarios relacionados con los programas de estudio y planes de estudio');
INSERT INTO Categoria (Nombre, Descripcion) VALUES ('Orientación Estudiantil', 'Comentarios relacionados con la orientación y apoyo a los estudiantes');
INSERT INTO Categoria (Nombre, Descripcion) VALUES ('Recursos Tecnológicos', 'Comentarios relacionados con los recursos tecnológicos disponibles para los usuarios');
INSERT INTO Categoria (Nombre, Descripcion) VALUES ('Servicios de Salud', 'Comentarios relacionados con los servicios de atención médica y salud en la institución');
INSERT INTO Categoria (Nombre, Descripcion) VALUES ('Seguridad', 'Comentarios relacionados con la seguridad y protección en la institución');
INSERT INTO Categoria (Nombre, Descripcion) VALUES ('Investigación', 'Comentarios relacionados con la investigación científica y proyectos de investigación');
INSERT INTO Categoria (Nombre, Descripcion) VALUES ('Cultura y Arte', 'Comentarios relacionados con actividades culturales y artísticas en la institución');
INSERT INTO Categoria (Nombre, Descripcion) VALUES ('Vida Estudiantil', 'Comentarios relacionados con la experiencia y vida estudiantil en la institución');


INSERT INTO Area (Nombre, Descripcion) VALUES ('Biblioteca', 'Área destinada a la consulta y préstamo de libros y recursos de investigación');
INSERT INTO Area (Nombre, Descripcion) VALUES ('Salones', 'Área destinada a la impartición de clases y actividades académicas');
INSERT INTO Area (Nombre, Descripcion) VALUES ('Edificios Administrativos', 'Área destinada a las oficinas y departamentos administrativos');
INSERT INTO Area (Nombre, Descripcion) VALUES ('Laboratorios', 'Área destinada a la realización de experimentos y actividades prácticas');
INSERT INTO Area (Nombre, Descripcion) VALUES ('Cafetería', 'Área destinada a la venta de alimentos y bebidas');
INSERT INTO Area (Nombre, Descripcion) VALUES ('D. de Informática', 'Área encargada de la gestión y desarrollo de sistemas informáticos');
INSERT INTO Area (Nombre, Descripcion) VALUES ('D. de Recursos Humanos', 'Área encargada de la gestión del personal y recursos humanos');
INSERT INTO Area (Nombre, Descripcion) VALUES ('D. de Finanzas', 'Área encargada de la gestión financiera y contabilidad');
INSERT INTO Area (Nombre, Descripcion) VALUES ('D. de Investigación', 'Área dedicada a la investigación científica y desarrollo de proyectos');
INSERT INTO Area (Nombre, Descripcion) VALUES ('Centro de Estudiantes', 'Área dedicada a brindar apoyo y servicios a los estudiantes');
INSERT INTO Area (Nombre, Descripcion) VALUES ('Auditorio', 'Espacio destinado a la realización de eventos y conferencias');

INSERT INTO Usuario (Matricula, Tipo, Nombre, Apellido_Pat, Apellido_Mat, Correo, Contrasena) VALUES (000000001, 1, 'Administrador', '', '', 'admin@example.com', 'admin');
INSERT INTO Usuario (Matricula, Tipo, Nombre, Apellido_Pat, Apellido_Mat, Correo, Contrasena) VALUES (202100123, 5, 'Juan', 'Gómez', 'López', 'juan.gomez@example.com', 'admin');
INSERT INTO Usuario (Matricula, Tipo, Nombre, Apellido_Pat, Apellido_Mat, Correo, Contrasena) VALUES (202100224, 5, 'María', 'Sánchez', 'García', 'maria.sanchez@example.com', 'admin');
INSERT INTO Usuario (Matricula, Tipo, Nombre, Apellido_Pat, Apellido_Mat, Correo, Contrasena) VALUES (202100325, 3, 'Carlos', 'Ramírez', 'Hernández', 'carlos.ramirez@example.com', 'admin');
INSERT INTO Usuario (Matricula, Tipo, Nombre, Apellido_Pat, Apellido_Mat, Correo, Contrasena) VALUES (202100426, 4, 'Laura', 'Torres', 'Martínez', 'laura.torres@example.com', 'admin');
INSERT INTO Usuario (Matricula, Tipo, Nombre, Apellido_Pat, Apellido_Mat, Correo, Contrasena) VALUES (202100527, 2, 'Pedro', 'Villa', 'González', 'pedro.villa@example.com', 'admin');

INSERT INTO Publicacion (Tipo, Id_Usuario, Titulo, Comentario, Fecha, Id_Area, Resuelto, Anonimo)
VALUES ((SELECT Id FROM Tipo_Publicacion WHERE Nombre = "Queja"), 2, "No se respetó el acuerdo 1:45.", "El día de hoy, 25 de mayo de 2023, en el salón CCO4 - 204 sucedió un evento que no me deja dormir. El profesor XXXXXX rompió el acuerdo 1:45 al no respetar la integridad de los alumnos con el evento BBBBBB.", '2023-05-25', 2, TRUE, TRUE);
INSERT INTO Publicacion (Tipo, Id_Usuario, Titulo, Comentario, Fecha, Id_Area, Resuelto, Anonimo)
VALUES ((SELECT Id FROM Tipo_Publicacion WHERE Nombre = "Sugerencia"), 3, "Bancas en la explanada entre CCO1 y CCO2", "Estaría muy bien si se colocaran bancas entre los salones CCO1 y CCO2, aprovechando el espacio que hay que no se usa.", '2023-02-13', 2, FALSE, FALSE);
INSERT INTO Publicacion (Tipo, Id_Usuario, Titulo, Comentario, Fecha, Id_Area, Resuelto, Anonimo)
VALUES ((SELECT Id FROM Tipo_Publicacion WHERE Nombre = "Queja"), 5, "El internet nunca sirve entre las 10:00 y las 13:00 horas.", "Lo que dice el título, el internet no sirve y es un gran problema cuando tenemos actividades que requieren de recursos en línea.", '2023-03-3', 2, FALSE, FALSE);
