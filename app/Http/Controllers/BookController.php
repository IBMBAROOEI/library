<?php

namespace App\Http\Controllers;

use App\Action\Book\CreateBook;
use App\Action\Book\ListBook;
use App\Action\Book\DeleteBook;
use App\Action\Book\GetBook;
use App\Action\Book\UpdateBook;
use App\Action\Data\BookData;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


/**
 * @OA\Info(title="My API", version="8.6")
 */

class BookController extends Controller
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

    protected CreateBook $createBook,
        protected DeleteBook $deleteBook,
        protected ListBook $listBook,
        protected UpdateBook $updateBook,
        protected GetBook $getBook,



    ){}




    public function index():JsonResponse{


$book=$this->listBook->handel();
        return response()->json([
"message"=>"ok",
"status"=>true,
"data"=>BookResource::collection($book),

        ],200);
    }






    public function store(Request $request): JsonResponse{

try{

$data=BookData::from($request->all());

$book=$this->createBook->handle($data);
return response()->json([
'message'=>'book creted',
'status'=>true,
'data'=>BookResource::collection($book),

],201);


}
catch(ValidationException $e){


    return response()->json([
'message'=>'validate error',
'status'=>false,
'errors'=>$e->validator->errors()->toArray(),

],422);

    }

    catch(\Exception $e){


    return response()->json([
'message'=>'error',
'status'=>false,
'errors'=>$e->getMessage()

],500);

    }
    }
}
