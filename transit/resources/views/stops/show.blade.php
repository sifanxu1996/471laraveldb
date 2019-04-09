@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- display buses for stop -->

            <div class="card">
                <div class="card-header">
                    <h3>Schedule of Stop {{ $stops->id }} </h3>
                </div>

                <div class="card-body">
                    @if (!empty($all_at_stop))
                        @php
                            foreach ($all_at_stop as $aas) {
                                foreach ($runs_start_at as $dep ) {
                                    if ($dep->start_stop_id == $stops->id && $dep->id == $aas->id) {
                                        @endphp <article>
                                            <h3>
                                                Route {{ $aas->id }}: {{ $aas->name }}
                                            </h3>
                                                Times: 
                                            <ul> @php
                                        foreach ($runs as $run ) {
                                            if ($run->route_id == $aas->id) {
                                            @endphp    <li>{{ date( 'H:i', strtotime($run->start_time)) }}</li> @php
                                            }
                                        }
                                        @endphp </ul> </article> @php
                                    }
                                }
                                foreach ($route_legs as $route_leg ) {
                                    if ($aas->id == $route_leg->route_id) {
                                        @endphp <article>
                                            <h3>
                                                Route {{ $aas->id }}: {{ $aas->name }}
                                            </h3>
                                                Times:
                                            <ul> @php
                                        $trav_time = $route_leg->duration;
                                        $start_stop = $route_leg->start_stop_id;
                                        foreach ($routes as $route ) {
                                            if ($route->id == $route_leg->route_id) {
                                                $begin_at = $route->start_stop_id;
                                                break;
                                            }
                                        }
                                        while ($start_stop != $begin_at) {
                                            foreach ($route_legs_all as $piece ) {
                                                if ($piece->route_id == $route_leg->route_id && $piece->end_stop_id == $start_stop) {
                                                    $trav_time += $piece->duration;
                                                    $start_stop = $piece->start_stop_id;
                                                    break;
                                                }
                                            }
                                        }
                                        foreach ($runs as $run ) {
                                            if ($run->route_id == $aas->id) {
                                                @endphp <li>{{ date('H:i', strtotime('+'. $trav_time .' minutes', strtotime($run->start_time))) }}</li> @php
                                            }
                                        }
                                        @endphp </ul> </article> @php
                                    }
                                }
                            }
                        @endphp
                    @endif
                </div>

            </div>

            

        </div>
    </div>
</div>

@endsection