<?php

return [
    'required' => 'Pole :attribute jest wymagane.',
    'string' => 'Pole :attribute musi być tekstem.',
    'max' => [
        'string' => 'Pole :attribute nie może przekraczać :max znaków.',
        'numeric' => 'Pole :attribute nie może być większe niż :max.',
        'file' => 'Plik :attribute nie może być większy niż :max kilobajtów.',
    ],
    'numeric' => 'Pole :attribute musi być liczbą.',
    'between' => [
        'numeric' => 'Pole :attribute musi być pomiędzy :min a :max.',
    ],
    'multiple_of' => 'Pole :attribute musi być wielokrotnością :value.',
    'in' => 'Wybrana wartość pola :attribute jest nieprawidłowa.',
    'boolean' => 'Pole :attribute musi mieć wartość prawda lub fałsz.',
    'date' => 'Pole :attribute musi być prawidłową datą.',
    'url' => 'Pole :attribute musi być prawidłowym adresem URL.',
    'image' => 'Plik :attribute musi być obrazem.',
    'email' => 'Pole :attribute musi być prawidłowym adresem e-mail.',
    'confirmed' => 'Potwierdzenie pola :attribute nie zgadza się.',
    'current_password' => 'Podane hasło jest nieprawidłowe.',
    'min' => [
        'string' => 'Pole :attribute musi mieć co najmniej :min znaków.',
    ],

    'attributes' => [
        'name' => 'nazwa',
        'district' => 'dzielnica',
        'address' => 'adres',
        'description' => 'opis',
        'body' => 'treść',
        'rating' => 'ocena',
        'status' => 'status',
        'visited_at' => 'data wizyty',
        'website' => 'strona internetowa',
        'cover_image' => 'zdjęcie okładkowe',
        'email' => 'e-mail',
        'password' => 'hasło',
        'current_password' => 'obecne hasło',
    ],
];
