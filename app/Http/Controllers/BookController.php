<?php

namespace App\Http\Controllers;

use App\Action\Book\CreateBook;
use App\Action\Book\DeleteBook;
use App\Action\Book\GetBook;
use App\Action\Book\ListBook;
use App\Action\Book\UpdateBook;
use App\Action\Data\BookData;
use App\Action\Filter\FilterBooks as FilterFilterBooks;

use App\Http\Resources\BookResource;
use App\Jobs\SendBookCreatedNotification;
use App\Models\Book;
use App\Traits\FileUpload;
// use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelData\Exceptions\ValidationException;

/**
 * @OA\Info(title="My API", version="8.6")
 */

class BookController extends Controller
{


    use FileUpload;
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
        protected FilterFilterBooks $filter



    ) {}



    public function filterbook(Request $request): JsonResponse
    {

        try {
        $filters = array_filter($request->only(['title', 'author', 'price_min', 'price_max']));

            if (empty($filters)) {
                return response()->json([
                    "message" => "filter  not found",
                    "status" => false,
                    "data" => []
                ], 400);
            }

        $booksQuery = $this->filter->handle($filters); // باید نام متد را صحیح کنید
        $books = $booksQuery->get(); // اجرای درخواست و دریافت کالکشن


            if ($books->isEmpty()) {
                return response()->json([
                    "message" => "books  not found",
                    "status" => false,
                    "data" => []
                ], 404);
            }



            return response()->json([
            "message" => "Books retrieved successfully",
            "status" => true,
            "data" => BookResource::collection($books),
        ], 200);

        } catch (\Exception $e) {


            return response()->json([
                'message' => 'errors',
                'status' => false,
                'errors' => $e->getMessage()

            ], 500);

        }
    }









    public function index(): JsonResponse
    {

       Gate::authorize('viewAny',Book::class);
        $book = $this->listBook->handel();
        return response()->json([
            "message" => "ok",
            "status" => true,
            "data" => BookResource::collection($book),

        ], 200);
    }






    // public function store(BookData $bookData, Request $request): JsonResponse
    // {
    //     try {

    //         $coverImageName = $this->UploadImage($request, 'cover_image');
    //         $bookData->cover_image = $coverImageName;

    //         $book = $this->createBook->handle($bookData);
    //         Gate::allows('create-books',$book);

    //         $categoryIds = $request->input('categorei_id');
    //         $book->categories()->attach($categoryIds);
    //         SendBookCreatedNotification::dispatch($book->title);

    //         Log::info("Job dispatched for book: {$book->title}");

    //         return response()->json([
    //             'message' => 'Book created successfully',
    //             'status' => true,
    //             'data' => new BookResource($book),
    //         ], 201);
    //     } catch (AuthorizationException $e) {
    //         return response()->json([
    //             'message' => 'You do not have permission to create a book.',
    //             'status' => false,
    //             'errors' => $e->getMessage()
    //         ], 403);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'An error occurred while creating the book',
    //             'status' => false,
    //             'errors' => $e->getMessage()
    //         ], 500);
    //     }
    // }


    public function store(BookData $bookData, Request $request): JsonResponse
    {
        try {
            // بررسی مجوز ایجاد کتاب
            Gate::authorize('create', Book::class);

            // بارگذاری تصویر جلد کتاب
            $coverImageName = $this->UploadImage($request, 'cover_image');
            $bookData->cover_image = $coverImageName;

            // ایجاد کتاب
            $book = $this->createBook->handle($bookData);

            // اتصال کتاب به دسته بندی‌ها
            $categoryIds = $request->input('categorei_id');
            $book->categories()->attach($categoryIds);

            // ارسال نوتیفیکیشن
            SendBookCreatedNotification::dispatch($book->title);

            Log::info("Job dispatched for book: {$book->title}");

            return response()->json([
                'message' => 'Book created successfully',
                'status' => true,
                'data' => new BookResource($book),
            ], 201);
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'You do not have permission to create a book.',
                'status' => false,
                'errors' => $e->getMessage()
            ], 403);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the book',
                'status' => false,
                'errors' => $e->getMessage()
            ], 500);
        }
    }


    //  public function show(Book $book):JsonResponse{


    // try{
    // $book=$this->getBook->handel($book);
    // return  response()->json([


    // 'message'=>'ok',
    // 'status'=>true,
    // 'data'=>BookResource::collection($book),
    // ],200);


    // }
    // catch(\Exception $e){
    // return  response()->json([


    // 'message'=>'not found',
    // 'status'=>true,

    // 'errors'=>$e->getMessage()],500);

    // }

    // }



    // public function update(Request $request, Book $book): JsonResponse{




    // try{
    //             $data = BookData::from($request->validated());

    //             $book = $this->updateBook->handel($book,$data);
    // return response()->json([
    // 'message'=>'book update',
    // 'status'=>true,
    // 'data'=>BookResource::collection($book),

    // ],200);


    // }
    // catch(ValidationException $e){


    //     return response()->json([
    // 'message'=>'validate error',
    // 'status'=>false,
    // 'errors'=>$e->validator->errors()->toArray(),

    // ],422);

    //     }

    //     catch(\Exception $e){


    //     return response()->json([
    // 'message'=>'error',
    // 'status'=>false,
    // 'errors'=>$e->getMessage()

    // ],500);

    //     }


    // }



    public function destroy(Book $book): JsonResponse{

        try{

            Gate::authorize('delete-books');
    $this->deleteBook->handel($book);

    return response()->json([204]);

        }



          catch(\Exception $e){



        return response()->json([
    'message'=>'fobiden',
    'status'=>false,
    'errors'=>$e->getMessage()

    ],403);

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
