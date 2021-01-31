<?php
namespace Modules\BASE\A01\Service\A01110\Web;

use Illuminate\Http\Request;
use App\Contracts\Service\FormServiceInterFace;

class A01110Service implements FormServiceInterFace
{
    public function index()
    {
        return \view('BASE_A01::A01110.index');
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
