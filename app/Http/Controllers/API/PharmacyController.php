<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Pharmacy;
use App\User;
use Validator;
use Illuminate\Support\Facades\Storage;


class PharmacyController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pharmacies = Pharmacy::where('status', 1)
        						->get();

        foreach ($pharmacies as $pharmacy) {

            $pharmacy['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$pharmacy->profile_picture;
            $pharmacy['logo'] = $_ENV['APP_URL'].'/storage/pharmacies/logo/'.$pharmacy->logo;
            //$pharmacy['rating'] = $pharmacy->averageRating;
        }

        return $this->sendResponse($pharmacies, 'Pharmacies retrieved successfully.');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profilePharmacy($id)
    {

        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$pharmacy->profile_picture;
        $pharmacy['logo'] = $_ENV['APP_URL'].'/storage/pharmacies/logo/'.$pharmacy->logo;
        //$pharmacy['rating'] = $pharmacy->averageRating;

        return $this->sendResponse($pharmacy, 'Pharmacy retrieved successfully.');
    }
}
