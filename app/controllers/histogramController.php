<?php

class histogramController extends Controller {

    public function whateveryouwant()
    {
        //$draw_data=ResponseData::all();
        $draw_data=ResponseData::all()->lists("response_data");
        return View::make('histogram', compact('draw_data'));
    }
}
?>