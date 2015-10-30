<?php

class BaseController extends Controller {
	
	public function __construct()
	{
		Validator::extend('file', function($attribute, $value, $parameters)
		{
			$permitidos = [
				'application/msword' => 'doc',
			        'application/pdf' => 'pdf',
			        'application/rtf' => 'rtf',
			        'application/vnd.kde.kspread' => 'ksp',
			        'application/vnd.kde.kword' => 'kwd',
			        'application/vnd.ms-excel' => 'xls',
			        'application/vnd.ms-excel.addin.macroenabled.12' => 'xlam',
			        'application/vnd.ms-excel.sheet.binary.macroenabled.12' => 'xlsb',
			        'application/vnd.ms-excel.sheet.macroenabled.12' => 'xlsm',
			        'application/vnd.ms-excel.template.macroenabled.12' => 'xltm',
				'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
			        'application/vnd.ms-word.document.macroenabled.12' => 'docm',
			        'application/vnd.ms-word.template.macroenabled.12' => 'dotm',
			        'application/vnd.ms-xpsdocument' => 'xps',
			        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
			        'application/vnd.openxmlformats-officedocument.wordprocessingml.template' => 'dotx',
			        'application/xml' => 'xml',
			        'image/bmp' => 'bmp',
			        'image/x-ms-bmp' => 'bmp',
			        'image/jpeg' => 'jpeg',
				'image/jpg' => 'jpg',
				'image/png' => 'png',
			];

    		return in_array($value, $permitidos);
		});
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
