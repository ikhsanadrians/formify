<?php

namespace App\Http\Controllers;

use App\Http\Resources\FormDetailResource;
use App\Http\Resources\FormResource;
use App\Models\Form;
use App\Http\Requests\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FormController extends Controller
{ 

   public function index(){
       $forms = Form::get();
       
       return response()->json([
         'message' => 'Get all forms success',
         'forms' => FormResource::collection(auth()->user()->forms),
       ]);
   }
   
   
   public function store(FormRequest $request) : JsonResponse {
           $data = $request->all();
           $data['allowed_domains'] = json_encode($request->allowed_domains);
           $data['creator_id'] = auth()->user()->id;
           
           $form = Form::create($data);

           return response()->json([
            'message' => 'Create From Success',
            'form' => new FormResource($form),
           ]);
   }
   
   public function show(string $form) : JsonResponse {
        $form = Form::where('slug',$form)->first();
        if(!$form) return response()->json([
            'message' => 'Form not Found',        
        ],404);

        $allowed_domains = json_decode($form->allowed_domains);

        $user_domain = explode('@',auth()->user()->email)[1];

        if($allowed_domains && (!in_array($user_domain,$allowed_domains) && auth()->user()->id !== $form->creator_id)) return response()->json([
            'message' => 'Forbidden access',
        ],403);

        return response()->json([
            'message' => 'Get form success',
            'form' => new FormDetailResource($form),
        ]);
   }

}
                         