@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <div class="mb-4">
        <a href="{{ route('tasks.index') }}" class="link">← Go back to the task list!</a>
    </div>

    <p class="mb-4 text-slate-700">{{ $task->description }}</p>

    @if ($task->long_description)
        <p class="mb-4 text-slate-700">{{ $task->long_description }}</p>
    @endif


    <p class="mb-4 text-sm text-slate-700">Created {{ $task->created_at->diffForHumans() }} • Updated {{ $task->updated_at->diffForHumans() }}</p>

    <p>
        @if($task->completed)
            <span class="font-medium text-green-500">Completed</span>
        @else
            <span class="font-medium text-red-500">Not completed</span>
        @endif
    </p>

<br>


<div>
    <a href="{{ route('tasks.edit', ['task'=>$task]) }}"
        class="btn-success">Edit</a>
</div>

<br>

<div>
    <form method="POST" action="{{ route('tasks.toggle-complete', ['task'=>$task])}}">
        @csrf
        @method('PUT')
        <button type="submit" class="btn-success">
            Mark as {{$task->completed ? 'not completed' : 'completed'}}
        </button>
    </form>
</div>


<div>
    <form action="{{ route('tasks.destroy', ['task'=> $task->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-cancel">Delete</button>
    </form>
</div>
@endsection
