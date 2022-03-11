<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gerenciador de Nota fiscais Xmlr</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        #frm-create-post label.error{
            color:red;
        }
    </style>
</head>

<body>
	
	<div class="container" style="margin-top: 50px;">
        <h4 style="text-align: center;">Gerenciador de Nota fiscais Xml</h4>

		@if($message = Session::get('error'))
			<div class="alert alert-danger alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>    
				<strong>{{ $message }}</strong>
			</div>
		@endif

        @if ($message = Session::get('success'))
			<div class="alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>    
				<strong>{{ $message }}</strong>
			</div>
        @endif


        <form action="{{ route('xml-upload') }}" id="frm-create-course" method="post">
           @csrf
            <div class="form-group">
                <label for="file">Select XML File:</label>
                <input type="file" class="form-control" required id="file" name="file">
            </div>

            <button type="submit" class="btn btn-primary" id="submit-post">Submit</button>
        </form>

		<div>
			<table class="table table-light">
				<thead class="thead-light">
					<tr>
						<th>id</th>
						<th>Total</th>
						<th>Logradouro</th>
						<th>Numero</th>
						<th>Bairro</th>
						<th>Municipio</th>
						<th>UF</th>
						<th>CEP</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($xml ?? [] as $datas)
						@php
							$xmlDataString = $datas->xml;
							$xmlObject = simplexml_load_string($xmlDataString);					
						@endphp
						<tr id="tr_xml">						
							<td scope="row">{{ $xmlObject->NFe->infNFe->attributes()->Id ?? '' }}</td>
							<td scope="row">{{ $xmlObject->NFe->infNFe->total->ICMSTot->vNF ?? '' }}</td>
							<td scope="row">{{ $xmlObject->NFe->infNFe->dest->enderDest->xLgr ?? '' }}</td>
							<td scope="row">{{ $xmlObject->NFe->infNFe->dest->enderDest->nro ?? '' }}</td>
							<td scope="row">{{ $xmlObject->NFe->infNFe->dest->enderDest->xBairro ?? '' }}</td>
							<td scope="row">{{ $xmlObject->NFe->infNFe->dest->enderDest->xMun ?? '' }}</td>
							<td scope="row">{{ $xmlObject->NFe->infNFe->dest->enderDest->UF ?? '' }}</td>
							<td scope="row">{{ $xmlObject->NFe->infNFe->dest->enderDest->CEP ?? '' }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
    </div>
</body>

</html>