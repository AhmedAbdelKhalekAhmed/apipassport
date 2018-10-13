<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Book;
use Validator;
class BookController extends BaseController
{
    //
    public function index(){

        $books=Book::all();
        return $this->sendResponse($books->toArray(),'Books read succesfully');
    }

    public function store(Request $request){
        $input=$request->all();
        $validator= Validator::make($input,[
            'name'=>'required',
            'details'=>'required',
        ]);

        if($validator->fails()){
            return $this->sendError('error validation',$vaidator->errors());
        }

        $book=Book::create($input);
        return $this->sendResponse($book->toArray(),'Book read succesfully');


    }

    public function show($id){
        $book=Book::find('$id');
        if(is_null($book)){
            return ('Book not found !');
        }
        
        return $this->sendResponse($book->toArray(),'Book read successfully');

    }

    public function update(Request $request, Book $book){
        $input=$request->all();
        $validator= Validator::make($input,[
            'name'=>'required',
            'details'=>'required',
        ]);

        if($validator->fails()){
            return $this->sendError('error validation',$vaidator->errors());
        }

        $book->name=$input['name'];
        $book->details=$input['details'];
        $book->save();

        return $this->sendResponse($book->toArray(),'Book update succesfully');

    }

    public function destroy(Book $book){
        $book->delete();
        return $this->sendResponse($book->toArray(),'Book deleted succesfully');

    }


}
