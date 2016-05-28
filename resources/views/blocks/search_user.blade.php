{!! Form::open([
    'method' => 'get',
    'route' => $route
]) !!}
    <div class="col-md-6">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search for..." value="{!! $search !!}">
                <span class="input-group-btn">
                    <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
        </div>
    </div>
{!! Form::close() !!}