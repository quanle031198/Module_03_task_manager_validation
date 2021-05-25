<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.list', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }


    public function store(FormTaskRequest $request)
    {
        $task = new Task();
        $task->title = $request->input('title');
        $task->content = $request->input('content');

        // upload file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('image', 'public');
            $task->image = $path;
        }

        $task->due_date = $request->input('due_date');
        $task->save();

        //dung session de dua ra thong bao
        Session::flash('success', 'Tạo mới thành công');
        //tao moi xong quay ve trang danh sach task
        return redirect()->route('tasks.index');
    }


    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->title = $request->input('title');
        $task->content = $request->input('content');

        if ($request->hasFile('image')) {

            //xoa anh cu neu co
            $currentImg = $task->image;
            if ($currentImg) {
                Storage::delete('/public/' . $currentImg);

                // cap nhat anh moi
                $image = $request->file('image');
                $path = $image->store('image', 'public');
                $task->image = $path;
            }
        }
        $task->due_date = $request->input('due_date');
        $task->save();

        //dung session de dua ra thong bao
        Session::flash('success', 'Cập nhật thành công');
        //tao moi xong quay ve trang danh sach task
        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $image = $task->image;

        //delete image
        if ($image) {
            Storage::delete('/public/' . $image);
        }

        $task->delete();

        //dung session de dua ra thong bao
        Session::flash('success', 'Xóa thành công');
        //xoa xong quay ve trang danh sach task
        return redirect()->route('tasks.index');
    }
}
