<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CollectionsController extends Controller
{

    private $matrizDeGeneros = [
            ['id'=>1, 'clave'=> 'SF','nombre'=>'Ciencia Ficción'],
            ['id'=>2, 'clave'=> 'AC','nombre'=>'Acción'],
            ['id'=>3, 'clave'=> 'WT','nombre'=>'Western'],
            ['id'=>4, 'clave'=> 'AD','nombre'=>'Aventuras'],
            ['id'=>5, 'clave'=> 'XX','nombre'=>'Adultos'],
        ];

    private $matrizDePeliculas = [
            ['id'=>1, 'ref'=> 'AR102','genero_id'=>1,'titulo'=>'Independence Day','pvp'=> 23.18],
            ['id'=>2, 'ref'=> 'BFD245','genero_id'=>1,'titulo'=>'Star Wars','pvp'=> 25.25],
            ['id'=>3, 'ref'=> 'RE23','genero_id'=>1,'titulo'=>'Star Trek','pvp'=> 15.17],
            ['id'=>4, 'ref'=> 'DS45','genero_id'=>1,'titulo'=>'Gravity','pvp'=> 18.56],
            ['id'=>5, 'ref'=> 'GH54','genero_id'=>1,'titulo'=>'The Martian','pvp'=> 22.56],
            ['id'=>6, 'ref'=> 'ALFA','genero_id'=>2,'titulo'=>'007. Licencia para matar','pvp'=> 10.00],
            ['id'=>7, 'ref'=> 'GAR50','genero_id'=>2,'titulo'=>'Asalto a la Casa Blanca','pvp'=> 18.20],
            ['id'=>8, 'ref'=> 'DM590','genero_id'=>2,'titulo'=>'Pelham 123','pvp'=> 12.33],
            ['id'=>9, 'ref'=> 'D4','genero_id'=>2,'titulo'=>'Difícil de matar','pvp'=> 34.67],
            ['id'=>10, 'ref'=> 'FER234','genero_id'=>2,'titulo'=>'Crank','pvp'=> 16.72],
            ['id'=>11, 'ref'=> 'DOM43','genero_id'=>3,'titulo'=>'Siete hombres sin piedad','pvp'=> 7.28],
            ['id'=>12, 'ref'=> 'GRE5602','genero_id'=>3,'titulo'=>'Cruzando el río Bravo','pvp'=> 3.25],
            ['id'=>13, 'ref'=> 'DD43','genero_id'=>3,'titulo'=>'Lluvia de plomo','pvp'=> 4.57],
            ['id'=>14, 'ref'=> 'DD44','genero_id'=>3,'titulo'=>'Estrella errante','pvp'=> 12.00],
            ['id'=>15, 'ref'=> 'JLD45','genero_id'=>3,'titulo'=>'La horca','pvp'=> 8.23],
            ['id'=>16, 'ref'=> 'JJS1002','genero_id'=>4,'titulo'=>'Viaje al centro de la tierra','pvp'=> 16.75],
            ['id'=>17, 'ref'=> 'RED43','genero_id'=>4,'titulo'=>'La momia','pvp'=> 18.24],
            ['id'=>18, 'ref'=> 'ERE44','genero_id'=>4,'titulo'=>'El arca perdida','pvp'=> 24.18],
            ['id'=>19, 'ref'=> 'TRE45','genero_id'=>4,'titulo'=>'La calavera de cristal','pvp'=> 22.13],
            ['id'=>20, 'ref'=> 'SED34','genero_id'=>4,'titulo'=>'El corazón verde','pvp'=> 17.99],
            ['id'=>21, 'ref'=> 'XXX01','genero_id'=>5,'titulo'=>'Cosas de parejas','pvp'=> 15.25],
            ['id'=>22, 'ref'=> 'XXX48','genero_id'=>5,'titulo'=>'Tres amigas muy fogosas','pvp'=> 17.69],
        ];

    
    public function creaColeccion(){

        // nueva coleccion

        // clase Collection
        $coleccion = new Collection([
            'Primer elemento',
            'Segundo elemento',
            'Tercer elemento',
        ]);

        // helper collection
        $semana = collect([
            'lunes',
            'martes',
            'miércoles',
            'jueves',
            'viernes',
        ]);

        //dd($coleccion);

        dd($semana);

    }

    public function peliculas(){

        //dd($matrizDeGeneros,$matrizDePeliculas);

        // convertimos los arrays a colecciones
        $generos = collect($this->matrizDeGeneros);
        $peliculas = collect($this->matrizDePeliculas);

        //dd($generos,$peliculas);

        // mapeamos las peliculas
        $peliculas = $peliculas->map(function ($pelicula){
            if($pelicula['genero_id'] == 5){
                $pelicula['publico'] = 'Adultos';
            }else{
                $pelicula['publico'] = 'Todos';
            }
            return $pelicula;
        });

        dd($peliculas);

    }

    public function dividir(){

        $peliculas = collect($this->matrizDePeliculas);

        $trozos = $peliculas->chunk(10);

        dd($trozos);

    }

    public function json(){

        $generos = collect($this->matrizDeGeneros);

        $json = $generos->toJson();

        dd($json);
    }

    public function peliculasConGenero(){

        // obtenemos las colecciones
        $peliculas = collect($this->matrizDePeliculas);
        $generos = collect($this->matrizDeGeneros);

        // mapeamos
        $peliculas = $peliculas->map(function ($pelicula) use ($generos){

            // obtenemos el genero
            $genero = $generos->where('id',$pelicula['genero_id']);

            // obtenemos el nombre del genero
            $genero = $genero->toArray()[key($genero->toArray())]['nombre'];

            // añadimos a la coleccion de peliculas
            $pelicula['genero'] = $genero;

            return $pelicula;
        });

        dd($peliculas);

    }

    public function metodoPrice(){

        // obtenemos las colecciones
        $peliculas = collect($this->matrizDePeliculas);

        // usamos metodo 'price'
        $peliculas = $peliculas->price('pvp');

        //dd($peliculas);

        echo "<pre>";
        print_r($peliculas);
        echo "</pre>";
    }

    // metodo que usa reject para filtrar la coleccion
    public function filtrado(){

        // obtenemos las colecciones
        $peliculas = collect($this->matrizDePeliculas);

        // peliculas ciencia ficcion
        $peliculasSF = $peliculas->reject(function ($pelicula){
            return ($pelicula['genero_id'] != 1);
        });

        dd($peliculasSF);

    }

}
