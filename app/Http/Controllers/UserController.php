<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function seeRegister(){
        return view('register');
    }

    public function faq(){
        return view('faq');
    }

    public function about(){
        return view('about');
    }

    public function seeLogin(){
        return view('login');
    }
    public function seeHome(){
        $categories = Category::all();
         return view('home', compact('categories'));
    }

    public function register(Request $req){
        $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8'
        ]);

        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => $req->password
        ]);

        Auth::login($user);
        $req->session()->regenerate();

        return redirect('/home');
    }


    public function login(Request $req){
        $req->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if (Auth::attempt($req->only('email', 'password'), $req->remember)) {
            $req->session()->regenerate();
            $user = Auth::user();

            return $user->role==='admin'? redirect('/admin/catalogue'):redirect('/home');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password',
        ]);

    }
    public function logout()
    {
        Auth::logout();

        return redirect('/home');
    }

    public function profile(){
        $user = auth()->user();
        $publishedTools = Product::where('user_id',$user->id)->get();
        $bookmarkedTools = $user->bookmarks()->with('product')->get()->pluck('product');
        $activity = Product::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->where('user_id', $user->id)
        ->groupBy('month')
        ->pluck('total', 'month');

       return view('user.profile', compact('user', 'publishedTools', 'bookmarkedTools', 'activity'));
    }

    public function deleteTool($toolId)
    {
        $tool = Product::find($toolId);
        
        if (!$tool || $tool->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $tool->delete();
        return response()->json(['success' => true]);
    }

    public function updateProfile(Request $req)
    {
        $user = auth()->user();
        
        $req->validate([
            'name' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($req->filled('name')) {
            $user->name = $req->name;
        }

        if ($req->hasFile('photo')) {
            $path = $req->file('photo')->store('photos', 'public');
            $user->photo = $path;
        }

        $user->save();
        
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
