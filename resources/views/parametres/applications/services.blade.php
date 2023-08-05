<div class="btn-list">

    <button type="button" class="btn btn-primary waves-effect " data-toggle="modal" data-target="#newServices">Noveaux Services</button>
</div>
<div class="table-responsive mg-t-10">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th> num </th>
                <th> Designation </th>
                <th> Materiels </th>
                <th> Prix </th>
                <th> Createur </th>
                <th> Date </th>
                <th class="text-center"> Action </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($liste as $data)
            <tr>
                <td>{{$data['id']}}</td>
                <td>{{$data['designation']}}</td>
                <td> {{$data['materiels']}} </td>
                <td>{{$data['prix']}} Ar</td>
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
