<?php

namespace App\Http\Controllers;

use App\Action\Categories\CreateCategorie;
use App\Action\Categories\DeleteCategories;
use App\Action\Categories\GetCategories;
use App\Action\Categories\ListCategories;
use App\Action\Categories\updateCategories;
use App\Action\Data\CategoriesData;
use App\Http\Resources\CategorieResource;
use App\Models\Categorie;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelData\Exceptions\ValidationException;

/**
 * @OA\Info(title="My API", version="8.6")
 */

class CategorieController extends Controller
{



    /**
     * @OA\Get(
     *     path="/api/books",
     *     operationId="getbooks",
     *     tags={"books"},
     *     summary="Get list of books",
     *     @OA\Response(response="200", description="List of books")
     * )
     */




    public function __construct(

        protected CreateCategorie $createCategorie,
        protected DeleteCategories $deleteCategories,
        protected ListCategories $ListCategories,
        protected updateCategories $updateCategories,
        protected GetCategories $getCategories,




    ) {}



    public function index(): JsonResponse
    {

        $cate = $this->ListCategories->handel();
        return response()->json([
            "message" => "ok",
            "status" => true,
            "data" => CategorieResource::collection($cate),

        ], 200);
    }






    public function store(CategoriesData $categoriesData): JsonResponse
    {

        try {
            $cate = $this->createCategorie->handle($categoriesData);
            return response()->json([
                'message' => 'categories creted',
                'status' => true,
                'data' => new CategorieResource($cate),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'errors',
                'status' => false,
                'errors' => $e->getMessage()

            ], 500);
        }
    }



     public function show(Categorie $categorie):JsonResponse{


    try{
      $categorie=$this->getCategories->handel($categorie);
    return  response()->json([


    'message'=>'ok',
    'status'=>true,
    'data'=> new CategorieResource($categorie),
    ],200);


    }
    catch(\Exception $e){
    return  response()->json([


    'message'=>'not found',
    'status'=>false,

    'errors'=>$e->getMessage()],500);

    }

    }



    public function update(Request $request, Categorie $categorie): JsonResponse{


    try{
          $data=CategoriesData::from($request);

            $cate = $this->updateCategories->handel($categorie,$data);
    return response()->json([
    'message'=>'category update',
    'status'=>true,
    'data'=> new CategorieResource($cate),

    ],200);


    }


        catch(\Exception $e){


        return response()->json([
    'message'=>'error',
    'status'=>false,
    'errors'=>$e->getMessage()

    ],500);

        }


    }



    public function destroy(Categorie $categorie): JsonResponse{

        try{

    $this->deleteCategories->handel($categorie);

    return response()->json([204]);

        }catch(\Exception $e){



        return response()->json([
    'message'=>'error',
    'status'=>false,
    'errors'=>$e->getMessage()

    ],500);


        }
    }
}
