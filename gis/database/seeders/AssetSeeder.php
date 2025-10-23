<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Asset;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            // Exemplos iniciais (mantidos para referência)
            ['name'=>'Station A','category'=>'station','latitude'=>41.9028,'longitude'=>12.4964], // Roma, Perto do Coliseu
            ['name'=>'Sensor B','category'=>'sensor','latitude'=>41.9038,'longitude'=>12.4924],   // Roma, Perto do Fórum
            
            // Novos Exemplos
            
            // Estações e Sensores Adicionais
            ['name'=>'Station C','category'=>'station','latitude'=>41.8890,'longitude'=>12.4780], // Roma, Perto da Pirâmide de Céstio
            ['name'=>'Sensor D','category'=>'sensor','latitude'=>41.9060,'longitude'=>12.4980],   // Roma, Perto do Quirinal
            
            // Categoria de "Ponto de Interesse" (POI)
            ['name'=>'Fountain of Trevi','category'=>'poi','latitude'=>41.9009,'longitude'=>12.4833], // Roma, Fonte de Trevi
            ['name'=>'Pantheon','category'=>'poi','latitude'=>41.8986,'longitude'=>12.4769],       // Roma, Panteão
            
            // Categoria de "Árvore" (Inventário Urbano)
            ['name'=>'Oak Tree 1','category'=>'tree','latitude'=>41.9015,'longitude'=>12.4870],    // Roma, Árvore perto do Palácio Barberini
            ['name'=>'Pine 2','category'=>'tree','latitude'=>41.8950,'longitude'=>12.4800],        // Roma, Árvore perto de Piazza Venezia
            
            // Exemplo de Coordenadas em outra cidade (para diversificar) - Ex: Milão
            ['name'=>'Milan Station X','category'=>'station','latitude'=>45.4642,'longitude'=>9.1900], // Milão, Perto do Duomo
            ['name'=>'Milan Sensor Y','category'=>'sensor','latitude'=>45.4635,'longitude'=>9.1895], // Milão, Sensor na área central
        ];

        foreach($items as $i) Asset::create($i);
    }
}
