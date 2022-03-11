<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\XmlData;

class ReadXmlController extends Controller
{
    public function index(Request $request)
    {			
		if(isset($request['file'])){

			$CNPJ = '';
			$protocolo = 'vazio';

			$ext = pathinfo($request['file'], PATHINFO_EXTENSION);
			if($ext != 'xml'){
				return back()->with('error', 'Arquivo não é xml');
			}

			$xmlDataString = file_get_contents(public_path('/xml/'.$request['file']));
			$xmlObject = simplexml_load_string($xmlDataString);
			
			if(isset($xmlObject->infNFe->emit->CNPJ)){
				$CNPJ = $xmlObject->infNFe->emit->CNPJ;
			}else if(isset($xmlObject->NFe->infNFe->emit->CNPJ)){
				$CNPJ = $xmlObject->NFe->infNFe->emit->CNPJ;
			}
		
			if($CNPJ != '09066241000884'){
				return back()->with('error', 'CNPJ não é válido '.$CNPJ);
			}

			if(isset($xmlObject->protNFe->infProt->nProt)){
				$protocolo = $xmlObject->protNFe->infProt->nProt;
			}else if(isset($xmlObject->protNFe->infProt->nProt)){
				$protocolo = $xmlObject->protNFe->infProt->nProt;
			}
			
			if($protocolo == 'vazio'){
				return back()->with('error', 'Protocolo não é válido '.$protocolo);
			}

			$id = DB::table('xml_data')->insertGetId([
				'xml' => $xmlDataString
			]);

			$xml = DB::table('xml_data')->get();
			
			view("xml-data", compact('xml'));
		}
		$xml = DB::table('xml_data')->get();
        return view("xml-data", compact('xml'));
    }
}
