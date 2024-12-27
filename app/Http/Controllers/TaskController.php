<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreTaskRequest;
use Spatie\Permission\Middleware;

class TaskController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {

    $tasks = Task::with('user')->paginate(10);
    return view('tasks.index', compact('tasks')); 

    }

    // Menampilkan form pembuatan tugas
    public function create()
    {
        $Cate = Category::all();
        return view('tasks.create', compact('Cate')); // Tampilkan form untuk membuat tugas baru
    }

    // Menyimpan tugas baru
    public function store(StoreTaskRequest $request)
    {
        // Validasi input
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable',
            'category_id' => 'required',
            'status' => 'nullable',
        ]);

        // Simpan tugas ke database
        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dibuat');
    }

    // Menampilkan detail tugas berdasarkan ID
    public function show($id)
    {
        $tasks = Task::findOrFail($id); // Cari tugas berdasarkan ID
        return view('tasks.show', compact('tasks')); // Tampilkan detail tugas
    }

    // Menampilkan form edit tugas
    public function edit($id)
    {
        $tasks = Task::findOrFail($id); // Cari tugas berdasarkan ID
        return view('tasks.edit', compact('tasks')); // Tampilkan form edit tugas
    }

    // Memperbarui tugas
    public function update(Request $request, $id)
    {
        $tasks = Task::findOrFail($id); // Cari tugas berdasarkan ID

        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable',
        ]);

        // Update tugas di database
        $tasks->update($validated);

        return redirect()->route('tasks.show', $tasks->id)->with('success', 'Tugas berhasil diperbarui');
    }

    // Menghapus tugas
    public function destroy($id)
    {
        $tasks = Task::findOrFail($id); // Cari tugas berdasarkan ID
        $tasks->delete(); // Hapus tugas

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dihapus');
    }
    public function overdueTasks()
    {
        // Menggunakan scope untuk mendapatkan task yang overdue
        $overdueTasks = Task::overdue()->get();
        return view('tasks.overdue', compact('overdueTasks'));
    }

    public function softDelete($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->back()->with('message', 'Task berhasil dihapus.');
    }

    // Mengembalikan data yang dihapus
    public function restore($id)
    {
        $task = Task::withTrashed()->find($id);
        $task->restore();
        return redirect()->back()->with('message', 'Task berhasil dipulihkan.');
    }

    // Menghapus data secara permanen
    public function forceDelete($id)
    {
        $task = Task::withTrashed()->find($id);
        $task->forceDelete();
        return redirect()->back()->with('message', 'Task dihapus secara permanen.');
    }

    // Menampilkan semua task termasuk yang dihapus
    public function indexWithTrashed()
    {
        $tasks = Task::withTrashed()->get();
        return view('tasks.index', compact('tasks'));
    }

    // Menampilkan hanya task yang dihapus
    public function onlyTrashed()
    {
        $tasks = Task::onlyTrashed()->get();
        return view('tasks.index', compact('tasks'));
    }
}