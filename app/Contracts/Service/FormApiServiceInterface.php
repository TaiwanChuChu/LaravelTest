<?php

namespace App\Contracts\Service;

use Illuminate\Http\Request;

interface FormApiServiceInterFace
{
    public function store(Request $request);
    public function update(Request $request, $id);
    public function destroy($id);
}
