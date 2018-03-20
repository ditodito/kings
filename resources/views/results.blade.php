<?php
$total_score = 0;
?>

@extends('layouts.master')

@section('title', 'ტესტირების შედეგები')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>შეკითხვა</th>
                        <th>თქვენი პასუხი</th>
                        <th>სწორი პასუხი</th>
                        <th>ქულა</th>
                    </tr>
                    @foreach ($results as $key => $result)
                        <?php
                            if ($result->score == 1) {
                                $row_class = 'success';
                                $total_score++;
                            } else {
                                $row_class = 'danger';
                            }
                        ?>
                        <tr class="{{ $row_class }}">
                            <td>{{ ++$key }}</td>
                            <td>{{ $result->question }}</td>
                            <td>{{ $result->answer }}</td>
                            <td>{{ $result->correct_answer }}</td>
                            <td>{{ $result->score }}</td>
                        </tr>
                    @endforeach
                </table>
                <p class="text-muted" style="margin-bottom: 20px;">
                    {{ count($results) }} შესაძლებელი ქულიდან თქვენ დააგროვეთ {{ $total_score }} ქულა
                </p>
                {{ link_to('testing/reset', $title = 'სცადეთ თავიდან', $attributes = ['class' => 'btn btn-default']) }}
                {{ link_to('testing/export', $title = 'Export', $attributes = ['class' => 'btn btn-success pull-right']) }}
            </div>
        </div>
    </div>
@endsection