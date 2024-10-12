@extends('layouts.app')


@section('title', 'The list of tasks')

@section('content')
        <nav class="mb-4">
            <a class="btn-task" href="{{ route('tasks.create') }}" class="link">Add Task!</a>
        </nav>

        @forelse ($tasks as $task)
                {{-- <div>{{$task->title}}</div> --}}
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}"
                @class(['font-bold' ,'line-through' => $task->completed])>{{ $task->title }}</a><br>
        @empty
            <div>There are no tasks!</div>
        @endforelse


        @if($tasks->count())
            <nav>
                {{ $tasks->links() }}
            </nav>
        @endif
@endsection

