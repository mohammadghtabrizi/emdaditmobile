<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $services = [

        1 => 'تعمیر پرینتر ، اسکنر ، کپی ، پلاتر',

        2 => 'شارژ کارتریج',

        3 => 'تعمیر کامپیوتر',

        4 => 'تعمیر لپ تاپ',

        5 => 'نصب و راه اندازی کامپیوتر و لپتاپ',

        6 => 'نصب و راه اندازی ماشین های اداری',

        7 => 'رفع ایرادنرم افزاری',

        8 => 'ویروس یابی'

    ];
	
	protected $citys = [
		
		1 => 'تهران',
		
		2 => 'تبریز'
		
		
	];
	
	
	protected $times = [
		
		1 => 'ساعت 9 الی 12',
		
		2 => 'ساعت 12 الی 16',
		
		3 => 'ساعت 16 الی 19'
		
	];
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
