 -- insercion de tipos de licencias
INSERT INTO `tipo_licencias` (`nombre`, `modalidad`) VALUES
('Generales', 'Todas'),
('Urbanizacion', 'Desarrollo.'),
('Urbanizacion', 'Reurbanizacion'),
('Urbanizacion', 'Saneamiento.'),
('Parcelacion', 'Desarrollo'),
('Parcelacion', 'Saneamiento'),
('Subdivicion', 'Reloteo'),
('Subdivicion', 'Rural'),
('Subdivicion', 'Urbana'),
('Construccion', 'Obra Nueva'),
('Construccion', 'Ampliacion'),
('Construccion', 'Adecuacion'),
('Construccion', 'Modificacion'),
('Construccion', 'Restauracion'),
('Construccion', 'Cerramiento'),
('Construccion', 'Reconstrucción'),
('Construccion', 'Demolicion Parcial'),
('Construccion', 'Demolicion Total'),
('Reconocimiento', 'N/A'),
('Otras', 'Ajuste de Cotas'),
('Otras', 'Concepto de Norma'),
('Otras', 'Concepto de Uso de Suelos'),
('Otras', 'Copia Certificada de Planos'),
('Otras', 'Modificacion de Planos'),
('Otras', 'Propiedad Horizontal'),
('Otras', 'Movimiento de Tierras'),
('Otras', 'Aprobacion de Piscina') 


--  insercion de documentos 
INSERT INTO `radicado_documentos`(`nombre`, `ruta`) VALUES ('Certificado de tradición', 'General'),
('Documento de identidad', 'General'),
('Poder especial', 'General'),
('Copia impuesto predial', 'General'),
('Dirección de los predios colindantes', 'General'),
('Matrícula profesional de los profesionales intervinientes', 'General'),
('Certificaciones que acrediten su experiencia', 'General'),
('Plano Topográfico', 'Especifico'),
('Plano de Proyecto Urbanístico', 'Especifico'),
('Disponibilidad de servicios publicos', 'Especifico'),
('Evidencia de Amenaza y Riesgo', 'Especifico'),
('Copia de la Licencia de Urbanización', 'Especifico'),
('Certificación Avance de Obra', 'Especifico'),
('Solicitud de Entrega de Cesiones Ejecutadas', 'Especifico'),
('Plano del Nuevo Proyecto Urbanístico', 'Especifico'),
('Plano del Proyecto Parcelacion', 'Especifico'),
('Copia Licencia Parcelacion Vencida', 'Especifico'),
('Plano Base', 'Especifico'),
('Plano Resultante', 'Especifico'),
('Plano Levantamiento Arquitectonico', 'Especifico'),
('Peritaje Tecnico', 'Especifico'),
('Declaracion de Antiguedad', 'Especifico'),
('Diseño Estructural', 'Especifico'),
('Estudios Geotecnico y Suelos', 'Especifico'),
('Proyecto Arquitectonico', 'Especifico'),
('Diseño de Elementos no Estructurales', 'Especifico'),
('Revision Independiente de Diseños', 'Opcional'),
('Concepto de Patrimonio', 'Opcional'),
('Acta de la Coopropiedad', 'Opcional'),
('Orden de Reforzamiento Estructural', 'Opcional'),
('Certificacion de Cesiones Anticipadas', 'Opcional'),
('Licencias Anteriores (no aplica para obra nueva)', 'Opcional'),
('Copia de Plano', 'Especifico'),
('Planos de Linderamiento', 'Especifico'),
('Copia de la Licencia', 'Especifico'),
('Declaracion juramentada de obra de acuerdo a Licencia', 'Especifico'),
('Poryecto de Division', 'Especifico'),
('Planos de Diseños', 'Especifico'),
('Planos Nueva Propuesta', 'Especifico'),
('Peticion ', 'Especifico') 

-- insercion de combinacion unica de licencias y documentos
INSERT INTO `lic_doc`(`id_doc`, `id_lic`) VALUES 
(1, 1), (1, 2), (1, 3), (1, 4), (1, 5), (1, 6), (1, 7),
(2, 8), (2, 9), (2, 10), (2, 11),
(3, 12), (3, 8), (3, 15), (3, 11),
(4, 9), (4, 11), (4, 12), (4, 13), (4, 14),
(5, 8), (5, 10), (5, 16), (5, 11),
(6, 16), (6, 17), (6, 13),
(7, 18), (7, 19),
(8, 8),
(9, 8),
(10, 23), (10, 24), (10, 25), (10, 26), (10, 27), (10, 28), (10, 29), (10, 30), (10, 31), (10, 10),
(11, 23), (11, 24), (11, 25), (11, 26), (11, 27), (11, 28), (11, 29), (11, 30), (11, 31), (11, 10), (11, 32),
(12, 23), (12, 24), (12, 25), (12, 26), (12, 27), (12, 28), (12, 29), (12, 30), (12, 31), (12, 10), (12, 32),
(13, 23), (13, 24), (13, 25), (13, 26), (13, 27), (13, 28), (13, 29), (13, 30), (13, 31), (13, 10), (13, 32), 
(14, 23), (14, 24), (14, 25), (14, 26), (14, 27), (14, 28), (14, 29), (14, 30), (14, 31), (14, 10), (14, 32), 
(15, 23), (15, 24), (15, 25), (15, 26), (15, 27), (15, 28), (15, 29), (15, 30), (15, 31), (15, 10), (15, 32), 
(16, 23), (16, 24), (16, 25), (16, 26), (16, 27), (16, 28), (16, 29), (16, 30), (16, 31), (16, 10), (16, 32), 
(17, 23), (17, 24), (17, 25), (17, 26), (17, 27), (17, 28), (17, 29), (17, 30), (17, 31), (17, 10), (17, 32), 
(18, 23), (18, 24), (18, 25), (18, 26), (18, 27), (18, 28), (18, 29), (18, 30), (18, 31), (18, 10), (18, 32), 
(19, 20), (19, 21), (19, 22), (19, 23), (19, 24), (19, 25), (19, 26), (19, 27), (19, 28), (19, 29), (19, 30), (19, 31), (19, 10), 
(20, 33),
(21, 40),
(22, 40),
(23, 40),
(24, 12), (24, 39),
(25, 34), (25, 35), (25, 36), (25, 37), (25, 28), 
(26, 24)

-- 

1
Urbanizacion - Desarrollo
  Plano topográfico
  Plano de proyecto urbanístico
  Disponibilidad de servicios publicos
  Evidencia de Amenaza y riesgo
Urbanizacion - Reurbanizacion
  1.1  Plano Topográfico
    Copia de la licencia de Urbanización
    Plano del Nuevo Proyecto Urbanístico
  1.1  Evidencia de Amenaza y riesgo
Urbanizacion - Saneamiento
  1.1  Plano de proyecto urbanístico 
  1.2  Copia de la Licencia de Urbanización
    Certificación Avance de Obra
    Solicitud de Entrega de Cesiones Ejecutadas
  1.1  Evidencia de Amenaza y riesgo 
2
Parcelacion - Desarrollo
  1.1  Plano Topográfico
  1.1  Disponibilidad de servicios publicos
    Plano del Proyecto Parcelacion
  1.1  Evidencia de Amenaza y riesgo
Parcelacion - Saneamiento
  2.1  Plano del proyecto parcelacion
    Copia Licencia Parcelacion Vencida
  1.3  Certificación avance de obra
3
Subdivicion - Urbana y Rural 
  1.1  Plano Topográfico
Subdivicion - Reloteo
  Plano Base
  Plano Resultante

4
Construccion - Todas
  Diseño Estructural
  Estudios Geotecnico y Suelos
  Proyecto Arquitectonico
  Diseño de Elementos no Estructurales

  **Revision independiente de diseños
    Concepto de Patrimonio
    Acta de la coopropiedad
    Orden de reforzamiento estructural
  Certificacion de cesiones anticipadas
  1.1  Disponibilidad de servicios publicos
    Licencias Anteriores (no aplica para obra nueva)**

5
Reconocimiento de efificaciones
      Plano Levantamiento Arquitectonico
      Peritaje Tecnico
      Declaracion de Antiguedad
  4.1 Diseño Estructural
  4.1 Estudios Geotecnico y Suelos
  4.1 Proyecto Arquitectonico
  4.1 Diseño de Elementos no Estructurales

  4.1 **Revision Independiente de Diseños
      Concepto de Patrimonio
      Acta de la Coopropiedad
      Orden de Reforzamiento Estructural
  4.1 Certificacion de Cesiones Anticipadas
  1.1  Disponibilidad de Servicios Publicos**

6
Otras actuaciones - ajuste de cotas y areas
  Copia de Plano

Otras actuaciones - Planos de propiedad Horizontal
  Planos de Linderamiento
  Copia de la Licencia
  Declaracion juramentada de obra de acuerdo a Licencia
  Poryecto de Division
4.1  Concepto de Patrimonio

Otras actuaciones - Movimiento de tierras
4.1  Estudios Geotecnico y Suelos

Otras actuaciones - aprobacion de piscinas
  Planos de Diseños

Otras actuaciones - Modificacion de planos Urbanisticos
  1.2  Copia de la licencia de Urbanizacion
  Planos Nueva propuesta

Otras actuaciones - Concepto de Norma
  Peticion 

Otras actuaciones - Uso de suelos
  6.6  Peticion 

Otras actuaciones - Copia Certificada de Planos
  6.6  Peticion 
 -->

SELECT (SELECT CONCAT(nombre, ' ', apellido) FROM terceros WHERE nit = r.ing_constructor) as ing_constructor , 
(SELECT CONCAT(nombre, ' ', apellido) FROM terceros WHERE nit = r.ing_proyectista) as ing_proyectista, 
(SELECT CONCAT(nombre, ' ', apellido) FROM terceros WHERE nit = r.ing_civil) as ing_civil, 
(SELECT CONCAT(nombre, ' ', apellido) FROM terceros WHERE nit = r.diseñador) as diseñador, 
(SELECT CONCAT(nombre, ' ', apellido) FROM terceros WHERE nit = r.ing_civilGeo) as ing_civilGeo, 
(SELECT CONCAT(nombre, ' ', apellido) FROM terceros WHERE nit = r.topografo) as topografo, 
(SELECT CONCAT(nombre, ' ', apellido) FROM terceros WHERE nit = r.ing_estructural) as ing_estructural, 
(SELECT CONCAT(nombre, ' ', apellido) FROM terceros WHERE nit = r.otros) as otros  
FROM radicacion r
WHERE r.consecutivo = '909090'  