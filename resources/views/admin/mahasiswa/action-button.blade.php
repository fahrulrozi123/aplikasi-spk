<div class="button-list" data-id="{{$id}}" data-table-target="table-mahasiswa">
    <button type="button" class="btn btn-icon waves-effect waves-light btn-primary" data-toggle="modal" data-target="#detail" data-id="{{$id}}" onclick="Detail(this);"><i class="fa fa-eye"></i></button>
    {{-- <button type="button" class="btn btn-icon waves-effect waves-light btn-warning" data-toggle="modal" data-target="#edit-mahasiswa" onclick="return editDataUser(this);" ><i class="fa fa-edit"></i></button> --}}
    <button data-url="{{route('admin.mahasiswa.delete')}}" class="btn btn-icon waves-effect waves-light btn-danger" onclick="hapusData(this);"> <i class="fa fa-trash"></i> </button>
</div>