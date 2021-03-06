<?php

namespace Ajtarragona\Accede\Models; 

use Ajtarragona\Accede\Models\AccedeObject;
use Ajtarragona\Accede\Models\Request as AccedeRequest;
use Ajtarragona\Accede\Models\Security as AccedeSecurity;
use Ajtarragona\Accede\Models\Operation as AccedeOperation;
use Ajtarragona\Accede\Models\Response as AccedeResponse;


class AccedeProvider {
	
	protected $options;
	
	public function __construct($options=array()) { 
		$opts=config('accede');
		if($options) $opts=array_merge($opts,$options);
		$this->options= json_decode(json_encode($opts), FALSE);
	}


	protected function sendRequest($tobj, $cmd, $params=false,$options=[]){
		$apl="TER";
		$ver="2.0";
		if($options && is_array($options)){
			if(isset($options["apl"])) $apl=$options["apl"];
			if(isset($options["ver"])) $ver=$options["ver"];
		}

		$op=new AccedeOperation($apl,$tobj, $cmd,$ver);
		//dd($op);
		$sec=new AccedeSecurity($this->options);
		//dump($params);
		//dd($sec);
		$request = new AccedeRequest($op,$sec,$params,false,false,$options);
		//dump($request);
		$request->setWSUrl($this->options->ws_url."?wsdl");
		//dd($request);
		return $request->send();
	}
}
