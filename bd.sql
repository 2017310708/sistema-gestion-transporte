CREATE DATABASE IF NOT EXISTS sistema_gestion_transporte;
USE sistema_gestion_transporte;

CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nombre VARCHAR(100),
    apellido_paterno VARCHAR(100),
    apellido_materno VARCHAR(100),
    rol ENUM('A', 'C', 'D', 'S') NOT NULL,
    estado ENUM('activo', 'inactivo', 'pendiente_confirmacion', 'bloqueado') DEFAULT 'pendiente_confirmacion',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE conductores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    nombre VARCHAR(100) NOT NULL,
    apellido_paterno VARCHAR(100) NOT NULL,
    apellido_materno VARCHAR(100) NOT NULL,
    nro_licencia VARCHAR(20) NOT NULL UNIQUE,
    telefono VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    direccion TEXT NOT NULL,
    tipo_licencia VARCHAR(10) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

CREATE TABLE rutas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    origen VARCHAR(100) NOT NULL,
    destino VARCHAR(100) NOT NULL,
    distancia DECIMAL(10,2) NOT NULL,
    tiempo_estimado TIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE vehiculos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nro_placa VARCHAR(10) NOT NULL UNIQUE,
    marca VARCHAR(50) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    color VARCHAR(30) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    capacidad_carga DECIMAL(10,2) NOT NULL,
    year INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE monitoreo_flota (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_vehiculo INT NOT NULL,
    latitud DECIMAL(10,8) NOT NULL,
    longitud DECIMAL(11,8) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_vehiculo) REFERENCES vehiculos(id)
);

CREATE TABLE cargas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    descripcion TEXT NOT NULL,
    peso DECIMAL(10,2) NOT NULL,
    tipo_carga VARCHAR(50) NOT NULL,
    estado ENUM('pendiente', 'en_transito', 'entregado', 'cancelado', 'devuelto') NOT NULL,
    id_ruta INT NOT NULL,
    id_vehiculo INT NOT NULL,
    id_conductor INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_ruta) REFERENCES rutas(id),
    FOREIGN KEY (id_vehiculo) REFERENCES vehiculos(id),
    FOREIGN KEY (id_conductor) REFERENCES conductores(id)
);

CREATE TABLE clientes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    razon_social VARCHAR(100) NOT NULL,
    ruc VARCHAR(11) NOT NULL UNIQUE,
    direccion TEXT NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

CREATE TABLE pedidos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT NOT NULL,
    fecha_solicitud DATETIME NOT NULL,
    fecha_recojo DATETIME NOT NULL,
    direccion_origen TEXT NOT NULL,
    direccion_destino TEXT NOT NULL,
    estado ENUM('pendiente_confirmacion', 'pendiente_pago', 'aprobado', 'en_proceso', 'en_ruta', 'completado', 'cancelado_cliente', 'cancelado_sistema') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id)
);

CREATE TABLE detalles_pedido (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_pedido INT NOT NULL,
    descripcion_carga TEXT NOT NULL,
    peso DECIMAL(10,2) NOT NULL,
    volumen DECIMAL(10,2),
    requisitos_especiales TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id)
);

CREATE TABLE mantenimientos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_vehiculo INT NOT NULL,
    tipo_mantenimiento ENUM('preventivo', 'correctivo') NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_programada DATE NOT NULL,
    fecha_realizada DATE,
    costo DECIMAL(10,2) NOT NULL,
    estado ENUM('pendiente_programacion', 'programado', 'en_proceso', 'esperando_repuestos', 'completado', 'cancelado', 'reprogramado') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_vehiculo) REFERENCES vehiculos(id)
);

CREATE TABLE incidentes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_vehiculo INT NOT NULL,
    id_conductor INT NOT NULL,
    tipo_incidente VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_incidente DATETIME NOT NULL,
    ubicacion TEXT NOT NULL,
    estado ENUM('reportado', 'en_investigacion', 'esperando_peritaje', 'en_proceso_legal', 'resuelto_conforme', 'resuelto_con_observaciones', 'archivado') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_vehiculo) REFERENCES vehiculos(id),
    FOREIGN KEY (id_conductor) REFERENCES conductores(id)
);

CREATE TABLE gastos_operativos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_vehiculo INT NOT NULL,
    tipo_gasto VARCHAR(50) NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    fecha_gasto DATE NOT NULL,
    descripcion TEXT,
    comprobante VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_vehiculo) REFERENCES vehiculos(id)
);
