@extends('userPanel.index')

@section('content')
    <div class="row justify-content-center">
        <form action="{{ route('cabinet.slots.spin') }}" method="POST">
            @csrf
            <input type="number" name="bet" min="0" step="0.1" required>
            <button type="submit" class="btn btn-success">spin</button>
        </form>
    </div>

    <div class="row justify-content-center">
        @if (isset($randomNumberArray))
            <div class="container mt-5">
                @foreach ($randomNumberArray as $key => $subArray)
                    <div class="row justify-content-center @if($key == 1) border border-5 @if($checkSpinResult > 0) border-success @else border-danger @endif  @endif">
                        @foreach ($subArray as $item)
                            <div class="col-1">
                                {{ $item }}
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Win: {{  session('checkSpinResult') }}
    <div class="row justify-content-end">
        @if( session('checkSpinResult') || session('checkSpinResult') == 0 )
            <button class="col-1 btn  @if(session('checkSpinResult') > 0) btn-success @else btn-danger @endif">
                Win: {{ session('checkSpinResult')}}
            </button>
        @endif
    </div> --}}




    <div class="row justify-content-end">
        @isset($checkSpinResult)
            <button class="col-1 btn  @if($checkSpinResult > 0) btn-success @else btn-danger @endif">
                Win: {{ $checkSpinResult }}
            </button>
        @endisset
    </div>

@endsection
