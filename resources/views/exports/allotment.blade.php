@php
    $html = '';
@endphp
@foreach ($allotment as $year)
    @foreach ($year['data'] as $month)
        @php
            $thead = '';
            $tbody = '';
            $table_body = '<tbody>';
            $table_head = '<table>'.'<thead>'.
                   '<tr>
                        <td style="text-align: left;font-weight: bold;" colspan="31">'.$month['month'].' '.$year['year'].'</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;font-weight: bold;" colspan="31"> Opening Allotment : '.$month['opening_allotment'].'</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;font-weight: bold;" colspan="31"> Remaining Allotment : '.$month['remaining_allotment'].'</td>
                    </tr>
                    <tr>';
            $first_child1 = true;
            $insert_head = true;
        @endphp
        @foreach ($month['data'] as $room)
            @php
                $first_child2 = true;
                $n = 1;
            @endphp
            @foreach ($room['data'] as $allotment)
                @if($first_child1)
                @php
                    $thead = '<th style="width:20px">Room Type / Date</th>';
                    $thead .= '<th>'.$n.'</th>';
                    $first_child1 = false;
                @endphp
                @else
                @php
                    $thead .= '<th>'.$n.'</th>';
                @endphp
                @endif
                @if ($first_child2)
                    @php
                        $tbody = '<tr><td>'.$room['name'].'</td>';
                        $first_child2 = false;
                    @endphp                    
                @endif
                    @php
                        $tbody .= '<td>'.$allotment.'</td>';
                    @endphp
                @php
                    $n++;
                @endphp
            @endforeach
            @if ($insert_head)
                @php
                    $thead .='</tr></thead>';
                    $table_head .= $thead;
                    $insert_head = false;
                @endphp
            @endif
            @php
                $tbody .= '</tr>';
                $table_body .= $tbody;
            @endphp
        @endforeach
        @php
            $table_body .= '</tbody>';
            $html .= $table_head . $table_body . '</table>';
        @endphp
    @endforeach
@endforeach
{!! $html !!}