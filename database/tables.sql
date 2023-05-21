CREATE DATABASE quejas_sugerencias_db;
USE quejas_sugerencias_db;

CREATE TABLE Tipo_Usuario (
  Id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  Nombre VARCHAR(255) NOT NULL
);

CREATE TABLE Tipo_Publicacion (
  Id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  Nombre VARCHAR(255) NOT NULL
);

CREATE TABLE Categoria (
  Id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  Nombre VARCHAR(255) NOT NULL,
  Descripcion VARCHAR(255) NOT NULL
);

CREATE TABLE Area (
  Id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  Nombre VARCHAR(255) NOT NULL,
  Descripcion VARCHAR(255) NOT NULL
);

CREATE TABLE Usuario (
  Id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  Matricula INT NOT NULL UNIQUE,
  Tipo INT NOT NULL,
  Nombre VARCHAR(255) NOT NULL,
  Apellido_Pat VARCHAR(255) NOT NULL,
  Apellido_Mat VARCHAR(255) NOT NULL,
  Correo VARCHAR(255) NOT NULL UNIQUE,
  Contraseña VARCHAR(255) NOT NULL,
  FOREIGN KEY (Tipo) REFERENCES Tipo_Usuario(Id)
);

CREATE TABLE Publicacion (
  Id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  Tipo INT NOT NULL,
  Id_Usuario INT NOT NULL,
  Comentario VARCHAR(255) NOT NULL,
  Fecha DATE NOT NULL,
  Id_Area INT NOT NULL,
  Resuelto BOOLEAN NOT NULL,
  Anonimo BOOLEAN NOT NULL,
  FOREIGN KEY (Tipo) REFERENCES Tipo_Publicacion(Id),
  FOREIGN KEY (Id_Usuario) REFERENCES Usuario(Id),
  FOREIGN KEY (Id_Area) REFERENCES Area(Id)
);

CREATE TABLE Respuesta_Publicacion (
  Id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  Id_Usuario INT NOT NULL,
  Comentario VARCHAR(255) NOT NULL,
  Fecha DATE NOT NULL,
  FOREIGN KEY (Id_Usuario) REFERENCES Usuario(Id)
);

CREATE TABLE Catalogo_Categoria_Publicacion (
  Id_Publicacion INT NOT NULL,
  Id_Categoria INT NOT NULL,
  PRIMARY KEY (Id_Publicacion, Id_Categoria),
  FOREIGN KEY (Id_Publicacion) REFERENCES Publicacion(Id),
  FOREIGN KEY (Id_Categoria) REFERENCES Categoria(Id)
);

CREATE TABLE Catalogo_Usuario_Area (
  Id_Usuario INT NOT NULL,
  Id_Area INT NOT NULL,
  PRIMARY KEY (Id_Usuario, Id_Area),
  FOREIGN KEY (Id_Usuario) REFERENCES Usuario(Id),
  FOREIGN KEY (Id_Area) REFERENCES Area(Id)
);

CREATE TABLE Catalogo_Respuesta (
  Id_Publicacion INT NOT NULL,
  Id_Respuesta INT NOT NULL,
  PRIMARY KEY (Id_Publicacion, Id_Respuesta),
  FOREIGN KEY (Id_Publicacion) REFERENCES Publicacion(Id),
  FOREIGN KEY (Id_Respuesta) REFERENCES Respuesta_Publicacion (Id)
);

CREATE TABLE Catalogo_foto (
  Id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  Nombre VARCHAR(255) NOT NULL,
  Id_Publicacion INT NOT NULL,
  FOREIGN KEY (Id_Publicacion) REFERENCES Publicacion(Id)
);