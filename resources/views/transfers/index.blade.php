@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="offset-2 col-sm-8">
            <div class="card">
                <div class="card-header">
                    Suggest a New Transfer
                </div>

                <div class="card-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <form action="{{ url('transfer') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 col-form-label">Task</label>

                            <div class="col-sm-6">
                                <select type="text" name="task" id="task-name" class="form-control">
                                @if (count($tasks))
                                    @foreach($tasks as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>    
                                    @endforeach
                                @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="user-name" class="col-sm-3 col-form-label">To User</label>

                            <div class="col-sm-6">
                                <select type="text" name="user" id="user-name" class="form-control">
                                @if (count($users))
                                    @foreach($users as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>    
                                    @endforeach
                                @endif
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if (count($transfersTo) > 0)
                <div class="card mt-3">
                    <div class="card-header">
                        Incoming Transfers
                    </div>

                    <div class="card-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Date</th>
                                <th>Task</th>
                                <th>To User</th>
                                <th>Status</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($transfersTo as $item)
                                    <tr>
                                        <td class="table-text"><div>{{ date('j F Y', strtotime($item->created_at)) }}</div></td>
                                        <td class="table-text"><div>{{ $item->task()->first()->name }}</div></td>
                                        <td class="table-text"><div>{{ $item->to()->first()->name }}</div></td>
                                        <td class="table-text"><div>{{ $item->status }}</div></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if (count($transfersFrom) > 0)
                <div class="card mt-3">
                    <div class="card-header">
                        Outgoing Transfers
                    </div>

                    <div class="card-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Date</th>
                                <th>Task</th>
                                <th>To User</th>
                                <th>Status</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($transfersFrom as $item)
                                    <tr>
                                        <td class="table-text"><div>{{ date('j F Y', strtotime($item->created_at)) }}</div></td>
                                        <td class="table-text"><div>{{ $item->task()->first()->name }}</div></td>
                                        <td class="table-text"><div>{{ $item->to()->first()->name }}</div></td>
                                        <td class="table-text"><div>{{ $item->status }}</div></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
