@extends('layout.master');
@push('plugin-style')
    
@endpush
@section('content')
<div class="container-fluid">
    <div class="card mb-0">
        <div class="card-header">
            <h4 style="color: rgb(68, 219, 212)"></h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name="txtname" placeholder="Supplier Name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Phone No</label>
                                    <input class="form-control" name="txtphone" placeholder="Phone" required>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" name="txtaddress" placeholder="Address" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="txtemail" placeholder="Email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Note</label>
                                <textarea type="text" class="form-control" rows="3" name ="txtnote" placeholder="Note" ></textarea>
                            </div>
                        </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea type="text" class="form-control" rows="3" name ="txtdescription" placeholder="Description" ></textarea>
                                </div>
                            </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                            <label>Status</label>
                            <textarea class="form-control" rows="3" name="txtstatus" placeholder="Status"></textarea>
                            </div>
                        </div>
                        </div>
                        <div style="padding-left:40%">
                        <button type="submit" class="btn btn-success" name="txtsubmit">Submit</button>
                        <button type="reset" class="btn btn-primary">Reset</button>
                        <button type="reset" class="btn btn-info"><a class="text-white" href="{{url('supplier')}}">Cancel</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection