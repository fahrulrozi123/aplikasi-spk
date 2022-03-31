<!-- Modaltambah banner-->
<div class="modal" id="tambah-banner">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header mh-horison">
                <h2 class="modal-title col-lg-6"><strong>MANAGE BANNER</strong></h2>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('banner.insert') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
                        <div class="fileinput-new thumbnail" data-trigger="fileinput">
                            <img src="{{ asset('/images/dashboard/insert-here2.png') }}" class="shadow"
                                height="100" alt="image">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <br><br>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <span class="btn btn-file">
                                    <span class="btn btn-horison-gold fileinput-new">
                                        <i class='glyphicon glyphicon-circle-arrow-up'></i>
                                        Browse File
                                    </span>
                                    <span class="btn btn-cancel fileinput-exists">Change</span>
                                    <input type="file" name="img" accept="image/*" id="img" class="validateImage"
                                        onchange="fileValidation();">
                                </span>
                                <a href="#" class="btn btn-delete fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6" align="right" style="padding-right:27px;">
                                <a class="btn btn-cancel btn-lg fileinput-exists" data-dismiss="modal" href="#">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-horison-gold btn-lg fileinput-exists">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ModalEdit banner-->
<div class="modal" id="edit-banner">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header mh-horison">
                <h2 class="modal-title col-lg-6"><strong>EDIT BANNER</strong></h2>
            </div>

            <div class="modal-body">
                <div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
                    <div class="fileinput-new thumbnail" data-trigger="fileinput">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    <div>
                        <span class="btn btn-info btn-file">
                            <span class="fileinput-new"><i class='glyphicon glyphicon-circle-arrow-up'></i> Browse
                                File</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="..." accept="image/*">
                        </span>
                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                        <a class="btn btn-white btn-lg" data-dismiss="modal" href="#">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-info btn-lg fileinput-exists">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- modal delete --}}
<div id="delete-banner" class="modal">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-body">
                <form role="form" method="POST" action="{{ route('banner.delete') }}">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" id="delete-iddata" name="id" />
                    <h3><i class="text-danger fa fa-trash"></i> Confirm to Delete Banner</h3>
                    <h4>Are you sure you want to delete this Banner?</h4>
            </div>
            <div class="modal-footer">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-red btn-icon btn-sm icon-left" id="deletedata_mainmodal">
                        <strong>Delete</strong>
                        <i class="entypo-trash"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-icon btn-sm icon-left" data-dismiss="modal">
                        <i class="entypo-cancel"></i>
                        <strong>Cancel</strong>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- modal banner --}}
<!-- ModalEdit banner-->
<div id="edit-modal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header mh-horison">
                <h2 class="modal-title col-lg-6"><strong>MANAGE BANNER</strong></h2>
            </div>

            <div class="modal-body">
                <div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
                    <div class="thumbnail center-block" style="margin-left: 80px;margin-right: 80px;">
                        <img class="banner-img" id="gambar" src="" style="" alt="Banner">
                    </div>
                    <div>
                        <input type="hidden" id="banner_status" value="">
                    </div>
                </div>
                <h3><label for="">Choose Position of Your Banners!</label></h3>
                <div class="row" style="margin-left:10px">
                    <div class="col-lg-3">
                        <div id="banner_status_1" class="checkbox checkbox-replace color-primary">
                            <input type="radio" name="banner_status" value="1">
                            <label><strong>Primary</strong></label>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div id="banner_status_2" class="checkbox checkbox-replace color-primary">
                            <input type="radio" name="banner_status" value="2">
                            <label><strong>Secondary</strong></label>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div id="banner_status_3" class="checkbox checkbox-replace color-primary">
                            <input type="radio" name="banner_status" value="3">
                            <label><strong>Third</strong></label>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div id="banner_status_4" class="checkbox checkbox-replace color-primary">
                            <input type="radio" name="banner_status" value="4">
                            <label><strong>None</strong></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="id-data" />
                <button type="button" onclick="if(confirm('Are you sure?')) setBanner('delete');"
                    class="btn btn-delete btn-lg delete-modal">Delete</button>
                <a class="btn btn-cancel btn-lg" data-dismiss="modal" href="#"> Cancel </a>
                <button type="button" onclick="if(confirm('Are you sure?')) setBanner('update');"
                    class="btn btn-horison-gold btn-lg ">Save</button>
            </div>
        </div>
    </div>
</div>
