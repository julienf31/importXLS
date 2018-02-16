<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Importation ficher excel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="row justify-content-md-center">
    <div class="m-4 col-10">
        <h2>Test d'importation de fichiers excel</h2>
        <hr>
        <div class="jumbotron">
            <p>Importation du fichier dans la base de donnée grace à la bibliotheque : <b>maatwebsite/excel</b></p>
        </div>
    </div>
</div>
<div class="row justify-content-md-center">
    <div class="m-4 col-10">
        <h3>Actions</h3>
        <hr>
        <a href="{{ route('read') }}" class="btn btn-success">Remplir la base</a>
        <a href="{{ route('clean') }}" class="btn btn-warning">Vider la base</a>
    </div>
</div>
<div class="row justify-content-md-center">
    <div class="m-4 col-10">
        <h3>Contenu de la base de donnée</h3>
        <hr>
        @if(sizeof($datas) > 0)
            <table  class="table">
                <thead>
                <th>SLC</th>
                <th>Date</th>
                <th>Lamp</th>
                <th>Volt</th>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{ $data['slc_number'] }}</td>
                        <td>{{ $data['date_time'] }}</td>
                        <td>{{ ($data['lamp_status'] == 'OFF') ? '<span class="text-danger">'.$data['lamp_status'].'</span>':'<span class="text-success">'.$data['lamp_status'].'</span>' }}</td>
                        <td>{{ $data['voltage'] }}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        @else
            No Data in database
        @endif
    </div>
</div>

</body>
</html>
