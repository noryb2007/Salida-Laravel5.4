@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Listado de Productos</div>

                <div class="panel-body">
                    {!! Form::open(['route'=>'listProducts','method'=>'GET']) !!}
                    	<div class="row">
                    		<div class="col-xs-10">
                    			{!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Buscar por palabras...']) !!}
                    		</div>
                    		<div class="col-xs-2">
                    			{!! Form::submit('FILTRAR',['class'=>'btn btn-primary']) !!}
                    		</div>
                    	</div>
                    {!! Form::close() !!}

                    <table class="table table-hover table-striped">
                    	<thead>
                    		<tr>
                    			<th width="20px">ID </th>
                    			<th> Nombre Producto </th>
                    			<th> Autor </th>
                    		</tr>
                    	</thead>

                    	<tbody>
                    		@foreach($products as $product)
	                    		<tr>
	                    			<td>{{ $product->id }} </td>
	                    			<td>
	                    				<strong>{{ $product->name }}</strong>
	                    				{{ $product->short }}
	                    			</td>
	                    			<td>
	                    				{{ $product->user->name }}
	                    			</td>
	                    		</tr>
                    		@endforeach
                    	</tbody>
                    </table>
                    @if($paginate)	
                    	{!! $products->render() !!}
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
