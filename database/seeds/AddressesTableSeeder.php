<?php

use Illuminate\Database\Seeder;
use App\Address;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addresses = [
            [
                'via' => 'via del corso',
                'n_civico' => '21',
                'citta' => 'Firenze',
                'cap' => '50122',
                'latitudine' => 43.7714584,
                'longitudine' => 11.2572536
            ],
            [
                'via' => 'Viale delle Magnolie',
                'n_civico' => '7',
                'citta' => 'Firenze',
                'cap' => '50143',
                'latitudine' => 43.777438,
                'longitudine' => 11.244724
            ],
            [
                'via' => 'Via Vacchereccia',
                'n_civico' => '19R',
                'citta' => 'Firenze',
                'cap' => '50122',
                'latitudine' => 43.7696,
                'longitudine' => 11.254446
            ],
            [
                'via' => 'Borgo Tegolaio',
                'n_civico' => '29',
                'citta' => 'Firenze',
                'cap' => '50125',
                'latitudine' => 43.764726,
                'longitudine' => 11.246625
            ],
            [
                'via' => 'Via del senato',
                'n_civico' => '2',
                'citta' => 'Poggibonsi',
                'cap' => '53036',
                'latitudine' => 43.468377,
                'longitudine' => 11.150724
            ],
            [
                'via' => 'Via Mario Fabiani',
                'n_civico' => '10',
                'citta' => 'Empoli',
                'cap' => '50053',
                'latitudine' => 43.717582,
                'longitudine' => 10.947871
            ],
            [
                'via' => 'Via Giovanni Duprè',
                'n_civico' => '84',
                'citta' => 'Siena',
                'cap' => '47065',
                'latitudine' => 43.316727,
                'longitudine' => 11.330989
            ],
            [
                'via' => 'Via romana',
                'n_civico' => '1479',
                'citta' => 'Lucca',
                'cap' => '55100',
                'latitudine' => 43.827394,
                'longitudine' => 10.650531
            ],
            [
                'via' => 'Via del Parlamento',
                'n_civico' => '101',
                'citta' => 'Roma',
                'cap' => '00186',
                'latitudine' => 41.90456,
                'longitudine' => 12.483537
            ],
            [
                'via' => 'Via Gregoriana',
                'n_civico' => '33',
                'citta' => 'Frascati',
                'cap' => '00044',
                'latitudine' => 41.811812,
                'longitudine' => 12.682152
            ],
            [
                'via' => 'Via Terenzio Varrone',
                'n_civico' => '55',
                'citta' => 'Rieti',
                'cap' => '02100',
                'latitudine' => 42.403559,
                'longitudine' => 12.858338
            ],
            [
                'via' => 'Via Barletta',
                'n_civico' => '27',
                'citta' => 'Roma',
                'cap' => '00192',
                'latitudine' => 41.910335,
                'longitudine' => 12.458167
            ],
            [
                'via' => 'Via delle Fornaci',
                'n_civico' => '41a',
                'citta' => 'Roma',
                'cap' => '00193',
                'latitudine' => 41.898572,
                'longitudine' => 12.456436
            ],
            [
                'via' => 'Via Cassia',
                'n_civico' => '931',
                'citta' => 'Roma',
                'cap' => '00189',
                'latitudine' => 41.972737,
                'longitudine' => 12.43108
            ],
            [
                'via' => 'Via della Cecchina',
                'n_civico' => '20',
                'citta' => 'Roma',
                'cap' => '00139',
                'latitudine' => 41.947931,
                'longitudine' => 12.54065
            ],
            [
                'via' => 'Via Villanova',
                'n_civico' => '4',
                'citta' => 'Viterbo',
                'cap' => '01100',
                'latitudine' => 42.433791,
                'longitudine' => 12.098765
            ],
            [
                'via' => 'Via San Damiano',
                'n_civico' => '11',
                'citta' => 'Milano',
                'cap' => '20122',
                'latitudine' => 45.469158,
                'longitudine' => 9.198904
            ],
            [
                'via' => 'Via Giosuè Carducci',
                'n_civico' => '38',
                'citta' => 'Milano',
                'cap' => '20123',
                'latitudine' => 45.462225,
                'longitudine' => 9.173627
            ],
            [
                'via' => 'Via Bruno Buozzi',
                'n_civico' => '12',
                'citta' => 'Rozzano',
                'cap' => '20090',
                'latitudine' => 45.377449,
                'longitudine' => 9.18339
            ],
            [
                'via' => 'Via Maria Cajani',
                'n_civico' => '2',
                'citta' => 'Brugherio',
                'cap' => '20861',
                'latitudine' => 45.557232,
                'longitudine' => 9.299668
            ],
            [
                'via' => 'Via Punta Licosa',
                'n_civico' => '15',
                'citta' => 'Milano',
                'cap' => '20151',
                'latitudine' => 45.504299,
                'longitudine' => 9.123971
            ],
            [
                'via' => 'Via Monte Sabotino',
                'n_civico' => '30',
                'citta' => 'Cusano Milanino',
                'cap' => '20095',
                'latitudine' => 45.557622,
                'longitudine' => 9.177754
            ],
            [
                'via' => 'Via Giani',
                'n_civico' => '2',
                'citta' => 'Vailate',
                'cap' => '26019',
                'latitudine' => 45.461251,
                'longitudine' => 9.60345
            ],
            [
                'via' => 'Via Tagliamento',
                'n_civico' => '74',
                'citta' => 'Avellino',
                'cap' => '83100',
                'latitudine' => 40.917695,
                'longitudine' => 14.7840442
            ],
            [
                'via' => 'Corso Vittorio Emanuele II',
                'n_civico' => '304',
                'citta' => 'Avellino',
                'cap' => '83100',
                'latitudine' => 40.913375,
                'longitudine' => 14.7842883
            ],
            [
                'via' => 'Via De Conciliis',
                'n_civico' => '42',
                'citta' => 'Avellino',
                'cap' => '83100',
                'latitudine' => 40.913929,
                'longitudine' => 14.7832784
            ],
            [
                'via' => 'Viale S.Modestino',
                'n_civico' => '42',
                'citta' => 'Mercogliano',
                'cap' => '83013',
                'latitudine' => 40.922816,
                'longitudine' => 14.7453965
            ],
            [
                'via' => 'Via Roma',
                'n_civico' => '793',
                'citta' => 'Montefredane',
                'cap' => '83030',
                'latitudine' => 40.962818,
                'longitudine' => 14.8103076
            ],
            [
                'via' => 'via Murato',
                'n_civico' => '20',
                'citta' => 'Forino',
                'cap' => '83020',
                'latitudine' => 40.861823,
                'longitudine' => 14.7340417
            ],
            [
                'via' => 'Via D’Affitto',
                'n_civico' => '90',
                'citta' => 'Ariano Irpino',
                'cap' => '83031',
                'latitudine' => 41.153958,
                'longitudine' => 15.091372
            ]
        ]; 

        foreach ($addresses as $address) {
            $new_addr = new Address();
            $new_addr->street_name = $address['via'];
            $new_addr->street_number = $address['n_civico'];
            $new_addr->post_code = $address['cap'];
            $new_addr->city = $address['citta'];
            $new_addr->long = $address['longitudine'];
            $new_addr->lat = $address['latitudine'];
            $new_addr->save();
        }
    }
}
