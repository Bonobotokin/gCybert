<div class="btn-list">

    <button type="button" class="btn btn-info waves-effect " data-toggle="modal" data-target="#newMateriels">Noveaux materiels</button>
</div>
<div class="table-responsive mg-t-10">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th> num </th>
                <th> Designation </th>
                <th> Conditionnement </th>
                <th> Totale </th>
                <th> Createur </th>
                <th> Date </th>
                <th class="text-center"> Action </th>
            </tr>
        </thead>
    
        <tbody>
            @foreach ($materiels as $data)
            <tr>
                <td>{{$data['id']}}</td>
                <td>{{$data['designation']}}</td>
                <td>{{$data['conditionnement']}}</td>
                <td>{{$data['totale']}} </td>
                <td>{{$data['personnel']}} </td>
                <td>{{$data['date']}} </td>
                <td class="material-design-btn text-center">

                    <a class="btn notika-btn-cyan waves-effect">Details</a>
                    <a class="btn notika-btn-indigo waves-effect">Modifier</a>
                    <a class="btn notika-btn-red waves-effect">Supprimer</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
