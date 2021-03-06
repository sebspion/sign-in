@extends('layouts.app')

@section('page_title')
    Mon PIN
@endsection

@section('content')
    <h3>Mon PIN</h3>
    <p>
        Associé à votre carte RFID, le code PIN vous permet d'entrer dans le Hackerspace.
    </p>

    @if($member->pin)
        {!! BootForm::open(['model' => $member, 'update' => 'pin.update']) !!}

        {!! BootForm::password('old_pin', 'Code PIN actuel', array()) !!}
        {!! BootForm::password('pin', 'Nouveau code PIN', array()) !!}

        {!! BootForm::submit('Modifier le PIN') !!}

        {!! BootForm::close() !!}
    @else
        {!! BootForm::open(['post' => 'pin.create']) !!}

        {!! BootForm::password('pin', 'Code PIN', array(
            'help_text' => 'Choisissez 4 chiffres'
        )) !!}

        {!! BootForm::submit('Ajouter le PIN') !!}

        {!! BootForm::close() !!}
    @endif
@endsection
