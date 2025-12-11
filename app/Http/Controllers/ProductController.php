<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Like;
use App\Models\Bookmark;
use App\Models\User;
use App\Mail\ToolSubmittedNotification;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allproducts = Product::where('status','pending')->get();
        return view('admin.catalogue.index', compact('allproducts'));
    }

    public function show($id){
        $product = Product::findOrFail($id);
        return view('admin.catalogue.show',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
    $categories = Category::all();
    return view('user.addproduct', compact('categories'));
    }

    public function create(Request $req)
    {
        $picturePath= null;
        if($req->hasFile('picture')){
            $picturePath = $req->file('picture')->store('products','public');
        }

        $documentPath = null;
        if($req->hasFile('tool_document')){
            $documentPath = $req->file('tool_document')->store('documents','public');
        }

        $product = Product::create([
            'name' => $req->name,
            'version' => $req->version,
            'category_id' => $req->category_id,
            'user_id' => auth()->id(),
            'description' => $req->description,
            'installation_steps' =>$req->installation_steps,
            'tool_document' => $documentPath,
            'picture' => $picturePath,
            'status' =>'pending'
        ]);

        // Send email to all admin users
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new ToolSubmittedNotification($product));
        }

        return back()->with('success', 'Tool submitted successfully! Admins will review your submission.'); 
    }

    public function publish($id){
        $product = Product::findOrFail($id);
        $product->status = 'approved';
        $product->save();
        return redirect()->route('catalogue');
    }

    public function reject($id){
        $product = Product::findOrFail($id);
        $product->status='rejected';
        $product->save();
         return redirect()->route('catalogue');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(Product $product)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit($id)
    // {
    //     $product = Product::findOrFail($id);
    //     return view('updateproduct', compact('product'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $req)
    {
        $picturePath= null;
        if($req->hasFile('picture')){
            $picturePath = $req->file('picture')->store('products','public');
        }

        $documentPath = null;
        if($req->hasFile('tool_document')){
            $documentPath = $req->file('tool_document')->store('documents','public');
        }

        Product::findOrFail($id)->update([
            'name' => $req->name,
            'version' => $req->version,
            'category_id' => $req->category_id,
            'description' => $req->description,
            'installation_steps' =>$req->installation_steps,
            'tool_document' => $documentPath,

            'picture' => $picturePath
        ]);

        $allproducts = Product::all();
        return view('catalogue', compact('allproducts'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return back();
    }

    public function showCategory($id){
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->where('status','approved')->get();
        return view('product.list', compact('category','products')); 
    }
    public function showdetail($category_id, $product_id){
         $product = Product::findOrFail($product_id);

         return view('product.showdetail', compact('product'));
    }

    public function toggleLike($product_id)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $product = Product::findOrFail($product_id);
        $like = Like::where('user_id', $user->id)
                     ->where('product_id', $product_id)
                     ->first();

        if ($like) {
            $like->delete();
            $isLiked = false;
        } else {
            Like::create([
                'user_id' => $user->id,
                'product_id' => $product_id
            ]);
            $isLiked = true;
        }

        $likeCount = $product->likes()->count();

        return response()->json([
            'isLiked' => $isLiked,
            'likeCount' => $likeCount
        ]);
    }

    public function toggleBookmark($product_id)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $product = Product::findOrFail($product_id);
        $bookmark = Bookmark::where('user_id', $user->id)
                             ->where('product_id', $product_id)
                             ->first();

        if ($bookmark) {
            $bookmark->delete();
            $isBookmarked = false;
        } else {
            Bookmark::create([
                'user_id' => $user->id,
                'product_id' => $product_id
            ]);
            $isBookmarked = true;
        }

        return response()->json([
            'isBookmarked' => $isBookmarked
        ]);
    }
}
