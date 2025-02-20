@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($message = Session::get('warning'))
                    <div class="alert alert-warning alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if (session('database_message'))
                    <script>
                        alert("{{ session('database_message') }}");
                    </script>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('til-accessories.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    @lang('crud.til_accessories_list.create_title')
                </h4>

                <form method="POST" action="{{ route('upload-accessories') }}" class="mt-4"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control" />
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            @lang('Excel Upload')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
