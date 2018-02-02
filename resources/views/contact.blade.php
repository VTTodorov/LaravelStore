@extends('layouts.app')


@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Contact</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-md-4 control-label">Name</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="title" id="title">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Email</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="title" id="title">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Message</label>
                <div class="col-md-6">
                    <textarea class="form-control" name="title" id="title" rows="20"></textarea>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary" name="button">Send</button>
        </div>
    </div>
@endsection
