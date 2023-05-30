<?php

use App\Http\Controllers\ProfileController;
use App\Models\Post;
use App\Resources\Make\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SIGA\Makes\Resources\MakeResource;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function (Request $request) {
    if ($resourse = app(PostResource::class)) {
        try {
            $resourse->init('Makes', 'makes');
            $sortable = $resourse->orderings;
            $data = array_merge(
                $resourse ->icon('fa-layer-group')->toArray(),
                app(Post::class)->query()->filter($request,$sortable)->paginate($request->query('perPage', 12))->toArray()
            );
            return response()->json($data);
        } catch (\Exception $ex) {
            return $this->PDOError($ex);
        }
    }
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
