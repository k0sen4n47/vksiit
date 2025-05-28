<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Str;

class SubjectController extends Controller
{
    /**
     * Отображает форму создания нового предмета.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function createSubject()
    {
        // Получаем список преподавателей
        $teachers = User::where('role', 'teacher')->get();

        // Получаем список групп
        $groups = Group::all();

        // Передаем списки в представление
        return view('admin.subject.create', compact('teachers', 'groups'));
    }

    /**
     * Сохраняет новый предмет в базе данных.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeSubject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:subjects',
            'abbreviation' => 'required|string|max:255',
            'connections.*.teacher_id' => 'nullable|exists:users,id',
            'connections.*.group_id' => 'nullable|exists:groups,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $validator->validated();

        $subject = Subject::create(array_merge($data, ['image_path' => null]));

        // TODO: Handle connections saving

        return redirect()->route('admin.subjects.index')->with('success', 'Предмет успешно создан!');
    }

    /**
     * Отображает список всех предметов с возможностью фильтрации.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function indexSubjects(Request $request)
    {
        $query = Subject::query();

        // Фильтр по поиску по названию предмета
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%');
        }

        $subjects = $query->get();

        return view('admin.subject.index', ['subjects' => $subjects, 'request' => $request]);
    }

    /**
     * Отображает форму редактирования предмета.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Contracts\View\View
     */
    public function editSubject(Subject $subject)
    {
        return view('admin.subject.edit', compact('subject'));
    }

    /**
     * Обновляет данные предмета в базе данных.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSubject(Request $request, Subject $subject)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:subjects,name,' . $subject->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $subject->update($validator->validated());

        return redirect()->route('admin.subjects.index')->with('success', 'Предмет успешно обновлен!');
    }

    /**
     * Удаляет предмет из базы данных.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroySubject(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('admin.subjects.index')->with('success', 'Предмет успешно удален!');
    }
} 