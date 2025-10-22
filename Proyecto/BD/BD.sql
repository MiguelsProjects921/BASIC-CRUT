-- Crear la base de datos
CREATE DATABASE Productos_DB;
USE Productos_DB;

-- Crear la tabla de productos
CREATE TABLE Productos (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Categoria VARCHAR(100) NOT NULL,
    Precio DECIMAL(10,2) NOT NULL,
    Stock INT NOT NULL,
    FechaIngreso DATE
);
