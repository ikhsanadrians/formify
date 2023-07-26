<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Models\Form;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuestionController extends Controller
{
   public function store(string $slug, QuestionRequest $request){
      $form  = Form::where('slug',$slug)->first();

      if(!$form) return response()->json([
         'message' => 'Form not found',
      ],404);

      if($form->creator_id !== auth()->user()->id) return response()->json([
          'message' => 'Forbidden access',     
      ],403);

      $question = Question::create([
         'form_id' => $form->id,
         'name' => $request->name,
         'choice_type' => $request->choice_type,
         'choices' => json_encode($request->choices),
         'is_required' => $request->is_required,
         
      ]);

      return response()->json([
        'message' => 'Add question success',
        'question' => new QuestionResource($question)
      ]);

   }
   
   public function destroy(string $slug, string $question_id) : JsonResponse {
        $form = Form::where('slug',$slug)->first();
        if(!$form)  return response()->json([
            'message' => 'Form Not Found',
        ],404);

        $question = $form->questions()->where('id',$question_id)->first();

        if(!$question)  return response()->json([
            'message' => 'Question not found',
        ],404);

        if($form->creator_id !== auth()->user()->id) return response()->json([
            'message' => 'Forbidden access',
        ],403);

        return response()->json([
            'message' => 'Remove question success',
        ]);
        
   }
     
}
