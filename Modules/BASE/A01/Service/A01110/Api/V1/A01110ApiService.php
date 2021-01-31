<?php
namespace Modules\BASE\A01\Service\A01110\Api\V1;

use Illuminate\Http\Request;
use App\Contracts\Service\FormApiServiceInterFace;

class A01110ApiService implements FormApiServiceInterFace
{
    public function store(Request $request)
    {
        dd('BASE Store API!');
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
