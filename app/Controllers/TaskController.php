<?php

namespace App\Controllers;

use App\Models\Task;
use CodeIgniter\Controller;

class TaskController extends BaseController
{
    public function index()
    {
        $taskModel = new Task();
        $data['tasks'] = $taskModel->findAll();

        return view('task_list', $data);
    }

    public function store()
    {
        $description = $this->request->getPost('description');
    // Временная проверка
        $taskModel = new Task();
        
        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status'      => 'new'
        ];

        
        // Используем встроенную валидацию модели
        if (!$taskModel->save($data)) {
            // Если валидация не прошла, возвращаем ошибки в сессию
            return redirect()->back()->withInput()->with('errors', $taskModel->errors());
        }
        
        return redirect()->to('/tasks')->with('message', 'Задача создана!');
    }

    public function delete($id = null)
 {
    $taskModel = new Task();
    $taskModel->delete($id);
    
    return redirect()->to('/tasks')->with('message', 'Задача удалена');
 }


 public function edit($id = null)
    {
        $taskModel = new \App\Models\Task();
        $data['task'] = $taskModel->find($id);

        if (empty($data['task'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Задача не найдена');
        }

        return view('edit_task', $data);
    }

    public function update($id = null)
    {
        $taskModel = new \App\Models\Task();
        
        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status')
        ];

        if (!$taskModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $taskModel->errors());
        }

        return redirect()->to('/tasks')->with('message', 'Задача обновлена');
    }

    public function updateStatus($id = null, $newStatus = null)
{
    $taskModel = new \App\Models\Task();
    
    // Проверяем, что передан допустимый статус
    $allowed = ['new', 'todo', 'done'];
    if (!in_array($newStatus, $allowed)) {
        return redirect()->back()->with('errors', ['Неверный статус']);
    }

    $taskModel->update($id, ['status' => $newStatus]);

    return redirect()->to('/tasks')->with('message', 'Статус обновлен');
}







}