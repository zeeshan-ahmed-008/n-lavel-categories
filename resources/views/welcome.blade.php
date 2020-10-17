<!DOCTYPE html>
<html>
    <head>
        <title>Dynamic dropdown</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body class="container">
        <div class="col-md-12 col-lg-12">
            {{-- begin::session message --}}
            @if(count($errors) > 0)
                    <div class="alert alert-danger  alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        @foreach($errors->all() as $error)
                                {{ $error }}<br>
                        @endforeach
                    </div>
                @endif
            @if ($message = Session::get('success'))
                <div class="alert alert-success  alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">×</button>   
                        <strong>{{ $message }}</strong>
                </div>
            @endif
            {{-- end::session message --}}
            {{-- begin::modal button --}}
            <div class="row text-right">    
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add New Menu</button>
            </div>
            {{-- end::modal button --}}

            <div class="row">
                <div class="col-md-12 text-center bg-primary">
                    <h2>Menu List</h2> 
                </div>
            </div>
            {{-- brgin::menu list --}}
            <ul>
                @foreach($menus as $menu)
                    <li>
                        {{ $menu->title }}
                        @if(count($menu->childs))
                            @include('manageChild',['childs' => $menu->childs])
                        @endif
                    </li>
                @endforeach
            </ul>
            {{-- end::menu list --}}
        </div>

        {{-- begin add mwnu modal --}}
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add New Menu</h4>
                    </div>
                    <form action="{{ route('menus.store')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control">   
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Parent</label>
                                        <select class="form-control" name="parent_id">
                                            <option selected disabled>Select Parent Menu</option>
                                            @foreach($allMenus as $key => $value)
                                                <option value="{{ $key }}">{{ $value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- add menu modal --}}
    </body>
</html>