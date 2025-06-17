<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Envio;

class EnvioSeeder extends Seeder
{
    public function run(): void
    {
        $envios = [
            // NORTE
            ['zona' => 'NORTE', 'nombre_cliente' => 'Jaume, Pina and Velázquez', 'pedido' => 'INCIDENCIA', 'destinatario' => 'Petrona Graciana Ricart Pi', 'bultos' => 4, 'palets' => null, 'usar_palets' => false],
            ['zona' => 'NORTE', 'nombre_cliente' => 'Cabrero Ltd', 'pedido' => 'P7602522', 'destinatario' => 'Julia Nogués Sanmiguel', 'bultos' => 1, 'palets' => null, 'usar_palets' => false],
            ['zona' => 'NORTE', 'nombre_cliente' => 'Terrón LLC', 'pedido' => 'P2565678', 'destinatario' => null, 'bultos' => 60, 'palets' => 3, 'usar_palets' => true],
            ['zona' => 'NORTE', 'nombre_cliente' => 'Segovia-Tapia', 'pedido' => 'P1700856', 'destinatario' => 'Roxana Amigó-Fernandez', 'bultos' => 20, 'palets' => 1, 'usar_palets' => true],
            ['zona' => 'NORTE', 'nombre_cliente' => 'Hernandez, López and Rivas', 'pedido' => 'INCIDENCIA', 'destinatario' => null, 'bultos' => 9, 'palets' => null, 'usar_palets' => false],
            // SUR
            ['zona' => 'SUR', 'nombre_cliente' => 'Reyes & Hijos', 'pedido' => 'P1728197', 'destinatario' => 'Raquel Collado Ruíz', 'bultos' => 7, 'palets' => null, 'usar_palets' => false],
            ['zona' => 'SUR', 'nombre_cliente' => 'Delgado S.L.', 'pedido' => 'INCIDENCIA', 'destinatario' => null, 'bultos' => 6, 'palets' => null, 'usar_palets' => false],
            ['zona' => 'SUR', 'nombre_cliente' => 'Martín y Cía', 'pedido' => 'P5923912', 'destinatario' => 'Ignacio Palomar', 'bultos' => 40, 'palets' => 2, 'usar_palets' => true],
            ['zona' => 'SUR', 'nombre_cliente' => 'Padilla-Rosales', 'pedido' => 'P1922342', 'destinatario' => null, 'bultos' => 80, 'palets' => 4, 'usar_palets' => true],
            ['zona' => 'SUR', 'nombre_cliente' => 'Salas e Hijos', 'pedido' => 'P9132912', 'destinatario' => 'Valeria Ureña', 'bultos' => 2, 'palets' => null, 'usar_palets' => false],
            // GRAN CANARIA
            ['zona' => 'GRAN CANARIA', 'nombre_cliente' => 'Campos y Asociados', 'pedido' => 'INCIDENCIA', 'destinatario' => 'Carmen Darder López', 'bultos' => 1, 'palets' => null, 'usar_palets' => false],
            ['zona' => 'GRAN CANARIA', 'nombre_cliente' => 'Ortiz SL', 'pedido' => 'P8123892', 'destinatario' => null, 'bultos' => 58, 'palets' => 3, 'usar_palets' => true],
            ['zona' => 'GRAN CANARIA', 'nombre_cliente' => 'Domínguez S.A.', 'pedido' => 'P2839283', 'destinatario' => 'Fernando Plaza', 'bultos' => 3, 'palets' => null, 'usar_palets' => false],
            ['zona' => 'GRAN CANARIA', 'nombre_cliente' => 'Muñoz & Nieto', 'pedido' => 'INCIDENCIA', 'destinatario' => null, 'bultos' => 8, 'palets' => null, 'usar_palets' => false],
            ['zona' => 'GRAN CANARIA', 'nombre_cliente' => 'Vega Group', 'pedido' => 'P1182782', 'destinatario' => 'Ismael Fuster', 'bultos' => 38, 'palets' => 2, 'usar_palets' => true],
            // RHENUS
            ['zona' => 'RHENUS', 'nombre_cliente' => 'Vázquez Ltd', 'pedido' => 'P9128372', 'destinatario' => null, 'bultos' => 5, 'palets' => null, 'usar_palets' => false],
            ['zona' => 'RHENUS', 'nombre_cliente' => 'Nieto Cargo', 'pedido' => 'P8291731', 'destinatario' => 'Lorena Marín', 'bultos' => 18, 'palets' => 1, 'usar_palets' => true],
            ['zona' => 'RHENUS', 'nombre_cliente' => 'Esteban Courier', 'pedido' => 'INCIDENCIA', 'destinatario' => null, 'bultos' => 3, 'palets' => null, 'usar_palets' => false],
            ['zona' => 'RHENUS', 'nombre_cliente' => 'Camacho & Camacho', 'pedido' => 'P8912738', 'destinatario' => 'Eva Soria', 'bultos' => 34, 'palets' => 2, 'usar_palets' => true],
            ['zona' => 'RHENUS', 'nombre_cliente' => 'Crespo Trans', 'pedido' => 'P7381923', 'destinatario' => null, 'bultos' => 4, 'palets' => null, 'usar_palets' => false],
            // TENEPALMA
            ['zona' => 'TENEPALMA', 'nombre_cliente' => 'González Express', 'pedido' => 'P9128372', 'destinatario' => 'Pedro Ferrer', 'bultos' => 5, 'palets' => null, 'usar_palets' => false],
            ['zona' => 'TENEPALMA', 'nombre_cliente' => 'Oliva Cargo', 'pedido' => 'INCIDENCIA', 'destinatario' => null, 'bultos' => 2, 'palets' => null, 'usar_palets' => false],
            ['zona' => 'TENEPALMA', 'nombre_cliente' => 'Ramos & Asociados', 'pedido' => 'P8812383', 'destinatario' => null, 'bultos' => 55, 'palets' => 3, 'usar_palets' => true],
            ['zona' => 'TENEPALMA', 'nombre_cliente' => 'Paredes Group', 'pedido' => 'P1827391', 'destinatario' => 'Inés Macías', 'bultos' => 33, 'palets' => 2, 'usar_palets' => true],
            ['zona' => 'TENEPALMA', 'nombre_cliente' => 'Benítez & López', 'pedido' => 'P1283892', 'destinatario' => 'Isabel Berenguer', 'bultos' => 6, 'palets' => null, 'usar_palets' => false],
        ];

        foreach ($envios as $envio) {
            Envio::create(array_merge($envio, [
                'etiqueta_pdf' => null,
                'enlistado' => false,
                'listado_id' => null,
            ]));
        }
    }
}
