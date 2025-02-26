<?php

namespace App\Http\Controllers;

use App\Action\Book\CreateBook;
use App\Action\Book\ListBook;
use App\Action\Book\DeleteBook;
use App\Action\Book\GetBook;
use App\Action\Book\UpdateBook;
use App\Action\Data\BookData;
use App\Http\Resources\BookResource;
// use Illuminate\Validation\ValidationException;
use Spatie\LaravelData\Exceptions\ValidationException;

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






    public function store( BookData $bookData): JsonResponse{

try{


$book=$this->createBook->handle($bookData);


return response()->json([
'message'=>'book creted',
'status'=>true,
'data'=> new BookResource($book),

],201);


} 

    catch(\Exception $e){


    return response()->json([
'message'=>'errors',
'status'=>false,
'errors'=>$e->getMessage()

],500);

    }
    }



 public function show(Book $book):JsonResponse{


try{
$book=$this->getBook->handel($book);
return  response()->json([


'message'=>'ok',
'status'=>true,
'data'=>BookResource::collection($book),
],200);


}
catch(\Exception $e){
return  response()->json([


'message'=>'not found',
'status'=>true,

'errors'=>$e->getMessage()],500);

}

}



public function update(Request $request, Book $book): JsonResponse{




try{
            $data = BookData::from($request->validated());

            $book = $this->updateBook->handel($book,$data);
return response()->json([
'message'=>'book update',
'status'=>true,
'data'=>BookResource::collection($book),

],200);


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



public function destroy(Book $book): JsonResponse{

    try{

$this->deleteBook->handel($book);

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
