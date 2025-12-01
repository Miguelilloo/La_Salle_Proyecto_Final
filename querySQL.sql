Create Database ProjectIrun;
use ProjectIrun;
Create Table Empresas 
(
	Id_empresa int auto_increment primary key,
    ruta_logo varchar(50),
    nombre_empresa varchar(50) not null,
    descripcion varchar(100),
    email varchar(100) not null,
    contra varchar(100)not null,
    enlace_web varchar(100),
    hora_mana_inic time not null,
	hora_mana_fin time not null,
	hora_tarde_inic time not null,
	hora_tarde_fin time not null,
    spots enum('Yes','No') not null
    
);
